<?php
/**
 * Template Name: Children page list
 */
get_header(); ?>

<div class="clear"></div>

</header> <!-- / END HOME SECTION  -->

<div id="content" class="site-content">

    <div class="container">

        <div class="content-left-wrap col-md-9">

            <div id="primary" class="content-area">

                <main id="main" class="site-main" role="main">

                    <?php 
                        while ( have_posts() ) : the_post(); 
                        
                            get_template_part( 'content', 'page' );
                            
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() ) :
                                comments_template();
                            endif;
                            
                        endwhile;
                    ?>


                    <?php
                        $post_ID = get_the_ID();
                        //query
                        $args = array(
                            'post_type'        => 'page',
                            'showposts'        => -1,
                            'post_parent'      => $post_ID,
                            'suppress_filters' => $suppress_filters,
                            'orderby'          => 'menu_order',
                            'order'            => 'ASC',
                            );
                        $faq_query = new WP_Query( $args );

                        if ( $faq_query->have_posts() ) : ?>
                        <?php while ( $faq_query->have_posts() ) : $faq_query->the_post(); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                    </h2>
                                </header><!-- .entry-header -->


                                <div class="entry-content">
                                    <?php if ( has_post_thumbnail()) : ?>
                                        <p>
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">

                                            <img class="aligncenter size-large" src="<?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large', true); echo $image_url[0]; ?>" alt="<?php the_title_attribute(); ?>" width="640" height="350" />
                                            </a>
                                        </p>
                                    <?php endif; ?>


                                    <?php the_content(""); ?>

                                </div><!-- .entry-content --><!-- .entry-summary -->

                            </article>

                        <?php endwhile; ?>

                    <?php else: ?>

                    <div class="no-results">
                        <?php echo '<p><strong>' . theme_locals("there_has") . '</strong></p>'; ?>
                        <p><?php echo theme_locals("we_apologize"); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php echo theme_locals("return_to"); ?></a> <?php echo theme_locals("search_form"); ?></p>
                        <?php get_search_form(); /* outputs the default Wordpress search form */ ?>
                    </div><!--.no-results-->

                    <?php endif; ?>
                </main><!-- #main -->

            </div><!-- #primary -->

        </div><!-- .content-left-wrap -->

        <div class="sidebar-wrap col-md-3 content-left-wrap">

            <?php get_sidebar(); ?>

        </div><!-- .sidebar-wrap -->

    </div><!-- .container -->
<?php get_footer(); ?>