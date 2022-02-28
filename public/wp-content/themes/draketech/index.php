<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();

$page_id = get_option( 'page_for_posts' );
?>
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
