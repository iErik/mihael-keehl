<article <?php post_class(); ?>>
  <header class="post-heading">
    <div class="post-title">
      <h1 class="title h4"><?php the_title(); ?></h1>
    </div>
    <?php if ( is_single() ) : ?>
      <div class="post-meta">
        <time class="post-time" datetime="<?= get_post_time('c', true); ?>" >
          <?= get_the_date(); ?>
        </time>
        <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="post-author">
          <?= get_the_author(); ?>
        </a>
      </div>
    <?php endif; ?>
  </header>

  <div class="post-content">
    <?php the_content(); ?>
  </div>
</article>

<?php if (comments_open() || get_comments_number()): ?>
  <aside class="post-comments">
      <?php comments_template(); ?>
  </aside>
<?php endif; ?>
