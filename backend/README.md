# Portfolio Backend (Render)

Minimal **PHP API** — no Yii2, no admin login page.

## Endpoints

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | API info (JSON) |
| GET | `/api/portfolio` | Portfolio data |
| POST | `/api/contact` | Send contact email |

## Email on Render (important)

**Render blocks outbound Gmail SMTP** (ports 587 and 465).  
`mailConfigured: true` with SMTP only means credentials exist — **email will still fail** on Render.

Use an **HTTP email API** instead (works on Render free tier):

### Option A — Brevo (recommended, works with Gmail sender)

1. Sign up at [brevo.com](https://www.brevo.com) (free).
2. **Senders** → verify `developer.company2026@gmail.com` (click link in inbox).
3. **SMTP & API** → create API key.
4. On Render → **Environment** → add:

| KEY | Value |
|-----|--------|
| `BREVO_API_KEY` | your Brevo API key (`xkeysib-...`) |
| `SENDER_EMAIL` | `developer.company2026@gmail.com` |
| `SENDER_NAME` | `LEGIT BUSINESS CONSULT LTD` |
| `CONTACT_EMAIL` | `developer.company2026@gmail.com` |

5. Redeploy. Open `https://portfolio-mbvg.onrender.com` — expect `"mailTransport": "brevo"`.

### Option B — Resend

| KEY | Value |
|-----|--------|
| `RESEND_API_KEY` | key from [resend.com](https://resend.com) |
| `SENDER_EMAIL` | verified sender (or `onboarding@resend.dev` for testing) |

### Local dev (XAMPP) — Gmail SMTP still OK

| KEY | Example |
|-----|---------|
| `SMTP_USER` | `developer.company2026@gmail.com` |
| `SMTP_PASSWORD` | Gmail App Password (16 chars, no spaces) |
| `SMTP_HOST` | `smtp.gmail.com` |
| `SMTP_PORT` | `587` |

## Local test

```bash
cd backend
composer install
php -S localhost:8080 -t public
```

Then open `http://localhost:8080/api/portfolio`.
