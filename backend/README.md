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
| `SMTP_USER` | `developer.company2026@gmail.com` |
| `SMTP_PASSWORD` | Gmail App Password (16 chars, no spaces) |
| `SMTP_HOST` | `smtp.gmail.com` |
| `SMTP_PORT` | `587` |
| `MAILER_DSN` | (optional) `smtp://user:pass@smtp.gmail.com:587` |
| `SENDER_EMAIL` | `developer.company2026@gmail.com` |
| `SENDER_NAME` | `LEGIT BUSINESS CONSULT LTD` |
| `CONTACT_EMAIL` | `developer.company2026@gmail.com` |

Open `https://portfolio-mbvg.onrender.com` — if `"mailConfigured": false`, set `SMTP_PASSWORD` on Render.

## Local test

```bash
cd backend
composer install
php -S localhost:8080 -t public
```

Then open `http://localhost:8080/api/portfolio`.
