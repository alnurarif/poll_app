$(document).ready(function () {
	$('#annually_button').on('click',function(){
		$('.plan_type_button').css('background-color','#808080');
		$(this).css('background-color','#4c4c4c');
		$('.plan').fadeOut();
		$('#anually_plan').fadeIn();
	});

	$('#monthly_button').on('click',function(){
		$('.plan_type_button').css('background-color','#808080');
		$(this).css('background-color','#4c4c4c');
		$('.plan').fadeOut();
		$('#monthly_plan').fadeIn();
	});

	$('#quarterly_button').on('click',function(){
		$('.plan_type_button').css('background-color','#808080');
		$(this).css('background-color','#4c4c4c');
		$('.plan').fadeOut();
		$('#quarterly_plan').fadeIn();
	});

	$('.plan').hide();
	$('.plan_type_button').css('background-color','#808080');
	$('#annually_button').css('background-color','#4c4c4c');
	$('#anually_plan').show();
});