<?php $site_logo = get_theme_mod( 'site_logo' ); ?>

<div class="panel-top header page-header-mobile d-lg-none">
  <div class="content">
    <div class="site-info">
      <a class="site-brand" href="<?= esc_url( home_url('/') ); ?>">
        <?php if ( !empty($site_logo) ) : ?>
          <img
            class="site-logo"
            src="<?php echo esc_url( $site_logo ); ?>"
            alt="<?php echo esc_attr( get_bloginfo('name') ); ?>"
          />
        <?php endif; ?>

        <?php bloginfo('name'); ?>
      </a>
    </div>

    <div class="panel-controls">
      <div class="panel-control sidebar-toggle">
        <button type="button" class="btn-unstyle">
          <i class="icn-menu"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="widget-area">
    <nav class="site-navigation" id="mobile-navigation" role="navigation">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'menu_id'        => 'menu-id',
          'menu_class'     => 'menu-primary mobile'
        ]);
      ?>
    </nav>

    <?php if (is_active_sidebar('sidebar-primary')): ?>
      <?php dynamic_sidebar('sidebar-primary'); ?>
    <?php endif; ?>
  </div>
</div>
