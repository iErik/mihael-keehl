<?php get_template_part('templates/page', 'heading'); ?>

<?php if ( have_posts() ) : ?>
  <div class="post-feed">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php
        $post_template = get_post_type() != 'post' ? get_post_type() : get_post_format();
        get_template_part('templates/content', $post_template);
      ?>
    <?php endwhile; ?>
  </div>

  <?php the_posts_navigation(); ?>
<?php endif; ?>
