# Strong Base Academy — Render Free Deployment Guide

Ye guide aapko batayegi kaise apni Laravel app Render pe **free** deploy karni hai.

⚠️ IMPORTANT: Ye "free demo" hosting hai — production/real business ke liye nahi.
- 15 min tak koi visit na ho to app "so jati hai" (agli visit pe 30-60 sec lagenge load hone mein)
- Sirf demo/portfolio dikhane ke liye best hai

---

## STEP 1: In 3 Files Ko Apne Project Mein Daalein

Is zip mein `Dockerfile`, `start.sh`, aur `.dockerignore` hain.
In teeno ko apne **project ke root folder** mein paste karein
(same level jahan `app`, `routes`, `composer.json` hain).

---

## STEP 2: GitHub Pe Push Karein

Apne project folder mein terminal khol kar:

```bash
git add .
git commit -m "Add Docker files for Render deployment"
git push
```

---

## STEP 3: Render Account Banayein

1. [render.com](https://render.com) pe jayein
2. **"Get Started"** → GitHub se signup karein (isse repo access khud mil jata hai)
3. Card ki zarurat nahi hai is step ke liye

---

## STEP 4: Database Banayein (Postgres)

Render MySQL free nahi deta, isliye **Postgres** use karenge
(Laravel dono support karta hai, code same rehta hai):

1. Render Dashboard → **"New +"** → **"PostgreSQL"**
2. Name: `strongbase-db`
3. Plan: **Free**
4. **"Create Database"**
5. Database create hone ke baad, **"Internal Database URL"** ya connection details
   (Host, Port, Database, Username, Password) copy kar lein — Step 6 mein chahiye honge

---

## STEP 5: Web Service Banayein

1. Render Dashboard → **"New +"** → **"Web Service"**
2. Apna GitHub repo select karein (`strongbase-academy`)
3. Settings:
   - **Name:** `strongbase-academy`
   - **Region:** Singapore (Pakistan se sabse close)
   - **Instance Type:** **Free**
   - Render khud Dockerfile detect kar lega

---

## STEP 6: Environment Variables Set Karein

Web service ke **"Environment"** tab mein ye variables add karein
(Database wale Step 4 se copy karein):

```
APP_NAME=Strong Base Academy
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com

DB_CONNECTION=pgsql
DB_HOST=<Render Postgres se Host>
DB_PORT=5432
DB_DATABASE=<Render Postgres se Database name>
DB_USERNAME=<Render Postgres se Username>
DB_PASSWORD=<Render Postgres se Password>

SESSION_DRIVER=database
```

---

## STEP 7: Deploy Karein

**"Create Web Service"** / **"Deploy"** dabayein. Render:
1. Aapki Dockerfile se image banayega
2. `start.sh` chalayega (jo migrations bhi kar dega automatically)
3. Live URL dega: `https://strongbase-academy.onrender.com`

Deploy hone mein 5-10 minute lag sakte hain (pehli dafa). Logs "Deploy" tab mein dekh sakte hain agar koi error aaye.

---

## STEP 8: Test Karein

- Public site: `https://your-app-name.onrender.com/`
- Admin: `https://your-app-name.onrender.com/login`
  - Email: `admin@strongbase.test`
  - Password: `password123`

---

## Agar Error Aaye

Render dashboard mein **"Logs"** tab kholein, jo error dikhe uska screenshot Claude ko bhej dein — exact fix bata dunga.

Common issues:
- **"Application key not set"** → APP_KEY env variable manually generate karke add karni pargi (agar auto-generate na ho, `php artisan key:generate --show` locally chala kar output paste kar dein APP_KEY variable mein)
- **Database connection error** → Environment variables (Step 6) dobara check karein, exact match hone chahiye Render Postgres details se
