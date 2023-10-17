<?php
global $post;

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
?>

<?php get_header(); ?>

<?php include SEVEN_TECH_PORTFOLIO . 'includes/section-project.php'; ?>

<?php get_footer(); ?>