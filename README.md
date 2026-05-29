# SMC Platform — Source Archive

A preservation snapshot of the **SMC platform**: a collection of related Laravel
(PHP) applications plus a few small demos and static sites. This repository
exists to keep the **source code** safe; it is not a deployable, ready-to-run
checkout — dependencies and secrets were intentionally left out (see below).

> **Status:** Archived snapshot, pushed 2026-05-29. Not actively maintained.

---

## What's in here

| Folder | composer name | Files | Notes |
|---|---|---:|---|
| `smc-laravel-8` | `smc-dev/smc-laravel-8` | 147 | Main Laravel app. Has `artisan`, `package.json`, and AWS `.ebextensions` (Elastic Beanstalk) config. |
| `smc-intranet-laravel` | `laravel/laravel` | 145 | Internal intranet app. Has `artisan` + `package.json`. |
| `smc-training` | `smc-dev/smc-training` | 78 | Training module (Laravel). |
| `smc-quizzes` | `smc-dev/smc-quizzes` | 67 | Quizzes app (Laravel). |
| `laravel-quiz-main-2` | `harishdurga/laravel-quiz` | 48 | Third-party Laravel quiz package ("Provides Quiz Functionality"). |
| `smc-erp` | `smc-dev/smc-erp` | 42 | ERP app (Laravel/PHP). |
| `smc-admin` | `smc-dev/smc-admin` | 28 | Admin panel (Laravel). |
| `demo-google-cloud-translate` | `smc-dev/demo-google-cloud-translate` | 7 | Google Cloud Translate demo (PHP). |
| `demo-email-reader` | — | 1 | Minimal email-reader demo (`src/index.php`). |
| `smc-jobs` | — | 6 | Static jobs site (`smc-jobs-static/` — HTML, images, logo). |
| `_demo` | — | 30 | Misc demo assets. |

**Root files:** `_test.php`, `style.css`, `SMC+Steve's+Chef+Logo.png`, `.gitignore`.

All `smc-dev/*` apps are built on Laravel. Total: **604 tracked files**.

> Note: `smc-front` and `smc-laravel` existed in the original tree but contained
> **no committable source** after exclusions (only ignored/empty content), so
> they are not present here.

---

## What was intentionally **excluded**

To keep the archive small and safe, the following were **not** committed. They
are listed in [`.gitignore`](.gitignore).

- **Dependencies (~9.8 GB)** — every `node_modules/` and `vendor/` directory.
  Regeneratable (see *Restoring* below).
- **Secrets** — all `.env` files, OAuth `*.key`/`*.pem` files, and a Google
  Cloud service-account JSON credential (`spring-cab-*.json`). These contain
  live credentials and were deliberately kept out of version control.
- **Large demo media (~450 MB)** — `DEMO*.pdf`, `DEMO*.key`, `*.pptx`.
- **Laravel runtime junk** — `storage/logs`, framework cache/sessions/views,
  `bootstrap/cache`.
- **OS / IDE cruft** — `.DS_Store`, `._*`, `.idea/`, `.vscode/`.

> ⚠️ Because secrets and large media were excluded, they exist **only** on the
> original source drive. If that drive is wiped, those files are gone — they are
> *not* recoverable from this repository.

---

## Restoring a working copy

For any of the Laravel apps:

```bash
cd <app-folder>
composer install           # restores vendor/
npm install                # restores node_modules/ (if package.json present)
cp .env.example .env        # then fill in real credentials
php artisan key:generate
```

You will need to **re-supply all secrets** (database creds, API keys, the Google
Cloud service-account file, OAuth keys) — none of them are in this repo.

---

## How this archive was created

1. Identified that the original ~10 GB folder was **~9.8 GB regeneratable
   dependencies** and only ~22 MB of actual source.
2. Copied the source to a clean staging area on the internal disk, excluding
   dependencies, secrets, and large media (the original external drive was 100%
   full, which blocked working in place).
3. Committed the source as a snapshot and pushed to GitHub over SSH.
4. GitHub push-protection flagged a Google Cloud service-account key that had
   been committed in plaintext; it was removed from the snapshot before the
   successful push.
