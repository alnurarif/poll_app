var base_url = $('base').attr('data-base');
$(document).ready(function () {
	$('.single_debate').on('click',function(e){

		e.preventDefault();
		$('#galton_wrapper').hide();
		var poll_id = $(this).attr('id').substr(14);
		$('html, body').animate({
	        scrollTop: $('#wrapper_poll').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
	    }, 'slow');
		getPollInformation(poll_id);

		
	});
	$('#question_right').on('click',function(){
		var current_selected_poll_id = $('#selected_poll_id').html();
		if($("#single_debate_"+current_selected_poll_id).next().length>0){
			var next_poll_id = $("#single_debate_"+current_selected_poll_id).next().attr('id').substr(14);	
			$('#galton_wrapper').hide();
			$('#wrapper_poll').css('height','750px');
			getPollInformation(next_poll_id);
		}
		
	});
	$('#question_left').on('click',function(){
		var current_selected_poll_id = $('#selected_poll_id').html();
		if($("#single_debate_"+current_selected_poll_id).prev().length>0){
			var previous_poll_id = $("#single_debate_"+current_selected_poll_id).prev().attr('id').substr(14);	
			getPollInformation(previous_poll_id);
		}
		
	});
	$('#question_cross').on('click',function(){
		// $('#wrapper_poll').fadeOut();
		$('#wrapper_poll').css('height','0px');
	});


	$( "#slider .second img" ).draggable({ 
		containment:'parent',
		stop: function(e,ui){
			var line_width = $("#slide_line").width();
			var pointer_position = parseInt($(this).css('left'), 10);

			var position_in_percentage = parseFloat((pointer_position*100)/line_width);
			vote_now_slider_poll(position_in_percentage);
		} 
	});


	$("#slider .second img").on('mouseup mouseleave',function(){
		
	});

	$('#close_add_button').on('click',function(){
		$('#image_after_voting #add_image').css('height','0px');
		$('#image_after_voting').fadeOut();

	});

	$('#information_icon').on('click',function(){
		$('#company_info_wrapper').fadeIn();
	});

	$('.arrow_up').on('click',function(){
		$(this).parent().parent().next().css('height','0px');
		$(this).css('display','none');
		$(this).next().css('display','block');
	});

	$('.arrow_down').on('click',function(){
		$('.arrow_up').css('display','none');
		$('.arrow_down').css('display','block');
		$('.info_paragraph_section').css('height','0px')
		$(this).parent().parent().next().css('height','auto');
		$(this).css('display','none');
		$(this).prev().css('display','block');

	});
	$('#company_info_wrapper_close').on('click',function(){
		$('#company_info_wrapper').fadeOut();
	});


});

function drawLineGraphSliderPoll(percentages) {
	var one = [], two = [], three = [], four = [], five = [], six = [], seven = [], eight = [], nine = [], ten = [];
	var percentage_array = new Array();
	percentages.forEach(function(percentage) {
		if(parseInt(percentage.percentage)>=0 && parseInt(percentage.percentage)<11){
			one.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=11 && parseInt(percentage.percentage)<21){
			two.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=21 && parseInt(percentage.percentage)<31){
			three.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=31 && parseInt(percentage.percentage)<41){
			four.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=41 && parseInt(percentage.percentage)<51){
			five.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=51 && parseInt(percentage.percentage)<61){
			six.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=61 && parseInt(percentage.percentage)<71){
			seven.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=71 && parseInt(percentage.percentage)<81){
			eight.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=81 && parseInt(percentage.percentage)<91){
			nine.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=91 && parseInt(percentage.percentage)<=100){
			ten.push(parseInt(percentage.percentage));
		} 	

	});
	var points = new Array(100);
        for (var i = 0; i <= 100; i++) {
            points[i] = i + 1; 
        }
	var chartData = {
		node: "graph",
		dataset: [one.length,two.length,three.length,four.length,five.length,six.length,seven.length,eight.length,nine.length,ten.length],
		labels: [10,20,30,40,50,60,70,80,90,100],
		pathcolor: "#288ed4",
		fillcolor: "#8e8e8e",
		xPadding: 0,
		yPadding: 0,
		ybreakperiod: 50
	};
	drawlineChart(chartData);
}
function run_compass_pointer() {
	var target = $('#compass_hand'),
	originX = target.offset().left + target.width() / 2,
	originY = target.offset().top + target.height() / 2,
	dragging = false,
	startingDegrees = 0,
	lastDegrees = 0,
	currentDegrees = 0,
	target_left = parseInt(target.css('left'), 10),target_top = parseInt(target.css('top'), 10);


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
			target.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
			target.css('-ms-transform', 'rotate(' + degrees + 'deg)');
			target.css('transform', 'rotate(' + degrees + 'deg)');
			ui.position.top = target_top;
			ui.position.left = target_left;
		},
		stop: function(e,ui){
			lastDegrees = currentDegrees;
			dragging = false;
			vote_now_compass(lastDegrees);
		}
	});
}

