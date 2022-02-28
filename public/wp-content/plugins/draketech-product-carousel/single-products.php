<?php
get_header();

require_once plugin_dir_path( __FILE__ ) . 'views.php';
?>

<main id="site-content" role="main">
	<div class="container-fluid no-padding">
		<div class="row">
					<?php
					if ( have_posts() )
					{
						while ( have_posts() )
						{
							the_post();
							View_Functions::single_character_view(get_the_ID());
						}
					}
					?>
		</div>
	</div>
</main><!-- #site-content -->

<?php get_footer(); ?>
