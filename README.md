# Redding Designs — Junior Developer Technical Challenge

This repository contains:

| Folder     | Description                           |
|------------|---------------------------------------|
| `backend/`  | WordPress plugin (custom REST API)     |
| `frontend/` | Vite + TypeScript + Tailwind frontend  |

---

## 🚀 How to run

### Backend (WordPress)

1. Copy the plugin folder:

`backend/test-resources-plugin/`


Into:

`wp-content/plugins/`

2. Activate it:

`WordPress Admin → Plugins → Test Resources Plugin → Activate`


The API will be available at:

`/wp-json/test/v1/resources`


---

### Frontend (Vite)

```sh
cd frontend
npm install
npm run dev

App runs at:

http://localhost:5173
```
The frontend fetches data from the WordPress REST API automatically.

---
### API Example

GET `/wp-json/test/v1/resources?min_level=intermediate`


- Summary is only shown if authenticated in WordPress

- Includes reading_estimate (words ÷ 200)

### Stack

- WordPress (custom plugin)

- TypeScript

- TailwindCSS

- Vite