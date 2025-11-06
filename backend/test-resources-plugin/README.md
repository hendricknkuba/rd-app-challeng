# Test Resources Plugin

Custom WordPress plugin developed for the **Redding Designs - Junior Developer Technical Challenge**.

This plugin exposes a **headless-style API** for a custom post type `resource`, allowing a TypeScript frontend to consume the data.

---

## Features Implemented

| Requiriments | Status |
|----------|--------|
| Custom Post Type `resource` | ✅ |
| Meta fields: `summary` (text), `level` (enum) | ✅ |
| Seed data automatically created on plugin activation | ✅ |
| Custom REST endpoint `/wp-json/test/v1/resources` | ✅ |
| Query param `?min_level=` with ordering logic | ✅ |
| `reading_estimate` computed dynamically | ✅ |
| Auth gating (summary only shown when authenticated) | ✅ |
| Works with nonce + cookies (Thunder Client/Postman compatible) | ✅ |

---

## REST API Endpoint

GET  `/wp-json/test/v1/resources`

### Query Params

| Param | Values | Default | Behavior |
|-------|--------|----------|----------|
| `min_level` | beginner / intermediate / advanced | beginner | Returns resources with level >= `min_level` |

Example:

GET `/wp-json/test/v1/resources?min_level=intermediate`


---

## Reading Estimate (required by challenge)

Formula used:

```txt
reading_estimate = ceil(total_words / 200)
200 words/minute It's a real-world benchmark used by the industry to estimate reading time.

Implementation in the code:

$words = str_word_count($summary);
$minutes = ceil($words / 200);
```


### Authentication Behavior

| Request status | Summary returns |
|-------|--------|
| Unauthenticated user | `null`|
| Authenticated user | actual text of the summary |

### How to test authenticated

#### 1. Logged in 

Open in an incognito window:

`http://localhost/wordpress/wp-json/test/v1/resources`

#### 2. Not authenticated (Postman)

GET `http://localhost/wordpress/wp-json/test/v1/resources`

Required:

- `X-WP-Nonce` header

- `wordpress_logged_in_<hash>` cookie


Once those are included, the summary will be visible.

---

## Installation

Copy the folder:

`backend/test-resources-plugin/`


into:

`wp-content/plugins/`

In WordPress admin:

`Plugins → Test Resources Plugin → Activate`

A sample resource will be created automatically.
