# Deploy kwenye Render — Yii2 Advanced (Portfolio)

## Tatizo uliloliona

```
DocumentRoot [/app/backend/web] does not exist
403 client denied by server configuration: /app/backend
```

Hii hutokea wakati Render inajenga kutoka folder **`backend` pekee**, lakini Dockerfile inatarajia **mradi mzima** kwenye `/app` (composer.json, vendor, frontend, backend).

---

## Portfolio website (https://portfolio-mbvg.onrender.com)

### Render Dashboard — weka hivi:

| Setting | Thamani |
|---------|---------|
| **Root Directory** | *(acha tupu — project root)* |
| **Runtime** | Docker |
| **Dockerfile Path** | `Dockerfile` |
| **Docker Build Context** | `.` |

Usiweke Root Directory = `backend` — hiyo ndiyo sababu ya error.

### Environment variables (optional)

| Key | Value |
|-----|-------|
| `YII_ENV` | `prod` |
| `YII_DEBUG` | `0` |

### Baada ya kubadilisha

1. **Manual Deploy** → Deploy latest commit
2. Subiri build imalize (composer install + php init)
3. Fungua: `https://portfolio-mbvg.onrender.com`

---

## Backend API (mbali — ikiwa unahitaji)

Unda **Web Service ya pili** au badilisha Dockerfile:

| Setting | Thamani |
|---------|---------|
| Root Directory | *(tupu)* |
| Dockerfile Path | `Dockerfile.backend` |

API URL: `https://YOUR-API.onrender.com/api/portfolio`

---

## Build error: `composer install` / `php init` exit code 1

Mara nyingi ni kwa sababu **`composer.lock` haikuwa kwenye GitHub** (ilikuwa kwenye `.gitignore`).

### Lazima upush hizi kwenye Git:

```bash
git add composer.lock Dockerfile .gitignore frontend/web/index.php frontend/web/robots.txt backend/web/index.php backend/web/robots.txt
git commit -m "Fix Render deploy: composer.lock and Dockerfile"
git push
```

Kisha **Manual Deploy** tena kwenye Render.
