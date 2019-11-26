var base_url = $('base').attr('data-base');
$(document).ready(function () {
    $('#speedo_meter_pointer_icon').on('dblclick',function(){
        resetUpdateIconForm();
        var icon_added = 0, current_one_id = 4;
        $('.icon_slider').each(function(i, obj) {
            if($(this).html()==""){
                icon_added++;    
                current_one_id--;
            }
        });
        if(current_one_id == 4){
            return false;
        }
        $('#slide_pointer_id').html('');

        getIcons();
        
    });

    $('.close_modal_cross').on('click',function(){
        $(this).parent().parent().fadeOut();
    });
    $('#poll_help').on('click',function(){
        $('#helpPollModal').fadeIn();
    });

    $('.icon_slider').on('dblclick',function(){
        id = $(this).attr('id').substr(11);
        $('#slide_pointer_id').html(id);
        $.ajax({
            url:base_url+"Dashboard/getIcons",
            method:"POST",
            data:{
                // user_id : user_id,
                csrf_test_name: $.cookie('csrf_cookie_name')
            },
            success:function(response) {
                var icons = window.icons = JSON.parse(response);
                arrange_icons_to_show(icons);
                $('#addIconsToSpeedoMeterSection').fadeIn();
            },
            error:function(){
                alert(a_error);
            }
        });
    });

    $('#create_new_icon_button').on('click',function(e){
        e.preventDefault();
        $('#select_icon_portion').fadeOut();
        $('#icon_submit_button').show();
        $('#icon_submit_button_for_right').hide();
        setTimeout(function(){ $('#add_icon_portion').fadeIn(); }, 400);

    });
    $('#icon_submit_cancel').on('click',function(e){
        e.preventDefault();
        $('#add_icon_portion').fadeOut();
        $('#icon_submit_button').hide();
        $('#icon_submit_button_for_right').show();
        setTimeout(function(){ $('#select_icon_portion').fadeIn(); }, 400);
    });
    $('#icon_save_cancel').on('click',function(e){
        e.preventDefault();
        $('#addIconsToSpeedoMeterSection').fadeOut();
        resetUpdateIconForm();
    });

    $('#icon_insert_form').submit(function(e){
        e.preventDefault();
        var form = new FormData(this); 
        $.ajax({
            url:base_url+"Dashboard/upload_icon",
            type:"post",
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                resetUpdateIconForm();
                $('#add_icon_portion').fadeOut();
                $('#icon_submit_button').hide();
                $('#icon_submit_button_for_right').show();
                getIcons();
                setTimeout(function(){ $('#select_icon_portion').fadeIn(); }, 400);
            }
        });
    });
    $('#icon_file').on('change',function(){
        var input = $(this);
        if (input[0].files && input[0].files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show_upload_before_image').html('<img id="icon_image_preview" src="'+e.target.result+'"/>');
                $('#right_preview_icon_image').attr('src',e.target.result);
            }

            reader.readAsDataURL(input[0].files[0]);
        }
        
    });
    $('#icon_name_to_insert').on('keyup',function(){
        $('#icon_name_just_show').html($(this).val());
    });

    $('#search_icon').on('keyup',function(){
        var searched_string = $(this).val().trim();
        var foundIcons = searchIcons(searched_string);
        
        arrange_icons_to_show(foundIcons);

    });

    $(document).on('click','.single_icon_and_name',function(){
        var icon_id = $(this).attr('id').substr(12);        
        
        var icon_object = searchIconById(icon_id, 'id', window.icons);
        
        $('#right_preview_icon_image').attr('src',base_url+'assets/dashboard/img/user_icons/'+icon_object.icon_file_name);
        $('#icon_name_just_show').html(icon_object.icon_name);
        $('#icon_id_slide_pointer').html(icon_id);

        // var icon_pointer = $('#speedo_meter_pointer_icon'); 
        // var degree = (icon_pointer.css('transform') != 'none') ? getDegrees(icon_pointer) : 0;
        // var transform = getTransform(icon_pointer);

        // var transform_splitted = transform.split(',');
        
        // if(transform_splitted[1]<0){
        //     degree = -Math.abs(degree);
        // }else{
        //     degree = Math.abs(degree);
        // }
        // var icon_added = 0, current_one_id = 4;

        // $('.icon_slider').each(function(i, obj) {
        //     console.log($(this).html());
        //     if($(this).html()==""){
        //         icon_added++;    
        //         current_one_id--;
        //     }
            
        // });
        // $('#icon_slider'+current_one_id).css('width','45px').html('<img src="'+base_url+'assets/dashboard/img/user_icons/'+icon_object.icon_file_name+'" id="moving_icon_image_'+icon_object.id+'" class="moving_icon_image"/>');

        // $('#icon_slider_id_input'+current_one_id).val(icon_id);
        
        // $('#addIconsToSpeedoMeterSection').fadeOut();
    });

    $(document).on('click','#icon_submit_button_for_right',function(){
        var icon_description = $('#icon_detail_poll').val();
        var icon_id = $('#icon_id_slide_pointer').html();
        var icon_object = searchIconById(icon_id, 'id', window.icons);
        var slide_pointer_id = $('#slide_pointer_id').html();

        var icon_added = 0, current_one_id = 4;

        $('.icon_slider').each(function(i, obj) {
            if($(this).html()==""){
                icon_added++;    
                current_one_id--;
            }
        });


        
        if(current_one_id > 0 && current_one_id < 4 && slide_pointer_id == ""){
            $('#icon_slider'+current_one_id).css('width','45px').html('<img src="'+base_url+'assets/dashboard/img/user_icons/'+icon_object.icon_file_name+'" id="moving_icon_image_'+icon_object.id+'" class="moving_icon_image"/>');
            $('#icon_slider_id_input'+current_one_id).val(icon_id);
            $('#icon_description'+current_one_id).val(icon_description);
        }else{
            $('#icon_slider'+slide_pointer_id).css('width','45px').html('<img src="'+base_url+'assets/dashboard/img/user_icons/'+icon_object.icon_file_name+'" id="moving_icon_image_'+icon_object.id+'" class="moving_icon_image"/>');            
            $('#icon_slider_id_input'+slide_pointer_id).val(icon_id);
            $('#icon_description'+slide_pointer_id).val(icon_description);
        }
        
        $('#addIconsToSpeedoMeterSection').fadeOut();
    });

    $('#previous_icons').slimscroll({
        height: '410px',
        width: '100%',
    }).parent().css({
        border: '0px solid #184055'
    }); 
});

