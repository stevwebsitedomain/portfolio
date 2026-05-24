# Portfolio Backend (Render)

Minimal **PHP API** — contact form email via **Gmail SMTP** (PHPMailer).

## Render environment variables

| KEY | Value |
|-----|--------|
| `GMAIL_APP_PASSWORD` | Gmail App Password (16 characters, spaces optional) |
| `SENDER_EMAIL` | `developer.company2026@gmail.com` |
| `SENDER_NAME` | `Steven Portfolio` |
| `CONTACT_EMAIL` | `developer.company2026@gmail.com` |
| `SMTP_USER` | `developer.company2026@gmail.com` (optional, defaults to SENDER_EMAIL) |

## Gmail App Password

1. Google Account → Security → 2-Step Verification (ON)
2. App passwords → create for "Mail" / "Render"
3. Copy 16-character password → paste into Render `GMAIL_APP_PASSWORD`
4. Redeploy

## SMTP settings (built-in)

- Host: `smtp.gmail.com`
- Port: `587`
- Encryption: TLS (STARTTLS)
- Auth: enabled

## Endpoints

| Method | Path | Description |
|--------|------|-------------|
| GET | `/api/contact` | Diagnostics |
| POST | `/api/contact` | Send contact email |

## Local test

```bash
cd backend
composer install
set GMAIL_APP_PASSWORD=your_app_password
php -S localhost:8080 -t public
```

**Note:** Render free tier may block outbound SMTP (ports 587/465). If SMTP fails with connection timeout, use a host that allows SMTP or a transactional email API.
