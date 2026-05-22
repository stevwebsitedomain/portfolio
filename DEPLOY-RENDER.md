# Deploy Yii2 Backend on Render (Docker)

## Fixed issues

- Removed `php init --env=Production` from Docker build (interactive — fails on Render).
- Production config is copied from `environments/prod/` during build.
- Apache document root: **`/app/backend/web`**
- Composer only: `composer install` or `composer update` if lock file missing.

## Render settings

| Field | Value |
|-------|--------|
| Root Directory | *(empty)* |
| Dockerfile Path | `./Dockerfile` |
| Docker Context | `.` |
| Docker Command | *(empty)* |

## After deploy

- API: `https://YOUR-SERVICE.onrender.com/api/portfolio`
- Or: `https://YOUR-SERVICE.onrender.com/index.php?r=api/portfolio`

## Git push

```bash
git add Dockerfile backend/Dockerfile DEPLOY-RENDER.md render.yaml
git commit -m "Render: remove php init, backend/web, composer only"
git push
```

Then **Manual Deploy** on Render.

## Optional: commit composer.lock

Faster builds if `composer.lock` is in the repository.
