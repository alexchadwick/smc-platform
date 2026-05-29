# SMC Platform — Source Archive

A preservation snapshot of the **SMC platform** monorepo: a collection of related
Laravel applications, a few React/Node front-ends, and some small standalone
demos. This repository exists to keep the **source code** safe; it is not a
deployable, ready-to-run checkout (dependencies and secrets were intentionally
left out — see below).

> **Status:** Archived snapshot, pushed 2026-05-29. Not actively maintained.

---

## What's in here

| Folder | Type | Notes |
|---|---|---|
| `smc-laravel-8` | Laravel (PHP) app | Main Laravel 8 application. Includes AWS `.ebextensions` (Elastic Beanstalk) config. |
| `smc-intranet-laravel` | Laravel (PHP) app | Internal intranet application. |
| `smc-admin` | Laravel (PHP) app | Admin panel. |
| `smc-training` | Laravel (PHP) app | Training module. |
| `smc-quizzes` | Laravel (PHP) app | Quizzes application. |
| `laravel-quiz-main-2` | Laravel (PHP) app | Secondary/variant quiz application. |
| `smc-erp` | React / Node app | Front-end app (`src/App.js`, `package.json`). |
| `smc-jobs` | Static HTML | Standalone `index.html` + `style.css`. |
| `smc-front` | Static HTML | Single `public/index.html`. |
| `smc-laravel` | Placeholder | Contains only a `README.md`. |
| `demo-google-cloud-translate` | PHP demo | Google Cloud Translate starter (`composer.json`). |
| `demo-email-reader` | PHP/Node demo | Small email-reader demo. |
| `_demo` | Misc demo assets | Node-based demo material. |
| `_MEETING` | Docs | Meeting notes / agenda (`notes.txt`, `meeting-2023.md`, `agenda.docx`). |
| `_test.php`, `style.css` | Root scratch files | Loose top-level files. |

All Laravel apps report `laravel/laravel` as their composer base.

---

## What was intentionally **excluded**

To keep the archive small and safe, the following were **not** committed. They
are listed in [`.gitignore`](.gitignore).

- **Dependencies (~9.8 GB)** — every `node_modules/` and `vendor/` directory.
  These are regeneratable (see *Restoring* below).
- **Secrets** — all `.env` files, OAuth `*.key`/`*.pem` files, and a Google
  Cloud service-account JSON credential (`spring-cab-*.json`). These contain
  live credentials and were deliberately kept out of version control.
- **Large demo media (~450 MB)** — presentation/exports such as `DEMO*.pdf`,
  `DEMO*.key`, and `*.pptx`.
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
composer install          # restores vendor/
npm install               # restores node_modules/ (if package.json present)
cp .env.example .env       # then fill in real credentials
php artisan key:generate
```

For the React/Node front-ends (`smc-erp`):

```bash
cd smc-erp
npm install
npm start
```

You will need to **re-supply all secrets** (database creds, API keys, the Google
Cloud service-account file, OAuth keys) — none of them are in this repo.

---

## How this archive was created

1. Identified that the original ~10 GB folder was **~9.8 GB regeneratable
   dependencies** and only ~22 MB of actual source.
2. Copied the source to a clean staging area, excluding dependencies, secrets,
   and large media (the original external drive was 100% full).
3. Committed the source as a single snapshot.
4. GitHub push-protection flagged a Google Cloud service-account key that had
   been committed in plaintext; it was removed from the snapshot before the
   successful push.

**603 source files** were preserved in the initial archive commit.
