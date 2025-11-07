# WordPress Resources Plugin

Custom plugin for the **Redding Designs – Junior Developer Challenge**.

It registers a `resource` post type and exposes the data through a custom REST endpoint so it can be consumed by a TypeScript frontend.

---

## What it does

- Registers a custom post type: **resource**
- Adds fields: `summary` and `level` (beginner / intermediate / advanced)
- Exposes a REST endpoint:

GET /wp-json/test/v1/resources

makefile
Copy code

Filtering:

GET /wp-json/test/v1/resources?min_level=intermediate



- Returns reading time (`reading_estimate`)
- If the user is not logged in, `summary` is hidden (`null`)

---

### Reading time calculation

The plugin returns a field called **`reading_estimate`**, which represents how many minutes it takes to read the summary.

Formula used:

`reading_estimate = ceil(total_words / 200)`


Reasoning:

- `200 words/minute` is a common reading speed benchmark.
- If there is no summary, the estimate is `0`.

Implementation (simplified):

```php
$words = str_word_count($summary);
$minutes = ceil($words / 200);
```

## Install

1. Copy the plugin folder into:

wp-content/plugins/

2. Activate it in:

`WordPress Admin → Plugins → Test Resources Plugin → Activate`

A sample resource is automatically created on activation.