## Purpose
Provide concise, actionable guidance to an AI code assistant so it can be productive immediately when editing this WordPress plugin.

## Big picture (what this repo is)
- A lightweight WordPress plugin that shows floating Call and Zalo buttons.
- Main entry: `floating-call-zalo-buttons.php` — defines constants, includes admin and public code, and registers two hooks:
  - `add_action('wp_enqueue_scripts', 'fczb_enqueue_scripts')` to enqueue CSS and add inline display CSS
  - `add_action('wp_footer', 'fczb_add_buttons_to_footer')` to print the buttons via `fczb_display_buttons()`

## Key files (start here)
- `floating-call-zalo-buttons.php` — plugin header, includes, hooks, and inline-style logic.
- `admin/settings-page.php` — registers settings, renders admin UI fields and provides `fczb_sanitize_settings()`.
- `public/display-buttons.php` — builds the front-end HTML for the buttons (uses option keys and escapes output).
- `public/css/style.css` — visual styles and class names used by the markup.

## Data flow & conventions
- All runtime settings are stored as a single array option: `get_option('fczb_settings')`.
- Option keys follow the `fczb_` prefix (examples: `fczb_enable_plugin`, `fczb_phone_number`, `fczb_display_on`).
- Admin registration pattern:
  - `fczb_register_settings()` calls `register_setting('fczb_settings_group','fczb_settings', 'fczb_sanitize_settings')`.
  - Fields are added with `add_settings_field()` and rendered with `fczb_render_checkbox_field`, `fczb_render_text_field`, `fczb_render_select_field`.
- Sanitization: `fczb_sanitize_settings()` coerces checkboxes to 0/1, sanitizes text via `sanitize_text_field()` and URLs via `esc_url_raw()`, and validates select values against allowed arrays. Any new settings should be added here to ensure safety and defaults.

## Hooks & runtime behavior to be aware of
- Enqueue + inline CSS: `fczb_enqueue_scripts()` only enqueues CSS when `fczb_enable_plugin` is true. It builds small inline CSS to implement the `display_on` (all / mobile-only / desktop-only) behavior.
- Footer injection: `fczb_add_buttons_to_footer()` calls `fczb_display_buttons()` if plugin is enabled and at least one button is enabled.
- Link generation:
  - Call links are generated as `tel:` with non-digits stripped.
  - Zalo links use `https://zalo.me/<digits>` and support an optional image URL `fczb_zalo_icon_url`.

## Security & escaping patterns used here
- Guard direct access: every PHP file checks `if ( ! defined( 'ABSPATH' ) ) exit;` — preserve this in new files.
- Output is escaped using: `esc_attr()`, `esc_url()`, `esc_html()`, `sanitize_html_class()` where appropriate. Follow the same functions for any new output.

## Styling and class conventions
- Top-level container class: `.fczb-container`
- Position classes: `.fczb-pos-bottom-right` / `.fczb-pos-bottom-left`
- Display classes (prefix): `.fczb-display-<value>` (value = `all`, `mobile-only`, `desktop-only`)
- Button base class: `.fczb-button` with modifiers `.fczb-call-button` and `.fczb-zalo-button`

## Common code edits and where to make them
- Add a new admin setting: update `fczb_register_settings()` (admin/settings-page.php), add a render helper if needed, and add sanitization in `fczb_sanitize_settings()`.
- Change front-end markup or behavior: edit `public/display-buttons.php` and update CSS in `public/css/style.css`. Keep escaping conventions.
- Change where/when CSS loads or how `display_on` is implemented: edit `fczb_enqueue_scripts()` in the main plugin file.

## How to test changes locally (no CI here)
1. Copy the plugin folder into a local WP environment `/wp-content/plugins/` (LocalWP, XAMPP, WSL + WP-CLI, etc.).
2. Activate in WP Admin > Plugins.
3. Visit Settings > Call/Zalo Buttons to toggle options and save.
4. Inspect a front-end page source and the footer to confirm:
   - Inline CSS from `fczb_enqueue_scripts()` appears.
   - The `.fczb-container` HTML matches expectation and has correct classes (position & display).
   - `tel:` and `https://zalo.me/` links are well-formed.
5. Use `WP_DEBUG` and `debug.log` (or `error_log`) for PHP errors.

## Notes for contributors / AI agents
- No build tools, tests, or package managers are present — changes are PHP/CSS only.
- Keep changes minimal and isolated: prefer adding a small function and tests (if you add tests, include instructions to run them).
- Preserve the `fczb_` naming prefix and existing escape/sanitize patterns.

If any of the above sections are unclear or you want the file to include examples of common edits (e.g., how to add a new setting + sanitization + UI), tell me which example you'd like and I will add it.
