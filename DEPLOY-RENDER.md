# Deploy Yii2 Advanced Backend on Render

## Critical: Root Directory

| Setting | Correct value | Wrong value |
|---------|---------------|-------------|
| **Root Directory** | *(empty)* | `backend` |
| **Dockerfile Path** | `backend/Dockerfile` | `Dockerfile` only if root empty |
| **Docker Build Context** | `.` | `backend` |

Yii2 Advanced needs `composer.json`, `common/`, and `vendor/` at **repository root**.

If Root Directory = `backend`, Docker only sees the `backend/` folder → **composer install fails** (no `composer.json`).

"Backend only" means Apache serves **`backend/web`**, not that Render root is the `backend` folder.

---

## Dockerfile (fixed)

- **PHP 8.2** (`yiisoftware/yii2-php:8.2-apache`)
- **Multi-stage build**: `composer:2.2` then Apache
- **No `php init`**
- **Composer**: `install --no-scripts` (fallback: `update`)
- **Entry point**: `/app/backend/web`

---

## Git — must include

```bash
git add composer.lock composer.json
git add backend/Dockerfile Dockerfile .dockerignore
git add backend/web/index.php backend/web/.htaccess backend/web/robots.txt
git add backend/config/main-local.php backend/config/params-local.php
git add common/config/main-local.php common/config/params-local.php
git add backend/controllers/ApiController.php
git commit -m "Fix Render: multi-stage Docker, PHP 8.2, composer.lock"
git push
```

`composer.lock` **must** be in GitHub.

---

## After deploy

- API: `https://YOUR-SERVICE.onrender.com/api/portfolio`
- Health: `https://YOUR-SERVICE.onrender.com/api/portfolio` (JSON)

---

## Free tier tips

- First build may take 5–10 minutes (composer download).
- Service sleeps after inactivity; first request may be slow.
