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

The Yii2 API on Render is unchanged. Example endpoint:

`https://portfolio-mbvg.onrender.com/api/portfolio`

This frontend is independent; connect it later with JavaScript `fetch()` if needed for the assignment demo.

## Architecture

```text
Frontend (Vercel)  →  Static HTML/CSS/JS  (this folder)
Backend (Render)   →  Yii2 Advanced API   (repo root backend/)
```
