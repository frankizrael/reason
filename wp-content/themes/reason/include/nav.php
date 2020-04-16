<?php	
$fid = get_option( 'page_on_front' );
?>
<header>
	<div class="fixed x-container">
		<div class="logo">
			<img src="<?php the_field('logo','options');?>">
		</div>
		<div class="menu">
			<a href="<?php echo site_url(); ?>/contacto" class="btn" id="contacto">Contáctanos</a>
			<a href="<?php echo site_url(); ?>" class="btn btn--green" id="menu">Menu</a>
		</div>
	</div>
</header>