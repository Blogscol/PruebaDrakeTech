<?php
/**
 * The template for displaying content in the index.php template.
 */
?>
            <article id="post-<?php the_ID(); ?>" class="col-md-6" style="margin: 20px 0px;">
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <p class="font-weight-bold darkWhite align-items-center justify-content-center"><?php echo get_the_title();?></p>
                    </div>
                    <div class="col-md-12">
                        <div class="rounded-circle d-flex align-items-center justify-content-center w-100">
											  <?php 
													$imageID = get_post_meta(get_the_ID(), 'second_featured_img', true);
											  	echo wp_get_attachment_image($imageID, 'carousel-thumb', array( 'class' => 'd-block w-100' ));
											  ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <p id="desc"><?php echo excerpt(get_post_meta(get_the_ID(), 'description', true), 80);?> </p>
                    <div class="d-flex">
                        <h6 class=" align-self-center"> 
                        	<a class="btn btn-primary" href="<?php echo get_permalink();?>" role="button">BUY</a><span class="rounded-circle sp1 px-2 py-0 ml-1"> <i class="fa fa-angle-right" aria-hidden="true"></i> </span> </a> </h6> <button class="btn d-flex ml-auto px-3 font-weight-bold darkWhite"><?php echo get_post_meta(get_the_ID(), 'condition', true);?></button>
                    </div>
                </div>
            </article>

