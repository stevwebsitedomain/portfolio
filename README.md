# Steven Makarious — Portfolio

Two folders only:

| Folder | Host | Purpose |
|--------|------|---------|
| `portfolio-frontend/` | **Vercel** | Static portfolio website |
| `backend/` | **Render** | JSON API + contact email (no login, no Yii2) |

## Render backend

- URL: https://portfolio-ar0s.onrender.com
- Endpoints: `GET /api/portfolio`, `POST /api/contact`
- Env: `MAILER_DSN`, `SENDER_EMAIL`, `SENDER_NAME`, `CONTACT_EMAIL`

## Vercel frontend

Set API URL in `portfolio-frontend/js/config.js` → `apiBaseUrl`
