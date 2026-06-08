# Antigravity Developer & Optimization Guide

This guide is designed for **Antigravity** (the AI agent) and other developers working on the **lara_vasti_ganatri** (Laravel Vasti Ganatri - Census/Population Counter) project. It provides a map of the project structure, instructions for saving tokens during development, and strict guidelines for creating high-performance code optimized for slow internet connections.

---

## 1. Project Directory Structure Map

This is a **Laravel 12** project utilizing **Vite** and **Tailwind CSS v4**. To avoid wasting tokens listing directories or files, reference this layout:

```
lara_vasti_ganatri/
├── app/                      # Core application code
│   ├── Http/
│   │   ├── Controllers/      # Request handlers (e.g., Census/Population controllers)
│   │   └── Middleware/       # HTTP middleware
│   ├── Models/               # Eloquent models (e.g., User, Citizen, CensusRecord)
│   └── Providers/            # Service providers
├── bootstrap/                # Application bootstrapping and cache configurations
│   ├── app.php               # Route, middleware, and exception configurations
│   └── providers.php         # Registered service providers
├── config/                   # Configuration files (database, cache, mail, etc.)
├── database/                 # Database migrations, seeders, and factories
│   ├── factories/            # Model factories for testing
│   ├── migrations/           # Database schema definitions
│   └── seeders/              # Database seed files
├── public/                   # Publicly accessible assets (compiled CSS/JS, images)
├── resources/                # Source assets and templates
│   ├── css/                  # Source CSS files (e.g., app.css with Tailwind v4 imports)
│   ├── js/                   # Source JavaScript files (e.g., app.js, bootstrap.js)
│   └── views/                # Blade template files
├── routes/                   # Routing definitions
│   ├── console.php           # Artisan command routes
│   └── web.php               # Web routes (controllers and views)
├── storage/                  # App logs, file uploads, and compiled blade templates
├── tests/                    # PHPUnit feature and unit tests
├── .env.example              # Environment variables template
├── composer.json             # PHP dependencies and script configurations
├── package.json              # NPM dependencies and script configurations
└── vite.config.js            # Vite bundler configuration (incorporating Tailwind CSS v4)
```

---

## 2. Token-Saving Guidelines for Antigravity

To ensure maximum efficiency and prevent unnecessary token consumption, adhere to the following rules:

1. **Precision View**: When reading files, use `view_file` with explicit `StartLine` and `EndLine` parameters whenever possible. Do not read the entire file if you only need a specific method or section.
2. **Targeted Searching**: Use `grep_search` with specific query terms and file filters (e.g., target `*.php` in `app/` or `*.blade.php` in `resources/views/`) instead of broad recursive listing tools.
3. **Chunked Modifying**: Do not overwrite entire files. For single edits, use `replace_file_content`. For multiple edits across a file, use `multi_replace_file_content` with small, specific replacement chunks.
4. **Skip Standard Configs**: Avoid reading standard Laravel files (like `bootstrap/app.php`, `config/*.php`, or `vendor/` directories) unless you are explicitly debugging a configuration or library issue.
5. **No Redundant Explanations**: Do not output long introductory sentences or re-explain the modifications you make. Keep chat responses concise and clear.

---

## 3. Slow-Internet & High-Performance Coding Standards

We must ensure that the application loads and runs extremely fast, even on slow, high-latency internet connections (e.g., 2G/3G mobile networks in rural areas). 

