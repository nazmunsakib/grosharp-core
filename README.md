# Grosharp Core

Grosharp Core provides the functional layer for the Grosharp WordPress site.

## Responsibilities
- Custom post types
- Taxonomies
- Gutenberg custom blocks
- React-powered brand/settings page
- Settings storage and sanitization

The theme owns visual presentation. This plugin owns data and reusable functionality.

## Architecture
- Main plugin file: `grosharp-core.php`
- PHP namespace: `GrosharpCore`
- PSR-4 paths: `src/` and `includes/`
- Composer autoloading is required through `vendor/autoload.php`
- Block source: `src/blocks/*`
- Block build output: `build/blocks/*`
- Block registration: `includes/Blocks/Registrar.php`
- Dynamic block rendering: each block's own `render.php`
- Block editor source should live beside each block in `src/blocks/{block}/index.js`
- Admin settings source: `assets/src/admin/settings.js`
- Build placeholders: `assets/build/`

## Custom Post Types
- `grosharp_project`: case studies / portfolio projects
- `grosharp_service`: services
- `grosharp_testimonial`: testimonials
- `grosharp_team`: optional team members

## Taxonomies
- `project_type`
- `industry`
- `service_category`
- `service_pillar`

## Blocks
- Hero
- Logo Strip
- Services Grid
- Process Steps
- Featured Projects
- Stats
- Testimonials
- Pricing / Packages
- FAQ
- CTA Band

Blocks are content-first. Editors can update copy, links, counts, and structured content. Broad style controls should stay disabled so the theme and global brand settings control the visual system.

Each dynamic block owns its markup in `src/blocks/{block}/render.php`. Do not put all render callbacks in one large file, and do not add a separate renderer-class layer unless a future block has a clear reusable-service need.

The project follows WordPress block build conventions: `@wordpress/scripts`, source files in `src/blocks`, production files in `build/blocks`, and metadata-driven registration. The old global `blocks` folder has been removed.

## Brand Settings
Settings are saved in the `grosharp_settings` option. The Grosharp theme reads this option and outputs CSS variables for:
- primary color
- accent color
- dark/ink/muted/surface colors
- heading font
- body font

## Development
Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies:

```bash
npm install
```

Build assets:

```bash
npm run build
```

Composer dependencies are required before activating the plugin. The committed JavaScript/CSS build placeholders allow the plugin assets to load before the full asset pipeline is rebuilt.
