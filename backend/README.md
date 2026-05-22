# Portfolio Backend (Render)

Minimal **PHP API** — no Yii2, no admin login page.

## Endpoints

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | API info (JSON) |
| GET | `/api/portfolio` | Portfolio data |
| POST | `/api/contact` | Send contact email |

## Render environment variables

| KEY | Example |
|-----|---------|
| `MAILER_DSN` | `smtp://developer.company2026@gmail.com:APP_PASSWORD@smtp.gmail.com:587` |
| `SENDER_EMAIL` | `developer.company2026@gmail.com` |
| `SENDER_NAME` | `LEGIT BUSINESS CONSULT LTD` |
| `CONTACT_EMAIL` | `developer.company2026@gmail.com` |
| `CORS_ORIGINS` | `https://your-app.vercel.app,https://portfolio-mbvg.onrender.com` |

## Local test

```bash
cd backend
composer install
php -S localhost:8080 -t public
```

Then open `http://localhost:8080/api/portfolio`.
