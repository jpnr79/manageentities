# MariaDB & PHP-FPM 8.4 Tuning Package

Complete performance optimization configuration for GLPI 11 on:
- **MariaDB 11.4.7**
- **PHP 8.4.5 with FPM**
- **System**: 8GB RAM, 6 CPU cores

## 📦 Package Contents

```
tuning_configs/
├── deploy_tuning.sh              ← Automated deployment script (RUN THIS!)
├── TUNING_GUIDE.md              ← Comprehensive 1000-line guide
├── QUICK_REFERENCE.txt          ← Quick lookup tables
├── README.md                    ← This file
├── php-fpm-pool-www.conf        ← PHP-FPM pool configuration
├── php-optimized.ini            ← PHP core settings
├── opcache-optimized.ini        ← OPcache settings
└── mariadb-optimized.cnf        ← MariaDB settings
```

## 🚀 Quick Start (2 minutes)

### Option 1: Automatic Deployment (Recommended)

```bash
# On your GLPI server:
cd /var/www/glpi/plugins/tuning_configs
sudo bash deploy_tuning.sh
```

The script will:
✅ Backup all existing configurations  
✅ Apply all optimized settings  
✅ Create necessary log directories  
✅ Restart PHP-FPM and MariaDB  
✅ Verify services are running  

### Option 2: Manual Deployment

```bash
# 1. Backup existing configurations
sudo cp /etc/php/8.4/fpm/pool.d/www.conf /etc/php/8.4/fpm/pool.d/www.conf.bak
sudo cp /etc/mysql/mariadb.conf.d/50-server.cnf /etc/mysql/mariadb.conf.d/50-server.cnf.bak

# 2. Copy PHP-FPM pool config
sudo cp php-fpm-pool-www.conf /etc/php/8.4/fpm/pool.d/www.conf

# 3. Update PHP.ini
# Edit /etc/php/8.4/fpm/php.ini with values from php-optimized.ini

# 4. Update OPcache
# Edit /etc/php/8.4/fpm/conf.d/10-opcache.ini with values from opcache-optimized.ini

# 5. Update MariaDB
# Append mariadb-optimized.cnf to /etc/mysql/mariadb.conf.d/50-server.cnf

# 6. Restart services
sudo systemctl restart php8.4-fpm mariadb
```

## 📊 What Gets Optimized

### PHP-FPM Pool
| Setting | Before | After | Benefit |
|---------|--------|-------|---------|
| Max children | 5 | 30 | Handle 6x more concurrent users |
| Memory limit | 128M | 256M | Support GLPI + plugins |
| Upload limit | 2M | 512M | Large file imports |

### OPcache
| Setting | Before | After | Benefit |
|---------|--------|-------|---------|
| Memory | 128M | 256M | Cache more code |
| JIT | Off | Tracing | 2-9x speed improvement |
| Max files | 10000 | 20000 | Cache all GLPI files |

### MariaDB
| Setting | Before | After | Benefit |
|---------|--------|-------|---------|
| Buffer pool | Default | 4GB | Keep all data in RAM |
| Log size | Default | 512M | Large transactions |
| Connections | 151 | 200 | More concurrent users |

## 📈 Expected Performance Gains

After applying optimizations:

```
Dashboard load:        3-5s   → 1-2s   (50-70% faster)
Report generation:     30-60s → 10-20s (50-80% faster)
Search queries:        2-5s   → 0.5-1s (60-75% faster)
Concurrent users:      5-10   → 30-50  (3-5x more)
Large uploads:         Timeouts → Stable
```

## 🔍 Monitoring Performance

### Check PHP-FPM
```bash
# View current processes
ps aux | grep php-fpm | wc -l

# See slow requests (>5s)
sudo tail -f /var/log/php8.4-fpm-slow.log

# Check errors
sudo tail -f /var/log/php8.4-fpm-errors.log
```

### Check MariaDB
```bash
# See slow queries (>2s)
sudo tail -f /var/log/mysql/slow.log

# View running queries
mysql -u root -p -e "SHOW PROCESSLIST;"

# Check InnoDB buffer pool usage
mysql -u root -p -e "SHOW ENGINE INNODB STATUS\G"
```

### System Monitoring
```bash
# Real-time monitoring
htop

# Memory usage
free -h

# Network I/O
iftop

# Disk I/O
iostat -x 1
```

## 🛠️ Customization by System Size

### For 4GB RAM System
Reduce these values by 50%:
```
innodb_buffer_pool_size = 2G (from 4G)
opcache.memory_consumption = 128M (from 256M)
pm.max_children = 15 (from 30)
```

### For 16GB+ RAM System
Increase by 50-100%:
```
innodb_buffer_pool_size = 8G (from 4G)
opcache.memory_consumption = 512M (from 256M)
opcache.jit_buffer_size = 200M (from 100M)
pm.max_children = 50 (from 30)
```

