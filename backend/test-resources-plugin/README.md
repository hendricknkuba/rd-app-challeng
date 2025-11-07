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

## Install

1. Copy the plugin folder into:

wp-content/plugins/

2. Activate it in:

`WordPress Admin → Plugins → Test Resources Plugin → Activate`

A sample resource is automatically created on activation.