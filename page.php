<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vacarme
 */

get_header();
?>

<main id="primary" class="site-main container">
	<div class="row">
		<?php
		$ancestorIds = get_post_ancestors($post);
		if (count($ancestorIds) > 0) {
			$topPageId =  $ancestorIds[count($ancestorIds) - 1];
		} else {
			$topPageId = $post->ID;
		}

		$pages = get_pages(array('child_of' => $topPageId));
		if (count($pages) > 0) {
		?>
			<aside class="col-2 bg-light">
				<button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarNavCollapse" aria-expanded="false" aria-controls="sidebarNavCollapse">
					<?php echo get_post($topPageId)->post_title ?>
				</button>
				<div class="collapse show" id="sidebarNavCollapse">
					<?php
					$pages = $pages ? wp_list_pluck($pages, 'ID') : '';
					$includes = implode(',', $pages);
					$children = wp_list_pages('title_li=&include=' . $includes . '&echo=0');

					echo $children ? "$children" : '';
					?>
				</div>
			</aside>
		<?php
		}
		?>
		<div class="col-10">
			<?php
			while (have_posts()) :
				the_post();

				get_template_part('template-parts/content', 'page');

				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
