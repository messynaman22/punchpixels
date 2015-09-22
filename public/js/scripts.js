

$(document).ready(function(){
    
    

    $("#label").click(function(){
        if($("#input").hasClass('focus')){
            $("#input").removeClass("focus");
        }
        else
        {
            $("#input").addClass("focus");
        }
    });

    var slider = $('.bxslider').bxSlider({
        pager: false,
        minSlides: 4,
        maxSlides: 4,
        speed: 1000,
        pause: 10000,
        auto: true,
        slideWidth: 360,
        slideMargin: 10,
        onSliderLoad: function(){
            $('.bxslider li[data-id="1"]:not(".bx-clone")').addClass('__active');
            var active_item_offset = $('.bxslider li.__active ').offset().left;
            var slide_offset_start = $('.bx-viewport').offset().left;
            var slide_offset_finish = $('.bx-viewport').offset().left + $('.bx-viewport').width();
            var left = $('.bxslider li.__active ').offset().left +$('.bxslider li.__active img').width()/2 - 20;
            if(left > slide_offset_finish)
                left = 0
            else
                left +='px';

            $('.clientpost .container2').css('margin-left',left);
            $('.carousel_content').hide();

            $('.carousel_content[data-id='+$('.bxslider .__active').data('id')+']').show();
            if((active_item_offset < slide_offset_start || active_item_offset > slide_offset_finish)){
                $('.container2').addClass('container2_hide');
            }else{
                $('.container2').removeClass('container2_hide');
            }

        },
        onSlideAfter: function($slideElement, oldIndex, newIndex){
            var active_item_offset = $('.bxslider li.__active ').offset().left;
            var slide_offset_start = $('.bx-viewport').offset().left;
            var slide_offset_finish = $('.bx-viewport').offset().left + $('.bx-viewport').width();
            var left = $('.bxslider li.__active ').offset().left +$('.bxslider li.__active img').width()/2 - 20;
            if(left > slide_offset_finish)
                left = 0
            else
                left +='px';

            $('.clientpost .container2').css('margin-left',left);
            $('.carousel_content').hide();

            $('.carousel_content[data-id='+$('.bxslider .__active').data('id')+']').show();
            if((active_item_offset < slide_offset_start || active_item_offset > slide_offset_finish)){
                $('.container2').addClass('container2_hide');
            }else{
                $('.container2').removeClass('container2_hide');
            }
        }
    });





    $( window ).resize(function() {
        var slide_offset_finish = $('.bx-viewport').offset().left + $('.bx-viewport').width();
        var left = $('.bxslider li.__active ').offset().left +$('.bxslider li.__active img').width()/2 - 20;
        if(left > slide_offset_finish)
            left = 0
        else
            left +='px';
        $('.clientpost .container2').css('margin-left',left);
    })



    $('.bxslider li ').hover(function(){
        var left = $(this).offset().left + $('.bxslider li.__active img').width()/2 - 20 + 'px';
        $('.clientpost .container2').css('margin-left',left);
        $('.carousel_content').hide();

        $('.carousel_content[data-id='+$(this).data('id')+']').show();
        $('.container2').removeClass('container2_hide');
            $(document).find('.bxslider li ').removeClass('__active');
            $(document).find(this).addClass('__active');
    }, function(){
        //var slide_offset_start = $('.bx-viewport').offset().left;
        //var slide_offset_finish = $('.bx-viewport').offset().left + $('.bx-viewport').width();
        //var left = $('.bxslider li.__active ').offset().left +$('.bxslider li.__active img').width()/2 - 20;
        //
        //var active_item_offset = $('.bxslider li.__active ').offset().left;
        //if(left > slide_offset_finish)
        //    left = 0
        //else
        //    left +='px';
        //
        //$('.clientpost .container2').css('margin-left',left);
        //$('.carousel_content').hide();
        //
        //$('.carousel_content[data-id='+$('.bxslider .__active').data('id')+']').show();
        //if((active_item_offset < slide_offset_start || active_item_offset > slide_offset_finish) && !$(this).hasClass('__active')){
        //    $('.container2').addClass('container2_hide');
        //}else{
        //    $('.container2').removeClass('container2_hide');
        //}
    });


    //$(document).on('click','.bxslider li ',function(){
    //
    //    $(document).find('.bxslider li ').removeClass('__active');
    //    $(document).find(this).addClass('__active');
    //    $(document).find('.container2').removeClass('container2_hide');
    //
    //
    //})

    var top_slider = $('.top_slider').bxSlider({
        controls: false,
        //minSlides: 1,
        mode:'vertical'
        //maxSlides: 1,
        //slideWidth: 360,
        //slideMargin: 10
    } );
    $('.customer-setisfaction .csicons li').on('click',function(e){
        e.preventDefault();
        $('.customer-setisfaction .csicons li').removeClass('__active');
        $(this).addClass('__active');
        var title = $(this).text();
        var content = $(this).data('content');
        $('.title_content').text(title);
        $('.body_content').text(content);
    })

})









