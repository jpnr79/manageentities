#!/bin/bash
# Tuning script for MariaDB and PHP-FPM 8.4
# Usage: sudo bash deploy_tuning.sh

set -e

echo "=== MariaDB and PHP-FPM 8.4 Tuning Script ==="
echo ""

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Backup existing configurations
echo -e "${YELLOW}Backing up current configurations...${NC}"
cp /etc/php/8.4/fpm/pool.d/www.conf /etc/php/8.4/fpm/pool.d/www.conf.bak.$(date +%Y%m%d_%H%M%S)
cp /etc/mysql/mariadb.conf.d/50-server.cnf /etc/mysql/mariadb.conf.d/50-server.cnf.bak.$(date +%Y%m%d_%H%M%S)
cp /etc/php/8.4/fpm/php.ini /etc/php/8.4/fpm/php.ini.bak.$(date +%Y%m%d_%H%M%S)
echo -e "${GREEN}✓ Backups created${NC}"
echo ""

# Update PHP-FPM pool configuration
echo -e "${YELLOW}Updating PHP-FPM pool configuration...${NC}"
cat > /etc/php/8.4/fpm/pool.d/www.conf << 'PHPFPM_EOF'
[www]
user = www-data
group = www-data
listen = /run/php/php8.4-fpm.sock
listen.owner = www-data
listen.group = www-data

; Process Manager Configuration for 8GB RAM / 6 CPU cores
pm = dynamic
pm.max_children = 30
pm.start_servers = 10
pm.min_spare_servers = 5
pm.max_spare_servers = 20

; Process requests limits to prevent memory leaks
pm.max_requests = 500
pm.max_requests_grace_timeout = 30s

; Performance settings
request_slowlog_timeout = 5s
slowlog = /var/log/php8.4-fpm-slow.log

; Limits
request_terminate_timeout = 120s

; Environment variables for GLPI
env[GLPI_LOG_LEVEL] = WARNING
PHPFPM_EOF

php-fpm8.4 -t > /dev/null 2>&1 && echo -e "${GREEN}✓ PHP-FPM configuration is valid${NC}" || echo -e "${RED}✗ PHP-FPM configuration has errors${NC}"
echo ""

# Update PHP.ini settings
echo -e "${YELLOW}Updating PHP.ini settings...${NC}"
PHP_INI="/etc/php/8.4/fpm/php.ini"

# Create a function to safely update ini values
update_ini() {
    local key="$1"
    local value="$2"
    local file="$3"
    
    if grep -q "^$key" "$file"; then
        sed -i "s/^$key.*/$key = $value/" "$file"
    else
        echo "$key = $value" >> "$file"
    fi
}

update_ini "memory_limit" "256M" "$PHP_INI"
update_ini "max_execution_time" "300" "$PHP_INI"
update_ini "max_input_time" "300" "$PHP_INI"
update_ini "post_max_size" "512M" "$PHP_INI"
update_ini "upload_max_filesize" "512M" "$PHP_INI"
update_ini "max_input_vars" "5000" "$PHP_INI"
update_ini "default_charset" "UTF-8" "$PHP_INI"

echo -e "${GREEN}✓ PHP.ini updated${NC}"
echo ""

# Update OPcache settings
echo -e "${YELLOW}Updating OPcache settings...${NC}"
OPCACHE_INI="/etc/php/8.4/fpm/conf.d/10-opcache.ini"

update_ini "opcache.memory_consumption" "256" "$OPCACHE_INI"
update_ini "opcache.interned_strings_buffer" "16" "$OPCACHE_INI"
update_ini "opcache.max_accelerated_files" "20000" "$OPCACHE_INI"
update_ini "opcache.validate_timestamps" "0" "$OPCACHE_INI"
update_ini "opcache.revalidate_freq" "0" "$OPCACHE_INI"
update_ini "opcache.fast_shutdown" "1" "$OPCACHE_INI"
update_ini "opcache.enable_file_override" "1" "$OPCACHE_INI"
update_ini "opcache.huge_code_pages" "1" "$OPCACHE_INI"
update_ini "opcache.jit" "tracing" "$OPCACHE_INI"
update_ini "opcache.jit_buffer_size" "100M" "$OPCACHE_INI"

