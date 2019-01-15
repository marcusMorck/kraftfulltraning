JQuery( document ).ready(function() {
    JQuery( '.submenu' ).hide();
    JQuery( '.menu-item' ).hover(function() {

        JQuery( '.submenu' ).toggle();
       
      });
});



    
    //'.sub-menu')