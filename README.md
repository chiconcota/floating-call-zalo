# Floating Call and Zalo Buttons

## Description
The **Floating Call and Zalo Buttons** WordPress plugin displays fixed floating buttons for phone calls and Zalo chat on the screen. It allows users to easily contact you via phone or Zalo.

## Features
- Display floating buttons for phone calls, Zalo chat, email, and SMS.
- Customize button colors via HEX color codes.
- Customize visibility for mobile, desktop, or both.
- Easy-to-use settings page in the WordPress admin panel.

## Installation
1. Download the plugin files and upload them to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to the settings page to configure the plugin.

## Usage
1. Go to the plugin settings page in the WordPress admin panel.
2. Enable the plugin and configure the display options (e.g., mobile-only, desktop-only, or all devices).
3. Save the settings. The floating buttons will appear on your website.

### New: Button color customization
- Two new settings were added under the respective button sections in the settings page:
	- "Màu nút Gọi (HEX)" — set the call button color (hex), default `#007bff`.
	- "Màu nút Zalo (HEX)" — set the Zalo button color (hex), default `#0068ff`.
These accept standard HEX color values (e.g. `#ff0000`). If left blank or invalid, defaults are used.

## Files Structure
- `floating-call-zalo-buttons.php`: Main plugin file.
- `admin/settings-page.php`: Contains the code for the settings page in the WordPress admin panel.
- `public/display-buttons.php`: Handles the display of the floating buttons on the frontend.
- `public/css/style.css`: Contains the styles for the floating buttons.

## License
This plugin is licensed under the GPL v2 or later. See the [GNU General Public License](https://www.gnu.org/licenses/gpl-2.0.html) for more details.