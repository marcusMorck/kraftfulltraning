$( document ).ready(function() {
    $('.thumbnail img').click(function(){
        var attr = $(this).attr('src');
        $('.product-image img').attr('src', attr);
    });
});


