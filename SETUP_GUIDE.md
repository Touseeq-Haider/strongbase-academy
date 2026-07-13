# Strong Base Academy — Complete Setup Guide

Ye zip Module 1 se Module 8 (final polish) tak ka **poora project code** hai:
app/ (Controllers, Models, Middleware), database/ (migrations, seeder),
resources/views/ (saari pages), routes/web.php

⚠️ Isme Laravel ka core framework (vendor/, .env, artisan, composer.json waghera)
shamil NAHI hai — wo aapko khud fresh Laravel install se milega (Step 1 mein).

---

## STEP 1: Fresh Laravel Project Banayein

Apne computer pe (jahan Laragon/XAMPP hai), terminal kholein aur chalayein:

```
composer create-project laravel/laravel strongbase-academy
cd strongbase-academy
```

---

## STEP 2: Ye Zip Ki Files Copy Karein

Is zip ko extract karein. Andar jo folders hain (app, database, resources, routes),
unko apne naye Laravel project ke **same-naam folders** mein copy-paste karein —
jab "replace/overwrite" ka poochay to Yes/Replace kar dein.

| Zip mein | Apne project mein paste karein |
|---|---|
| app/ | [project]/app/ |
| database/ | [project]/database/ |
| resources/ | [project]/resources/ |
| routes/ | [project]/routes/ |

---

## STEP 3: Middleware Register Karein

`bootstrap/app.php` file kholein aur `withMiddleware()` section ko is tarah update karein:

```php
<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

---

## STEP 4: Database Setup (.env file)

`.env` file kholein, ye values set karein:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=strongbase_academy
DB_USERNAME=root
DB_PASSWORD=
```

Phir apne MySQL (phpMyAdmin ya terminal) mein database banayein:
```sql
CREATE DATABASE strongbase_academy;
```

Config cache clear karein:
```
php artisan config:clear
```

---

## STEP 5: Migrations + Seed Data Chalayein

```
php artisan migrate:fresh --seed --seeder=AcademySeeder
```

Isse tables ban jayengi + ek default admin account + 11 subjects seed ho jayenge.

---

## STEP 6: Laragon/MySQL Start Karein

Laragon kholein → "Start All" (ya sirf MySQL start) → status green hona chahiye.

---

## STEP 7: Server Chalayein

```
php artisan serve
```

Browser mein kholein:

- **Public Website:** http://127.0.0.1:8000/
- **Login Page:** http://127.0.0.1:8000/login

**Default Admin Login:**
- Email: `admin@strongbase.test`
- Password: `password123`

(Login ke baad "Change Password" se ise zaroor badal dein)

---

## Features List (Kya Kya Bana Hai)

1. Auth system — Admin/Tutor roles, login/logout, change password
2. Admin Panel — Students, Tutors CRUD, Subject-Tutor assignment
3. Tutor Panel — apne subjects dekhna, attendance mark karna, history
4. Fee Management — generate monthly fees, paid/partial/unpaid tracking,
   printable receipts, WhatsApp payment reminders, overdue alerts
5. Admission Inquiries — public form se aati hain, admin track karta hai
6. Professional Dashboard — Chart.js graphs (fee trend, students by level, attendance)
7. Public Website — premium animated homepage (dynamic subjects/tutors, admission form)

---

## Agar Koi Error Aaye

Screenshot/error message Claude ko bhej dein, fix kar diya jayega.