function run_speedo_meter_pointer(){
	var target = $('#speedo_meter_pointer_icon'),
	originX = target.offset().left + target.width() / 2,
	originY = target.offset().top + target.height() / 2,
	dragging = false,
	startingDegrees = 0,
	lastDegrees = 0,
	currentDegrees = 0,
	target_left = parseInt(target.css('left'), 10),
	target_top = parseInt(target.css('top'), 10);

	$(target).draggable({
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

			target.find('img').css({
			   '-moz-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
			   '-webkit-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
			   '-o-transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
			   'transform' : 'rotate('+parseFloat(degrees*-1).toFixed(4)+'deg)',
			});
			target.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
			target.css('-ms-transform', 'rotate(' + degrees + 'deg)');
			target.css('transform', 'rotate(' + degrees + 'deg)');
			$('#compass_hand2').css('-webkit-transform', 'rotate(' + degrees + 'deg)');
			$('#compass_hand2').css('-ms-transform', 'rotate(' + degrees + 'deg)');
			$('#compass_hand2').css('transform', 'rotate(' + degrees + 'deg)');
			ui.position.top = target_top;
			ui.position.left = target_left;
		},
		stop: function(e,ui){
			lastDegrees = currentDegrees;
			dragging = false;
			vote_now(lastDegrees);
		}
	});

	pointer_two_times_zoom();
}
function vote_now(lastDegrees) {
	var poll_id = $('#selected_poll_id').html();
	$.ajax({
        url:base_url+"Votes/giveVoteSpeedoMeter",
        method:"POST",
        data:{
            rotation : lastDegrees,
            poll_id : poll_id,
            csrf_test_name: $.cookie('csrf_cookie_name')
        },
        success:function(response) {
        	var response = JSON.parse(response);
        	var vote_first_section = parseInt(response.first);
        	var vote_mid_section = parseInt(response.mid);
        	var vote_last_section = parseInt(response.last);
        	var total_votes = parseInt(response.total_votes.total_votes);
        	var company_info = response.company_info;
        	var vote_first_section_percentage = parseInt(Math.round((vote_first_section*100)/total_votes));
        	var vote_mid_section_percentage = parseInt(Math.round((vote_mid_section*100)/total_votes));
        	var vote_last_section_percentage = parseInt(Math.round((vote_last_section*100)/total_votes));
        	$('#left_vote_percentage_text').html(vote_first_section_percentage);
        	$('#mid_vote_percentage_text').html(vote_mid_section_percentage);
        	$('#right_vote_percentage_text').html(vote_last_section_percentage);
        	$('.speedo_meter_vote_percentage_text').show();
        	$('#wrapper_poll').css('height','750px');
        	if(company_info.package_id=='2'){
        		if(company_info.icon_file_name=="" ||company_info.icon_file_name==null){
        			$('#galton_icon').attr('src', base_url+'assets/dashboard/img/profile_avatar.png');	
        		}else{
        			$('#galton_icon').attr('src', base_url+'assets/galton_board/img/user_icons/'+company_info.icon_file_name);
        		}
        		
        		$('#galton svg').css('display','none').css('top','-7px');
        		var galton_color = '#cfcfcf';
        		if(company_info.galton_color=="" || company_info.galton_color==null){
        			galton_color = '#cfcfcf';	
        		}else{
        			galton_color = '#'+company_info.galton_color;
        		}
        		$('#galton svg').css('display','block');
        		
        		$('html, body').animate({
			        scrollTop: $('#wrapper_poll').offset().top + 600 //#DIV_ID is an example. Use the id of your destination on the page
			    }, 'slow');

        		setGalton(response.galton_info.last_galton_result_array,total_votes,galton_color);
        		
        		$('#galton .bar').css('background',galton_color);
        		$('#wrapper_poll').css('height','1250px');
        		
        		
        	}
        	$('#user_voted').html(total_votes);
        	// $('#image_after_voting').fadeIn('500');
 			// $('#image_after_voting #add_image').css('height','400px');
        	
        },
        error:function(){
            alert(a_error);
        }
    });
}
function vote_now_compass(lastDegrees) {
	var poll_id = $('#selected_poll_id').html();
	$.ajax({
        url:base_url+"Votes/giveVoteCompass",
        method:"POST",
        data:{
            rotation : lastDegrees,
            poll_id : poll_id,
            csrf_test_name: $.cookie('csrf_cookie_name')
        },
        success:function(response) {
        	var response = JSON.parse(response);
        	var vote_first_section = parseInt(response.first);
        	var vote_second_section = parseInt(response.second);
        	var vote_third_section = parseInt(response.third);
        	var vote_forth_section = parseInt(response.forth);
        	var vote_fifth_section = parseInt(response.fifth);
        	var vote_sixth_section = parseInt(response.sixth);
        	var company_info = response.company_info;
        	var total_votes = parseInt(response.total_votes.total_votes);
        	var vote_first_section_percentage = parseInt(Math.round((vote_first_section*100)/total_votes));
        	var vote_second_section_percentage = parseInt(Math.round((vote_second_section*100)/total_votes));
        	var vote_third_section_percentage = parseInt(Math.round((vote_third_section*100)/total_votes));
        	var vote_forth_section_percentage = parseInt(Math.round((vote_forth_section*100)/total_votes));
        	var vote_fifth_section_percentage = parseInt(Math.round((vote_fifth_section*100)/total_votes));
        	var vote_sixth_section_percentage = parseInt(Math.round((vote_sixth_section*100)/total_votes));
        	$('#compass_vote_percentage_text_1').html(vote_first_section_percentage);
        	$('#compass_vote_percentage_text_2').html(vote_second_section_percentage);
        	$('#compass_vote_percentage_text_3').html(vote_third_section_percentage);
        	$('#compass_vote_percentage_text_4').html(vote_forth_section_percentage);
        	$('#compass_vote_percentage_text_5').html(vote_fifth_section_percentage);
        	$('#compass_vote_percentage_text_6').html(vote_sixth_section_percentage);
        	// $('#mid_vote_percentage_text').html(vote_mid_section_percentage);
        	// $('#right_vote_percentage_text').html(vote_last_section_percentage);
        	$('#wrapper_poll').css('height','750px');
        	if(company_info.package_id=='2'){
        		if(company_info.icon_file_name=="" ||company_info.icon_file_name==null){
        			$('#galton_icon').attr('src', base_url+'assets/dashboard/img/profile_avatar.png');	
        		}else{
        			$('#galton_icon').attr('src', base_url+'assets/galton_board/img/user_icons/'+company_info.icon_file_name);
        		}
        		
        		$('#galton svg').css('display','none').css('top','-7px');
        		var galton_color = '#cfcfcf';
        		if(company_info.galton_color=="" || company_info.galton_color==null){
        			galton_color = '#cfcfcf';	
        		}else{
        			galton_color = '#'+company_info.galton_color;
        		}
        		$('#galton svg').css('display','block');
        		
        		$('html, body').animate({
			        scrollTop: $('#wrapper_poll').offset().top + 600 //#DIV_ID is an example. Use the id of your destination on the page
			    }, 'slow');

        		setGalton(response.galton_info.last_galton_result_array,total_votes,galton_color);
        		
        		$('#galton .bar').css('background',galton_color);
        		$('#wrapper_poll').css('height','1250px');
        		
        		
        	}

        	$('.compass_vote_percentage_text').show();
        	$('#user_voted').html(total_votes);
        	// $('#image_after_voting').fadeIn('500');
 			// $('#image_after_voting #add_image').css('height','400px');
        	
        },
        error:function(){
            alert(a_error);
        }
    });
}
function vote_now_slider_poll(percentage) {
	var poll_id = $('#selected_poll_id').html();
	$.ajax({
        url:base_url+"Votes/giveVoteSlider",
        method:"POST",
        data:{
            percentage : percentage,
            poll_id : poll_id,
            csrf_test_name: $.cookie('csrf_cookie_name')
        },
        success:function(response) {

        	var response = JSON.parse(response);
        	var vote_first_section = parseInt(response.first);
        	var vote_mid_section = parseInt(response.mid);
        	var vote_last_section = parseInt(response.last);
        	var total_votes = parseInt(response.total_votes.total_votes);
        	var company_info = response.company_info;
        	var all_percentages = response.all_percentages;
        	var vote_first_section_percentage = parseInt(Math.round((vote_first_section*100)/total_votes));
        	var vote_mid_section_percentage = parseInt(Math.round((vote_mid_section*100)/total_votes));
        	var vote_last_section_percentage = parseInt(Math.round((vote_last_section*100)/total_votes));

        	$('#slider_left_percentage_text').html(vote_first_section_percentage);
        	$('#slider_mid_percentage_text').html(vote_mid_section_percentage);
        	$('#slider_right_percentage_text').html(vote_last_section_percentage);

        	$('.slider_percentage_text').show();

        	$('#user_voted').html(total_votes);
        	$('#wrapper_poll').css('height','750px');
        	if(company_info.package_id=='2'){
        		if(company_info.icon_file_name=="" ||company_info.icon_file_name==null){
        			$('#galton_icon').attr('src', base_url+'assets/dashboard/img/profile_avatar.png');	
        		}else{
        			$('#galton_icon').attr('src', base_url+'assets/galton_board/img/user_icons/'+company_info.icon_file_name);
        		}
        		
        		$('#galton svg').css('display','none').css('top','-7px');
        		var galton_color = '#cfcfcf';
        		if(company_info.galton_color=="" || company_info.galton_color==null){
        			galton_color = '#cfcfcf';	
        		}else{
        			galton_color = '#'+company_info.galton_color;
        		}
        		$('#galton svg').css('display','block');
        		
        		$('html, body').animate({
			        scrollTop: $('#wrapper_poll').offset().top + 600 //#DIV_ID is an example. Use the id of your destination on the page
			    }, 'slow');

        		setGalton(response.galton_info.last_galton_result_array,total_votes,galton_color);
        		
        		$('#galton .bar').css('background',galton_color);
        		$('#wrapper_poll').css('height','1250px');
        		
        		
        	}

        	drawChart(vote_first_section_percentage,vote_mid_section_percentage,vote_last_section_percentage);
 			$('#piechart').fadeIn();
 			// drawLineGraphSliderPoll(all_percentages);

 			// $('#image_after_voting').fadeIn('500');
 			// $('#image_after_voting').fadeIn('500');
 			// $('#image_after_voting #add_image').css('height','400px');
        },
        error:function(){
            alert(a_error);
        }
    });
}
function zoom_in_zoom_out_pointer() {
	var image_container = $('#speedo_meter_pointer_icon');
	var zoom_in_out_pointer = $('#speedo_meter_pointer_icon img');
	var image_container_width = image_container.width();
	var zoom_in_out_pointer_width = zoom_in_out_pointer.width();

	var image_two_times_zoom_and_out_width = parseInt(image_container_width)*2;
	var image_three_times_zoom_and_out_width = parseInt(image_container_width)*3;
	
	if(zoom_in_out_pointer_width == image_three_times_zoom_and_out_width){
		pointer_two_times_zoom();
	}else if(zoom_in_out_pointer_width == image_two_times_zoom_and_out_width){
		pointer_three_times_zoom();
	}
}    
var interval_past = setInterval(function(){
	zoom_in_zoom_out_pointer();
}, 500); 
var interval = setInterval(function(){
	clearInterval(interval_past);
}, 2000); 
var interval_next = setInterval(function(){
        interval_past = setInterval(function(){
		        zoom_in_zoom_out_pointer();
		        // clearInterval(interval);
		}, 400); 
}, 2001); 
function pointer_three_times_zoom() {
	var image_container = $('#speedo_meter_pointer_icon');
	var zoom_in_out_pointer = $('#speedo_meter_pointer_icon img');
	var image_container_width = image_container.width();
	
	var image_three_times_zoom_and_out_width = parseInt(image_container_width)*3;
	var image_half_width = image_three_times_zoom_and_out_width/2;
	zoom_in_out_pointer.css('margin-top',-Math.abs(image_half_width)).css('margin-left',-Math.abs(image_container_width)).css('width',image_three_times_zoom_and_out_width);	
}

