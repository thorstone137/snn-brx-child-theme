<?php

function snn_add_menu_page() {
    
    $dynamic_title = get_option('snn_menu_title', 'SNN Settings');

    add_menu_page(
        'SNN Settings', 
        $dynamic_title, 
        'manage_options', 
        'snn-settings', 
        'snn_settings_page_callback', 
        '', 
        99 
    );
}
add_action('admin_menu', 'snn_add_menu_page');

function snn_settings_page_callback() {
    ?>
    <div class="wrap">
        <h1>SNN Bricks Builder Child Theme Settings</h1>
        <div style="max-width:600px; margin-bottom:80px ">
        <p  style="line-height:24px !important;  ">
            This theme is designed to give you the tools and flexibility you need to build and customize your site effortlessly. 
            From managing post types and fields to enhancing security and design,  
            everything is straightforward and ready for you to use. If you need guidance,  
            the Wiki has all the details. Enjoy building your site.
        </p>
        <a href="https://github.com/sinanisler/snn-brx-child-theme/wiki" target="_blank" >Wiki Documentation ➤</a>
        </div>

        <form method="post" action="options.php">
            <?php
            settings_fields('snn_settings_group');
            do_settings_sections('snn-settings');
            submit_button();
            ?>
        </form>
    </div>

    <style>
        .wrap {
        }
        .tt1 {
            width: 880px;
            height: 40px;
        }
        .style_css, .head-css, #wp_head_css_frontend, #wp_footer_html_frontend, #wp_head_html_frontend {
            width: 880px;
            height: 220px;
        }
        [type="checkbox"] {
            width: 18px !important;
            height: 18px !important;
            float: left;
            margin-right: 10px !important;
        }
        #snn_custom_css {
            width: 880px;
            height: 330px;
        }
    </style>
    <?php
}

function snn_register_settings() {
    register_setting('snn_settings_group', 'snn_menu_title'); 

    add_settings_section(
        'snn_general_section',
        'General Setting',
        'snn_general_section_callback',
        'snn-settings'
    );

    add_settings_field(
        'snn_menu_title_field',
        'White Label Name',
        'snn_menu_title_field_callback',
        'snn-settings',
        'snn_general_section'
    );
}
add_action('admin_init', 'snn_register_settings');

function snn_general_section_callback() {
    echo '<p>General setting for the SNN menu page.</p>';
}

function snn_menu_title_field_callback() {
    $menu_title = get_option('snn_menu_title', 'SNN Settings');
    echo '<input type="text" name="snn_menu_title" value="' . esc_attr($menu_title) . '" class="regular-text">';
    echo '<p>You can rename SNN Settings with this input.</p>';
}


function mytheme_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'footer_custom_css', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'footer_custom_css', array(
        'label'       => ' ',
        'section'     => 'custom_css', 
        'settings'    => 'footer_custom_css',
        'type'        => 'checkbox',
        'description' => ' ',
    ) );
}
add_action( 'customize_register', 'mytheme_customize_register' );



?>
