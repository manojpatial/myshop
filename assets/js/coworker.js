$(document).ready(function() {
	var base_url = $('#base').val();
	//alert(base_url); 
	//Upload logo using AJAX on Registration page
	
	
	
	$(document).on("click", ".vote-box", function() {
		var divId = $(this).attr('id');
		var explode = divId.split('-');
		var id = explode[1];
		$('#causeid').val(id);
		
		$('.hover_bkgr_fricc').show();
	});
	
	//Popup close function
	/* $('.hover_bkgr_fricc').click(function(){
		$('.hover_bkgr_fricc').hide(); 
	}); */
	$('.popupCloseButton').click(function(){
		$('.hover_bkgr_fricc').hide();
	});
	
	//popup voting circle click for voting type 2
	
	
	$(document).on("click", ".vote-cir", function() {
		var divId = $(this).attr('id');
		var explode = divId.split('-');
		var voteid = explode[1];
		var causeid = $('#causeid').val();
		//alert('#number-'+causeid);
		$('#invote-'+voteid).val(causeid);
		$('#number-'+causeid+' span').text(voteid);
		$(this).addClass('disable');
		
		//get valus of hidden values and make submit button clickable

		var vote1 = $("#invote-1").val();
		var vote2 = $("#invote-2").val();
		var vote3 = $("#invote-3").val();
		
		if(vote1 !='' && vote2 !='' && vote3 !='')
		{
			$("#vote-submit").removeClass('btn-disable');
		}
		
	});
	
	//popup voting circle click for voting type 1
	
	
	$(document).on("click", ".vote-cir-individual", function() {
		var divId = $(this).attr('id');
		var explode = divId.split('-');
		var voteid = explode[1];
		var causeid = $('#causeid').val();
		//alert('#number-'+causeid);
		//alert(voteid);
		$('#invote-4').val(causeid);
		$('#number-'+causeid+' span').text(voteid);
		$(this).addClass('disable');
		
		//get valus of hidden values and make submit button clickable

		var vote1 = $("#invote-4").val();
		
		
		if(vote1 !='')
		{
			$("#vote-submit").removeClass('btn-disable');
		}
			
	});
	
	//submit vote from voting page
	$(document).on("click", "#vote-submit", function() {
		var votingType = $("#voting-type").val();
		var project_id = $("#project_id").val();
		var user_id = $("#user_id").val();
		
		if(votingType == 1){
			var vote4 = $("#invote-4").val();
			var dataString = {'votingType': votingType,'project_id': project_id, 'user_id': user_id, 'vote': vote4};
			
		}else if(votingType == 2){
			var vote = {};
			vote['1'] = $("#invote-1").val();
			vote['2'] = $("#invote-2").val();
			vote['3'] = $("#invote-3").val();
			var dataString = {'votingType': votingType,'project_id': project_id, 'user_id': user_id, 'vote': vote};
		}
		
		$.ajax({
			type: "POST",
			url: base_url+"Coworker/submit_vote",
			data: dataString,
			//dataType: 'json',
			cache: false,
			success: function(result){
				$('.popup').show();
			}
		});
		
		
	});
	$('.back_but').click(function(){
		$('.popup').hide();
	});
	//Menu show/hide
	$(document).on("click", ".avt-sec a", function() {
		$('.menus').toggle();
	 
	});
	
}); 