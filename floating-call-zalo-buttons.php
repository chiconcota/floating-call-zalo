<?php
/**
 * Plugin Name:       Floating Call and Zalo Buttons
 * Plugin URI:        https://lytatthanh.com/ (Thay bằng URL của bạn)
 * Description:       Hiển thị nút gọi điện thoại và Zalo nổi cố định trên màn hình.
 * Version:           1.2.0
 * Author:            lý tất thành
 * Author URI:        https://lytathanh.com/ (Thay bằng URL của bạn)
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       lytatthanh
 * Domain Path:       /vietnamese
 */

// Ngăn chặn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Định nghĩa hằng số cho plugin
define( 'FCZB_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'FCZB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'FCZB_VERSION', '1.0.0' );

// Bao gồm các file cần thiết
require_once FCZB_PLUGIN_PATH . 'admin/settings-page.php';
require_once FCZB_PLUGIN_PATH . 'public/display-buttons.php';

/**
 * Đăng ký CSS và JS cho frontend
 */
function fczb_enqueue_scripts() {
    $options = get_option( 'fczb_settings' );
    $is_enabled = isset( $options['fczb_enable_plugin'] ) ? $options['fczb_enable_plugin'] : 0;

    if ( $is_enabled ) {
        wp_enqueue_style( 'dashicons' ); // Đảm bảo Dashicons được tải
        wp_enqueue_style( 'fczb-style', FCZB_PLUGIN_URL . 'public/css/style.css', array(), FCZB_VERSION );

        // Thêm inline style để xử lý hiển thị mobile/desktop nếu cần thiết qua class
        $display_on = isset( $options['fczb_display_on'] ) ? $options['fczb_display_on'] : 'all';
        $custom_css = ".fczb-container { display: none; } /* Mặc định ẩn */";
        if ($display_on === 'all') {
             $custom_css = ".fczb-container { display: flex; }";
        } elseif ($display_on === 'mobile-only') {
            $custom_css .= "@media (max-width: 768px) { .fczb-container.fczb-display-mobile-only { display: flex !important; } }";
             $custom_css .= "@media (min-width: 769px) { .fczb-container.fczb-display-mobile-only { display: none !important; } }";
        } elseif ($display_on === 'desktop-only') {
            $custom_css .= "@media (min-width: 769px) { .fczb-container.fczb-display-desktop-only { display: flex !important; } }";
            $custom_css .= "@media (max-width: 768px) { .fczb-container.fczb-display-desktop-only { display: none !important; } }";
        }
        wp_add_inline_style('fczb-style', $custom_css);
    }
}
add_action( 'wp_enqueue_scripts', 'fczb_enqueue_scripts' );

/**
 * Thêm hook để hiển thị nút ở footer
 */
function fczb_add_buttons_to_footer() {
    $options = get_option( 'fczb_settings' );
     $is_enabled = isset( $options['fczb_enable_plugin'] ) ? $options['fczb_enable_plugin'] : 0;
    if ( $is_enabled ) {
        fczb_display_buttons(); // Gọi hàm hiển thị từ file display-buttons.php
    }
}
add_action( 'wp_footer', 'fczb_add_buttons_to_footer' );

?>
