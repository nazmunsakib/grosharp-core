# Grosharp Core Development Notes

## Coding Standards
- Use WordPress APIs for registration, settings, sanitization, escaping, and REST exposure.
- Keep PHP classes under the `GrosharpCore` namespace.
- Keep new classes PSR-4 compatible under `src/`.
- Use Composer autoloading. Do not add a fallback autoloader.
- Escape output in render callbacks.
- Sanitize all option and attribute input before storage or output.
- Keep block controls content-focused. Do not add per-block design controls unless the project architecture changes.

## Brand Color Flow
1. React settings page saves values to `grosharp_settings`.
2. The theme reads `grosharp_settings` in `inc/settings-css.php`.
3. The theme prints CSS variables such as `--grosharp-primary`.
4. Tailwind theme tokens use those CSS variables.
5. Plugin block markup uses theme classes and is restyled globally.

## Adding A New Block
1. Create source files in `src/blocks/{block-slug}`.
2. Add `block.json`, `index.js`, `edit.js`, and `render.php` in that source folder.
3. Use `save.js` only for static blocks that need saved markup.
4. Add the block slug to `includes/Blocks/Registrar.php`.
5. Build assets with `npm run build`; production files should land in `build/blocks`.
6. Register blocks from built metadata, not from handcrafted global editor scripts.
7. Add Tailwind utility classes in markup and theme tokens where needed.

## Block Build Standard
- Use `@wordpress/scripts` through `npm run start` and `npm run build`.
- Keep editable block source in `src/blocks`.
- Keep built block assets in `build/blocks`.
- Let `block.json` declare block assets wherever possible.
- Do not manually enqueue one global block editor script for all blocks.
- Do not create a single renderer file for all blocks.
- Do not create separate renderer classes for normal dynamic blocks; keep output in the block's own `render.php`.
- Keep PHP service/registration classes outside `src/blocks` so WordPress block source and PHP infrastructure do not collide on Windows.

## Adding A New CPT
1. Add registration in `src/PostTypes/Registrar.php`.
2. Add any taxonomy relationship in `src/Taxonomies/Registrar.php`.
3. Add theme templates if the content is public.
4. Flush permalinks after activation or structural changes.
