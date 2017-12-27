<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>

    <div class="site-main">
      <div class="panel-wrapper row no-gutters">
        <?php
          do_action('get_header');
          get_template_part('templates/header', 'mobile');
          get_template_part('templates/header');
         ?>

        <div class="panel-right">
          <div class="content">
            <?php include Wrapper\template_path(); ?>
          </div>
        </div><!-- /.panel-right -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->

    <?php
      do_action('get_footer');
      wp_footer();
    ?>
  </body>
</html>
