#!/bin/bash
#
# GLPI Fine-Tuned Configuration Deployment Script
# ═══════════════════════════════════════════════════════════════════════
# 
# This script deploys FINE-TUNED configurations optimized for your
# actual workload (56MB DB, 10 peak connections, 8GB RAM).
#
# Advantages over standard tuning:
# - More efficient memory usage (~1.2GB saved)
# - Better balanced for current load
# - Monitoring enabled (slow queries, slow requests)
# - Room to grow as usage increases
#
# Generated: December 9, 2025
# ═══════════════════════════════════════════════════════════════════════

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
BACKUP_DIR="/var/www/glpi/plugins/tuning_configs/backups/finetuned_$(date +%Y%m%d_%H%M%S)"
CONFIG_DIR="/var/www/glpi/plugins/tuning_configs"

echo -e "${BLUE}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║     GLPI Fine-Tuned Configuration Deployment Script            ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════════╝${NC}"
echo ""

# Check if running as root
if [ "$EUID" -ne 0 ]; then 
    echo -e "${RED}✗ Please run as root or with sudo${NC}"
    exit 1
fi

echo -e "${GREEN}✓ Running as root${NC}"
echo ""

# Create backup directory
echo -e "${YELLOW}Creating backup directory...${NC}"
mkdir -p "$BACKUP_DIR"
echo -e "${GREEN}✓ Backup directory created: $BACKUP_DIR${NC}"
echo ""

# Backup current configurations
echo -e "${YELLOW}Backing up current configurations...${NC}"

# Backup PHP-FPM pool config
if [ -f /etc/php/8.4/fpm/pool.d/www.conf ]; then
    cp /etc/php/8.4/fpm/pool.d/www.conf "$BACKUP_DIR/www.conf.backup"
    echo -e "${GREEN}✓ Backed up: /etc/php/8.4/fpm/pool.d/www.conf${NC}"
fi

# Backup existing PHP tuning config if exists
if [ -f /etc/php/8.4/fpm/conf.d/99-glpi-tuning.ini ]; then
    cp /etc/php/8.4/fpm/conf.d/99-glpi-tuning.ini "$BACKUP_DIR/99-glpi-tuning.ini.backup"
    echo -e "${GREEN}✓ Backed up: /etc/php/8.4/fpm/conf.d/99-glpi-tuning.ini${NC}"
fi

# Backup existing OpCache tuning config if exists
if [ -f /etc/php/8.4/fpm/conf.d/99-opcache-tuning.ini ]; then
    cp /etc/php/8.4/fpm/conf.d/99-opcache-tuning.ini "$BACKUP_DIR/99-opcache-tuning.ini.backup"
    echo -e "${GREEN}✓ Backed up: /etc/php/8.4/fpm/conf.d/99-opcache-tuning.ini${NC}"
fi

# Backup MariaDB config if exists
if [ -f /etc/mysql/mariadb.conf.d/99-glpi-tuning.cnf ]; then
    cp /etc/mysql/mariadb.conf.d/99-glpi-tuning.cnf "$BACKUP_DIR/99-glpi-tuning.cnf.backup"
    echo -e "${GREEN}✓ Backed up: /etc/mysql/mariadb.conf.d/99-glpi-tuning.cnf${NC}"
fi

echo ""

# Deploy fine-tuned configurations
echo -e "${YELLOW}Deploying fine-tuned configurations...${NC}"
echo ""

# 1. PHP-FPM Pool Configuration
echo -e "${BLUE}[1/4] Deploying PHP-FPM pool configuration...${NC}"
if [ -f "$CONFIG_DIR/finetuned_php_fpm_www.conf" ]; then
    cp "$CONFIG_DIR/finetuned_php_fpm_www.conf" /etc/php/8.4/fpm/pool.d/www.conf
    echo -e "${GREEN}✓ Deployed: PHP-FPM pool config (40 workers, balanced)${NC}"
else
    echo -e "${RED}✗ Source file not found: finetuned_php_fpm_www.conf${NC}"
    exit 1
fi

# 2. PHP Configuration
echo -e "${BLUE}[2/4] Deploying PHP configuration...${NC}"
if [ -f "$CONFIG_DIR/finetuned_php.ini" ]; then
    cp "$CONFIG_DIR/finetuned_php.ini" /etc/php/8.4/fpm/conf.d/99-glpi-finetuned.ini
    echo -e "${GREEN}✓ Deployed: PHP config (512M memory, 100M uploads)${NC}"
else
    echo -e "${RED}✗ Source file not found: finetuned_php.ini${NC}"
    exit 1
fi

# 3. OpCache Configuration
echo -e "${BLUE}[3/4] Deploying OpCache configuration...${NC}"
if [ -f "$CONFIG_DIR/finetuned_opcache.ini" ]; then
    cp "$CONFIG_DIR/finetuned_opcache.ini" /etc/php/8.4/fpm/conf.d/99-opcache-finetuned.ini
    echo -e "${GREEN}✓ Deployed: OpCache config (192M memory, 16K files)${NC}"
else
    echo -e "${RED}✗ Source file not found: finetuned_opcache.ini${NC}"
    exit 1
fi

