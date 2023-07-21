<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zonda
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="employee">
			<?php
			$name = get_the_title();
			$image = get_the_post_thumbnail_url();
			$division_term = get_the_terms(get_the_ID(), 'division')[0];
			$company_logo = get_field('logo_image', "term_$division_term->term_id");

			$in_company_date = get_field('in_company_date');
			$start_datetime = new DateTime($in_company_date);
			$diff = $start_datetime->diff(new DateTime(date('Y-m')));
			$since_date_sentence = '0 years';
			if ($diff->y > 0) {
				$since_date_sentence = "$diff->y years";
			} else if ($diff->m > 0) {
				$since_date_sentence = "$diff->m months";
			} else if ($diff->d > 0) {
				$since_date_sentence = "$diff->d days";
			}
			?>

			<?php if ($image) : ?>
				<figure class="photo">
					<img src="<?= $image ?>" alt="<?= "$name photo" ?>">
				</figure>
			<?php endif ?>
			<header>
				<h1 class="name"><?= $name ?></h1>
				<p><?= get_field('empl_position') ?></p>
			</header>

			<section class="company">
				<div class="division">
					<?php if ($company_logo) : ?>
						<div class="division-logo">
							<img src="<?= $company_logo["url"] ?>" alt="<?= $company_logo["alt"] ?>">
						</div>
					<?php endif ?>
					<p><?= $division_term->name ?></p>
				</div>
				<p>
					With the company since <time datetime="<?= $in_company_date ?>"><?= $since_date_sentence ?></time>
				</p>
			</section>

			<section>
				<?php the_content(); ?>
			</section>
		</article>

	<?php endwhile; ?>

</main><!-- #main -->

<?php
get_footer();
