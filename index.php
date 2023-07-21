<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zonda
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	if (have_posts()) :

		if (is_home() && !is_front_page()) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php
		endif;
		$employees = get_posts([
			'post_type' => 'employee',
		]); ?>
		<?php if ($employees) : ?>
			<section class="employee-list">
				<?php foreach ($employees as $post) :
					setup_postdata($post); ?>
					<article id="post-<?php the_ID(); ?>" class="employee">
						<?php
						$name = get_the_title();
						$image = get_the_post_thumbnail_url();
						$division_term = get_the_terms(get_the_ID(), 'division')[0];
						$company_logo = get_field('logo_image', "term_$division_term->term_id");
						?>

						<?php if ($image) : ?>
							<figure class="photo">
								<img src="<?= $image ?>" alt="<?= "$name photo" ?>">
							</figure>
						<?php endif ?>
						<header>
							<h2 class="name"><a href="<?= get_the_permalink() ?>"><?= $name ?></a></h2>
							<p><?= get_field('empl_position') ?></p>
						</header>
					</article>
				<?php wp_reset_postdata();
				endforeach; ?>
			</section>
	<?php endif;


	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
