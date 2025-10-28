<?php
// Ngăn chặn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Thêm trang cài đặt vào menu Admin
 */
function fczb_add_admin_menu() {
    add_options_page(
        __( 'Floating Call & Zalo Buttons', 'fczb' ), // Tiêu đề trang
        __( 'Call/Zalo Buttons', 'fczb' ),       // Tiêu đề menu
        'manage_options',                        // Quyền truy cập
        'fczb_settings_page',                    // Slug của trang
        'fczb_settings_page_html'                // Hàm hiển thị nội dung trang
    );
}
add_action( 'admin_menu', 'fczb_add_admin_menu' );

/**
 * Đăng ký các cài đặt
 */
function fczb_register_settings() {
    register_setting( 'fczb_settings_group', 'fczb_settings', 'fczb_sanitize_settings' );

    // Section chính
    add_settings_section(
        'fczb_general_section',
        __( 'Cài đặt chung', 'fczb' ),
        null, // Callback không cần thiết
        'fczb_settings_page'
    );

    // Section Nút Gọi
    add_settings_section(
        'fczb_call_button_section',
        __( 'Cài đặt Nút Gọi', 'fczb' ),
        null,
        'fczb_settings_page'
    );

     // Section Nút Zalo
    add_settings_section(
        'fczb_zalo_button_section',
        __( 'Cài đặt Nút Zalo', 'fczb' ),
        null,
        'fczb_settings_page'
    );

    // Field: Bật Plugin
    add_settings_field(
        'fczb_enable_plugin',
        __( 'Bật Plugin', 'fczb' ),
        'fczb_render_checkbox_field',
        'fczb_settings_page',
        'fczb_general_section',
        [ 'id' => 'fczb_enable_plugin', 'label_for' => 'fczb_enable_plugin' ]
    );

     // Field: Vị trí nút
    add_settings_field(
        'fczb_button_position',
        __( 'Vị trí nút', 'fczb' ),
        'fczb_render_select_field',
        'fczb_settings_page',
        'fczb_general_section',
        [
            'id' => 'fczb_button_position',
            'options' => [
                'bottom-right' => __( 'Góc dưới Phải', 'fczb' ),
                'bottom-left'  => __( 'Góc dưới Trái', 'fczb' ),
            ],
            'label_for' => 'fczb_button_position'
        ]
    );

    // Field: Hiển thị trên
    add_settings_field(
        'fczb_display_on',
        __( 'Hiển thị trên', 'fczb' ),
        'fczb_render_select_field',
        'fczb_settings_page',
        'fczb_general_section',
        [
            'id' => 'fczb_display_on',
            'options' => [
                'all'          => __( 'Tất cả (Desktop & Mobile)', 'fczb' ),
                'mobile-only'  => __( 'Chỉ Mobile', 'fczb' ),
                'desktop-only' => __( 'Chỉ Desktop', 'fczb' ),
            ],
            'label_for' => 'fczb_display_on'
        ]
    );


    // --- Cài đặt Nút Gọi ---
     add_settings_field(
        'fczb_enable_call_button',
        __( 'Bật Nút Gọi', 'fczb' ),
        'fczb_render_checkbox_field',
        'fczb_settings_page',
        'fczb_call_button_section',
        [ 'id' => 'fczb_enable_call_button', 'label_for' => 'fczb_enable_call_button' ]
    );
    add_settings_field(
        'fczb_phone_number',
        __( 'Số điện thoại', 'fczb' ),
        'fczb_render_text_field',
        'fczb_settings_page',
        'fczb_call_button_section',
        [ 'id' => 'fczb_phone_number', 'label_for' => 'fczb_phone_number', 'desc' => __('Nhập số điện thoại đầy đủ, ví dụ: 0912345678', 'fczb') ]
    );

    // Field: Màu nút Gọi (hex)
    add_settings_field(
        'fczb_call_color',
        __( 'Màu nút Gọi (HEX)', 'fczb' ),
        'fczb_render_text_field',
        'fczb_settings_page',
        'fczb_call_button_section',
        [ 'id' => 'fczb_call_color', 'label_for' => 'fczb_call_color', 'desc' => __('Nhập mã màu HEX cho nút Gọi, ví dụ: #007bff', 'fczb') ]
    );

    // --- Cài đặt Nút Zalo ---
     add_settings_field(
        'fczb_enable_zalo_button',
        __( 'Bật Nút Zalo', 'fczb' ),
        'fczb_render_checkbox_field',
        'fczb_settings_page',
        'fczb_zalo_button_section',
        [ 'id' => 'fczb_enable_zalo_button', 'label_for' => 'fczb_enable_zalo_button' ]
    );
    add_settings_field(
        'fczb_zalo_number',
        __( 'Số điện thoại Zalo', 'fczb' ),
        'fczb_render_text_field',
        'fczb_settings_page',
        'fczb_zalo_button_section',
        [ 'id' => 'fczb_zalo_number', 'label_for' => 'fczb_zalo_number', 'desc' => __('Nhập số điện thoại đã đăng ký Zalo, ví dụ: 0912345678', 'fczb') ]
    );
     add_settings_field(
        'fczb_zalo_icon_url',
        __( 'URL Icon Zalo (Tùy chọn)', 'fczb' ),
        'fczb_render_text_field',
        'fczb_settings_page',
        'fczb_zalo_button_section',
        [ 'id' => 'fczb_zalo_icon_url', 'label_for' => 'fczb_zalo_icon_url', 'desc' => __('Để trống nếu muốn dùng chữ "Zalo". Nhập URL ảnh icon Zalo nếu có.', 'fczb') ]
    );

    // Field: Màu nút Zalo (hex)
    add_settings_field(
        'fczb_zalo_color',
        __( 'Màu nút Zalo (HEX)', 'fczb' ),
        'fczb_render_text_field',
        'fczb_settings_page',
        'fczb_zalo_button_section',
        [ 'id' => 'fczb_zalo_color', 'label_for' => 'fczb_zalo_color', 'desc' => __('Nhập mã màu HEX cho nút Zalo, ví dụ: #0068ff', 'fczb') ]
    );

}
add_action( 'admin_init', 'fczb_register_settings' );

