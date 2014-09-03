var allPhotos = [];

$(document).ready(function(){

    getAllPhotos();

    $('#upload-form').hide();

    $('span.upload').on('click', function(){
        $(this).parent('section').children('form').slideToggle();
    });

    $("#upload-form").ajaxForm(function(data) {
        if (data == 1){
            $('#upload-form').slideUp().andSelf().resetForm();
            getAllPhotos();
        } else {
            alert(data);
        }
    });

    $('#showImage').on('click', function(){
        $(this).css('display','none').andSelf().children('div').children('img').remove();
    });
});

function getAllPhotos(){
    $.post("main.php", function(data){
        printAllPhoto(data);
    }, "json");
}

function showImageResize(){
    var elem = $('#showImage').children('div').children('img');
    var h = elem.height();
    var w = elem.width();
    if (h>w){
        elem.css('max-height', '580px');
    } else {
        elem.css('max-width', '580px');
    }
}

function removePhoto(elem, id){
    $.get("del.php?id=" + id, function(data){
        if (data == 1){
            elem.parent('.pic').fadeOut('normal').end().remove();
        }
    });
}

function editComment(div){
    var msg = div.parent('form').serialize();
    $.ajax({
        type: 'POST',
        url: 'edit.php',
        data: msg,
        success: function() {
            getAllPhotos();
        }
    });
}

function printAllPhoto(photos){
    var mainContainer = $('#main-container');
    mainContainer.html('');
    for (var i = 0; i < photos.length; i++){
        allPhotos[i] = photos[i];
        mainContainer.append(
        "<div class='pic'>" +
            "<div class='pic-area'><img src='" + photos[i].img + "'></div>" +
            "<div class='date'><strong>Дата загрузки: </strong>" + photos[i].date + "</div>" +
            "<div class='comment'><strong>Описание: </strong>" + photos[i].comment + "</div>" +
            "<form action='' method='post'>" +
                "<textarea name='comment' cols='20' rows='2' maxlength='200'>" + photos[i].comment + "</textarea><br>" +
                "<input type='hidden' name='id' value='" + photos[i].id + "'>" +
                "<div onclick='editComment($(this))' class='btn'>Отправить</div>" +
            "</form>" +
            "<span class='edit'>Редактировать</span>" +
            "<span class='del-button del' onclick='removePhoto($(this), " + photos[i].id + ")'>Удалить</span>" +
        "</div>"
        );
    }
    $('div.pic').children('form').hide();

    mainContainer.children('div.pic').children('div').children('img').each(function(){
        var img = $(this);

        img.on('mouseover', function(){
            $(this).parent('div').parent('div.pic').css('opacity', '1');
        });

        img.on('mouseout', function(){
            $(this).parent('div').parent('div.pic').css('opacity', '0.75');
        });

        img.on('click', function(){
            var img = $(this).clone();
            $('#showImage').css('display','block').andSelf().children('div').append(img);
            showImageResize();
        });
    });

    $('span.edit').on('click', function(){
        $(this).prev().toggle().andSelf().prev().prev().toggle();
    });
}

function sort(elem, i){
    if (i == 2){
        $('#sortByDate').removeClass('active');
        elem.addClass('active');
        allPhotos.sort(function(obj1, obj2){
            return (obj2.size - obj1.size);
        });
    } else {
        $('#sortBySize').removeClass('active');
        elem.addClass('active');
        allPhotos.sort(function(obj1, obj2){
            return (obj2.id - obj1.id);
        });
    }
    printAllPhoto(allPhotos);
    console.log(allPhotos);
}