### A. Frontend & Asset Optimization
* **Blade Templating Engine Only**: The frontend MUST be built using **Laravel Blade** templates. Do not use React, Vue, Svelte, or any other SPA/client-side rendering frameworks. All HTML pages must be server-side rendered (SSR) using Blade for maximum initial load performance and compatibility with low-bandwidth environments.
* **Tailwind CSS v4 & Vite Compilation**: Never import large, unminified CSS/JS libraries via third-party CDN links. Compile and bundle everything locally using Vite (`npm run build`). This enables tree-shaking, CSS purging, and minification.
* **Minimal JavaScript Payload**: Use **Alpine.js** or vanilla JS for interactive elements instead of heavy frontend frameworks. Keep `resources/js/app.js` as lightweight as possible.
* **Image Compression**: Use SVG for icons/illustrations. For raster images, use WebP format with high compression rates. Always specify width and height on images to prevent Layout Shifts (CLS).
* **Font Optimization**: Do not load massive font families. Use system fonts or embed a single optimized font file locally rather than making blocking HTTP requests to external font registries (like Google Fonts) on every page load.
* **Caching Headers**: Ensure standard assets are cached by the browser using long-lived headers (configured in the web server or Laravel's middleware).

### B. Database & Query Performance
* **Eager Loading**: Always prevent the N+1 query problem. When fetching models with relationships, use eager loading (e.g., `Citizen::with('district')->get()` instead of calling `$citizen->district->name` inside a loop).
* **Smart Migrations (Indexing)**: Add database indexes on columns frequently used in filtering (`where`), sorting (`orderBy`), and joins.
  ```php
  $table->index('district_id');
  $table->index('status');
  ```
* **Chunking Large Data Sets**: When dealing with large database tables (e.g., thousands of census records), never load everything using `all()` or `get()`. Use chunking or lazy collections:
  ```php
  Citizen::chunk(200, function ($citizens) {
      foreach ($citizens as $citizen) {
          // Process citizen
      }
  });
  ```
* **Select Only Required Fields**: Avoid `SELECT *`. Retrieve only the columns necessary for the view to reduce the memory footprint and network transmission size:
  ```php
  Citizen::select(['id', 'first_name', 'last_name'])->get();
  ```

### C. Backend (Laravel) Performance
* **Query Caching**: Cache expensive database queries or static list values (e.g., district lists, configuration values) using Laravel's Cache facade:
  ```php
  $districts = Cache::remember('districts', 3600, function () {
      return District::all();
  });
  ```
* **Route & Config Caching**: When deploying to production, always optimize configurations and routes:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
* **Avoid Bloated Responses**: Send compact JSON payloads in AJAX/API endpoints. Avoid nesting deep relational data structures unless requested.
* **Gzip/Brotli Compression**: Enable output compression (like Gzip or Brotli) in the web server configurations to compress HTML, CSS, and JS files sent over the network.

---

## 4. UI Design & Styling Standards

To ensure a premium, modern, and extremely responsive interface across all physical display dimensions—from the smallest feature phone to a large-scale projector—abide by the following design system.

### A. Responsive & Layout Rules (Omnidevice Scaling)
1. **Fluid Scaling**: Avoid absolute pixel sizes (`px`) for dimensions, spacing, and font sizing. Use relative units (`rem`, `em`, `%`, or `viewport units` like `vw`/`vh`). For fluid typography, use CSS `clamp()`:
   ```css
   font-size: clamp(1rem, 2.5vw, 2.5rem);
   ```
2. **Keypad & Feature Phones (≥240px)**: 
   - Optimize touch targets (minimum `44px` height/width) for keypads/trackpads and mobile touch input.
   - Use container padding rules that shrink dynamically on micro-screens (e.g., `px-2` on mobile, `px-6` on tablet).
   - Ensure the page can be fully navigated using keyboard/focus tabs.
3. **Ultra-Wide Screens & Projectors (up to 4K/8K)**:
   - Always wrap content layouts in a centered container with a maximum width limit (e.g., `max-w-7xl` or `max-w-[1440px] mx-auto`) to prevent elements from stretching excessively and losing readable proportion.
   - Use high-contrast ratios (minimum 4.5:1 for body text, 3:1 for headings) so layouts remain crisp and legible when projected on large screens under high ambient light.
4. **Tailwind Breakpoints**: Leverage standard breakpoints starting from `xs` (320px) up to `2xl` (1536px), and override/extend them if needed for custom micro-screens or projectors.

### B. Strict Color System
To keep the branding premium, cohesive, and consistent, use the following strict color palette. Access these variables in CSS/Tailwind:

| Role | Color Value (Hex) | Description / Tailwind Class |
| :--- | :--- | :--- |
| **Primary (Brand)** | `#4f46e5` (Indigo 600) / `#6366f1` (Indigo 500) | Main actions, branding elements, primary buttons. |
| **Primary Hover** | `#4338ca` (Indigo 700) | Hover state for primary actions. |
| **Secondary (Accents)** | `#0d9488` (Teal 600) / `#14b8a6` (Teal 500) | Secondary buttons, badges, status indicators. |
| **Neutral Background (Light Mode)** | `#f8fafc` (Slate 50) | Main background for pages. |
| **Card / Container Background** | `#ffffff` (White) | Content boxes, tables, form background. |
| **Neutral Dark (Dark Mode Background)** | `#0f172a` (Slate 900) | Main background for dark mode. |
| **Dark Card Background** | `#1e293b` (Slate 800) | Containers / cards in dark mode. |
| **Text Primary** | `#0f172a` (Slate 900) / `#f8fafc` (Slate 50 in Dark Mode) | Headers, bold labels, main readability body. |
| **Text Secondary** | `#475569` (Slate 600) / `#94a3b8` (Slate 400 in Dark Mode) | Subtitles, helper texts, table headers. |
| **Alert/Error** | `#e11d48` (Rose 600) | Validation failures, errors, deleting actions. |
| **Success** | `#16a34a` (Green 600) | Validation success, success banners. |
