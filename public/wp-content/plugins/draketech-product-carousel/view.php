<?php
class View_Functions
{
	public static function list_products_shortcode($content, $data)
	{
		$condition = $data['condition'];

		if($condition == "all")
			$condition = array('new', 'used');

		$posts = get_posts([
			'post_type' 	=> 'products',
			'post_status'	=> 'publish',
			'numberposts'	=> $data['size'],
			'meta_key'		=> 'condition',
			'meta_value'	=> $condition,
			'fields'		=> 'ids'
		]);

		ob_start();
		?>
		<div class="">
			<div class="row">
				<div class="col-md-12">
					<div id="carousel-products" class="carousel slide" data-ride="carousel">
					  <div class="carousel-inner">
							<?php
								$count = 0;
								foreach($posts as $post)
								{
									$count++;
									if($count == 1)
										self::list_product_view($post, 'active');
									else
										self::list_product_view($post);
								}
							?>
				    </div>
					  <a class="carousel-control-prev" href="#carousel-products" data-slide="prev">
					    <span class="carousel-control-prev-icon"></span>
					  </a>
					  <a class="carousel-control-next" href="#carousel-products" data-slide="next">
					    <span class="carousel-control-next-icon"></span>
					  </a>
					</div>

					<div class="col-md-12">
						<a class="font-weight-bold btn btn-primary btn-lg btn-block" id="view_more_products" href="<?php echo get_post_type_archive_link('products'); ?>" role="button">View all Products</a>
					</div>

				</div>


			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	public static function card_product_view($postID)
	{
		$condition = get_post_meta($postID, 'condition', true);
		?>
		<div class="col-md-3 productsDPC <?php echo $condition; ?>">
  			<a href="<?php echo get_the_permalink($postID); ?>" class="list-group-item list-group-item-action">		
				<div class="card">			
				  <?php echo get_the_post_thumbnail($postID, 'carousel-thumb', array( 'class' => 'card-img-top' )); ?>
					<div class="card-body">
						<p class="font-weight-bold pt-2 mb-1 text-center titleArchive"><?php echo get_the_title($postID); ?></p>
				  	</div>
				</div>
			</a>
		</div>
		<?php
	}

	public static function list_product_view($postID, $active='')
	{
		?>
      <div class="carousel-item <?php echo $active;?>">
  			<a href="<?php echo get_the_permalink($postID); ?>" class="list-group-item list-group-item-action">
	        <div class="row">
            <div class="col-md-12 col-12">
              <div class="row">
	              <div class="col-md-12 user-img pt-1">
								  <?php 
										$imageID = get_post_meta($postID, 'second_featured_img', true);
								  	echo wp_get_attachment_image($imageID, 'carousel-thumb', array( 'class' => 'd-block w-100' ));
								  ?>
	              </div>
	              <div class="col-md-12">
                  <p class="font-weight-bold pt-2 mb-1 text-center text-md-left listText"><?php echo get_the_title($postID); ?></p>
                  <div class="user-detail">
                    <p class="m-0"><?php echo self::excerpt(get_post_meta($postID, 'description', true), 85); ?></p>
                  </div>
	              </div>
              </div>
            </div>
	        </div>
  			</a>

	    </div>
		<?php
	}

	public static function single_product_view($postID)
	{
		$imageID = get_post_meta($postID, 'second_featured_img', true);

		if($imageID)
		{
			$singleRow = "singleRowIMG";
			$singleInfo = "singleInfoIMG";

			$image_attributes = wp_get_attachment_image_src( $imageID, "full" )
			?>
				<div class="col-md-12 col-12 imageFull">
					<?php echo '<img class="img-responsive card-img-top" src="' . $image_attributes[0] . '">'; ?>
				</div>
			<?php			
		}
		else
		{
			$singleRow = "singleRow";
			$singleInfo = "singleInfo";
		}

		?>
            <div class="col-md-12 col-12 backgroundFill">
                <div class="row <?php echo $singleRow;?>">
                    <div class="col-md-3">
                    </div>

                    <div class="col-md-1 user-img pt-1">
					  <?php echo get_the_post_thumbnail($postID, 'carousel-medium', array( 'class' => ' card-img-top' )); ?>
                    </div>
                    <div class="col-md-8">
                        <p class="font-weight-bold pt-2 mb-1 text-center text-capitalize text-md-left singleTitleText"><?php echo get_the_title($postID); ?></p>

                        <p class="font-weight-bold pt-2 mb-1 text-center text-capitalize text-md-left singleTitleText"><?php echo get_post_meta($postID, 'condition', true); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-12 backgroundFill">
                <div class="row">            
	            	<div class="col-md-3">
	            	</div>

	            	<div class="<?php echo $singleInfo;?> col-md-6">
                        <p class="font-weight-bold pt-2 mb-1 text-capitalize">Description</p>
	            		<p><?php echo get_post_meta($postID, 'description', true); ?></p>
                        
	            	</div>

	            	<div class="col-md-3">
	            	</div>
	            </div>
			</div>

		<?php
	}


	public static function excerpt($title, $cutOffLength)
	{
			$title = strip_tags($title);
	    $charAtPosition = "";
	    $titleLength = strlen($title);

	    do
	    {
	        $cutOffLength++;
	        $charAtPosition = substr($title, $cutOffLength, 1);
	    } while ($cutOffLength < $titleLength && $charAtPosition != " ");

	    return substr($title, 0, $cutOffLength) . '...';
	}
}
?>