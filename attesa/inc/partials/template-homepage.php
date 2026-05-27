<?php
/**
 *
 * Template Name: Homepage
 *
 *
 * @package Green_Dream_Shop
 */
get_header(); ?>
    <main id="primary" class="site-main">

        <div class="dream-hero" style="background-image: url(<?php echo esc_url(get_field('background_image')); ?>);">
            <div class="dream-hero-inner">
                <?php if(get_field('up_title')): ?>
                    <span class="hero-up-title"><?php echo esc_html(get_field('up_title')); ?></span>
                <?php endif; ?>
                <?php if(get_field('title')): ?>
                    <h1 class="hero-title"><?php echo esc_html(get_field('title')); ?></h1>
                <?php endif; ?>
                <?php if(get_field('sub_title')): ?>
                    <span class="hero-sub-title"><?php echo esc_html(get_field('sub_title')); ?></span>
                <?php endif; ?>
                <?php if(get_field('button_url')): ?>
                    <a class="hero-button" href="<?php echo esc_url(get_field('button_url')); ?>"><?php echo esc_html(get_field('button_text')); ?></a>
                <?php endif; ?>
            </div>
            <div class="dream-hero-bg"></div>
        </div>

        <div class="dream-2img-block" style="background-image: url(<?php echo esc_url(get_field('second_block_background_image')); ?>);">
            <div class="dream-2img-block-inner">
                <div class="dream-2img-single-block">
                    <?php if(get_field('first_title')): ?>
                        <h3 class="dream-2img-title first"><?php echo esc_html(get_field('first_title')); ?></h3>
                    <?php endif; ?>
                    <?php if(get_field('first_text')): ?>
                        <?php echo wp_kses_post(get_field('first_text')); ?>
                    <?php endif; ?>
                    <?php if(get_field('first_image')): ?>
                        <?php echo wp_get_attachment_image( get_field('first_image'), 'full');  ?>
                    <?php endif; ?>
                </div>
                <div class="dream-2img-single-block">
                    <?php if(get_field('second_image')): ?>
                        <?php echo wp_get_attachment_image( get_field('second_image'), 'full');  ?>
                    <?php endif; ?>
                    <?php if(get_field('second_title')): ?>
                        <h3 class="dream-2img-title"><?php echo esc_html(get_field('second_title')); ?></h3>
                    <?php endif; ?>
                    <?php if(get_field('second_text')): ?>
                        <?php echo wp_kses_post(get_field('second_text')); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="dream-2img-block-bg"></div>
        </div>

        <div class="dream-latest-product">
            <div class="dream-latest-product-inner">
                <div class="dream-latest-product-head">
                    <?php if(get_field('latest_product_title')): ?>
                        <h2 class="dream-latest-product-title"><?php echo esc_html(get_field('latest_product_title')); ?></h2>
                    <?php endif; ?>
                    <?php if(get_field('view_all_products_button_text')): ?>
                        <a class="dream-latest-product-show-all" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php echo esc_html(get_field('view_all_products_button_text')); ?></a>
                    <?php endif; ?>
                </div>
                <div class="dream-latest-product-list">
                    <?php echo do_shortcode('[products limit="'. intval(get_field('product_to_show')) .'" columns="4" orderby="date" order="DESC" ]'); ?>
                </div>
            </div>
        </div>

        <div class="dream-icons-block">
            <div class="dream-icons-block-inner">
                <?php if(get_field('icons_block_title')): ?>
                    <h2 class="dream-icons-block-title"><?php echo esc_html(get_field('icons_block_title')); ?></h2>
                <?php endif; ?>
                <?php
                    if( have_rows('block_list') ):
                        echo '<div class="dream-icons-block-list">';
                        while ( have_rows('block_list') ) : the_row();
                            $background = get_sub_field('block_background');
                            $color = get_sub_field('block_color');
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $description = get_sub_field('description');
                            $text_button = get_sub_field('text_button');
                            $url_button = get_sub_field('url_button');
                            echo '<div class="dream-icons-block-single" style="background: '. $background .'; color: '.$color.';">';
                                echo '<div class="dream-icons-block-single-icon">'. wp_get_attachment_image( $icon, 'full') .'</div>';
                                echo '<div class="dream-icons-block-single-title">'. esc_html($title) .'</div>';
                                echo '<div class="dream-icons-block-single-text">'. wp_kses_post($description) .'</div>';
                                if ($url_button) {
                                    echo '<a class="dream-icons-block-single-button" style="border-color:'.$color.';color: '.$color.'" href="'. esc_url($url_button) .'">'. esc_html($text_button) .'</a>';
                                }
                            echo '</div>';
                        endwhile;
                        echo '</div>';
                    endif;
                ?>
            </div>
        </div>

        <div class="dream-customers-block" style="background-image: url(<?php echo esc_url(get_field('customer_reviews_background_image')); ?>);">
            <div class="dream-customers-block-inner">
                <?php if(get_field('customer_reviews_title')): ?>
                    <h2 class="dream-customers-block-title"><?php echo esc_html(get_field('customer_reviews_title')); ?></h2>
                <?php endif; ?>
                <?php
                    if( have_rows('reviews') ):
                        echo '<section class="splide splide_customers inner" aria-label="Customers">';
                            echo '<div class="splide__track">';
                                echo '<ul class="splide__list">';
                                while ( have_rows('reviews') ) : the_row();
                                    $stars = get_sub_field('stars');
                                    $title = get_sub_field('title');
                                    $review = get_sub_field('review');
                                    $customer_name = get_sub_field('customer_name');
                                    $verified_customer = get_sub_field('verified_customer');
                                    echo '<li class="splide__slide">';
                                        echo '<div class="dream-customers-block-single-star">'. str_repeat('★', $stars) .'</div>';
                                        echo '<div class="dream-customers-block-single-title">'. esc_html($title) .'</div>';
                                        echo '<div class="dream-customers-block-single-text">'. wp_kses_post($review) .'</div>';
                                        echo '<div class="dream-customers-block-single-bottom">';
                                            echo '<div class="dream-customers-block-single-name">'. esc_html($customer_name) .'</div>';
                                        if ($verified_customer) {
                                            echo '<div class="dream-customers-block-single-verified"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10ZM15.0379 6.21209C14.6718 5.84597 14.0782 5.84597 13.7121 6.21209C13.7032 6.22093 13.6949 6.23029 13.6872 6.24013L9.34675 11.7709L6.72985 9.15403C6.36373 8.78791 5.77014 8.78791 5.40402 9.15403C5.0379 9.52015 5.0379 10.1137 5.40402 10.4799L8.71208 13.7879C9.0782 14.154 9.67179 14.154 10.0379 13.7879C10.0461 13.7798 10.0538 13.7712 10.061 13.7622L15.0512 7.52434C15.404 7.15727 15.3995 6.57371 15.0379 6.21209Z" fill="#5E908A"/>
</svg><span>'. esc_html__('Verified Customer', 'green-dream-shop') .'</span></div>';
                                        }
                                        echo '</div>';
                                    echo '</li>';
                                endwhile;
                                echo '</ul>';
                            echo '</div>';
                        echo '</section>';
                    endif;
                ?>
            </div>
            <div class="dream-customers-block-bg"></div>
        </div>

        <div class="dream-latest-articles">
            <div class="dream-latest-articles-inner">
                <div class="dream-latest-articles-head">
                    <?php if(get_field('blog_title')): ?>
                        <h2 class="dream-latest-articles-title"><?php echo esc_html(get_field('blog_title')); ?></h2>
                    <?php endif; ?>
                    <?php if(get_field('view_all_articles_button_text')): ?>
                        <a class="dream-latest-articles-show-all" href="<?php echo esc_url( get_field('view_all_articles_button_url') ); ?>"><?php echo esc_html(get_field('view_all_articles_button_text')); ?></a>
                    <?php endif; ?>
                </div>
                    <?php
                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 4,
                        'post_status'    => 'publish'
                    );

                    $query = new WP_Query( $args );
                    $index = 0;

                    if ( $query->have_posts() ) : ?>
                        
                    <div class="dream-latest-articles-list">

                        <div class="blog-list featured">

                            <?php while ( $query->have_posts() ) : $query->the_post(); 
                                $index++;
                                
                                if ( $index === 1 ) : ?>
                                    
                                    <article class="post-large">
                                        
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>" class="thumb-large">
                                                <?php the_post_thumbnail( 'medium_large' ); ?>
                                            </a>
                                        <?php endif; ?>

                                        <h3 class="title-large">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>

                                        <time class="date" datetime="<?php echo esc_attr( get_the_date('c') ); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>

                                        <p class="excerpt">
                                            <?php echo wp_trim_words( get_the_excerpt(), 40, '...' ); ?>
                                        </p>

                                    </article>

                            <?php endif; endwhile; ?>

                        </div>

                        <div class="blog-list">

                            <?php 
                            $query->rewind_posts();
                            $index = 0;

                            while ( $query->have_posts() ) : $query->the_post();
                                $index++;
                                if ( $index === 1 ) continue; // Skip first
                            ?>

                                <article class="post-small">

                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>" class="thumb-small">
                                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                                        </a>
                                    <?php endif; ?>

                                    <div class="small-content">
                                        <h3 class="title-small">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>

                                        <time class="date" datetime="<?php echo esc_attr( get_the_date('c') ); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>

                                        <p class="excerpt">
                                            <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                        </p>
                                    </div>

                                </article>

                            <?php endwhile; ?>

                        </div>

                    </div>

                    <?php endif; wp_reset_postdata(); ?>

            </div>
        </div>

    </main><!-- #main -->

<?php
get_footer();