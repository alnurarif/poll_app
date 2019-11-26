var base_url = $('base').attr('data-base');
$(document).ready(function () {
	$('.slider_get_icon').on('dblclick',function(){
		$('#requested_pointer_id').html($(this).attr('id').substr(15));
        getIcons();
        
        
    });
    $('.close_modal_cross').on('click',function(){
        $(this).parent().parent().fadeOut();
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
    });
    $(document).on('click','#icon_submit_button_for_right',function(){
        var icon_description = $('#icon_detail_poll').val();
        var icon_id = $('#icon_id_slide_pointer').html();
        var icon_object = searchIconById(icon_id, 'id', window.icons);
        var slide_pointer_id = $('#requested_pointer_id').html();
		
		$('#slider_get_icon'+slide_pointer_id+' img').attr('src',base_url+'assets/dashboard/img/user_icons/'+icon_object.icon_file_name);		
		$('#icon_slider_id_input'+slide_pointer_id).val(icon_id);
		$('#icon_description'+slide_pointer_id).val(icon_description);
        
        $('#addIconsToSpeedoMeterSection').fadeOut();
    });

    $('#previous_icons').slimscroll({
        height: '410px',
        width: '100%',
    }).parent().css({
        border: '0px solid #184055'
    });

    $('#poll_help').on('click',function(){
        $('#helpPollModal').fadeIn();
    });
});

$(function() {
  $( "#slider .second img" ).draggable({ containment:'parent' });
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