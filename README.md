# Floating Call and Zalo Buttons

## Description
The **Floating Call and Zalo Buttons** WordPress plugin displays fixed floating buttons for multiple contact methods: phone calls, Zalo chat, email, and SMS. It allows visitors to easily reach you through their preferred communication channel.

## Features
### Contact Buttons
- **Gọi điện thoại (Call)**: Quick phone calls with tel: protocol
- **Zalo Chat**: Direct messaging via Zalo with custom icon support
- **Email**: Instant email composition with mailto: links
- **SMS**: Quick text messaging with sms: protocol

### Customization
- Individual enable/disable toggles for each button
- Customize colors for each button using HEX codes:
  - Call button (default: `#007bff`)
  - Zalo button (default: `#0068ff`)
  - Email button (default: `#28a745`)
  - SMS button (default: `#dc3545`)
- Customize visibility: mobile-only, desktop-only, or all devices
- Position buttons: bottom-left or bottom-right corner
- Optional custom Zalo icon

## Installation
1. Download the plugin files and upload them to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to Settings > Call/Zalo Buttons to configure.

## Usage & Configuration

### General Settings
1. Visit the WordPress admin panel and go to Settings > Call/Zalo Buttons
2. Enable the plugin and choose display options:
   - Button position (bottom-right/bottom-left)
   - Display on (all/mobile-only/desktop-only)

### Button Configuration
Each button can be configured independently:

#### Call Button
- Enable/disable the button
- Set phone number
- Customize color (HEX, default: `#007bff`)

#### Zalo Button
- Enable/disable the button
- Set Zalo phone number
- Optional custom icon URL
- Customize color (HEX, default: `#0068ff`)

#### Email Button (New!)
- Enable/disable the button
- Set email address
- Customize color (HEX, default: `#28a745`)

#### SMS Button (New!)
- Enable/disable the button
- Set SMS phone number
- Customize color (HEX, default: `#dc3545`)

### Color Customization
Each button supports custom colors via HEX codes:
```
Gọi điện thoại: #007bff (Default blue)
Zalo: #0068ff (Zalo blue)
Email: #28a745 (Green)
SMS: #dc3545 (Red)
```
To customize colors:
1. Find the color section under each button's settings
2. Enter a valid HEX color code (e.g., `#ff0000` for red)
3. Invalid or empty values will use the default color

## Files Structure
- `floating-call-zalo-buttons.php`: Main plugin file
- `admin/settings-page.php`: Settings page and admin UI
- `public/display-buttons.php`: Frontend button display
- `public/css/style.css`: Button styles and animations

## License
This plugin is licensed under the GPL v2 or later. See the [GNU General Public License](https://www.gnu.org/licenses/gpl-2.0.html) for more details.