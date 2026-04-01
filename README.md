# nPunto Activity Tracker

A comprehensive Laravel 11 application for tracking daily activities of application support team members with real-time status updates, reporting, and handover management.

## Features

✅ **Activity Management**
- Create and manage activities (e.g., "Daily SMS Count Comparison")
- Track activity descriptions and purposes

✅ **Activity Updates**
- Update activity status (Pending/Done)
- Add remarks/comments for each update
- Automatic timestamp capture
- Personnel bio details capture

✅ **Daily View**
- View all activities and updates for each day
- See personnel updates with timestamps
- Easy date navigation
- Handover view for pending items

✅ **Reporting & Analytics**
- Query activity histories with date range filters
- Filter by activity, person, and status
- Summary reports with trends
- Staff performance metrics
- Export to CSV

✅ **User Authentication**
- Secure login/register system
- Role-based access (admin/staff)
- User profiles with department info
- Session management

## System Requirements

- **PHP**: 8.2 or higher
- **MySQL**: 5.7 or higher (or SQLite for development)
- **Composer**: Latest version
- **Laravel**: 11.0

## Installation & Setup

### 1. Clone Repository
```bash
cd c:\laragon\www\npunto
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration

First, you'll need to create the `.env` file from the example:

```bash
# On Windows (PowerShell):
Copy-Item .env.example -Destination .env

# On Windows (Command Prompt):
copy .env.example .env
```

Edit the `.env` file with your database credentials:
```
APP_NAME="nPunto Activity Tracker"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=npunto
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
# This will set APP_KEY in your .env file
php artisan key:generate
```

### 5. Create Database

```bash
# Create a new MySQL database named 'npunto'
# Using phpMyAdmin or command line:
CREATE DATABASE npunto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Seed Initial Data

```bash
php artisan db:seed
```

This will create:
- Admin user: `admin@npunto.local` / `password`
- Three sample support staff members
- Five sample activities

## Running the Application

### Development Server

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

Alternatively, if using Laragon, navigate to the project and start the server through Laragon's interface.

## Default Credentials

**Admin Account:**
- Email: `admin@npunto.local`
- Password: `password`

**Staff Accounts:**
- john@npunto.local / password
- jane@npunto.local / password
- mike@npunto.local / password

⚠️ **Security Note**: Change these passwords immediately in production!

## Database Schema

### Users Table
- id
- name
- email
- password
- phone
- department
- role (admin/staff)
- timestamps

### Activities Table
- id
- title
- description
- created_by (FK to users)
- timestamps

### Activity Updates Table
- id
- activity_id (FK to activities)
- user_id (FK to users)
- status (pending/done)
- remark
- timestamps

## Application Structure

```
npunto/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── ActivityController.php
│   │   │   ├── DailyController.php
│   │   │   └── ReportController.php
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Activity.php
│       └── ActivityUpdate.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── auth/
│       ├── activities/
│       ├── daily/
│       └── reports/
├── routes/
│   └── web.php
├── config/
│   ├── app.php
│   ├── auth.php
│   └── database.php
└── public/
    └── index.php
```

## Usage Guide

### 1. Login
- Visit http://localhost:8000
- Click "Login"
- Enter credentials

### 2. Dashboard
- View quick statistics
- See recent activity updates
- Access quick action buttons

### 3. Create Activity
- Navigate to Activities → New Activity
- Enter title and description
- Click Create

### 4. Update Activity Status
- View specific activity
- Click "Update Activity Status"
- Select status (Pending/Done)
- Add remarks (optional)
- Submit

### 5. Daily View
- Navigate to "Daily View"
- Select or navigate to date
- See all updates for that day
- View personnel, status, time, and remarks

### 6. Handover View
- Click "View Handover (Pending Items)" from Daily View
- See pending activities for handover
- Facilitate shift transitions

### 7. Generate Reports
- Navigate to Reports
- Set date range
- Filter by activity, person, status
- Export to CSV

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /login | Login form |
| POST | /login | Process login |
| GET | /register | Registration form |
| POST | /register | Create new account |
| POST | /logout | Logout |
| GET | /dashboard | Dashboard |
| GET | /activities | List all activities |
| GET | /activities/create | Create activity form |
| POST | /activities | Store new activity |
| GET | /activities/{id} | View activity details |
| POST | /activities/{id} | Update activity status |
| GET | /daily | Daily view |
| GET | /daily/handover | Handover view |
| GET | /reports | Activity reports |
| GET | /reports/summary | Summary reports |
| GET | /reports/export | Export to CSV |

## Commands

### Useful Artisan Commands

```bash
# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Specific seeder
php artisan db:seed --class=UserSeeder

# Refresh database (WARNING: deletes all data)
php artisan migrate:refresh --seed

# Create backup
php artisan backup:run

# Check application status
php artisan tinker
```

## Troubleshooting

### Application key not set
```bash
php artisan key:generate
```

### Database connection refused
- Check MySQL is running (in Laragon, start MySQL)
- Verify DB_HOST, DB_PORT, and DB_NAME in .env
- Check DB_USERNAME and DB_PASSWORD are correct

### Migrations fail
```bash
# Reset and re-run
php artisan migrate:refresh --seed
```

### Clear cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Production Deployment

1. **Set environment to production**
   ```
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimize application**
   ```bash
   php artisan optimize
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Set proper permissions**
   ```bash
   chmod -R 755 storage/
   chmod -R 755 bootstrap/cache/
   ```

4. **Enable HTTPS**
   - Configure SSL certificate
   - Update APP_URL to https

5. **Setup automated backups**
   ```bash
   php artisan backup:run
   ```

## Security Recommendations

- [ ] Change all default passwords
- [ ] Update APP_KEY (already done via key:generate)
- [ ] Enable HTTPS in production
- [ ] Set APP_DEBUG=false in production
- [ ] Add rate limiting for login attempts
- [ ] Regular database backups
- [ ] Keep Laravel and dependencies updated
- [ ] Review and update .gitignore
- [ ] Use environment-specific .env files

## Performance Tips

- Enable query caching in config/database.php
- Use pagination for large datasets (already implemented)
- Create database indexes (already added)
- Use Laravel's cache features for reports
- Monitor slow queries in APP_DEBUG mode

## Support & Contributing

For issues or improvements, please contact the development team.

## License

Proprietary - nPunto Ltd.

---

**Version**: 1.0.0  
**Last Updated**: April 1, 2026
