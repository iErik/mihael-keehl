<?php $categories = get_the_category(); ?>

<?php foreach( $categories as $category ): ?>
  <div class="post-category">
    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
       alt="<?php echo esc_attr( sprintf( __('View all posts in %s', 'mihael-keehl'), $category->name) ); ?>"
       class="category-link">
      <?php echo esc_html( $category->name ); ?>
    </a>
  </div>
<?php endforeach; ?>
