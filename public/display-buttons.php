<?php
// Ngăn chặn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Hiển thị HTML của các nút bấm
 */
function fczb_display_buttons() {
    $options = get_option( 'fczb_settings' );

    // Lấy các cài đặt, cung cấp giá trị mặc định nếu chưa có
    $enable_plugin      = isset( $options['fczb_enable_plugin'] ) ? $options['fczb_enable_plugin'] : 0;
    $enable_call        = isset( $options['fczb_enable_call_button'] ) ? $options['fczb_enable_call_button'] : 0;
    $enable_zalo        = isset( $options['fczb_enable_zalo_button'] ) ? $options['fczb_enable_zalo_button'] : 0;
    $phone_number       = isset( $options['fczb_phone_number'] ) ? $options['fczb_phone_number'] : '';
    $zalo_number        = isset( $options['fczb_zalo_number'] ) ? $options['fczb_zalo_number'] : '';
    $position           = isset( $options['fczb_button_position'] ) ? $options['fczb_button_position'] : 'bottom-right';
    $display_on         = isset( $options['fczb_display_on'] ) ? $options['fczb_display_on'] : 'all';
    $zalo_icon_url      = isset( $options['fczb_zalo_icon_url'] ) ? $options['fczb_zalo_icon_url'] : '';

    // Chỉ hiển thị nếu plugin được bật và có ít nhất 1 nút được bật
    if ( ! $enable_plugin || ( ! $enable_call && ! $enable_zalo ) ) {
        return;
    }

    // Xác định class vị trí và class hiển thị (CSS sẽ xử lý việc ẩn/hiện)
    $position_class = 'fczb-pos-' . sanitize_html_class( $position );
    $display_class = 'fczb-display-' . sanitize_html_class($display_on);


    // Chuẩn bị link Zalo (loại bỏ ký tự không phải số nếu cần)
    $zalo_link_number = preg_replace('/\D/', '', $zalo_number); // Loại bỏ ký tự không phải số
    $zalo_link = $zalo_link_number ? 'https://zalo.me/' . $zalo_link_number : '#'; // Tạo link hoặc để # nếu không có số


    // Chuẩn bị link điện thoại
    $call_link_number = preg_replace('/\D/', '', $phone_number);
    $call_link = $call_link_number ? 'tel:' . $call_link_number : '#';

    ?>
    <div class="fczb-container <?php echo esc_attr( $position_class ); ?> <?php echo esc_attr($display_class); ?>">
        <?php if ( $enable_call && $call_link != '#' ) : ?>
            <a href="<?php echo esc_url( $call_link ); ?>" class="fczb-button fczb-call-button" aria-label="<?php esc_attr_e( 'Gọi điện thoại', 'fczb' ); ?>">
                <span class="dashicons dashicons-phone"></span>
            </a>
        <?php endif; ?>

        <?php if ( $enable_zalo && $zalo_link != '#' ) : ?>
            <a href="<?php echo esc_url( $zalo_link ); ?>" target="_blank" rel="noopener noreferrer" class="fczb-button fczb-zalo-button" aria-label="<?php esc_attr_e( 'Chat qua Zalo', 'fczb' ); ?>">
                <?php if ( ! empty( $zalo_icon_url ) ) : ?>
                    <img src="<?php echo esc_url( $zalo_icon_url ); ?>" alt="<?php esc_attr_e( 'Zalo', 'fczb' ); ?>" class="fczb-zalo-icon-img">
                <?php else : ?>
                    <span class="fczb-zalo-icon-text">Zalo</span> <?php // Hoặc dùng icon SVG/font nếu muốn ?>
                <?php endif; ?>
            </a>
        <?php endif; ?>
    </div>
    <?php
}

?>