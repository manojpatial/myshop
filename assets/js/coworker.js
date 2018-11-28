$(document).ready(function() {
	var base_url = $('#base').val();
	//alert(base_url); 
	//Upload logo using AJAX on Registration page
	
	var current_language = $('#current_language').val()
	
	
	if(current_language == 'Chinese') 
	{
		var invalid_image = 'Invalid Image File';
		var image_size_error = 'Image File Size is very big';
		var image_size_mb = 'Image size should be less than 5MB';
		var fill_all_fields = 'Please Fill All Fields';
		var activity_icon_error = 'Please select an icon for activity';
		var add_cause_error = 'Please add Cause information before create a stage';
		var add_activity_error = 'Please add an activity for this stage';
		var stage_icon_error = 'Please select an icon for stage';
		var remove_cert_confirm = 'Are you sure to remove this certificate?';
		var remove_serv_confirm = 'Are you sure  to remove this service?';
		var add_activity_text = 'Add Activity';
		var thanks_card = 'Thanks Card';
		var updated = 'Updated';
		
	}
	else if(current_language == 'Spanish')
	{
		
		var invalid_image = 'Invalid Image File';
		var image_size_error = 'Image File Size is very big';
		var image_size_mb = 'Image size should be less than 5MB';
		var fill_all_fields = 'Please Fill All Fields';
		var activity_icon_error = 'Please select an icon for activity';
		var add_cause_error = 'Please add Cause information before create a stage';
		var add_activity_error = 'Please add an activity for this stage';
		var stage_icon_error = 'Please select an icon for stage';
		var remove_cert_confirm = 'Are you sure to remove this certificate?';
		var remove_serv_confirm = 'Are you sure  to remove this service?';
		var add_activity_text = 'Add Activity';
		var thanks_card = 'Thanks Card';
		var updated = 'Updated';
	}
	else
	{
		var invalid_image = 'Invalid Image File';
		var image_size_error = 'Image File Size is very big';
		var image_size_mb = 'Image size should be less than 5MB';
		var fill_all_fields = 'Please Fill All Fields';
		var activity_icon_error = 'Please select an icon for activity';
		var add_cause_error = 'Please add Cause information before create a stage';
		var add_activity_error = 'Please add an activity for this stage';
		var stage_icon_error = 'Please select an icon for stage';
		var remove_cert_confirm = 'Are you sure to remove this certificate?';
		var remove_serv_confirm = 'Are you sure to remove this service?';
		var add_activity_text = 'Add Activity';
		var thanks_card = 'Thanks Card';
		var updated = 'Updated';
		
		
	}
	
	$(document).on("click", ".vote-box", function() {
		var divId = $(this).attr('id');
		var explode = divId.split('-');
		var id = explode[1];
		$('#causeid').val(id)
		$('.hover_bkgr_fricc').show();
	});
	
	//Pop up close function
	/* $('.6').click(function(){
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
	
	
	
	
	//Project Section: Show scenario UL and activity UL on click of stage icon
	$(document).on("click", ".stage_icon", function() {
		$('#stage-listing').hide();
		$('.timeline-badge').removeClass('badge_selected');
		$(this).closest('.timeline-badge').addClass('badge_selected');
		$(".exp-icon").removeClass('scenario_ul_show');
		$(".act_timeline").removeClass('activity_ul_show');
		var anchorId = $(this).attr("id");
		//alert(divId); 
		
		var explode = anchorId.split('_');
		var stage_id = explode[1];
		//alert(cause_id);
		$("#scenario_"+stage_id).addClass('scenario_ul_show');
		
		$("#act_stage_"+stage_id).addClass('activity_ul_show');
		
	});
	//Project Section: hide scenario UL and activity UL on click of stage icon and show stage listing
	$(document).on("click", ".back_to_stage", function() {
		$('#stage-listing').show();
		//$('.timeline-badge').removeClass('badge_selected');
		
		//$(".exp-icon").removeClass('scenario_ul_show');
		$(".act_timeline").removeClass('activity_ul_show');
		
	});
	
	//Project Section: show certificate section
	$(document).on("click", ".certificate_icon", function() {
		$('#certificates-listing').css('display','inline-flex');
		$('#stage-listing').hide();
	});
	//Project Section: show certificate section
	$(document).on("click", "#back-cert", function() {
		$('#certificates-listing').css('display','none');
		$('#stage-listing').show();
	});
	//Project Section: Show price with stage icon on click of scenario_ul icon
	$(document).on("click", ".exp-icon.scenario_ul_show li", function() {
		
		var mainUlId = $(this).closest('.exp-icon.scenario_ul_show').attr('id');
		var explode = mainUlId.split('_');
		var stage_id = explode[1];
		var liId = $(this).attr("id");
		var explode_liid = liId.split('_');
		var class_name = explode_liid[1];
		//alert(class_name);
		$('#timeline_stage_'+stage_id+' span.cost').hide();
		$('#timeline_stage_'+stage_id+' .'+class_name+'_cost').show();
		
		$('#'+mainUlId+' li').removeClass('selected-ic');
		$('#'+mainUlId+' li .blue').removeClass('show');
		$('#'+mainUlId+' li .grey').addClass('show');
		$('#'+mainUlId+' #'+liId).addClass('selected-ic');
		$('#'+mainUlId+' #'+liId+' .blue').addClass('show');
		$('#'+mainUlId+' #'+liId+' .grey').removeClass('show');
	});
	
	
	
	
	//Project step: Upload activity images using AJAX
	$(document).on("change", ".upload-file-act", function() {
		
		// var card_id = $(this).attr('id');
		// var explode = card_id.split('_');
		// var id = parseInt(explode[2]);
		// alert($(this).attr('id'));
		
		var inputId = $(this).attr('id');
		var explode_inputId = inputId.split('-');
		var act_id = explode_inputId[2];
		var popId = $(this).closest('.activity_pop').attr('id');
		
		var name = document.getElementById(inputId).files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{
		   alert(invalid_image);
		} 
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById(inputId).files[0]);
		var f = document.getElementById(inputId).files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert(image_size_error);
		}
		else
		{
			form_data.append("file", document.getElementById(inputId).files[0]);
			form_data.append("act_id", act_id);
			
			$.ajax({
				url: base_url+"Causes/upload_activity_photo",
				method:"POST",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend:function(){
				//$('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
				},   
				success:function(data)
				{
					var imageName = data;
					var Url = base_url+'assets/uploads/activity-photo/'+imageName;
					var html = '<img src="'+Url+'">';
					$("#"+popId+" #image-"+act_id).html(html);
					
					$("#"+popId+" #act_image_name").val(imageName);
				}
		   });
		}
	});
	
	
	// Add more thanks card on Edit cause 
	
	$(document).on("click", ".thanks_add_more", function() {
		var buttonId = $("#thanks-card-ul .add_thanks:last").attr('id');
		
		var explode = buttonId.split('_');
		var id = parseInt(explode[2]);
		var newid = id+1;
	
		var li = '<li><a id="add_thanks_'+newid+'" href="javascript:void(0)" class="add_thanks thanks_card_butn">+'+thanks_card+'</a></li>'
		$("#thanks-card-ul").append(li);
		
		
		var thanks_popup_html = $("#pop_id_1").html();
		
		//alert(thanks_popup_html);
		var html = '<div id="pop_id_'+newid+'" class="popup">';
				  
			html +=thanks_popup_html;
			html += '</div>';
			 
		$("#thanks-popup-section").append(html);

	});
	
	// save thanks card
	$(document).on("click", ".save_thanks_card", function() {
		var divid = $(this).closest('.popup').attr('id');
		//alert(divid); return false;
		var message = $("#"+divid+" #message").val();
		var donor_user_id = $("#"+divid+" #donor-list option:selected").val();
		var donor_user_name = $("#"+divid+" #donor-list option:selected").text();
		var cause_id = $("#"+divid+" #cause_id").val();
		var card_id = $("#"+divid+" #card_id").val();
		var db_card_id = $("#"+divid+" #db_card_id").val();
		//alert(card_id);
		var dataString = {'message': message, 'donor_user_id': donor_user_id,'cause_id': cause_id,'db_card_id': db_card_id};
		//alert(dataString);
		if(message=='' || donor_user_id=='')
		{
			alert(fill_all_fields);
			return false;
		}
		if(db_card_id =='')
		{
			//alert('save');
			$.ajax({
				type: "POST",
				url: base_url+"/Causes/add_thanks_card",
				data: dataString,
				//dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					$("#"+card_id).text(donor_user_name+" "+thanks_card);
					$("#"+divid+" #db_card_id").val(result);
					$('.popup').hide();
					
				}
			});
		}
		else{
			
			//alert('save');
			$.ajax({
				type: "POST",
				url: base_url+"/Causes/update_thanks_card",
				data: dataString,
				//dataType: 'json',
				cache: false,
				success: function(result){
					alert(result);
					$("#"+card_id).text(donor_user_name+" "+thanks_card);
					$("#"+divid+" #db_card_id").val(result);
					$('.popup').hide();
					
				}
			});
		}
	});
	
	
	//show popup on click of Thanks Card button
	$(document).on("click", ".thanks_card_butn", function() {
		var card_id = $(this).attr('id');
		var explode = card_id.split('_');
		var id = parseInt(explode[2]);
		
		$("#pop_id_"+id+" #card_id").val(card_id);
		$('#pop_id_'+id).show();
	});
	
	$(document).on("click", ".back_but", function() {
		$('.popup').hide();
	});
	
	// show popup on thanks card end
	
	//publish cause from My Causes page
	$(".publish_cause_butn").click(function(){
		var causeId = $(this).attr('id');
		var explode = causeId.split('-');
		var cause_id = parseInt(explode[1]);
		$('.popup').show();
	});

	/* $('.popup').click(function(){
		$('.popup').hide();
	}); */
	$('.popupCloseButton').click(function(){
		$('.popup').hide();
	});
	
	/*----- Activity Log jQuery ---------*/
	//open popup
	$(document).on("click", ".add_actlog", function() {
		var Ulid = $(this).closest('.simp-btn').attr('id');
		var act_log_id = $(this).attr('id');
		var explode = act_log_id.split('_');
		var id = explode[2];
		//alert(act_log_id);
		$('#'+Ulid+' #pop_actlog_'+id+" #act_log_id").val(act_log_id);
		$('#'+Ulid+' #pop_actlog_'+id).show();
	});
	//close popup
	$(document).on("click", ".cancel_but", function() {
		$('.popup').hide();
	});
	
	
	// save Activity log
	$(document).on("click", ".save_act_log", function() {
		var divid = $(this).closest('.activity_pop').attr('id');
		//alert(divid); 
		var description = $("#"+divid+" #description").val();
		//alert(description);
		var act_image_name = $("#"+divid+" #act_image_name").val();
		var act_id = $("#"+divid+" #act_id").val();
		var cause_id = $("#"+divid+" #cause_id").val();
		var db_actlog_id = $("#"+divid+" #db_actlog_id").val();
		var act_log_id = $("#"+divid+" #act_log_id").val();
		//alert(card_id);
		var dataString = {'description': description, 'act_image_name': act_image_name,'act_id': act_id,'cause_id': cause_id,'db_actlog_id': db_actlog_id};
		
		if(description=='' || act_image_name=='')
		{
			alert(fill_all_fields);
			return false;
		}
		
		if(db_actlog_id =='')
		{
			//alert('save');
			$.ajax({
				type: "POST",
				url: base_url+"/Causes/add_activity_log",
				data: dataString,
				//dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					$("#"+act_log_id).text(description);
					$("#"+act_log_id).parent('li').addClass('active');
					$("#"+divid+" #db_actlog_id").val(result);
					$('.popup').hide();
				}
			});
		}
		else{
			//alert('save');
			$.ajax({
				type: "POST",
				url: base_url+"/Causes/update_activity_log",
				data: dataString,
				//dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					$("#"+act_log_id).text(description);
					$("#"+act_log_id).parent('li').addClass('active');
					$("#"+divid+" #db_actlog_id").val(result);
					$('.popup').hide();
					
				}
			});
		}
	});
	
	/*----- Activity Log jQuery end ---------*/
	
	//On load show Approved Cause popup on My Cause page Start
	$('.approve_pop').each(function() {
		var current_language = $('#current_language').val();
		
		var approvCauseId = $(this).val();
		//var explode = approvCauseId.split('_');
		//var id = explode[2];

		$('#approve_pop_'+approvCauseId).show();
	});
	//Hide Popup and change status of pop_approved in database to 1
	$(document).on("click", ".approve_cause", function() {
		var formDivId = $(this).closest('.popup_appr').attr('id');
		var causeId = $('#'+formDivId+' #appr_cause_id').val();
		//alert(causeId);
		$.ajax({
			type: "POST",
			url: base_url+"Causes/approve_cuase_status",
			data: "cause_id="+causeId,
			dataType: 'json',
			cache: false,
			success: function(result){
				//alert(result);
				if(result == 1){
					$('#'+formDivId).hide();
				}else{
					//alert('Error.');
				}
				
			}
		});
		

		
	});
	
	
	
	
	
	
	//Menu show/hide
	$(document).on("click", ".avt-sec a", function() {
		$('.menus').toggle();
	 
	});
	
}); 