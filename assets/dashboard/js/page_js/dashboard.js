var base_url = $('base').attr('data-base');
$(document).ready(function () {
	$('.open_delete_modal').on('click',function(e){
        e.preventDefault();
        var poll_id = $(this).attr('id').substr(18); 
        $('#pollIdDelete').attr('href',base_url+"Dashboard/deletePoll/"+poll_id);
        $('#deletePollModal').fadeIn();
    });
    $('.open_poll_info_modal').on('click',function(e){
    	e.preventDefault();
        var poll_id = $(this).attr('id').substr(21);
        $('#infoPollModal').fadeIn(); 
        
        $.ajax({
	        url:base_url+"Dashboard/getPollInformation",
	        method:"POST",
	        data:{
	            poll_id : poll_id,
	            csrf_test_name: $.cookie('csrf_cookie_name')
	        },
	        success:function(response) {
	        	var response = JSON.parse(response);
	        	var people_participated = response.total_votes;
	        	var poll_has_been_running_for = response.diff;
	        	var poll_three_highest_days = response.poll_three_highest_days;
	        	var poll_three_lowest_days = response.poll_three_lowest_days;
	        	var votes_from_countries = response.votes_from_countries;
	        	
	        	var three_highest_days_of_perticipation = 'None';
	        	var three_lowest_days_of_perticipation = 'None';
	        	var votes_from_countries_text = '';

	        	if(poll_three_highest_days.length>0){
	        		var i = 1;
	        		three_highest_days_of_perticipation = '';
	        		poll_three_highest_days.forEach(function(entry) {
	        			if(i == poll_three_highest_days.length){
	        				three_highest_days_of_perticipation += entry.created_at;
	        			}else{
	        				three_highest_days_of_perticipation += entry.created_at+', ';
	        			}
						
						i++;
					});	
	        	}

	        	if(poll_three_lowest_days.length>0){
	        		var i = 1;
	        		three_lowest_days_of_perticipation = '';
	        		poll_three_lowest_days.forEach(function(entry) {
	        			if(i == poll_three_lowest_days.length){
	        				three_lowest_days_of_perticipation += entry.created_at;
	        			}else{
	        				three_lowest_days_of_perticipation += entry.created_at+', ';
	        			}
						
						i++;
					});	
	        	}

	        	if(votes_from_countries.length>0){
	        		votes_from_countries.forEach(function(entry) {
	        			if(entry.country_name == null){
	        				votes_from_countries_text += '<p>Anonymous: '+entry.votes+'</p>';	
	        			}else{
	        				votes_from_countries_text += '<p>'+entry.country_name+': '+entry.votes+'</p>';
	        			}
	        			
					});	
	        		
	        	}else{
	        		votes_from_countries_text += '<p>None</p>';
	        	}
	        	
	        	$('#people_perticipated_to_poll').html(people_participated);
	        	$('#poll_has_been_running_for').html(poll_has_been_running_for);
	        	$('#three_highest_days_of_perticipation').html('<p>'+three_highest_days_of_perticipation+'</p>');
	        	$('#three_lowest_days_of_perticipation').html('<p>'+three_lowest_days_of_perticipation+'</p>');
	        	$('#votes_from_countries').html(votes_from_countries_text);
	        	
	        },
	        error:function(){
	            alert(a_error);
	        }
	    });
	    $('#votes_from_countries').slimscroll({
	        height: '150px',
	        width: '100%',
	    }).parent().css({
	        border: '0px solid #184055'
	    });

        // $('#pollIdDelete').attr('href',base_url+"Dashboard/deletePoll/"+poll_id);
        // $('#deletePollModal').fadeIn();
    });
    $('#pollDeleteCancel').on('click',function(e){
    	e.preventDefault();
    	$('#deletePollModal').fadeOut();
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
	$('#infoPollModal #infoPollModalContent .close_modal_cross').on('click',function(){
		$('#infoPollModal').fadeOut();
	});
});