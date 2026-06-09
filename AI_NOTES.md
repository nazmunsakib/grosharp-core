# Grosharp Core Plugin Notes

## Responsibility
The plugin owns reusable functionality:
- Custom Gutenberg blocks
- Custom post types
- Taxonomies
- Meta fields and editor data
- Dynamic render callbacks
- React-powered settings page for global brand/theme settings
- Settings storage, sanitization, and output helpers
- REST helpers if needed
- Shortcodes only if blocks are not appropriate

## Expected Custom Post Types
These are likely, but still open for final confirmation:
- `grosharp_project` for case studies / portfolio projects
- `grosharp_service` for agency services
- `grosharp_testimonial` for client testimonials
- `grosharp_team` if team profiles are needed

## Service Scope
Services should support three main pillars:
- Development
- Design
- Marketing

Service detail pages should be powered by service content and reusable blocks where possible.

## Expected Blocks
These are likely starting points:
- Hero section
- Client/logo strip
- Services grid
- Process steps
- Featured case studies
- Testimonial slider or grid
- Pricing/packages
- CTA band
- FAQ

## Block Editing Rule
Blocks should allow editors to update content only:
- text
- links
- images/media
- selected posts
- simple content options

Do not add broad per-block style controls. Styling should come from the theme, Tailwind, `theme.json`, and global settings.

## Settings Page
The React settings page should manage:
- brand colors
- logo
- typography choices
- company name and tagline
- contact info
- social links
- CTA defaults
- footer information

## Development Notes
- Use the `grosharp` text domain.
- Register blocks from build metadata when a build system exists.
- Prefer dynamic blocks for CPT-driven sections.
- Sanitize attributes and escape rendered output.

## Current Scaffold
- Main plugin file: `grosharp-core.php`.
- Namespace: `GrosharpCore`.
- PSR-4 paths: `src/` and `includes/`.
- Composer metadata exists in `composer.json`.
- Composer autoloading is required through `vendor/autoload.php`.
- CPT registrar exists for projects/case studies, services, testimonials, and team.
- Taxonomy registrar exists for project type, industry, service category, and service pillar.
- Settings registration saves `grosharp_settings`.
- React settings page shell exists under the Grosharp admin menu.
- Block source exists in `src/blocks`.
- Built block output exists in `build/blocks`.
- Block registration exists in `includes/Blocks/Registrar.php`.
- Server-side rendering lives in each block folder's native `render.php`.
- Blocks are registered from metadata via `register_block_type()`.

## Current Hero Block Direction
- Hero block follows the provided Draftr screenshot inspiration without copying it directly.
- Default content: "Design, build, and grow your digital presence."
- Visual output includes a centered badge/headline/copy, primary CTA, image-based Growth Dashboard preview, and secondary mobile creative card.
- The block includes content controls only, including badge text, heading, copy, CTA labels/URLs, visual title, dashboard image URL, and image alt text.
- Hero markup should use Tailwind utility classes instead of relying on custom selector CSS.

## Next Improvements
- Activation-test inside WordPress admin.
- Improve repeatable block item editing beyond JSON textareas.
- Add media/logo upload support to settings page.
- Add meta fields for case study details and testimonial attribution.
- Add theme patterns that compose these blocks into pages.

## Render Architecture
- Do not recreate a monolithic `RenderCallbacks.php`.
- Do not add a separate `includes/Blocks/Renderers` layer for normal blocks.
- Keep dynamic block markup in `src/blocks/{block-slug}/render.php`.
- `includes/Blocks/Registrar.php` registers block metadata folders.

## Block Development Standard
- Follow the WordPress Block Editor Handbook pattern with `@wordpress/scripts`.
- Block source should live in `src/blocks/{block-slug}`.
- Built production block files should live in `build/blocks/{block-slug}`.
- `block.json` should declare assets wherever possible.
- Avoid manually enqueuing one global editor script for all custom blocks.
- Do not create a top-level `blocks` fallback folder.
