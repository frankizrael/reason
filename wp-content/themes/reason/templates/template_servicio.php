<?php /* Template Name: servicio */
set_query_var('ENTRY', 'servicio');
get_header();
$frontpage_id = get_option( 'page_on_front' );
?>
<?php get_template_part('include/nav'); ?>

<?php
get_footer();
?>
