<?php

/**
 * The template for displaying the home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vacarme
 */

get_header();
?>

<main id="primary" class="site-main container">
    <div id="dynamic-map" class="dynamic-map container-fluid"></div>
</main>

<?php
get_sidebar();
get_footer();
