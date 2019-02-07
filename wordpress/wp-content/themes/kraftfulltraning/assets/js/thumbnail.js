$( document ).ready(function() {//Check that the document has finished loading

  
    $('.thumbnail img').click(function(){//When clicking on a thumbnail, change product image

        $('.thumbnail img').removeClass('thumbnail-active');//Removes the class 'thumbnail-active from the default thumbnail.

        var attr = $(this).attr('src');//Get the src attribute from the image being clicked by using attr
        $('.product-image img').attr('src', attr);//Change the src attribute on product image to display thumbnail image
        $(this).addClass('thumbnail-active');//Add the class 'thumbnail-active' to the clicked thumbnail.
    });
});


