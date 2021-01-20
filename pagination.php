<div class="flex_container container">
    <div class="right_content">
        <?php
            $category = get_queried_object();
            $category_name  = $category->name ;
            $search_keyword = get_search_query(); // if on search page
        ?>
        <div class="wrapper">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'statue',
                'posts_per_page' => 12,
                'paged' => $paged,
                's' => get_search_query(), // if on search page
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()): $query->the_post();
                    $img_url =  get_the_post_thumbnail_url(null, 'large') ?? $default_unit_img_url;
                    ?>
                    <div class="single_house">
                        <a href="<?php echo get_permalink() ?>">
                            <img src="<?=$img_url; ?>" alt="">
                        </a>
                        <div class="info_box">
                            <div class="info">
                                <h2> <a href="<?php echo get_permalink() ?>"> <?php the_title(); ?>  </a> </h2>
                                <div>
                                    <h5 class="light"><s>$<?php the_field('product_gallery_price') ?>.00</s></h5>
                                    <h5 class="bold">$<?php the_field('product_discounted_price') ?>.00</h5>
                                </div>
                            </div>
                            <a class="link" href="<?php echo get_permalink() ?>">
                            <i class="fa fa-shopping-cart d_inline_m m_right_9"></i>View Details</a>
                        </div>
                    </div>
                <?php
                endwhile;
            endif;
            ?>
        </div><!--End wrapper-->
        <?php 
            $big = 999999999;
            echo paginate_links( array(
                    'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'current' => max( 1, get_query_var('paged') ),
                    'total'   => $query->max_num_pages,
                    'mid_size'     => 1,
                    'prev_text'    => 'Prev',
                    'next_text'    => 'Next',
                )
            ); 
        ?>
        <?php wp_reset_postdata(); ?>
    </div><!--End right_content-->
</div><!--end flex_container-->
