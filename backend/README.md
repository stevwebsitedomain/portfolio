# Portfolio Backend (Render)

Minimal **PHP API** — Brevo HTTP API only (no SMTP).

## Endpoints

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | API info (JSON) |
| GET | `/api/portfolio` | Portfolio data |
| GET | `/api/contact` | Contact diagnostics (`mailReady`, transport) |
| POST | `/api/contact` | Send contact email via Brevo API |

## Render environment variables

| KEY | Value |
|-----|--------|
| `BREVO_API_KEY` | Brevo **API key** starting with `xkeysib-` (not `xsmtpsib-`) |
| `SENDER_EMAIL` | `developer.company2026@gmail.com` |
| `SENDER_NAME` | `LEGIT BUSINESS CONSULT LTD` |
| `CONTACT_EMAIL` | `developer.company2026@gmail.com` |

### Brevo setup

1. [brevo.com](https://www.brevo.com) → **Senders** → verify `developer.company2026@gmail.com`
2. **SMTP & API** → **API keys** → Generate → copy `xkeysib-...`
3. Render → **Environment** → `BREVO_API_KEY` → Save → **Redeploy**
4. Check: `https://portfolio-mbvg.onrender.com/api/contact` → `"mailReady": true`

## Local test

```bash
cd backend
composer install
php -S localhost:8080 -t public
```

Set `BREVO_API_KEY` in your shell, then POST to `http://localhost:8080/api/contact`.
