# Portfolio Backend (Render)

Minimal **PHP API** — Brevo HTTP API only (no SMTP).

## Endpoints

| Method | Path | Description |
|--------|------|-------------|
| GET | `/api/contact` | Diagnostics (`senderEmail`, `brevoKeyPrefix`, `mailReady`) |
| POST | `/api/contact` | Send contact email via Brevo API |

## Render environment variables

| KEY | Value |
|-----|--------|
| `BREVO_API_KEY` | Brevo **API key** starting with `xkeysib-` (not `xsmtpsib-`) |
| `BREVO_SENDER_EMAIL` | Verified sender in Brevo, e.g. `stevenabalwambo@gmail.com` |
| `SENDER_EMAIL` | Same as `BREVO_SENDER_EMAIL` |
| `SENDER_NAME` | `Steven Portfolio` |
| `CONTACT_EMAIL` | Where form messages are delivered |

### Brevo setup

1. [brevo.com](https://www.brevo.com) → **Senders** → verify `stevenabalwambo@gmail.com`
2. **SMTP & API** → **API keys** → Generate → copy `xkeysib-...`
3. Render → set `BREVO_API_KEY` and `SENDER_EMAIL=stevenabalwambo@gmail.com` → redeploy
4. Check GET `/api/contact`:
   - `"senderEmail": "stevenabalwambo@gmail.com"`
   - `"brevoKeyPrefix": "xkeysib-"`
   - `"brevoKeyLooksValid": true`

## 401 "Key not found"

Usually means:

- Wrong key type (`xsmtpsib-` SMTP key instead of `xkeysib-` API key)
- Invalid or revoked API key
- Extra spaces/quotes in Render env value

POST `/api/contact` returns the full `brevoResponse` body from Brevo for debugging.
