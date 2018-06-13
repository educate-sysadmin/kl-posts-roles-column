<?php
/*
Plugin Name: KL Posts Roles Column
Plugin URI: https://github.com/educate-sysadmin/kl-posts-roles-column
Description: Wordpress plugin to show role restrictions in pages/posts list
Version: 0.1
Author: b.cunningham@ucl.ac.uk
Author URI: https://educate.london
License: GPL2
*/

function kl_columns_role_head($defaults) {
    $defaults['roles'] = 'Roles';
    return $defaults;
}

function kl_columns_role_content($column_name, $post_id) {
    if ($column_name == 'roles') {
        $roles = members_get_post_roles( $post_id );
        for ($c = 0; $c < count($roles); $c++) {
            echo $roles[$c];
            if ($c < count($roles)-2) { echo ', '; }
        }
    }
}

add_filter('manage_posts_columns', 'kl_columns_role_head');
add_action('manage_posts_custom_column', 'kl_columns_role_content', 10, 2);
add_filter('manage_pages_columns', 'kl_columns_role_head');
add_action('manage_pages_custom_column', 'kl_columns_role_content', 10, 2);