function pointer_two_times_zoom() {
	var image_container = $('#speedo_meter_pointer_icon');
	var zoom_in_out_pointer = $('#speedo_meter_pointer_icon img');
	var image_container_width = image_container.width();
	
	var image_two_times_zoom_and_out_width = parseInt(image_container_width)*2;
	
	var image_out_part_of_container = image_two_times_zoom_and_out_width - image_container_width;

	var half_of_out_part = image_out_part_of_container/2;

	var image_half_width = image_two_times_zoom_and_out_width/2;
	zoom_in_out_pointer.css('margin-top',-Math.abs(image_half_width)).css('margin-left',-Math.abs(half_of_out_part)).css('width',image_two_times_zoom_and_out_width);	
}

function getPollInformation(poll_id) {
	$('#selected_poll_id').html(poll_id);
	$('#piechart').fadeOut();
	$.ajax({
        url:base_url+"Debates/getPoll",
        method:"POST",
        data:{
            poll_id : poll_id,
            csrf_test_name: $.cookie('csrf_cookie_name')
        },
        success:function(response) {
            var poll_info = JSON.parse(response);
            var poll = poll_info.poll;
        	var poll_icons = poll_info.poll_icons;
        	var votes = poll_info.votes;
        	
        	$('#question_header').html(poll.question);
        	$('#left_label_text').html(poll.left_label);
        	$('#right_label_text').html(poll.right_label);
        	$('#slide_left_answer').html(poll.left_label);
        	$('#slide_right_answer').html(poll.right_label);
        	$('#debate_creator_company').html(poll.company_name);
        	$('#compass_wrapper2').hide();
        	$('#plain_slider_wrapper').hide();
        	$('#compass_wrapper').hide();
        	if(poll.poll_type == "Speedo Meter"){
        		var icon_slider_image1 = "";
			    var icon_slider_image2 = "";
			    var icon_slider_image3 = "";
			    var icon_slider_pointer_show1 = "";
			    var icon_slider_pointer_show2 = "";
			    var icon_slider_pointer_show3 = "";
			    $('#icon_slider1,#icon_slider2,#icon_slider3').html('').css('width','0px').css('transform','rotate(0deg');
			    if(poll_icons.length>0){
			        var i = 1;
			        poll_icons.forEach(function(entry) {
				    	$('#icon_slider'+i).html('<img style="transform: rotate('+parseFloat(entry.icon_rotation*-1).toFixed(4)+'deg)" src="'+base_url+'assets/dashboard/img/user_icons/'+entry.icon_file_name+'" id="moving_icon_image_'+entry.id+'" class="moving_icon_image"/>');
				    	$('#icon_slider'+i).css('width','45px').css('transform','rotate('+parseFloat(entry.icon_rotation).toFixed(4)+'deg');
			            i++;
					});
			    }
        		$('#compass_hand2').html('<img src="'+base_url+'assets/dashboard/img/logos/'+poll.company_logo+'" id="compass_hand_company_logo">');
			    $('#compass_hand2').css('background-color','#'+poll.indicator_color);
			    $('#compass_wrapper2').show();
        	}else if(poll.poll_type == "Slider"){
        		$('#slider_get_icon1 img').attr('src',base_url+'assets/dashboard/img/profile_avatar.png');
        		$('#slider_get_icon2 img').attr('src',base_url+'assets/dashboard/img/profile_avatar.png');
        		if(poll_icons.length>0){
			        var i = 1;
			        poll_icons.forEach(function(entry) {
			        	if(entry.icon_side == "Left"){
			        		$('#slider_get_icon1 img').attr('src',base_url+'assets/dashboard/img/user_icons/'+entry.icon_file_name);
			        	}
			        	if(entry.icon_side == "Right"){
			        		$('#slider_get_icon2 img').attr('src',base_url+'assets/dashboard/img/user_icons/'+entry.icon_file_name);
			        	}
			            i++;
					});
			    }
			    $('#slider_company_icon').attr('src',base_url+'assets/dashboard/img/logos/'+poll.company_logo);

        		$('#plain_slider_wrapper').show();
        	}else if(poll.poll_type == "Compass"){
        		$('.compass_image_holder').remove();
        		if(poll_icons.length>0){
			        var i = 1;

			        poll_icons.forEach(function(entry) {
			        	var image_position_array = entry.compass_icon_position.split(',');
			        	var compass_icon_image = '';	
			        	compass_icon_image += '<div class="compass_image_holder" style="top: '+image_position_array[1]+'px;left: '+image_position_array[0]+'px;">';
			        		compass_icon_image += '<img src="'+base_url+'assets/dashboard/img/user_icons/'+entry.icon_file_name+'">';
			        	compass_icon_image += '</div>';
			        	$('#compass').prepend(compass_icon_image)
			        	
			        	// if(entry.icon_side == "Left"){
			        	// 	$('#slider_get_icon1 img').attr('src',base_url+'assets/dashboard/img/user_icons/'+entry.icon_file_name);
			        	// }
			        	// if(entry.icon_side == "Right"){
			        	// 	$('#slider_get_icon2 img').attr('src',base_url+'assets/dashboard/img/user_icons/'+entry.icon_file_name);
			        	// }
			            i++;
					});
			    }
			    $('.circTxt').html('');
			    circularText(poll.first_label, 175, 0, 0);
				circularText(poll.second_label, 175, 0, 90);
				circularText(poll.third_label, 175, 0, 180);
				circularText(poll.forth_label, 175, 0, 270);
				if(poll.indicator_color == "" || poll.indicator_color == null){
					$('#compass_indicator').css('fill','#c62d2d');	
				}else{
					$('#compass_indicator').css('fill','#'+poll.indicator_color);
				}
				
        		$('#compass_wrapper').show();

        	}
        	$('#user_voted').html(votes.total_votes);

        	$('#wrapper_poll').css('height','750px');
        	// $('#wrapper_poll').fadeIn();
        	setTimeout(function(){ 
        		run_speedo_meter_pointer();
        		run_compass_pointer(); 
        	}, 1000);
        	
        },
        error:function(){
            alert(a_error);
        }
    });
}



  google.charts.load('current', {'packages':['corechart']});
  // google.charts.setOnLoadCallback(drawChart);

  function drawChart(first,mid,last) {

    var data = google.visualization.arrayToDataTable([
      ['Vote', 'Percentage'],
      ['First', first],
      ['Mid', mid],
      ['Last', last]
    ]);

    var options = {
      title: 'Vote Percentage'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
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

function setGalton(galtonInfo,total_votes,drop_color) {
	$('#galton_wrapper').show();
	// $last_galton_result_array = $galton_info['last_galton_result_array'];
	
	// $galton_bar_height1 = ($last_galton_result_array[0]*100)/$galton_info['votes'];
	// $galton_bar_height2 = ($last_galton_result_array[1]*100)/$galton_info['votes'];
	// $galton_bar_height3 = ($last_galton_result_array[2]*100)/$galton_info['votes'];
	// $galton_bar_height4 = ($last_galton_result_array[3]*100)/$galton_info['votes'];
	// $galton_bar_height5 = ($last_galton_result_array[4]*100)/$galton_info['votes'];
	// $galton_bar_height6 = ($last_galton_result_array[5]*100)/$galton_info['votes'];
	// $galton_bar_height7 = ($last_galton_result_array[6]*100)/$galton_info['votes'];
	// $galton_bar_height8 = ($last_galton_result_array[7]*100)/$galton_info['votes'];
	// $galton_bar_height9 = ($last_galton_result_array[8]*100)/$galton_info['votes'];
	// $galton_bar_height10 = ($last_galton_result_array[9]*100)/$galton_info['votes'];
	// $galton_bar_height11 = ($last_galton_result_array[10]*100)/$galton_info['votes'];

	var galton_bar_height1 = (parseInt(galtonInfo[0])*100)/parseInt(total_votes);
	var galton_bar_height2 = (parseInt(galtonInfo[1])*100)/parseInt(total_votes);
	var galton_bar_height3 = (parseInt(galtonInfo[2])*100)/parseInt(total_votes);
	var galton_bar_height4 = (parseInt(galtonInfo[3])*100)/parseInt(total_votes);
	var galton_bar_height5 = (parseInt(galtonInfo[4])*100)/parseInt(total_votes);
	var galton_bar_height6 = (parseInt(galtonInfo[5])*100)/parseInt(total_votes);
	var galton_bar_height7 = (parseInt(galtonInfo[6])*100)/parseInt(total_votes);
	var galton_bar_height8 = (parseInt(galtonInfo[7])*100)/parseInt(total_votes);
	var galton_bar_height9 = (parseInt(galtonInfo[8])*100)/parseInt(total_votes);
	var galton_bar_height10 = (parseInt(galtonInfo[9])*100)/parseInt(total_votes);
	var galton_bar_height11 = (parseInt(galtonInfo[10])*100)/parseInt(total_votes);
	for(i=0;i<400;i++){

		var image_left = Math.floor(Math.random() * 400) + 1;
		
		$('#galton').append('<svg width="5px" viewbox="0 0 30 42" style="left:'+image_left+'px"> <path fill="'+drop_color+'" stroke="'+drop_color+'" stroke-width="1.5"d="M15 3 Q16.5 6.8 25 18 A12.8 12.8 0 1 1 5 18 Q13.5 6.8 15 3z" /> </svg>'); 
		// <path stroke-width="2.5" d="M15 3 Q16.5 6.8 25 148 A18.8 16.8 0 1 1 5 148 Q16.5 6.8 15 3z" />
		// $('#galton').append('<img style="left:'+image_left+'px" src="'+base_url+'assets/dashboard/img/rain_drop_small.png" class="rain_drop"/>');
		
	}
	// <path stroke-width="2.5" d="M15 3 Q16.5 6.8 25 148 A18.8 16.8 0 1 1 5 148 Q16.5 6.8 15 3z" />
	
	setTimeout(function(){ 
		$('#galton_bar1').css('height',galton_bar_height1*2+'%')
		$('#galton_bar2').css('height',galton_bar_height2*2+'%')
		$('#galton_bar3').css('height',galton_bar_height3*2+'%')
		$('#galton_bar4').css('height',galton_bar_height4*2+'%')
		$('#galton_bar5').css('height',galton_bar_height5*2+'%')
		$('#galton_bar6').css('height',galton_bar_height6*2+'%')
		$('#galton_bar7').css('height',galton_bar_height7*2+'%')
		$('#galton_bar8').css('height',galton_bar_height8*2+'%')
		$('#galton_bar9').css('height',galton_bar_height9*2+'%')
		$('#galton_bar10').css('height',galton_bar_height10*2+'%')
		$('#galton_bar11').css('height',galton_bar_height11*2+'%')

	}, 1500);


	for (var i=0;i<=400;i++) {
		(function(ind) {
			setTimeout(function(){
				$('#galton svg').eq(ind).css('top','400px');
				// $('#galton .rain_drop').eq(ind).css('top','400px');
			}, 10 * ind);
		})(i);
	}


	console.log(galton_bar_height1, galton_bar_height2, galton_bar_height3, galton_bar_height4, galton_bar_height5, galton_bar_height6, galton_bar_height7, galton_bar_height8, galton_bar_height9, galton_bar_height10, galton_bar_height11);
}