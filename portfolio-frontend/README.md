# Portfolio Frontend (Static)

Static portfolio website for **Vercel** deployment. No PHP or Yii2 required.

## Structure

```text
portfolio-frontend/
├── index.html          # Main page
├── css/                # main.css, portfolio-custom.css
├── js/                 # main.js, contact-form.js
├── images/             # Logos, favicon, hero background
└── assets/vendor/      # Bootstrap, AOS, Swiper, icons, etc.
```

## Local preview

Open `index.html` directly in your browser, or run a simple server:

```bash
cd portfolio-frontend
npx serve .
```

## Vercel deployment

**Option A — Root directory (recommended)**

1. Connect this GitHub repo to Vercel.
2. Set **Root Directory** to `portfolio-frontend`.
3. Framework Preset: **Other** (static site).
4. Build Command: leave empty.
5. Output Directory: `.` (or leave default).

**Option B — Repo root**

The root `vercel.json` sets `"outputDirectory": "portfolio-frontend"` so you can deploy from the repository root without changing Root Directory.

## Backend API (Render)

Backend base URL is set in **`js/config.js`**:

```javascript
window.PORTFOLIO_CONFIG = {
  apiBaseUrl: 'https://portfolio-mbvg.onrender.com',
  endpoints: {
    portfolio: '/api/portfolio',
    requestPasswordReset: '/api/applicant/request-password-reset',
  },
};
```

| Endpoint | Method | Purpose |
|----------|--------|---------|
| `/api/portfolio` | GET | Portfolio JSON for this site |
| `/api/applicant/request-password-reset` | POST | Send reset email (`{ "email": "..." }`) |

Vercel serves only static files. All API calls go to Render using `config.js` + `api-portfolio.js`.

Admin login on Render root (`/`) is separate from the public API.

### Password reset email (Render)

Set environment variable on Render:

`MAILER_DSN=smtp://developer.company2026@gmail.com:YOUR_APP_PASSWORD@default`

Emails show sender name **LEGIT BUSINESS CONSULT LTD** (from `common/config/params.php`).

## Architecture

```text
Frontend (Vercel)  →  Static HTML/CSS/JS  (this folder)
Backend (Render)   →  Yii2 Advanced API   (repo root backend/)
```