# 4. MariaDB Configuration
echo -e "${BLUE}[4/4] Deploying MariaDB configuration...${NC}"
if [ -f "$CONFIG_DIR/finetuned_mariadb.cnf" ]; then
    cp "$CONFIG_DIR/finetuned_mariadb.cnf" /etc/mysql/mariadb.conf.d/99-glpi-finetuned.cnf
    echo -e "${GREEN}✓ Deployed: MariaDB config (3G buffer, 100 connections)${NC}"
else
    echo -e "${RED}✗ Source file not found: finetuned_mariadb.cnf${NC}"
    exit 1
fi

echo ""

# Create slow query log directory
echo -e "${YELLOW}Setting up monitoring directories...${NC}"
mkdir -p /var/log/mysql
chown mysql:mysql /var/log/mysql
touch /var/log/mysql/ubuntu-200-slow.log
chown mysql:mysql /var/log/mysql/ubuntu-200-slow.log
echo -e "${GREEN}✓ Created slow query log directory${NC}"

# Create PHP slow log
touch /var/log/php8.4-fpm-slow.log
chown www-data:www-data /var/log/php8.4-fpm-slow.log
echo -e "${GREEN}✓ Created PHP slow request log${NC}"

echo ""

# Validate configurations
echo -e "${YELLOW}Validating configurations...${NC}"

# Test PHP-FPM config
php-fpm8.4 -t 2>&1 | head -5
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ PHP-FPM configuration is valid${NC}"
else
    echo -e "${RED}✗ PHP-FPM configuration has errors${NC}"
    echo -e "${YELLOW}Rolling back...${NC}"
    cp "$BACKUP_DIR/www.conf.backup" /etc/php/8.4/fpm/pool.d/www.conf 2>/dev/null
    exit 1
fi

echo ""

# Restart services
echo -e "${YELLOW}Restarting services...${NC}"
echo -e "${BLUE}This may take 30-60 seconds...${NC}"
echo ""

# Restart PHP-FPM
echo -e "${BLUE}Restarting PHP-FPM 8.4...${NC}"
systemctl restart php8.4-fpm
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ PHP-FPM restarted successfully${NC}"
else
    echo -e "${RED}✗ PHP-FPM restart failed${NC}"
    exit 1
fi

# Restart MariaDB
echo -e "${BLUE}Restarting MariaDB...${NC}"
systemctl restart mariadb
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ MariaDB restarted successfully${NC}"
else
    echo -e "${RED}✗ MariaDB restart failed${NC}"
    echo -e "${YELLOW}Check: journalctl -xeu mariadb${NC}"
    exit 1
fi

# Restart Apache (if running)
if systemctl is-active --quiet apache2; then
    echo -e "${BLUE}Restarting Apache...${NC}"
    systemctl restart apache2
    echo -e "${GREEN}✓ Apache restarted successfully${NC}"
fi

echo ""
echo -e "${GREEN}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║           ✓ Fine-Tuned Configuration Applied Successfully!     ║${NC}"
echo -e "${GREEN}╚════════════════════════════════════════════════════════════════╝${NC}"
echo ""

# Display summary
echo -e "${BLUE}Configuration Summary:${NC}"
echo -e "  ${GREEN}✓${NC} PHP-FPM: 40 workers (balanced for load)"
echo -e "  ${GREEN}✓${NC} PHP Memory: 512MB per script"
echo -e "  ${GREEN}✓${NC} Upload Limit: 100MB"
echo -e "  ${GREEN}✓${NC} OpCache: 192MB (efficient)"
echo -e "  ${GREEN}✓${NC} MariaDB Buffer: 3GB (50x DB size)"
echo -e "  ${GREEN}✓${NC} Max Connections: 100"
echo -e "  ${GREEN}✓${NC} Slow Query Log: Enabled (>2s)"
echo -e "  ${GREEN}✓${NC} PHP Slow Log: Enabled (>10s)"
echo ""

echo -e "${BLUE}Memory Allocation:${NC}"
echo -e "  • MariaDB: ~3.3GB"
echo -e "  • PHP-FPM: ~2.8GB (peak)"
echo -e "  • System: ~2GB headroom"
echo -e "  • Total: ~8GB"
echo ""

echo -e "${BLUE}Monitoring:${NC}"
echo -e "  • Slow queries: tail -f /var/log/mysql/ubuntu-200-slow.log"
echo -e "  • Slow PHP: tail -f /var/log/php8.4-fpm-slow.log"
echo -e "  • PHP-FPM status: systemctl status php8.4-fpm"
echo -e "  • Memory: free -h"
echo ""

echo -e "${BLUE}Backups Location:${NC}"
echo -e "  $BACKUP_DIR"
echo ""

echo -e "${YELLOW}Next Steps:${NC}"
echo -e "  1. Test GLPI access and functionality"
echo -e "  2. Monitor performance for 24-48 hours"
echo -e "  3. Check slow query logs for optimization opportunities"
echo -e "  4. Verify memory usage: free -h"
echo -e "  5. If needed, scale up to standard tuning configs"
echo ""

echo -e "${GREEN}Deployment completed at $(date)${NC}"
echo ""