/**
 * Hàm render các loại trường nhập liệu (checkbox, text, select)
 */
function fczb_render_checkbox_field( $args ) {
    $options = get_option( 'fczb_settings' );
    $id = esc_attr( $args['id'] );
    $value = isset( $options[$id] ) ? $options[$id] : 0;
    echo '<input type="checkbox" id="' . $id . '" name="fczb_settings[' . $id . ']" value="1" ' . checked( 1, $value, false ) . '/>';
    if (isset($args['desc'])) {
        echo '<p class="description">' . esc_html($args['desc']) . '</p>';
    }
}

function fczb_render_text_field( $args ) {
    $options = get_option( 'fczb_settings' );
    $id = esc_attr( $args['id'] );
    $value = isset( $options[$id] ) ? $options[$id] : '';
    echo '<input type="text" id="' . $id . '" name="fczb_settings[' . $id . ']" value="' . esc_attr( $value ) . '" class="regular-text" />';
     if (isset($args['desc'])) {
        echo '<p class="description">' . esc_html($args['desc']) . '</p>';
    }
}

function fczb_render_select_field( $args ) {
    $options = get_option( 'fczb_settings' );
    $id = esc_attr( $args['id'] );
    $current_value = isset( $options[$id] ) ? $options[$id] : '';
    $select_options = $args['options'];

    echo '<select id="' . $id . '" name="fczb_settings[' . $id . ']">';
    foreach ( $select_options as $value => $label ) {
        echo '<option value="' . esc_attr( $value ) . '" ' . selected( $current_value, $value, false ) . '>' . esc_html( $label ) . '</option>';
    }
    echo '</select>';
     if (isset($args['desc'])) {
        echo '<p class="description">' . esc_html($args['desc']) . '</p>';
    }
}


/**
 * Hàm làm sạch (sanitize) dữ liệu trước khi lưu
 */
function fczb_sanitize_settings( $input ) {
    $sanitized_input = [];

    // Sanitize checkboxes (chuyển thành 0 hoặc 1)
    $checkboxes = ['fczb_enable_plugin', 'fczb_enable_call_button', 'fczb_enable_zalo_button'];
    foreach($checkboxes as $cb) {
        $sanitized_input[$cb] = isset( $input[$cb] ) ? 1 : 0;
    }

    // Sanitize text fields
    $text_fields = ['fczb_phone_number', 'fczb_zalo_number'];
     foreach($text_fields as $tf) {
        $sanitized_input[$tf] = isset( $input[$tf] ) ? sanitize_text_field( $input[$tf] ) : '';
    }

     // Sanitize Zalo icon URL
      $sanitized_input['fczb_zalo_icon_url'] = isset( $input['fczb_zalo_icon_url'] ) ? esc_url_raw( $input['fczb_zalo_icon_url'] ) : '';


    // Sanitize select fields
    $select_fields = [
        'fczb_button_position' => ['bottom-right', 'bottom-left'],
        'fczb_display_on'      => ['all', 'mobile-only', 'desktop-only']
    ];
    foreach ($select_fields as $key => $allowed_values) {
        if ( isset( $input[$key] ) && in_array( $input[$key], $allowed_values, true ) ) {
            $sanitized_input[$key] = $input[$key];
        } else {
             // Giá trị mặc định nếu không hợp lệ (ví dụ: lấy giá trị đầu tiên)
            $sanitized_input[$key] = reset($allowed_values);
        }
    }

    // Sanitize color fields (hex) with sensible defaults
    // Defaults match the colors used in CSS: call = #007bff, zalo = #0068ff
    if ( isset( $input['fczb_call_color'] ) ) {
        $call_color = sanitize_hex_color( $input['fczb_call_color'] );
        $sanitized_input['fczb_call_color'] = $call_color ? $call_color : '#007bff';
    } else {
        $sanitized_input['fczb_call_color'] = '#007bff';
    }

    if ( isset( $input['fczb_zalo_color'] ) ) {
        $zalo_color = sanitize_hex_color( $input['fczb_zalo_color'] );
        $sanitized_input['fczb_zalo_color'] = $zalo_color ? $zalo_color : '#0068ff';
    } else {
        $sanitized_input['fczb_zalo_color'] = '#0068ff';
    }


    return $sanitized_input;
}

/**
 * Hàm hiển thị HTML cho trang cài đặt
 */
function fczb_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'fczb_settings_group' ); // Output nonces, action, etc.
            do_settings_sections( 'fczb_settings_page' ); // Output sections and fields
            submit_button( __( 'Lưu thay đổi', 'fczb' ) );
            ?>
        </form>
    </div>
    <?php
}

?>