## ⚠️ Troubleshooting

### High Memory Usage
```bash
# Check memory
free -h

# Reduce pool size
sudo sed -i 's/pm.max_children = 30/pm.max_children = 20/' /etc/php/8.4/fpm/pool.d/www.conf
sudo systemctl restart php8.4-fpm
```

### High CPU Usage
```bash
# Check CPU
top

# Increase workers
sudo sed -i 's/pm.max_children = 30/pm.max_children = 40/' /etc/php/8.4/fpm/pool.d/www.conf
sudo systemctl restart php8.4-fpm
```

### Slow Queries
```bash
# Check slow log
sudo tail -100 /var/log/mysql/slow.log

# Run analysis
mysql -u root -p < analyze_queries.sql
```

### PHP Processes Growing
```bash
# Restart sooner (recycle more frequently)
sudo sed -i 's/pm.max_requests = 500/pm.max_requests = 100/' /etc/php/8.4/fpm/pool.d/www.conf
sudo systemctl restart php8.4-fpm
```

## ↩️ Rollback Instructions

If you need to revert changes:

```bash
# Find backup files
ls -la /etc/php/8.4/fpm/pool.d/www.conf.bak.*
ls -la /etc/mysql/mariadb.conf.d/50-server.cnf.bak.*

# Restore PHP-FPM
sudo cp /etc/php/8.4/fpm/pool.d/www.conf.bak.20250209_000000 \
        /etc/php/8.4/fpm/pool.d/www.conf
sudo systemctl restart php8.4-fpm

# Restore MariaDB
sudo cp /etc/mysql/mariadb.conf.d/50-server.cnf.bak.20250209_000000 \
        /etc/mysql/mariadb.conf.d/50-server.cnf
sudo systemctl restart mariadb
```

## 📚 Documentation Files

| File | Purpose |
|------|---------|
| `TUNING_GUIDE.md` | 9000+ word comprehensive guide with theory and examples |
| `QUICK_REFERENCE.txt` | Quick lookup tables and formulas |
| `php-optimized.ini` | All PHP core settings with comments |
| `opcache-optimized.ini` | OPcache settings including JIT |
| `mariadb-optimized.cnf` | MariaDB InnoDB optimization |

## ✅ Pre-Deployment Checklist

- [ ] Server has root/sudo access
- [ ] System has 8GB+ RAM (adjust if less)
- [ ] MariaDB is running: `systemctl status mariadb`
- [ ] PHP-FPM is running: `systemctl status php8.4-fpm`
- [ ] GLPI is accessible
- [ ] Disk has 1GB free space
- [ ] Backups exist of current configs

## ✅ Post-Deployment Checklist

- [ ] PHP-FPM started successfully
- [ ] MariaDB started successfully
- [ ] GLPI dashboard loads without errors
- [ ] Test file upload (>100MB)
- [ ] Check slow query log: `tail /var/log/mysql/slow.log`
- [ ] Check PHP errors: `tail /var/log/php8.4-fpm-errors.log`
- [ ] Monitor memory for 10 minutes
- [ ] Verify process count: `ps aux | grep php-fpm | wc -l`

## 🔗 References

- [GLPI Project](https://glpi-project.org/)
- [PHP-FPM Documentation](https://www.php.net/manual/en/install.fpm.php)
- [MariaDB Documentation](https://mariadb.com/kb/en/)
- [OPcache Guide](https://www.php.net/manual/en/book.opcache.php)
- [MySQL Tuning Primer](https://launchpad.net/mysql-tuning-primer)

## 📞 Support

If you encounter issues:

1. **Check logs first**:
   ```bash
   sudo tail -50 /var/log/php8.4-fpm-errors.log
   sudo tail -50 /var/log/mysql/error.log
   ```

2. **Review TUNING_GUIDE.md** section 7-8 for troubleshooting

3. **Rollback if needed**:
   ```bash
   sudo cp /etc/php/8.4/fpm/pool.d/www.conf.bak.* /etc/php/8.4/fpm/pool.d/www.conf
   sudo systemctl restart php8.4-fpm
   ```

## 📝 Version History

- **v1.0** - December 9, 2025
  - Initial release
  - MariaDB 11.4.7 optimization
  - PHP 8.4.5 with JIT
  - GLPI 11.x compatible
  - 8GB RAM / 6 CPU cores

---

**System**: 8GB RAM, 6 CPU cores  
**MariaDB**: 11.4.7  
**PHP**: 8.4.5 (FPM)  
**GLPI**: 11.x  
**Created**: December 9, 2025  

🚀 **Ready to deploy? Run:** `sudo bash deploy_tuning.sh`
