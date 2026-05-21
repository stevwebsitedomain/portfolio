# Append + Yii2 Advanced

## Muundo

- **Yii2 Advanced** — `backend/`, `common/`, `console/`, `frontend/`, `vendor/`
- **Template (PHP)** — `frontend/views/site/*.php`
- **Assets** — `frontend/web/assets/`
- **Forms** — `frontend/web/forms/`
- **HTML za zamani** — `_legacy_html/`

## XAMPP

Weka document root kwa:

`c:\xampp\htdocs\TEMPLATES - SITES\Append\frontend\web`

URL mfano:

- `http://localhost/` → ukurasa wa nyumbani
- `http://localhost/blog`
- `http://localhost/portfolio-details`

Hakikisha `mod_rewrite` imewashwa na `.htaccess` inaruhusiwa.

## Dev server (hiari)

```bash
cd "c:\xampp\htdocs\TEMPLATES - SITES\Append"
php yii serve --docroot=frontend/web --port=8080
```

Fungua: http://localhost:8080/

## Kurasa (PHP)

| URL | View |
|-----|------|
| `/` | `frontend/views/site/index.php` |
| `/blog` | `blog.php` |
| `/blog-details` | `blog-details.php` |
| `/portfolio-details` | `portfolio-details.php` |
| `/services-details` | `services-details.php` |
| `/starter-page` | `starter-page.php` |
