/**
 * Created by Александр on 30.08.14.
 */
$(document).ready(function(){
    var h = 400;

    $('div.pic').children('form').hide();

    $('#main-container').children('div.pic').children('div').children('img').each(function(){
        var img = $(this);

        img.on('mouseover', function(){
            $(this).parent('div').parent('div.pic').css('opacity', '1');
        });

        img.on('mouseout', function(){
            $(this).parent('div').parent('div.pic').css('opacity', '0.75');
        });

        img.on('click', function(){
            var img = $(this).clone();
            $('#showImage').css('display','block').andSelf().children('div').append(img)
                .end().$(this).css('opacity', '0.75');
        });
    });

    $('#showImage').on('click', function(){
        $(this).css('display','none').andSelf().children('div').children('img').remove();
    });

    $('span.edit').on('click', function(){
        $(this).prev().toggle().andSelf().prev().prev().toggle();
    });

});