# Steven Makarious — Portfolio (Yii3)

Yii3 web application (`yiisoft/app`) organized like Yii2 **advanced**:

| Yii2 advanced | Yii3 in this repo |
|---------------|-------------------|
| `frontend/` | `src/Web/` + `public/` |
| `backend/` | `src/Backend/` (contact + portfolio API) |
| `common/` | `src/Shared/` |
| `console/` | `src/Console/` |
| `frontend/web/` | `public/` |

## XAMPP

Document root is `public/`, or open:

- http://localhost/MY-PORTIFOLIO/My-PortiFolio/
- http://localhost/MY-PORTIFOLIO/My-PortiFolio/public/

```bash
copy .env.example .env
composer install --no-dev --ignore-platform-reqs
```

GitHub must be reachable for Composer (this environment could not finish `vendor/` because `api.github.com` timed out).

Dev server:

```bash
php yii serve --docroot=public --port=8080
```

## Routes

| URL | Handler |
|-----|---------|
| `/` | `src/Web/HomePage` |
| `/about` `/projects` `/contact` `/services` `/news` `/gallery` `/qualifications` | matching `src/Web/*Page` |
| `GET /api/portfolio` | `src/Backend/Portfolio` |

Old static folders (`portfolio-frontend/`, `public_html_root/`) were removed. Yii3 serves the site from `public/`.
