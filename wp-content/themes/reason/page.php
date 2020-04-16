<?php
set_query_var('ENTRY', 'page');
get_header();
?>
<?php get_template_part('include/nav'); ?>
<section class="init banner flex align-items-center" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
	<div class="x-container titlePrincipal">
		<div class="title title--white">
			<h1><?php the_title();?></h1>
			<p><?php the_field('subtitle');?></p>
		</div>
	</div>
</section>
<section class="contentPage <?php if(get_field('is_partner')) { echo 'partnerPage'; }?>">
	<div class="x-container">
		<div class="contenido box">
			<?php 
				if(get_field('is_partner')) { 
					?>
				<div class="partertLemento">
					<?php
						$parnters = get_field('partner');
						foreach ($parnters as $p) {
							?>
					<div class="pp">
						<img src="<?php echo $p['imagen']; ?>">
						<span><div><?php echo $p['text']; ?></div></span>
					</div>
							<?php
						}
					?>
				</div>
					<?php
				} else {
					the_content();
				}
			?>
		</div>
	</div>
</section>

<?php get_footer();