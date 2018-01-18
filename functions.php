<?php
/**
 * Mihael includes
 *
 * The $mihael_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */

 define( 'MIHAEL_MINIMUM_PHP_VERSION', '5.4.0' );

 // Check if site meets theme requirements
 if ( version_compare(phpversion(), MIHAEL_MINIMUM_PHP_VERSION, '<') ) :

   add_action('after_switch_theme', 'mihael_revert_switch', 1, 2);
   function mihael_revert_switch($old_theme_name, $old_theme = false) {

     // Theme not activated info message.
     add_action( 'admin_notices', 'mihael_admin_notice' );
     function mihael_admin_notice() {
       ?>
         <div class="update-nag">
           <?php esc_html_e( 'You need to update your PHP version to run the Mihael Keehl Theme.', 'mihael-keehl' ); ?> <br />
           <?php esc_html_e( 'Actual version is:', 'mihael-keehl' ) ?>
           <strong><?php echo phpversion(); ?></strong>,
           <?php esc_html_e( 'minimum required is', 'mihael-keehl' ) ?>
           <strong><?php echo MIHAEL_MINIMUM_PHP_VERSION; ?></strong>
         </div>
       <?php
     }

     // Switch back to previous theme.
     switch_theme( $old_theme->stylesheet );
     return false;
   }

else :

  //  Bootstrap the theme
   $mihael_includes = array(
     'lib/extras.php',       // Custom functions
     'lib/setup.php',        // Theme setup
     'lib/titles.php',       // Page titles
     'lib/wrapper.php',      // Theme wrapper class
     'lib/customizer.php',   // Theme customizer
     'lib/styles.php',       // Dynamic custom styles
     'lib/template-tags.php' // Custom template tags
   );

   foreach ($mihael_includes as $file) {
     if (!$filepath = locate_template($file)) {
       trigger_error(sprintf(__('Error locating %s for inclusion', 'mihael-keehl'), $file), E_USER_ERROR);
     }

     require_once $filepath;
   }
   unset($file, $filepath);

endif;
