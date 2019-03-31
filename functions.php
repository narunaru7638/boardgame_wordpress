<?php
//カスタムヘッダー画像の設置
$custom_header_defaults = array(
    'default-image' => get_bloginfo('template_url').'/images/headers/logo.png','header-text' => false, //ヘッダー画像上にテキストを被せる

);


//カスタムヘッダー機能を有効にする
add_theme_support( 'custom-header', $custom_header_defaults );
?>