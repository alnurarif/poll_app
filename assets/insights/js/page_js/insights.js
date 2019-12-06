var base_url = $('base').attr('data-base');
$(document).ready(function () {
	$('#polls_responses').slimscroll({
        height: '300px',
        width: '100%',
    }).parent().css({
        border: '0px solid #184055'
    });
    $('#responses_from_countries').slimscroll({
        height: '300px',
        width: '100%',
    }).parent().css({
        border: '0px solid #184055'
    }); 
    $('#most_responses_from_countries').slimscroll({
        height: '300px',
        width: '100%',
    }).parent().css({
        border: '0px solid #184055'
    }); 
    $('.down_arrow').on('click',function(){
    	var poll_id = $(this).attr('id').substr(11);
    	$('.single_poll_country_votes_details').css('height','0px');
    	$('#single_poll_country_votes_details_'+poll_id).css('height','auto');
    	
    	$('.up_arrow').hide();
    	$('#up_arrow_'+poll_id).show();
    	$('.down_arrow').show();
    	$(this).hide();
    });
    $('.up_arrow').on('click',function(){
    	var poll_id = $(this).attr('id').substr(9);
    	$('#single_poll_country_votes_details_'+poll_id).css('height','0px');
    	$('#down_arrow_'+poll_id).show();
    	$(this).hide();
    });

    $('.down_arrow_most_response').on('click',function(){
    	var poll_id = $(this).attr('id').substr(25);
    	$('.single_poll_country_most_votes_details').css('height','0px');
    	$('#single_poll_country_most_votes_details_'+poll_id).css('height','auto');
    	
    	$('.up_arrow_most_response').hide();
    	$('#up_arrow_most_response_'+poll_id).show();
    	$('.down_arrow_most_response').show();
    	$(this).hide();
    });
    $('.up_arrow_most_response').on('click',function(){
    	var poll_id = $(this).attr('id').substr(23);
    	$('#single_poll_country_most_votes_details_'+poll_id).css('height','0px');
    	$('#down_arrow_most_response_'+poll_id).show();
    	$(this).hide();
    });
});
