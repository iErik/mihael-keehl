import 'jquery';

//  Open social links in a new tab
//  ------------------------------

jQuery(($) => {
  $('.social-navigation .menu-item a').attr('target', '_blank');
});

//  Toggle Sidebar
//  --------------

jQuery(($) => {
  $('.sidebar-toggle').click(function () {
    let pageHeader = $(this).closest('.header');

    if ( $(pageHeader).hasClass('page-header') )
      $(pageHeader).find('.content').toggleClass('fade-out');
    else
      $(pageHeader).toggleClass('is-active');

    $(pageHeader).find('.widget-area').toggleClass('is-active');

    $(pageHeader).find('.panel-control')
      .toggleClass('fade-out')
      .on('transitionend webkitTransitionEnd oTransitionEnd', function() {
        $(this)
          .off('transitionend webkitTransitionEnd oTransitionEnd')
          .toggleClass('fade-out');

        if ( $(this).hasClass('sidebar-toggle') )
          $(this).find('i').toggleClass('icn-menu icn-close');
      });
  });
});


//  Toggle Search Form
//  ------------------

jQuery(($) => {
  $('.page-header .search-form button').click(function() {
    $('.page-header .search-form').toggleClass('is-active');
  });
});
