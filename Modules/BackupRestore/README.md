# Backup & Restore Module

A comprehensive backup and restore solution for Laravel applications. This module provides a user-friendly interface to create, manage, and restore application backups.

## Features

### ✨ Core Features
- **Full System Backup** - Complete application backup (database + files)
- **Database Backup** - Export database with mysqldump or Laravel DB
- **Files Backup** - Backup storage, uploads, and custom directories
- **One-Click Restore** - Restore from any backup with safety checks
- **Backup Management** - View, download, delete, and validate backups
- **Real-time Progress** - Visual progress indicators for operations

### 🛡️ Security Features
- **Backup Validation** - Integrity checks before restore
- **Environment Masking** - Sensitive data protection in .env backups
- **Pre-restore Backup** - Automatic backup before restore operations
- **File Size Limits** - Configurable limits for backup files
- **Directory Exclusions** - Skip sensitive/large directories

### ⚙️ Advanced Features
- **Configurable Settings** - Extensive configuration options
- **Automatic Cleanup** - Keep only N most recent backups
- **Console Commands** - CLI support for automation
- **Error Handling** - Comprehensive error logging
- **Disk Space Monitoring** - Track backup storage usage

## Installation

The module is automatically enabled when created. Access it through:
```
/backuprestore
```

## Configuration

Edit the configuration file at `Modules/BackupRestore/config/config.php`:

```php
return [
    'max_backups' => 10,           // Keep 10 most recent backups
    'max_file_size' => 50485760,   // 50MB file size limit
    'exclude_directories' => [     // Directories to skip
        'node_modules',
        '.git',
        'vendor',
        // ...
    ],
];
```

### Environment Variables

Add these to your `.env` file:

```env
# Backup Settings
BACKUP_MAX_BACKUPS=10
BACKUP_MAX_FILE_SIZE=52428800
BACKUP_PATH=backups

# Database Settings
BACKUP_USE_MYSQLDUMP=true
BACKUP_DB_COMPRESS=true

# Security
BACKUP_ENCRYPT=false
BACKUP_BEFORE_RESTORE=true

# Performance
BACKUP_MEMORY_LIMIT=512
BACKUP_TIME_LIMIT=300
```

## Usage

### Web Interface

1. **Navigate** to Settings → Backup & Restore in the sidebar
2. **Create Backups** by clicking on backup type buttons
3. **Monitor Progress** with real-time progress bars
4. **Manage Backups** from the backup history table
5. **Restore Data** using the restore modal

### Console Commands

Create backups via command line:

```bash
# Full backup (database + files)
php artisan backup:run full

# Database only
php artisan backup:run database

# Files only
php artisan backup:run files
```

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/backuprestore` | Dashboard view |
| POST | `/backuprestore/backup/full` | Create full backup |
| POST | `/backuprestore/backup/database` | Create database backup |
| POST | `/backuprestore/backup/files` | Create files backup |
| POST | `/backuprestore/restore` | Restore from backup |
| DELETE | `/backuprestore/backup/delete` | Delete backup |
| GET | `/backuprestore/backup/download` | Download backup |

## File Structure

```
Modules/BackupRestore/
├── App/
│   ├── Http/Controllers/
│   │   └── BackupRestoreController.php
│   ├── Services/
│   │   └── BackupService.php
│   └── Console/
│       └── BackupCommand.php
├── config/
│   └── config.php
├── resources/views/
│   ├── index.blade.php
│   └── layouts/master.blade.php
├── routes/
│   └── web.php
└── README.md
```

## Backup Types

### Full Backup
- Complete application backup
- Includes database + files
- Compressed ZIP format
- Recommended for production

### Database Backup
- SQL dump of all tables
- Uses mysqldump if available
- Fallback to Laravel DB export
- Handles large databases efficiently

### Files Backup
- Storage directory backup
- Public uploads backup
- Environment file (masked)
- Custom directories from config

## Security Considerations

1. **Permissions** - Ensure proper file permissions (755/644)
2. **Storage Location** - Backups stored in `storage/app/backups`
3. **Sensitive Data** - Environment variables are masked
4. **Access Control** - Use Laravel permissions for access
5. **File Validation** - Backups validated before restore

## Troubleshooting

### Common Issues

**1. Backup Creation Fails**
- Check disk space availability
- Verify directory permissions
- Review Laravel logs for details

**2. MySQL Backup Issues**
- Ensure mysqldump is installed
- Check database credentials
- Falls back to Laravel DB export

**3. Large File Backup**
- Increase PHP memory limit
- Adjust max_file_size in config
- Use file exclusions for large directories

**4. Restore Fails**
- Validate backup integrity first
- Check available disk space
- Review restore error logs

### Log Files

Check these log files for debugging:
- `storage/logs/laravel.log` - General application logs
- Backup operations are logged with context

## Performance Tips

1. **Exclude Large Directories** - Skip unnecessary folders
2. **Use mysqldump** - Faster for large databases
3. **Set Memory Limits** - Adjust for large operations
4. **Regular Cleanup** - Maintain backup retention limits
5. **Schedule Wisely** - Run during low-traffic hours

## Contributing

1. Fork the module
2. Create feature branch
3. Make changes
4. Add tests if applicable
5. Submit pull request

## Support

For issues and questions:
1. Check the troubleshooting section
2. Review Laravel logs
3. Verify configuration settings
4. Test with smaller backup sets

## License

This module is open-sourced software licensed under the MIT license. 