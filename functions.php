<?php

// remove_action('rest_api_init', 'create_initial_rest_routes', 99);

$dirbase = get_template_directory();

require_once $dirbase . '/endpoints/user_post.php';
require_once $dirbase . '/endpoints/user_get.php';
require_once $dirbase . '/endpoints/photo_post.php';
require_once $dirbase . '/endpoints/photo_delete.php';

// update_option('large_size_w', 1000);
// update_option('large_size_h', 1000);
// update_option('large_crop', 1);

function custom_image_sizes() {
  // Adiciona um tamanho de imagem de 1000x1000 pixels, recortado (cortado para o centro)
  add_image_size('custom_square', 1000, 1000, true);
}
add_action('after_setup_theme', 'custom_image_sizes');

function change_api() {
  return 'json';
}
add_filter('rest_url_prefix', 'change_api');

function expire_token() {
  return time() + (60 * 60 * 24);
}
add_action('jwt_auth_expire', 'expire_token');

?>