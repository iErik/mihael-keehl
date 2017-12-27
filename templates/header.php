<?php $site_logo  = get_theme_mod( 'site_logo' ); ?>
<?php $logo_style = get_theme_mod( 'logo_style', 'show-title' ); ?>

<div class="panel-left header page-header d-none d-lg-flex">
  <div class="panel-controls">
    <div class="panel-control sidebar-toggle">
      <button class="btn-unstyle" type="button">
        <i class="icn-menu"></i>
      </button>
    </div>

    <div class="panel-control search-form <?php echo is_search() ? 'is-active' : '' ?>">
      <?php get_search_form(); ?>
      <button type="button" class="btn-unstyle">
        <i class="icn-search"></i>
      </button>
    </div>
  </div>

  <div class="content-wrap">
    <div class="content">
      <div class="site-info">
        <a class="site-brand <?php echo ((!empty($site_logo) && ($logo_style == 'hide-title')) ? 'hide-title' : '') ?>" href="<?= esc_url( home_url('/') ); ?>">
          <?php if ( !empty($site_logo) ) : ?>
            <img
              class="site-logo"
              src="<?php echo esc_url( $site_logo ); ?>"
              alt="<?php echo esc_attr( get_bloginfo('name') ); ?>"
            />
          <?php endif; ?>

          <?php if ( !( !empty($site_logo) && ($logo_style == 'hide-title') ) ) : ?>
              <?php bloginfo('name'); ?>
            </a>
          <?php if ( !empty( get_bloginfo('description') ) ) : ?>
            <h2 class="site-desc">
              <?php bloginfo('description'); ?>
            </h2>
          <?php endif; ?>
        <?php else :  ?>
          </a>
        <?php endif; ?>
      </div>

      <?php if ( has_nav_menu('social') ): ?>
        <nav class="social-navigation fadeIn">
          <?php
            wp_nav_menu([
              'theme_location' => 'social',
              'link_before'    => '<span class="screen-reader-text">',
              'link_after'     => '</span>',
              'menu_class'     => 'menu-social',
              'fallback_cb'    => false,
            ]);
          ?>
        </nav>
      <?php endif; ?>
    </div>

    <div class="widget-area">
      <nav class="site-navigation" id="site-navigation" role="navigation">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'menu_id'        => 'menu-id',
            'menu_class'     => 'menu-primary'
          ]);
        ?>
      </nav>

      <?php if (is_active_sidebar('sidebar-primary')): ?>
        <?php dynamic_sidebar('sidebar-primary'); ?>
      <?php endif ?>
    </div>
  </div>
</div>
