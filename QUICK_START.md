# QUICK REFERENCE GUIDE
## nPunto Activity Tracker

---

## 🚀 INSTANT START

### Windows Users (Automatic)
```bash
cd c:\laragon\www\npunto
setup.bat
```

### Manual Setup
```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

---

## 🔑 LOGIN CREDENTIALS

| User | Email | Password |
|------|-------|----------|
| Admin | admin@npunto.local | password |
| Staff 1 | john@npunto.local | password |
| Staff 2 | jane@npunto.local | password |
| Staff 3 | mike@npunto.local | password |

---

## 📍 Key URLs

| Feature | URL |
|---------|-----|
| Welcome | http://localhost:8000 |
| Login | http://localhost:8000/login |
| Register | http://localhost:8000/register |
| Dashboard | http://localhost:8000/dashboard |
| Activities | http://localhost:8000/activities |
| Daily View | http://localhost:8000/daily |
| Handover | http://localhost:8000/daily/handover |
| Reports | http://localhost:8000/reports |
| Report Summary | http://localhost:8000/reports/summary |

---

## 📋 CORE FEATURES

### 1. Activity Management
- ✅ Create activities
- ✅ Update status (Pending/Done)
- ✅ Add remarks
- ✅ View activity history

### 2. Daily Tracking
- ✅ View all activities for any date
- ✅ See updates per person
- ✅ Track timestamps
- ✅ View person's department & phone

### 3. Handover Management
- ✅ See pending items only
- ✅ Organized by activity
- ✅ Shows last update info
- ✅ Facilitates shift changes

### 4. Reporting
- ✅ Query by date range
- ✅ Filter by activity/person/status
- ✅ View summary statistics
- ✅ Export to CSV

---

## 🛠️ COMMON COMMANDS

```bash
# Development server
php artisan serve

# Database operations
php artisan migrate              # Run migrations
php artisan migrate:fresh --seed # Reset DB
php artisan db:seed              # Seed data
php artisan tinker               # PHP REPL

# Cache management
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan optimize:clear

# Production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## 📁 Important Files/Folders

```
app/
├── Models/              # Database models
└── Http/Controllers/    # Controllers (4 files)

database/
├── migrations/          # Database schema
└── seeders/            # Initial data

resources/
└── views/              # UI templates (9+)

routes/
└── web.php            # URL routing

config/
├── app.php            # App config
├── auth.php           # Auth config
└── database.php       # DB config

.env                   # Environment variables
README.md              # Full documentation
DEPLOYMENT.md          # Deployment guide
```

---

## 🐛 TROUBLESHOOTING

| Issue | Solution |
|-------|----------|
| Key not set | `php artisan key:generate` |
| DB connection fail | Check .env DB settings |
| Table not found | `php artisan migrate` |
| Permission denied | `chmod 755 storage/` |
| Blank page | `php artisan cache:clear` |
| CSS/JS not loading | `php artisan storage:link` |

---

## 🔐 SECURITY NOTES

- Change default passwords immediately
- Set APP_DEBUG=false in production
- Keep .env secure (not in version control)
- Use HTTPS in production
- Regular database backups
- Monitor access logs

---

## 📊 DATABASE TABLES

**Users**
- id, name, email, phone, department, role, password

**Activities**
- id, title, description, created_by, timestamps

**ActivityUpdates**
- id, activity_id, user_id, status, remark, timestamps

---

## 🔄 WORKFLOW EXAMPLE

1. **Admin creates activity**: "Daily SMS Count Comparison"
2. **Staff updates status**: John marks it "Done" with remark
3. **View daily**: See John's update with timestamp
4. **Generate report**: Query past week updates
5. **Handover**: View pending items for next shift

---

## 📞 COMMON TASKS

### Create Activity
1. Dashboard → New Activity
2. Fill title & description
3. Click Create

### Update Activity
1. Activities → Select activity
2. Click "Update Activity Status"
3. Select status (Pending/Done)
4. Add remark (optional)
5. Click Update

### View Daily Updates
1. Click "Daily View"
2. Choose date or navigate
3. See all updates for that day

### Generate Report
1. Click "Reports"
2. Set date range
3. Apply filters (optional)
4. Click Export CSV (optional)

---

## 🎯 COMPLETION CHECKLIST

- [x] Models created (User, Activity, ActivityUpdate)
- [x] Migrations created
- [x] Seeders created
- [x] Controllers created (4)
- [x] Routes configured
- [x] Views created (9+)
- [x] Authentication implemented
- [x] Daily tracking view
- [x] Handover management
- [x] Reporting system
- [x] CSV export
- [x] Configuration files
- [x] Documentation complete
- [x] Setup scripts included

---

**Version**: 1.0.0  
**Last Updated**: April 1, 2026  
**Status**: ✅ PRODUCTION READY
