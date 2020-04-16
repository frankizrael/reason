<?php /* Template Name: home */
set_query_var('ENTRY', 'home');
get_header();
?>
<?php get_template_part('include/nav'); ?>
<section class="home-full">
	<div class="x-container">
		<div class="fullheight">
			<article class="swiper-projects " id="home_slider">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
							$servicios = get_field('servicios');
							foreach ($servicios as $se) {
						?>
						<div class="swiper-slide">
							<div class="fullheight">
								<div class="img">
									<img src="<?php echo $se['imagen']; ?>">
								</div>
								<div class="text">
									<h3><?php echo $se['frase']; ?></h3>
									<div class="content">
										<?php echo $se['autor']; ?>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</article>
			<div class="reason_list">
				<?php
					$servicios = get_field('servicios');
					$a = 0;
					foreach ($servicios as $se) {
				?>
				<a href="javascript:void(0)" data="<?php echo $a;?>" class="link" data-after="<?php echo $se['title']; ?>">
					<?php echo $se['title']; ?>
				</a>
				<?php
					$a++;
					}
				?>
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

<?php
get_footer();
?>
