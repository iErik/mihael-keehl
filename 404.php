<?php get_template_part('templates/page', 'heading'); ?>

<section class="error-404">
  <div class="heading">
    <h1 class="heading-main"><?php _e('Oops!', 'mihael-keehl'); ?></h1>
    <h2 class="subheading"><?php _e('The page you’re looking for could not be found.', 'mihael-keehl'); ?></h2>
  </div>

  <form class="search-form" action="/" method="get" role="search">
    <label class="search-field-wrapper">
      <span class="screen-reader-text"><?php _x('Search for', 'label', 'mihael-keehl'); ?></span>
      <i class="icn-search"></i>
      <input
        type="search"
        name="s"
        class="search-field"
        placeholder="Maybe you were looking for something else..."
        value="<?php get_search_query(); ?>">
    </label>
  </form>
</section>
