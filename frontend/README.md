# Resources Frontend (Vite + TypeScript + Tailwind)

Frontend application that consumes the custom WordPress API from the backend plugin.

---

## What it does

- Fetches WordPress resources from `/wp-json/test/v1/resources`
- Allows filtering by level: beginner / intermediate / advanced
- Displays cards with title, summary (if authenticated), level and reading time
- Has loading state during fetch operations

---

## Run locally (Vite)

```sh
cd frontend
npm install
npm run dev
This starts Vite at:

http://localhost:5173
If WordPress is running elsewhere, update the API URL in src/api.ts.

Build for production

npm run build
npm run preview

```
## Project structure

```sh
frontend/
 ├── src/
 │    ├── api.ts        → fetches resources
 │    ├── ui.ts         → renders cards
 │    └── main.ts       → handles events & loading state
 ├── index.html
 ├── vite.config.ts
 └── tailwind.config.js