echo -e "${GREEN}✓ OPcache updated${NC}"
echo ""

# Update MariaDB configuration
echo -e "${YELLOW}Updating MariaDB configuration...${NC}"
cat >> /etc/mysql/mariadb.conf.d/50-server.cnf << 'MARIADB_EOF'

# Optimized settings for 8GB RAM / 6 CPU cores
max_connections = 200
max_allowed_packet = 256M
thread_cache_size = 10
table_open_cache = 4000

# InnoDB Settings
innodb_buffer_pool_size = 4G
innodb_log_file_size = 512M
innodb_flush_log_at_trx_commit = 2
innodb_file_per_table = 1
innodb_flush_method = O_DIRECT

# MyISAM (if needed)
key_buffer_size = 64M

# Query Optimization
query_cache_type = 0
query_cache_size = 0

# Temporary Tables
tmp_table_size = 128M
max_heap_table_size = 128M

# Slow Query Log
slow_query_log = 1
slow_query_log_file = /var/log/mysql/slow.log
long_query_time = 2
log_queries_not_using_indexes = 1

# Connection Settings
interactive_timeout = 28800
wait_timeout = 28800
net_read_timeout = 30
net_write_timeout = 60

# Sort and Join
sort_buffer_size = 4M
read_rnd_buffer_size = 2M
join_buffer_size = 4M
MARIADB_EOF

echo -e "${GREEN}✓ MariaDB configuration updated${NC}"
echo ""

# Create log directories if they don't exist
echo -e "${YELLOW}Creating log directories...${NC}"
mkdir -p /var/log/mysql
touch /var/log/php8.4-fpm-slow.log
touch /var/log/php8.4-fpm-errors.log
touch /var/log/php8.4-opcache-errors.log
chown mysql:mysql /var/log/mysql /var/log/mysql/slow.log 2>/dev/null || true
chown www-data:www-data /var/log/php8.4-fpm-slow.log /var/log/php8.4-fpm-errors.log /var/log/php8.4-opcache-errors.log 2>/dev/null || true
chmod 660 /var/log/php8.4-fpm-slow.log /var/log/php8.4-fpm-errors.log /var/log/php8.4-opcache-errors.log
echo -e "${GREEN}✓ Log directories created${NC}"
echo ""

# Restart services
echo -e "${YELLOW}Restarting PHP-FPM and MariaDB...${NC}"
systemctl restart php8.4-fpm
echo -e "${GREEN}✓ PHP-FPM restarted${NC}"

systemctl restart mariadb
echo -e "${GREEN}✓ MariaDB restarted${NC}"
echo ""

# Verify services are running
echo -e "${YELLOW}Verifying services...${NC}"
if systemctl is-active --quiet php8.4-fpm; then
    echo -e "${GREEN}✓ PHP-FPM is running${NC}"
else
    echo -e "${RED}✗ PHP-FPM is not running${NC}"
fi

if systemctl is-active --quiet mariadb; then
    echo -e "${GREEN}✓ MariaDB is running${NC}"
else
    echo -e "${RED}✗ MariaDB is not running${NC}"
fi
echo ""

# Display optimized settings
echo -e "${GREEN}=== Tuning Complete ===${NC}"
echo ""
echo "Key optimizations applied:"
echo "  PHP-FPM:"
echo "    - Max children: 30 (from 5)"
echo "    - Memory limit: 256M"
echo "    - Upload limit: 512M"
echo "    - OPcache memory: 256M with JIT enabled"
echo ""
echo "  MariaDB:"
echo "    - Buffer pool: 4GB (50% of RAM)"
echo "    - InnoDB log size: 512M"
echo "    - Max connections: 200"
echo ""
echo "Configuration backups saved to:"
echo "  - /etc/php/8.4/fpm/pool.d/www.conf.bak.*"
echo "  - /etc/mysql/mariadb.conf.d/50-server.cnf.bak.*"
echo ""
echo "Monitor performance with:"
echo "  tail -f /var/log/php8.4-fpm-slow.log"
echo "  tail -f /var/log/mysql/slow.log"
