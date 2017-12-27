<?php use Roots\Sage\Titles; ?>

<article <?php post_class(); ?>>

  <div class="post-contents">
    <div class="post-heading">
      <div class="post-title">
        <h2 class="title h4">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
      </div>

      <div class="post-meta">
        <time class="post-time" datetime="<?= get_post_time('c', true); ?>" >
          <?= get_the_date(); ?>
        </time>
      </div>
    </div>

    <div class="post-summary">
      <?php echo Titles\get_excerpt(); ?>
    </div>

    <div class="post-categories">
      <?php get_template_part('templates/entry-categories'); ?>
    </div>
  </div>
</article>
