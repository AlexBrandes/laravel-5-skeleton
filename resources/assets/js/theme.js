$(document).ready(function() {

   // Toggle Left Menu
   $(document).on('click', '.left-panel .nav-parent > a', function() {

      var parent = $(this).parent();
      var sub = parent.find('> ul');

      // Dropdown works only when left-panel is not collapsed
      if(!$('body').hasClass('left-panel-collapsed')) {
         if(sub.is(':visible')) {
            sub.slideUp(200, function(){
               parent.removeClass('nav-active');
               $('.main-panel').css({height: ''});
               adjustMainPanelHeight();
            });
         } else {
            closeVisibleSubMenu();
            parent.addClass('nav-active');
            sub.slideDown(200, function(){
               adjustMainPanelHeight();
            });
         }
      }
      return false;
   });

   function closeVisibleSubMenu() {
      $('.left-panel .nav-parent').each(function() {
         var t = $(this);
         if(t.hasClass('nav-active')) {
            t.find('> ul').slideUp(200, function(){
               t.removeClass('nav-active');
            });
         }
      });
   }

   function adjustMainPanelHeight() {
      // Adjust main-panel height
      var docHeight = $(document).height();
      if(docHeight > $('.main-panel').height())
         $('.main-panel').height(docHeight);
   }
   adjustMainPanelHeight();


   // Tooltip
   $('.tooltips').tooltip({ container: 'body'});

   // Popover
   $('.popovers').popover();

   // Close Button in Panels
   $('.panel .panel-close').click(function(){
      $(this).closest('.panel').fadeOut(200);
      return false;
   });


   // Minimize Button in Panels
   $('.minimize').click(function(){
      var t = $(this);
      var p = t.closest('.panel');
      if(!$(this).hasClass('maximize')) {
         p.find('.panel-body, .panel-footer').slideUp(200);
         t.addClass('maximize');
         t.html('&plus;');
      } else {
         p.find('.panel-body, .panel-footer').slideDown(200);
         t.removeClass('maximize');
         t.html('&minus;');
      }
      return false;
   });


   // Add class everytime a mouse pointer hover over it
   $('.nav-bracket > li').hover(function(){
      $(this).addClass('nav-hover');
   }, function(){
      $(this).removeClass('nav-hover');
   });


   // Menu Toggle
   $('.menu-toggle').click(function(){

      var body = $('body');
      var bodypos = body.css('position');

      if (bodypos != 'relative') {

         if (! body.hasClass('left-panel-collapsed')) {
            body.addClass('left-panel-collapsed');
            $('.nav-bracket ul').attr('style','');

            $(this).addClass('menu-collapsed');

            $.cookie('left-panel-collapsed', true, { expires: 30 });
         } 
         else {
            body.removeClass('left-panel-collapsed');
            $('.nav-bracket li.active ul').css({display: 'block'});

            $(this).removeClass('menu-collapsed');

            $.removeCookie('left-panel-collapsed');
         }
      } 
      else {
         if (body.hasClass('left-panel-show')) {
            body.removeClass('left-panel-show');
            $.cookie('left-panel-collapsed', 1, { expires: 30 });
         }
         else {
            body.addClass('left-panel-show');
            $.removeCookie('left-panel-collapsed');
         }

         adjustMainPanelHeight();
      }

   });

   reposition_topnav();

   $(window).resize(function(){

      if($('body').css('position') == 'relative') {

         $('body').removeClass('left-panel-collapsed');

      } else {
         $('body').css({left: '', marginRight: ''});
      }

      reposition_topnav();

   });




   /* This function allows top navigation menu to move to left navigation menu
    * when viewed in screens lower than 1024px and will move it back when viewed
    * higher than 1024px
    */
   function reposition_topnav() {
      if($('.nav-horizontal').length > 0) {

         // top navigation move to left nav
         // .nav-horizontal will set position to relative when viewed in screen below 1024
         if($('.nav-horizontal').css('position') == 'relative') {

            if($('.left-panel .nav-bracket').length == 2) {
               $('.nav-horizontal').insertAfter('.nav-bracket:eq(1)');
            } else {
               // only add to bottom if .nav-horizontal is not yet in the left panel
               if($('.left-panel .nav-horizontal').length == 0)
                  $('.nav-horizontal').appendTo('.left-panelinner');
            }

            $('.nav-horizontal').css({display: 'block'})
                                  .addClass('nav-pills nav-stacked nav-bracket');

            $('.nav-horizontal .children').removeClass('dropdown-menu');
            $('.nav-horizontal > li').each(function() {

               $(this).removeClass('open');
               $(this).find('a').removeAttr('class');
               $(this).find('a').removeAttr('data-toggle');

            });

            if($('.nav-horizontal li:last-child').has('form')) {
               $('.nav-horizontal li:last-child').hide();
            }

         } else {
            // move nav only when .nav-horizontal is currently from left-panel
            // that is viewed from screen size above 1024
            if($('.left-panel .nav-horizontal').length > 0) {

               $('.nav-horizontal').removeClass('nav-pills nav-stacked nav-bracket')
                                        .appendTo('.topnav');
               $('.nav-horizontal .children').addClass('dropdown-menu').removeAttr('style');
               $('.nav-horizontal li:last-child').show();
               $('.nav-horizontal > li > a').each(function() {

                  $(this).parent().removeClass('nav-active');

                  if($(this).parent().find('.dropdown-menu').length > 0) {
                     $(this).attr('class','dropdown-toggle');
                     $(this).attr('data-toggle','dropdown');
                  }

               });
            }

         }

      }
   }

   // Left Panel Collapsed
   if($.cookie('left-panel-collapsed')) {
      $('body').addClass('left-panel-collapsed');
      $('.menu-toggle').addClass('menu-collapsed');
   }

   // Check if left-panel is collapsed
   if($('body').hasClass('left-panel-collapsed'))
      $('.nav-bracket .children').css({display: ''});


   // Handles form inside of dropdown
   $('.dropdown-menu').find('form').click(function (e) {
      e.stopPropagation();
   });


});
