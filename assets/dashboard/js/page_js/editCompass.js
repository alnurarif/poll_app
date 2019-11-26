var base_url = $('base').attr('data-base');
$(document).ready(function () {
	$('#compass').on('dblclick',function(e){
		var $this = $(this);
		var offset = $this.offset();
		var width = $this.width();
		var height = $this.height();

		var distance = 0;

		var limit_from_center = 70;

		var centerX =  width / 2;
		var centerY = height / 2;

		// var max_x_limit = centerX + limit_from_center;
		// var max_y_limit = centerY + limit_from_center;

		var relX = e.pageX - offset.left;
		var relY = e.pageY - offset.top;

		divPos = {
	        left: e.pageX - offset.left,
	        top: e.pageY - offset.top
	    };
		
		const xDistance = centerX - relX;
		const yDistance = centerY - relY;	    
	    
	    distance = Math.sqrt((xDistance * xDistance) + (yDistance * yDistance));

	    // if(parseFloat(relX) < parseFloat(max_x_limit) && parseFloat(relY) < parseFloat(max_y_limit)){
	    // 	console.log('ok',max_x_limit,max_y_limit,centerX,centerY,relX,relY);	
	    // }
	    
	    // console.log(distance);
	    if(parseFloat(distance)<=parseFloat(90)){
	    	$('#clickedX').html(relX);
	    	$('#clickedY').html(relY);
	    	var compass_icon_number = 0;

			compass_icon_number = $('.compass_image_holder').length;
	    	if(compass_icon_number<5){
	    		getIcons();	
	    	}
	    	
	    }
		// $(this).html('<p style="position:absolute;top:'+divPos.top+'px;left:'+divPos.left+'px">arif</p>')
		// $(this).html('<p style="position:absolute;top:'+centerY+'px;left:'+centerX+'px">arif</p>')
	});

	//icon select modal portion
	$(document).on('click','.single_icon_and_name',function(){
        var icon_id = $(this).attr('id').substr(12);        
        
        var icon_object = searchIconById(icon_id, 'id', window.icons);
        
        $('#right_preview_icon_image').attr('src',base_url+'assets/dashboard/img/user_icons/'+icon_object.icon_file_name);
        $('#icon_name_just_show').html(icon_object.icon_name);
        $('#icon_id_slide_pointer').html(icon_id);
    });
    $('.close_modal_cross').on('click',function(){
        $(this).parent().parent().fadeOut();
    });
    $('#poll_help').on('click',function(){
        $('#helpPollModal').fadeIn();
    });
    $('#search_icon').on('keyup',function(){
        var searched_string = $(this).val().trim();
        var foundIcons = searchIcons(searched_string);
        
        arrange_icons_to_show(foundIcons);

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
    $(document).on('click','#icon_submit_button_for_right',function(){
        var icon_description = $('#icon_detail_poll').val();
        var icon_id = $('#icon_id_slide_pointer').html();
        var icon_object = searchIconById(icon_id, 'id', window.icons);

        var clickedX = $('#clickedX').html();
        var clickedY = $('#clickedY').html();
		
		var compass_icon_number = 0;

		$('#compass').append('<div class="compass_image_holder" style="top: '+clickedY+'px;left: '+clickedX+'px;"><img src="'+base_url+'assets/dashboard/img/user_icons/'+icon_object.icon_file_name+'"/></div>')
		// $('#slider_get_icon'+slide_pointer_id+' img').attr('src',base_url+'assets/dashboard/img/user_icons/'+icon_object.icon_file_name);		
		compass_icon_number = $('.compass_image_holder').length;

		$('#compass_icon_id_input'+compass_icon_number).val(icon_id);
		$('#compass_icon_position'+compass_icon_number).val(Math.round(clickedX)+','+Math.round(clickedY));
		$('#icon_description'+compass_icon_number).val(icon_description);
        
        $('#addIconsToSpeedoMeterSection').fadeOut();
    });
    $('.compass_option').on('keyup',function(){
    	var text = $(this).val().trim();
    	if(text.length>23){
    		text = text.slice(0,(text.length - 1));
    		$(this).val(text);
    	}
    });
});
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
function searchIconById(id, fieldName, myArray) {
    var foundResult = null;
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i][fieldName] == id) {
            foundResult =  myArray[i];
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

function circularText(txt, radius, classIndex, origin = 0) {
    txt = txt.split(""), classIndex = document.getElementsByClassName("circTxt")[classIndex];

    var deg = 90 / txt.length;
    
    var space_between_letters_in_deg = 3;
    var total_space_of_letters_in_deg = parseInt(3*txt.length);
    var space_without_letter_in_deg = 90-total_space_of_letters_in_deg;
    var half_space_without_letter_in_deg = space_without_letter_in_deg/2;
    origin = origin + half_space_without_letter_in_deg;
    txt.forEach((ea) => {
        ea = `<p style='height:${radius}px;position:absolute;transform:rotate(${origin}deg);transform-origin:0 100%'>${ea}</p>`;
        classIndex.innerHTML += ea;
        origin += space_between_letters_in_deg;
    });
}

circularText($('#compass_option_1').val(), 175, 0, 0);
circularText($('#compass_option_2').val(), 175, 0, 90);
circularText($('#compass_option_3').val(), 175, 0, 180);
circularText($('#compass_option_4').val(), 175, 0, 270);