$(function() {
    var target = $('#speedo_meter_pointer_icon'),
        originX = target.offset().left + target.width() / 2,
        originY = target.offset().top + target.height() / 2,
        dragging = false,
        startingDegrees = 0,
        lastDegrees = 0,
        currentDegrees = 0,
        target_left = parseInt(target.css('left'), 10),
        target_top = parseInt(target.css('top'), 10);
        console.log(target.offset().left,target.width(),target.offset().top,target.height());
    console.log(originX,originY,dragging, startingDegrees, lastDegrees, currentDegrees, target_left, target_top);
    
    var target2 = $('#icon_slider1'),
        originX2 = target2.offset().left + target2.width() / 2,
        originY2 = target2.offset().top + target2.height() / 2,
        dragging2 = false,
        startingDegrees2 = lastDegrees2 = currentDegrees2 = 0,
        target_left2 = parseInt(target2.css('left'), 10),
        target_top2 = parseInt(target2.css('top'), 10);

        // startingDegrees2 = lastDegrees2 = currentDegrees2 = (target2.css('transform') != 'none') ? getDegrees(target2) : 0

    var target3 = $('#icon_slider2'),
        originX3 = target3.offset().left + target3.width() / 2,
        originY3 = target3.offset().top + target3.height() / 2,
        dragging3 = false,
        startingDegrees3 = (target3.css('transform') != 'none') ? getDegrees(target3) : 0,
        lastDegrees3 = 0,
        currentDegrees3 = 0,
        target_left3 = parseInt(target3.css('left'), 10),
        target_top3 = parseInt(target3.css('top'), 10);

    var target4 = $('#icon_slider3'),
        originX4 = target4.offset().left + target4.width() / 2,
        originY4 = target4.offset().top + target4.height() / 2,
        dragging4 = false,
        startingDegrees4 = (target4.css('transform') != 'none') ? getDegrees(target4) : 0,
        lastDegrees4 = 0,
        currentDegrees4 = 0,
        target_left4 = parseInt(target4.css('left'), 10),
        target_top4 = parseInt(target4.css('top'), 10);
    

    $(target).draggable(
    {   
        start: function(e){
            
            dragging = true;

            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY, mouseX - originX),
            startingDegrees = radians * (180 / Math.PI);
                
        }, 
        drag: function(e,ui){
            var data = target.data( 'circle' ); 
            
            var mouseX, mouseY, radians, degrees;
        
            if (!dragging) {
                return;
            }
            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY, mouseX - originX),
            degrees = radians * (180 / Math.PI) - startingDegrees + lastDegrees;
            
            currentDegrees = degrees;
            degrees = (degrees>90 && degrees<180)?90:degrees;
            degrees = (degrees>180)?-90:degrees;
            console.log(radians * (180 / Math.PI),startingDegrees,lastDegrees,degrees);
            target.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
            target.css('-ms-transform', 'rotate(' + degrees + 'deg)');
            target.css('transform', 'rotate(' + degrees + 'deg)');
            ui.position.top = target_top;
            ui.position.left = target_left;
        },
        stop: function(e,ui){
            lastDegrees = currentDegrees;
            dragging = false;
        }
    });

    $(target2).draggable(
    {   
        start: function(e){
            
            dragging2 = true;

            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY2, mouseX - originX2),
            startingDegrees2 = radians * (180 / Math.PI);             
        }, 
        drag: function(e,ui){
            var data = target2.data( 'circle' ); 
            
            var mouseX, mouseY, radians, degrees;
        
            if (!dragging2) {
                return;
            }
            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY2, mouseX - originX2),
            degrees = radians * (180 / Math.PI) - startingDegrees2 + lastDegrees2;
            console.log(radians * (180 / Math.PI),startingDegrees2,lastDegrees2,degrees);
            currentDegrees2 = degrees;
            degrees = (degrees>90 && degrees<180)?90:degrees;
            degrees = (degrees>180)?-90:degrees;
            target2.find('img').css({
               '-moz-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               '-webkit-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               '-o-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               'transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
            });
            target2.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
            target2.css('-ms-transform', 'rotate(' + degrees + 'deg)');
            target2.css('transform', 'rotate(' + degrees + 'deg)');
            ui.position.top = target_top2;
            ui.position.left = target_left2;
        },
        stop: function(e,ui){
            lastDegrees2 = currentDegrees2;
            dragging2 = false;

            $('#icon_slider_rotation1').val(lastDegrees2);
        }
    });

    $(target3).draggable(
    {   
        start: function(e){
            
            dragging3 = true;

            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY3, mouseX - originX3),
            startingDegrees3 = radians * (180 / Math.PI);
                
        }, 
        drag: function(e,ui){
            var data = target3.data( 'circle' ); 
            
            var mouseX, mouseY, radians, degrees;
        
            if (!dragging3) {
                return;
            }
            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY3, mouseX - originX3),
            degrees = radians * (180 / Math.PI) - startingDegrees3 + lastDegrees3;
            
            currentDegrees3 = degrees;
            degrees = (degrees>90 && degrees<180)?90:degrees;
            degrees = (degrees>180)?-90:degrees;
            target3.find('img').css({
               '-moz-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               '-webkit-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               '-o-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               'transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
            });

            target3.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
            target3.css('-ms-transform', 'rotate(' + degrees + 'deg)');
            target3.css('transform', 'rotate(' + degrees + 'deg)');
            ui.position.top = target_top3;
            ui.position.left = target_left3;
        },
        stop: function(e,ui){
            lastDegrees3 = currentDegrees3;
            dragging3 = false;
            $('#icon_slider_rotation2').val(lastDegrees3);
        }
    });
    $(target4).draggable(
    {   
        start: function(e){
            
            dragging4 = true;

            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY4, mouseX - originX4),
            startingDegrees4 = radians * (180 / Math.PI);
                
        }, 
        drag: function(e,ui){
            var data = target4.data( 'circle' ); 
            
            var mouseX, mouseY, radians, degrees;
        
            if (!dragging4) {
                return;
            }
            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY4, mouseX - originX4),
            degrees = radians * (180 / Math.PI) - startingDegrees4 + lastDegrees4;
            
            currentDegrees4 = degrees;
            degrees = (degrees>90 && degrees<180)?90:degrees;
            degrees = (degrees>180)?-90:degrees;

            target4.find('img').css({
               '-moz-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               '-webkit-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               '-o-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
               'transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
            });

            target4.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
            target4.css('-ms-transform', 'rotate(' + degrees + 'deg)');
            target4.css('transform', 'rotate(' + degrees + 'deg)');
            ui.position.top = target_top4;
            ui.position.left = target_left4;
        },
        stop: function(e,ui){
            lastDegrees4 = currentDegrees4;
            dragging4 = false;
            $('#icon_slider_rotation3').val(lastDegrees4);
        }
    });
});
function resetUpdateIconForm(){
    $('#icon_insert_form').trigger("reset");
    $('#add_icon_portion').fadeOut();
    setTimeout(function(){ $('#select_icon_portion').fadeIn(); }, 400);
    $('#show_upload_before_image').html('');
    $('#right_preview_icon_image').attr('src',base_url+'assets/dashboard/img/profile_avatar.png');
    $('#icon_name_just_show').html('Influencer Name');
}
function searchIcons(searchedValue){
    
    var resultObject = search(searchedValue, window.icons);
    return resultObject;
}
function search(nameKey, myArray){
    var foundResult=new Array();
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i].icon_name.toLowerCase().includes(nameKey.toLowerCase())) {
            foundResult.push(myArray[i]);
        }
    }
    return foundResult;
}
function arrange_icons_to_show(foundIcons) {
    var icons_to_show = '';
    foundIcons.forEach(function(icon){
        icons_to_show += '<div class="single_icon_and_name fix" id="single_icon_'+icon.id+'">';
            icons_to_show += '<img src="'+base_url+'assets/dashboard/img/user_icons/'+icon.icon_file_name+'" class="icon_image"/>';
            icons_to_show += '<p class="icon_name_show">'+icon.icon_name+'</p>';
        icons_to_show += '</div>';
    });
    $('#previous_icons').html(icons_to_show);
}
function getDegrees(element) {
    var degrees = null;
    $.each(['-webkit-transform', '-moz-transform', '-o-transform', '-sand-transform', '-ms-transform', 'transform'], function(index, value) {
        var matrix = element.css(value);
        if(degrees == null || Boolean(matrix)) {
            var arrMatrix = matrix.match(/[\-0-9.]+/g);
            
            if(
                (parseFloat(arrMatrix[1]) == (-1 * parseFloat(arrMatrix[2]))) ||
                (parseFloat(arrMatrix[3]) == parseFloat(arrMatrix[0])) ||
                ((parseFloat(arrMatrix[0]) * parseFloat(arrMatrix[3]) - parseFloat(arrMatrix[2]) * parseFloat(arrMatrix[1])) == 1)
            ) {
                // degrees = Math.round(Math.acos(parseFloat(arrMatrix[0])) * 180 / Math.PI);
                degrees = (Math.acos(parseFloat(arrMatrix[0])) * 180 / Math.PI).toFixed(4);
            } else {
                degrees = 0;
            }

        }
    });
    return degrees;
}
function getTransform(element) {
    var string = element.css('transform');
    string = string.replace('matrix(','').replace(')','');
    return string;

}
function searchIconById(id, fieldName, myArray) {
    var foundResult = null;
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i][fieldName] == id) {
            foundResult =  myArray[i];
        }
    }
    return foundResult;
}
function getIcons() {
    $.ajax({
        url:base_url+"Dashboard/getIcons",
        method:"POST",
        data:{
            // user_id : user_id,
            csrf_test_name: $.cookie('csrf_cookie_name')
        },
        success:function(response) {
            var icons = window.icons = JSON.parse(response);
            arrange_icons_to_show(icons);
            $('#addIconsToSpeedoMeterSection').fadeIn();
        },
        error:function(){
            alert(a_error);
        }
    });
}