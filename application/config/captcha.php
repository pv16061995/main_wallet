<?php
$config = array(
    'img_path'      => 'captcha_images/',
    'img_url'       => base_url().'captcha_images/',
    'img_width'     => '150',
    'img_height'    => 50,
    'word_length'   => 8,
    'font_size'     => 16
);
$captcha = create_captcha($config);
?>