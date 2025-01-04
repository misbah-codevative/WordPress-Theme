<?php /*
Template Name: home-page-template
*/

get_header(); ?>
<div id="primary">

<div class="hero_area">
  <!-- slider section -->
  <section class="slider_section ">
    <div class="main-banner">
      <img src="<?php echo get_field("main_banner_image");?>" alt="">
    </div>
    <div class="main-banner-wrap">
      <div class="main-heading">
        <h1><?php echo get_field("main_heading");?></h1>
      </div>
      <div class="main-thumbnail">
        <div class="thumbnail01"><img src="<?php echo get_field("main_thumbnail_01");?>" alt=""></div>
        <div class="thumbnail02"><img src="<?php echo get_field("main_thumbnail_02");?>" alt=""></div>
      </div>
    </div>
  </section>
  <!-- end slider section -->
</div>

<!-- who we are section -->
<section class="whoweare_section mt-5 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <h2>Who </br><span>We Are</span></h2>
        <img src="<?php echo get_field("who_we_are_image");?>" alt="">
      </div>
      <div class="col-lg-8 col-md-8">
        <?php echo get_field("who_we_are_text");?>
      </div>
    </div>
  </div>
</section>

<!-- end who we are section -->

<!-- Our Services section -->
<section class="service-section">
  <div class="container">
    <div class="row">
      <?php
      $args = array(
          'post_type' => 'services',
          'posts_per_page' => -1 // Change this to your desired number of posts
      );

      $services_query = new WP_Query($args);

      if ($services_query->have_posts()) : ?>
          <div class="owl-carousel">
              <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
                  <div class="item item-box">
                    <?php 
                    // Get the featured image
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', ['class' => 'service-image']); // You can change 'full' to any registered image size
                    }
                    ?>
                    <h3><?php the_title(); ?></h3>
                    <div><?php the_content(); ?></div>
                  </div>
              <?php endwhile; ?>
          </div>
      <?php else : ?>
          <p><?php _e('No services found.'); ?></p>
      <?php endif; ?>

      <?php wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<!-- Our Services section -->

</div><!-- #primary -->
<?php get_footer(); ?>