(function($) {

  // Update Site title
  wp.customize('blogname', function(value) {
    value.bind(function(to) {
      $('.brand').text(to);
    });
  });

  wp.customize('blogdescription', function(value) {

  });

})(jQuery);
