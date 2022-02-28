<?php
class Admin_Functions {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function init()
	{
		add_action( 'init', 'register_draketech_product_carousel_posts' );
		add_shortcode('draketech_product_carousel', 'draketech_product_carousel_att');

		add_image_size( 'carousel-thumb', 320, 320 );
		add_image_size( 'carousel-medium', 500, 500 );
	}
}

function draketech_product_carousel_att($atts, $content = null)
{
    $default = array
    (
        'condition' => 'all',
        'size' => 5,
    );

    $Products = shortcode_atts($default, $atts);
    $content = do_shortcode($content);

	require_once plugin_dir_path( __FILE__ ) . 'view.php';

	return View_Functions::list_products_shortcode($content, $Products);
}

function register_draketech_product_carousel_posts()
{
    $labels = array
    (
        'name'                => _x( 'Products', 'Post Type General Name', 'draketech-product-carousel' ),
        'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'draketech-product-carousel' ),
        'menu_name'           => __( 'Products', 'draketech-product-carousel' ),
        'parent_item_colon'   => __( 'Parent Product', 'draketech-product-carousel' ),
        'all_items'           => __( 'All Products', 'draketech-product-carousel' ),
        'view_item'           => __( 'View Products', 'draketech-product-carousel' ),
        'add_new_item'        => __( 'Add New Product', 'draketech-product-carousel' ),
        'add_new'             => __( 'Add New', 'draketech-product-carousel' ),
        'edit_item'           => __( 'Edit Product', 'draketech-product-carousel' ),
        'update_item'         => __( 'Update Product', 'draketech-product-carousel' ),
        'search_items'        => __( 'Search Product', 'draketech-product-carousel' ),
        'not_found'           => __( 'Not Found', 'draketech-product-carousel' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'draketech-product-carousel' ),
    );
      
	$args = array
	(
		'labels'             => $labels,
		'description'        => __( 'DrakeTech Products Carousel', 'draketech-product-carousel' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'Products' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 4,
    	'menu_icon'           => plugins_url() . '/draketech-product-carousel/admin/icons/draketech.png',
		'supports'           => array( 'title', 'thumbnail' )
	);

	register_post_type( 'Products', $args );
	flush_rewrite_rules();
}

add_action( 'add_meta_boxes', 'dpc_meta_box_add' );
function dpc_meta_box_add()
{
  add_meta_box( 'dc-meta-box', 'Product Data', 'dpc_meta_box_cb', ['Products'], 'normal', 'high' );
}

function dpc_meta_box_cb( $post )
{
	$values = get_post_custom( $post->ID );

	$condition = isset( $values['condition'] ) ? esc_attr( $values['condition'][0] ) : '';

	$description = isset( $values['description'] ) ? esc_attr( $values['description'][0] ) : '';

    ?>

    <div class="">
			<p>
				<label for="condition"><h2><span style="font-size: 20px;">Condition</span></h2></label>
	    </p>
	    <p>
				<select name="condition">
					<option value="new" <?php selected( $condition, 'new' ); ?>>New</option> 
					<option value="used" <?php selected( $condition, 'used' ); ?>>Used</option>
				</select>
			</p>
		</div>    

    <div class="">
			<p>
				<label for="productImage"><h2><span style="font-size: 20px;">Image</span></h2></label>
		  </p>
		  <p>
		  <?php
			  $meta_key = 'second_featured_img';

		  	echo dpc_image_uploader_field($meta_key, get_post_meta($post->ID, $meta_key, true) ); ?>
			</p>
		</div>

    <div class="">
			<p>
	    	<label for="description"><h2><span style="font-size: 20px;">Description</span></h2></label>
	    </p>
			<?php 
				wp_editor( htmlspecialchars_decode($description), 'description', $settings = array('textarea_name'=>'description', 'media_buttons' => false, 'teeny' => true, 'textarea_rows' => 10) );
 			?>
		</div>

	<?php
}

function dpc_image_uploader_field( $name, $value = '')
{
    $image = ' button">Upload image';
    $image_size = 'carousel-medium';
    $display = 'none';

    if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) )
    {
        $image = '"><img src="' . $image_attributes[0] . '" style="max-width:35%;display:block;" />';
        $display = 'inline-block';
    } 

    return '
    <div>
        <a href="#" class="dpc_upload_image_button' . $image . '</a>
        <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
        <a href="#" class="dpc_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
    </div>';
}

add_action( 'save_post', 'dpc_meta_box_save' );
function dpc_meta_box_save( $post_id )
{
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( isset( $_POST['condition'] ) )
        update_post_meta( $post_id, 'condition', $_POST['condition'] );

    if( isset( $_POST['description'] ) )
        update_post_meta( $post_id, 'description', $_POST['description'] );

    if( isset( $_POST['second_featured_img'] ) )
    	update_post_meta( $post_id, 'second_featured_img', $_POST['second_featured_img'] );  
}

add_filter('template_include', 'Products_template');
function Products_template( $template )
{
	if ( is_post_type_archive('Products') )
  	{
		return plugin_dir_path(__FILE__) . 'archive-Products.php';
	}
	else if( is_singular('Products') )
	{
		return plugin_dir_path(__FILE__) . 'single-Products.php';
	}

	return $template;
}
?>