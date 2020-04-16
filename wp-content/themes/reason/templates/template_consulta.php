<?php
/* Template Name: consulta */
set_query_var('ENTRY', 'consulta');
get_header();
?>
<?php get_template_part('include/nav'); ?>
<section class="home-full">
	<div class="x-container">
		<div class="fullheight">
			<div class="flex">
				<div class="left fullheight">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="right">
					<div class="title">
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="form">
						<?php echo do_shortcode('[contact-form-7 id="5" title="Contacto"]'); ?>
					</div>
				</div>
			</div>
			<div class="social">
				<?php
					$social = get_field('social','options');
					foreach ($social as $s) {
				?>
				<a href="<?php echo $s['href']; ?>" target="_blank">
					<?php echo $s['text']; ?>
				</a>
				<?php
					$a++;
					}
				?>
			</div>
		</div>
	</div>
</section>
<?php get_footer();