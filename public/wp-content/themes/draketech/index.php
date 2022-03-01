<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();
?>
<div style="background: url(http://dummy-images.com/winter/dummy-2090x1290-Dugs.jpg);background-size: cover !important;" class="jumbotron bg-cover text-white">
    <div class="container py-5 text-center">
        <h1 class="display-4 font-weight-bold">Header</h1>
        <p class="font-italic mb-0" style="padding: 20px 0px;">Mauris ut urna varius, molestie velit in, sodales diam. Praesent et nisi vel lacus ultrices laoreet. Sed iaculis tortor ac quam egestas.</p>
        <a href="#" role="button" class="btn btn-primary px-5">More</a>
    </div>
</div>

<div class="row">
	<div class="col-md-8">
		<?php
			get_template_part( 'archive', 'loop' );
		?>
	</div><!-- /.col -->
	<div class="col-md-4">
		<?php
			if ( is_active_sidebar( 'primary_widget_area' ) ) :
		?>
			<div class="col-md-12">
				<?php
					dynamic_sidebar( 'primary_widget_area' );

					if ( current_user_can( 'manage_options' ) ) :
				?>
					<span class="edit-link"><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="badge badge-secondary"><?php esc_html_e( 'Edit', 'draketech' ); ?></a></span><!-- Show Edit Widget link -->
				<?php
					endif;
				?>
			</div>
		<?php
			endif;
		?>	
	</div>
</div><!-- /.row -->
<?php
get_footer();
