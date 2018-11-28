$(document).ready(function() {
	var base_url = $('#base').val(); 
	var current_language = $('#current_language').val();
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
		var remove_serv_confirm = 'Are you sure  to remove this service?';
		var add_activity_text = 'Add Activity';
		var thanks_card = 'Thanks Card';
		
		
	}
	//alert(base_url);
	//Upload Institution logo using AJAX on Registration page
	$(document).on("change", "#upload-file-selector-reg", function() {
	
		var name = document.getElementById("upload-file-selector-reg").files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{ 
		   alert(invalid_image);
		} 
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("upload-file-selector-reg").files[0]);
		var f = document.getElementById("upload-file-selector-reg").files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert(image_size_error);
		}
		else
		{
			form_data.append("file", document.getElementById('upload-file-selector-reg').files[0]);
			$.ajax({
				url: base_url+"Admin/upload_institution_logo",
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
					var Url = base_url+'assets/uploads/institution-logo/'+imageName;
					
				   $('#uploaded_image').show();
				  
				   $("#img-thumbnail").attr("src",Url);
				   $("#logoName").val(imageName);
				}
		   });
		}
	});
	
	//Upload Institution validity image using AJAX on Registration page
	$(document).on("change", "#upload-file-selector-reg_vali", function() {
	
		var name = document.getElementById("upload-file-selector-reg_vali").files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{ 
		   alert(invalid_image);
		}  
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("upload-file-selector-reg_vali").files[0]);
		var f = document.getElementById("upload-file-selector-reg_vali").files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert(image_size_error);
		}
		else
		{
			form_data.append("file", document.getElementById('upload-file-selector-reg_vali').files[0]);
			$.ajax({
				url: base_url+"Admin/upload_institution_logo",
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
					//alert(imageName);
					var Url = base_url+'assets/uploads/institution-logo/'+imageName;
					
				   $('#uploaded_image_validity').show();
				  
				   $("#img-thumbnail-validity").attr("src",Url);
				   $("#ins_certificate").val(imageName);
				}
		   });
		}
	});
	
	/*---
	
		Cause Creation JS start from here
		
	---*/
	//Upload Cause Picture using AJAX on cuase creation info page
	
	$(document).on("change", "#upload-file-selector", function() {
		var name = document.getElementById("upload-file-selector").files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{
		   alert(invalid_image);
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("upload-file-selector").files[0]);
		var f = document.getElementById("upload-file-selector").files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 5000000)
		{
			alert(image_size_mb);
		}
		else
		{
			form_data.append("file", document.getElementById('upload-file-selector').files[0]);
			$.ajax({
				url: base_url+"Admin/upload_cause_picture",
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
					var Url = base_url+'assets/uploads/cause-picture/'+imageName;
					
				   $('#uploaded_image').show();
				   $('p#instruction').hide();
				  
				   $("#img-thumbnail").attr("src",Url);
				   $("#causePic").val(imageName);
				}
		   });
		}
	});
	
	//Upload certification images using AJAX on cuase creation info page
	
	$(document).on("change", ".upload_certificates_images", function() {
		var divId = $(this).attr("id");
		var explode = divId.split('_');
		var id = explode[1];
		//alert('cert');
		var name = document.getElementById(divId).files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{
		   alert(invalid_image);
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById(divId).files[0]);
		var f = document.getElementById(divId).files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert(image_size_error);
		}
		else
		{
			form_data.append("file", document.getElementById(divId).files[0]);
			$.ajax({
				url: base_url+"Admin/upload_cause_picture",
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
					var Url = base_url+'assets/uploads/cause-picture/'+imageName;
					//alert(Url);
				   $('#uploaded_image_cert_images_'+id).show();
				  
				   $("#img-thumbnail-cert-images-"+id).attr("src",Url);
				 $("#upload-file-selector-hidden_"+id).val(imageName);
				}
		    });
		}
	});
	
	//Upload services images using AJAX on cuase creation info page
	
	$(document).on("change", ".upload_service_images", function() {
		var divId = $(this).attr("id");
		var explode = divId.split('_');
		var id = explode[1];
		//alert('serv');
		var name = document.getElementById(divId).files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{
		   alert(invalid_image);
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById(divId).files[0]);
		var f = document.getElementById(divId).files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert(image_size_error);
		}
		else
		{
			form_data.append("file", document.getElementById(divId).files[0]);
			$.ajax({
				url: base_url+"Admin/upload_cause_picture",
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
					var Url = base_url+'assets/uploads/cause-picture/'+imageName;
					//alert('#uploaded_image_serv_images_'+id);
				   $('#uploaded_image_serv_images_'+id).show();
				  
				   $("#img-thumbnail-serv-images-"+id).attr("src",Url);
				  $("#upload-file-selector-"+id).val(imageName);
				}
		    });
		}
	});
	//show & add certification to cause..
	$(document).on("click", ".add_cert", function() {
		var divId = $(this).attr("id");
		var explode = divId.split('_');
		var id = explode[2];
		$(".certificate_form").hide();
		$(".services_form").hide();
		$("#certificate_form_"+id).show();
	});
	//enable Other text field on certificate dropdown..
	$(document).on("change", ".select_certificate", function() {
		var formDivId = $(this).closest('.certificate_form').attr('id');
		var name = $('#'+formDivId+ ' .select_certificate option:selected').val();
		//alert(name);
		if(name == 'other'){
			$('#'+formDivId+ ' #other_certificae').prop("disabled", false);
		}else{
			$('#'+formDivId+ ' #other_certificae').prop("disabled", true);
		}
		/* var divId = $(this).attr("id");
		var explode = divId.split('_');
		var id = explode[2];
		$(".certificate_form").hide();
		$(".services_form").hide();
		$("#certificate_form_"+id).show(); */
	});
	 //Hide certification form on click of BACK button..
	$(document).on("click", ".cert_back", function() {
		$(".certificate_form").hide();
	});
	
	 //click  Save button certification form to cause..
	$(document).on("click", ".cert_save", function() {
		var divId = $(this).attr("id");
		var explode = divId.split('_');
		var rowid = explode[2];
		
		var name = $("#certificate_form_"+rowid+" .select_certificate option:selected").text();
		//alert(name); return false;
		var other_certificae = $("#certificate_form_"+rowid+" #other_certificae").val();
		if(name == 'Other'){
			var certName = other_certificae;
		}else{
			var certName = name;
		}
		//var certificates = $("#certificate_form_"+rowid+" #certificates").text();
		
		var corporate_benefits = $("#certificate_form_"+rowid+" #corporate_benefits").val();
		var corporate_restrictions = $("#certificate_form_"+rowid+" #corporate_restrictions").val();
		var imagename = $("#certificate_form_"+rowid+" #upload-file-selector-hidden_"+rowid).val();
		var dbCertId = $("#certificate_form_"+rowid+" #dbCertId_"+rowid).val();
		
		
		var dataString = {'certificates_name': name, 'other_certificae': other_certificae, 'corporate_benefits': corporate_benefits, 'corporate_restrictions': corporate_restrictions, 'imagename': imagename,'dbCertId': dbCertId};
		//alert(dataString);
		if(name=='' ||  corporate_benefits=='' || corporate_restrictions=='' || imagename=='')
		{
			alert(fill_all_fields);
			return false;
		}
		if(dbCertId =='') //update certificae
		{
			//alert('save');
			$.ajax({
				type: "POST",
				url: base_url+"/Admin/cause_creation_save_certificates",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					$("#add_cert_"+rowid).text(certName);
					$("#certificate_form_"+rowid+" #dbCertId_"+rowid).val(result);
					$("#add_cert_"+rowid).addClass('active');
					$("#add_cert_"+rowid).parent( "li" ).addClass('active');
					$(".certificate_form").hide();
					$(".services_form").hide();
				}
			});
		}
		else{ //insert certificae
			$.ajax({
				type: "POST",
				url: base_url+"Admin/cause_creation_update_certificates",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					$("#add_cert_"+rowid).text(certName);
					$(".certificate_form").hide();
					$(".services_form").hide();
				}
			});
		}
	});
	
	
	//Remove certification on cause edit page..
	$(document).on("click", ".cert_remove", function() {
		var anchorId = $(this).attr("id");
		var explode = anchorId.split('_');
		var certid = explode[1];
		var certLiId = $(this).closest('.add_cert').attr('id');
		//alert(certLiId);
		//alert(cause_id);
		if (confirm(remove_cert_confirm)) {
			$.ajax({
				type: "POST",
				url: base_url+"Admin/delete_certificate",
				data: "certid="+certid,
				dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					if(result == 1){
						window.location.reload(true);
					}else{
						alert('Error.');
					}
					
				}
			});
		}
	});
	
	
	
	 //Hide service form on click of BACK button..
	$(document).on("click", ".serv_back", function() {
		$(".services_form").hide();
	});
	
	 //click  Done button certification form to cause..
	$(document).on("click", ".serv_save", function() {
		var divId = $(this).attr("id");
		var explode = divId.split('_');
		var rowid = explode[2];
		
		var name = $("#services_form_"+rowid+" .service_name").val();
		
		//var certificates = $("#certificate_form_"+rowid+" #certificates").text();
		var service_name = $("#services_form_"+rowid+" #service_name").val();
		var imagename = $("#services_form_"+rowid+" #upload-file-selector-"+rowid).val();
		var dbServId = $("#services_form_"+rowid+" #dbServId_"+rowid).val();
		
		
		var dataString = {'service_name': name, 'imagename': imagename,'dbServId': dbServId};
		//alert(dataString);
		if(name=='' || imagename=='')
		{
			alert(fill_all_fields);
			return false;
		}
		if(dbServId =='') //update activity
		{	
			//alert('save');
			$.ajax({
				type: "POST",
				url: base_url+"/Admin/cause_creation_save_services",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					$("#add_serv_"+rowid).text(name);
					$("#services_form_"+rowid+" #dbServId_"+rowid).val(result);
					$("#add_serv_"+rowid).addClass('active');
					$("#add_serv_"+rowid).parent( "li" ).addClass('active');
					$(".certificate_form").hide();
					$(".services_form").hide();
				}
			});
		}
		else{ //insert activity
			$.ajax({
				type: "POST",
				url: base_url+"Admin/cause_creation_update_services",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					$("#add_serv_"+rowid).text(name);
					$(".certificate_form").hide();
					$(".services_form").hide();
				}
			});
		}
	});
	//show & add certification to cause..
	$(document).on("click", ".add_serv", function() {
		var divId = $(this).attr("id");
		var explode = divId.split('_');
		var id = explode[2];
		$(".services_form").hide();
		$(".certificate_form").hide();
		$("#services_form_"+id).show();
		
	});
	
	//Remove services on cause edit page..
	$(document).on("click", ".serv_remove", function() {
		var anchorId = $(this).attr("id");
		var explode = anchorId.split('_');
		var servid = explode[1];
		//var servLiId = $(this).closest('.add_cert').attr('id');
		//alert(certLiId);
		//alert(cause_id);
		if (confirm(remove_serv_confirm)) {
			$.ajax({
				type: "POST",
				url: base_url+"Admin/delete_service",
				data: "servid="+servid,
				dataType: 'json',
				cache: false,
				success: function(result){
					//alert(result);
					if(result == 1){
						window.location.reload(true);
					}else{
						//alert('Error.');
					}
					
				}
			});
		}
	});
	
	
	
	//Previous button to certification div in  cause information tab..
	$(document).on("click", "#infoprev", function() {
		$('#info_2').hide();
		$('#info_1').show();
	
	});
	//Next button to certification div in  cause information tab..
	$(document).on("click", "#info_next", function() {
		$('#info_2').show();
		$('#info_1').hide();
	});
	
	
	//Save cause info into database..
	$(document).on("click", "#infonext", function() {
		// var str = $( "form#cause_form" ).serialize();
		// console.log(str);
		var another_activity = $("#another_activity").val();
		var cause_name = $("#cause_name").val();
		var cause_desc = $("#cause_desc").val();
		var pesimistic_scen = $("#pesimistic_scen").val();
		var expected_scen = $("#expected_scen").val();
		var best_scen = $("#best_scen").val();
		var sen_unit = $("#sen_unit").val();
		var image_name = $("#causePic").val();
		var cause_id = $("#causeid").val();
		var user_id = $("#user_id").val();
		
		var db_cert_ids = [];  // update cause id in added certificates          
        $("input[name^=cert_ids]").each(function(){
            db_cert_ids.push($(this).val());
        });
		var db_serv_ids = [];  // update cause id in added services          
        $("input[name^=serv_ids]").each(function(){
            db_serv_ids.push($(this).val());
        });
		//alert(stageDivId);
		
		console.log(db_cert_ids);
		console.log(db_serv_ids);
		//return false
		
		var dataString = {'another_activity': another_activity,'cause_name': cause_name, 'cause_desc': cause_desc, 'pesimistic_scen': pesimistic_scen, 'expected_scen': expected_scen, 'best_scen': best_scen, 'sen_unit': sen_unit, 'image_name': image_name,'db_cert_ids': db_cert_ids,'db_serv_ids': db_serv_ids,'user_id': user_id,'cause_id': cause_id};
		if(cause_name=='' || cause_desc=='' || pesimistic_scen=='' || expected_scen=='' || best_scen=='' || sen_unit=='')
		{
			alert(fill_all_fields);
		}
		else if(image_name == ''){
			alert("Please select an image for your cause");
		}
		else
		{
			//alert(cause_id);
			if(cause_id =='')
			{
				$.ajax({
					type: "POST",
					url: base_url+"Admin/cause_creation_save_info",
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function(result){
						$("#tab_step, #tab_step a").addClass('active');
						$("#step").addClass('active show');
						$("#info").removeClass('active show');
						$("#tab_info, #tab_info a").removeClass('active show');
						$("#causeid").val(result);
						//window.location.href = base_url+"Causes/steps";
					}
				});
			}
			else{
				$.ajax({
					type: "POST",
					url: base_url+"Admin/cause_creation_update_info",
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function(result){
						$("#tab_step, #tab_step a").addClass('active');
						$("#step").addClass('active show');
						$("#info").removeClass('active show');
						$("#tab_info, #tab_info a").removeClass('active');
						//$("#causeid").val(result);
						//window.location.href = base_url+"Causes/steps";
					}
				});
			}
		}
	});
	//update cause info from edit page
	$(document).on("click", "#editinfonext", function() {
		//alert('ddd');
		var another_activity = $("#another_activity").val();
		var cause_name = $("#cause_name").val();
		var cause_desc = $("#cause_desc").val();
		var pesimistic_scen = $("#pesimistic_scen").val();
		var expected_scen = $("#expected_scen").val();
		var best_scen = $("#best_scen").val();
		var sen_unit = $("#sen_unit").val();
		var image_name = $("#causePic").val();
		var cause_id = $("#causeid").val();
		var user_id = $("#user_id").val();
		var db_cert_ids = [];  // update cause id in added certificates          
        $("input[name^=cert_ids]").each(function(){
            db_cert_ids.push($(this).val());
        });
		var db_serv_ids = [];  // update cause id in added services          
        $("input[name^=serv_ids]").each(function(){
            db_serv_ids.push($(this).val());
        });
		//alert(stageDivId);
		
		console.log(db_cert_ids);
		console.log(db_serv_ids);
		//return false
		
		var dataString = {'another_activity': another_activity,'cause_name': cause_name, 'cause_desc': cause_desc, 'pesimistic_scen': pesimistic_scen, 'expected_scen': expected_scen, 'best_scen': best_scen, 'sen_unit': sen_unit, 'image_name': image_name,'db_cert_ids': db_cert_ids,'db_serv_ids': db_serv_ids,'user_id': user_id,'cause_id': cause_id};
		if(cause_name==''||cause_desc==''||pesimistic_scen==''||expected_scen==''||best_scen==''||sen_unit=='')
		{
			alert(fill_all_fields);
		}
		else
		{
			$.ajax({
				type: "POST",
				url: base_url+"Admin/cause_creation_update_info",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(result){
					$("#tab_stage, #tab_stage a").addClass('active');
					$("#stage").addClass('active show');
					$("#info").removeClass('active show');
					$("#tab_info, #tab_info a").removeClass('active');
					//$("#causeid").val(result);
					//window.location.href = base_url+"Causes/steps";
				}
			}); 
			
		}
	});
	//Show activity form on click of button
	
	$(document).on("click", "#letstart", function() {
		
		$("#tab_step, #tab_step a").removeClass('active');
		$("#step").removeClass('active show');
		$("#tab_step").hide();
		$("#tab_stage").show();
		$("#tab_stage, #tab_stage a").addClass('active');
		$("#stage").addClass('active show');
	
	});
	
	
	
	//Show activity form on click of button
	
	$(document).on("click", ".create-activity", function() {
		var stageDivId = $(this).closest('.stage-section').attr('id');
		$("#"+stageDivId+" .activity-box").hide();
		var divId = $(this).attr("id");
		//alert(divId); 
		
		var explode = divId.split('-');
		var id = explode[1];
		$("#"+stageDivId+" #activity-form-"+id).show();
	
	});
	
	// Add new activity button
	$(document).on("click", ".add-more", function() {
		var stageDivId = $(this).closest('.stage-section').attr('id');
		//alert(stageDivId);
		var buttonId = $("#"+stageDivId+" .activity-buttons").children().last().attr('id');
		
		var explode = buttonId.split('-');
		var id = parseInt(explode[1]);
		var newid = id+1;
		
		var htmls = '<br><button id="activitybutton-'+newid+'" type="button" class="create-activity btn creat-btn"><i class="fa fa-plus" aria-hidden="true"></i> '+add_activity_text+' </button>';
		$("#js-activity-data .form-numb").text(newid);
		$("#"+stageDivId+" .activity-buttons").append(htmls);
		$("#"+stageDivId+" .activity-box").hide();
		// Create form 
		var activity_form_html = $("#js-activity-data").html();
		
		//alert(activity_form_html);
		var html = '<div id="activity-form-'+newid+'" class="activity-box">';
				 
				   html +=activity_form_html;
				 html += '</div>';
				 
				$("#"+stageDivId+" #activity-form-section").append(html);
		
	});
	
	// select icon for stage
	$(document).on("click", "#stage-icon.icon-list a", function() {
		var stageDivId = $(this).closest('.stage-section').attr('id');
		var anchorId = $(this).attr('id');
		$("#"+stageDivId+" #stage-icon.icon-list a").removeClass('iactive');
		$("#"+stageDivId+" #stage-icon.icon-list #"+anchorId+"").addClass('iactive');
		$("#"+stageDivId+" .stage-icon-name").val(anchorId);
		//alert(divid);
	
	});
	// select icon for activity
	$(document).on("click", ".icon-list a", function() {
		var stageDivId = $(this).closest('.stage-section').attr('id');
		var divid = $(this).closest('.activity-box').attr('id');
		var anchorId = $(this).attr('id');
		$("#"+stageDivId+" #"+divid+" .icon-list a").removeClass('iactive');
		$("#"+stageDivId+" #"+divid+" #"+anchorId+"").addClass('iactive');
		$("#"+stageDivId+" #"+divid+" .icon-name").val(anchorId);
		
		//alert(divid);
	
	});
	
	//Insert activity data into database
	$(document).on("click", ".add-activity .create-btn", function() {
		var stageDivId = $(this).closest('.stage-section').attr('id');
		
		var divid = $(this).closest('.activity-box').attr('id');
		var explode = divid.split('-');
		var id = explode[2];

		var actName = $("#"+stageDivId+" #"+divid+" #act-name").val();
		var actNumber = $("#"+stageDivId+" #"+divid+" #act-number").val();
		var actDescription = $("#"+stageDivId+" #"+divid+" #act-description").val();
		var actPesimistic = $("#"+stageDivId+" #"+divid+" #act-pesimistic").val();
		var actExpected = $("#"+stageDivId+" #"+divid+" #act-expected").val();
		var actBest = $("#"+stageDivId+" #"+divid+" #act-best").val();
		var iconName = $("#"+stageDivId+" #"+divid+" .icon-name").val();
		var dbActId = $("#"+stageDivId+" #"+divid+" .db-act-id").val();
		var causeId = $("#causeid").val();
		var dataString = {'act_name': actName, 'act_number': actNumber, 'act_desc': actDescription, 'act_pesimistic': actPesimistic, 'act_expected': actExpected, 'act_best': actBest, 'icon_name': iconName, 'cause_id': causeId, 'db_act_id': dbActId, 'activity': id};
		
		if(actName==''||actNumber==''||actDescription==''||actPesimistic==''||actExpected==''||actBest=='')
		{
			alert(fill_all_fields);
		}
		else if(iconName == ''){
			alert(activity_icon_error);
		}
		else
		{
			if(dbActId !='') //update activity
			{
				$.ajax({
					type: "POST",
					url: base_url+"/Admin/cause_creation_update_activity",
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function(result){
						//alert('Activity data updated successfully');
						$("#"+stageDivId+" #"+divid+" .db-act-id").val(result);
						$("#"+stageDivId+" #"+divid+"").hide();
						var buttontext = '<i class="fa fa-pencil" aria-hidden="true"></i> '+actName;
						$("#"+stageDivId+" #activitybutton-"+id).html(buttontext);
						//window.location.href = base_url+"Causes/steps";
					}
				});
			}
			else{ //insert activity
				$.ajax({
					type: "POST",
					url: base_url+"Admin/cause_creation_save_activity",
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function(result){
						//alert(result);
						var input = '<input type="hidden" value="'+result+'" name="act_ids[]">'
						$("#"+stageDivId+" #activities-ids").append(input);
						$("#"+stageDivId+" #"+divid+" .db-act-id").val(result);
						//alert('Activity data added successfully');
						$("#"+stageDivId+" #"+divid+"").hide();
						var buttontext = '<i class="fa fa-pencil" aria-hidden="true"></i> '+actName;
						$("#"+stageDivId+" #activitybutton-"+id).html(buttontext);
						//window.location.href = base_url+"Causes/steps";
					}
				});
			}
		}
	
	});
	
	// Add new stage on the click of Save stage button & save data into database
	
	$(document).on("click", ".btn.add-stage-btn", function() {
		var stageDivId = $(this).closest('.stage-section').attr('id');
		var buttonId = $(this).attr('id');
		var explode = buttonId.split('-');
		var newid = parseInt(explode[2]);
		var nextId = newid+1;
		var stageName = $("#"+stageDivId+" #stage-name").val();
		var stageNumber = $("#"+stageDivId+" #stage-number").val();
		var stageDescription = $("#"+stageDivId+" #stage-description").val();
		var iconName = $("#"+stageDivId+" .stage-icon-name").val();
		var dbStgId = $("#"+stageDivId+" .db-stg-id").val();
		var causeId = $("#causeid").val();
		var db_act_ids = [];            
        $("#"+stageDivId+"  input[name^=act_ids]").each(function(){
            db_act_ids.push($(this).val());
        });
		
		//alert(stageDivId);
		
		console.log(db_act_ids);
		if(causeId == ''){
			alert(add_cause_error);
			return false;
		}
		else if(db_act_ids == ''){
			
			alert(add_activity_error);
			return false;
		}
		var dataString = {'stg_name': stageName, 'stg_number': stageNumber, 'stg_desc': stageDescription, 'icon_name': iconName, 'cause_id': causeId, 'db_stg_id': dbStgId, 'db_act_ids': db_act_ids};
		if(stageName==''||stageNumber==''||stageDescription=='')
		{
			alert(fill_all_fields);
		}
		else if(iconName == ''){
			alert(stage_icon_error);
		}
		else{
			var dbStgId = $("#"+stageDivId+" .db-stg-id").val();
			//alert(dbStgId);
			if(dbStgId == '')
			{
				$.ajax({
					type: "POST",
					url: base_url+"Admin/cause_creation_save_stage",
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function(result){
						//alert(result);
						//return false;
						$("#"+stageDivId+" .db-stg-id").val(result);
						$("#js-stage-form .next").attr("id", "next-stage-"+nextId);
						$("#js-stage-form .prev").attr("id", "prev-stage-"+(newid-1));
						var stage_form_html = $("#js-stage-form").html();
						// set new stage HTML
						var html = '<div id="stage-'+newid+'" class="stage-section">';
							
							html +=stage_form_html;
						html +='</div>';
						$("#stage .stage-section").hide();
						$("#stage .container-fluid").append(html);
					}
				});

			}else{
				$.ajax({
					type: "POST",
					url: base_url+"Admin/cause_creation_update_stage",
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function(result){
						//alert(result);
						//return false;
						//$("#"+stageDivId+" .db-stg-id").val(result);
					}
				});
				var nextDivId =  "stage-"+newid;
				if (document.getElementById(nextDivId)) {
					//alert('this record already exists');
					$(".stage-section").hide();
					$("#stage-"+newid).show();
				} else {
					// set new stage HTML
					$("#js-stage-form .next").attr("id", "next-stage-"+nextId);
					$("#js-stage-form .prev").attr("id", "prev-stage-"+(newid-1));
					var stage_form_html = $("#js-stage-form").html();
					var html = '<div id="stage-'+newid+'" class="stage-section">';
						
						html +=stage_form_html;
					html +='</div>';
					$("#stage .stage-section").hide();
					$("#stage .container-fluid").append(html);
				}
			}
		}
		
	});
	
	//Goto previous stage
	$(document).on("click", ".prev.btn.create-btn", function() {
		var stageDivId = $(this).closest('.stage-section').attr('id');
		var buttonId = $(this).attr('id');
		var explode = buttonId.split('-');
		var id = parseInt(explode[2]);
		var newid = id+1;
		var stageDbId = $("#stage-"+newid+" .db-stg-id").val();
		//alert(stageDbId);
		if(stageDbId == '')
		{
			$("#stage-"+newid).remove();
		}
		$(".stage-section").hide();
		$("#stage-"+id).show();
		
	});
	
	
	//Load project section from a view template using AJAX
	$(document).on("click", "#tab_project a, #finish-stages", function() {
		var cause_id = $("#causeid").val();
		//alert(cause_id);
		$.ajax({
			type: "POST",
			url: base_url+"Admin/get_view_ajax",
			data: "cause_id="+cause_id,
			dataType: 'html',
			cache: false,
			success: function(result){
				//alert(result);
				$("#project").html(result);
				//hide stage tabs
				$("#tab_stage, #tab_stage a").removeClass('active show');
				$("#stage").removeClass('active show');
				//show project tab
				//$("#tab_project").show();
				$("#tab_project, #tab_project a").addClass('active');
				$("#project").addClass('active show');
			}
		});
		
	});
	
	//Set status to 1 after click on Finish Cause button on Project tab
	$(document).on("click", ".finish-cause", function() {
		var buttonId = $(this).attr('id');
		var explode = buttonId.split('-');
		var cause_id = parseInt(explode[2]);
		//alert(cause_id);
		$.ajax({
			type: "POST",
			url: base_url+"Admin/finish_cause",
			data: "cause_id="+cause_id,
			//dataType: 'json',
			cache: false,
			success: function(result){
				window.location = base_url+"Admin/dashboard";
				//alert(result);
				//if(result == 1){
					//window.location = base_url+"Admin/dashboard";
				//}else{
					//alert('Error.');
				//}//
				
			}
		});
		
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
		;
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
				url: base_url+"Admin/upload_activity_photo",
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
	
	
	// Institution registration form
	
	
	$(document).on("click", "#inst_next_1", function() {
		var counter = 0;
		$("#inst_step_basic .required").each(function() {
		   // alert($(this).val());
			if ($(this).val() == "") {
				//alert('Y');
				$(this).next( "span.error" ).show();
				counter++;
			}else{
			   //alert('N');
			   $(this).next( "span.error" ).hide();
			}
		});   
		
		var email = $("#inst_step_basic  #email").val();
		var conf_email = $("#conf_email").val();
		var txt = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (email != '' && !txt.test(email)) {
			$("#email").next( "span.error" ).text('Email is not valid').show();
			counter = 1;
		} else if(email == '') {
			$("#email").next( "span.error" ).text('Email is required').show();
			counter = 1;
		}else{
			$("#email").next( "span.error" ).text('').hide();
			//counter = 0;
		}
		if (conf_email != '' && !txt.test(conf_email)) {
			$("#conf_email").next( "span.error" ).text('Email is not valid').show();
			//counter = 1;
		} else if(conf_email == '') {
			$("#conf_email").next( "span.error" ).text('Confirm email is required').show();
			counter = 1;
		}else{
			$("#conf_email").next( "span.error" ).text('').hide();
			//counter = 0;
		}
		if ((email !='' && conf_email !='') && (email != conf_email))
		{
			$("#conf_email").next( "span.error" ).text('Email and confirm email are not the same').show();
			counter = 1;
		}
		else{
			//$("#conf_email").next( "span.error" ).text('').hide();
			//counter = 0;
		}
		var logoName = $("#logoName").val();
		if(logoName ==''){
			$(".logo_error").show();
			counter = 1;
		}else{
			$(".logo_error").hide();
			
		}
		//alert(counter);
		if(counter > 0){
			//alert('1');
		  return false;
		 
		}else{
			//alert('2');
			$('#inst_step_info').show();
			$('#inst_step_basic').hide();
		}
		
		
	});
	
	$(document).on("click", "#inst_next_2", function() {
		var counter = 0;
		$("#inst_step_info .required").each(function() {
		   // alert($(this).val());
			if ($(this).val() == "") {
				//alert('Y');
				$(this).next( "span.error" ).show();
				counter++;
			}else{
			   //alert('N');
			   $(this).next( "span.error" ).hide();
			}
		});   
		
		var email = $("#inst_step_info  #rep_email").val();
		//var conf_email = $("#conf_email").val();
		var txt = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (email != '' && !txt.test(email)) {
			$("#rep_email").next( "span.error" ).text('Email is not valid').show();
			counter = 1;
		} else if(email == '') {
			$("#rep_email").next( "span.error" ).text('Email is required').show();
			counter = 1;0
		}else{
			$("#rep_email").next( "span.error" ).text('').hide();
			//counter = 0;
		}
		
		
		var ins_certificate = $("#ins_certificate").val();
		if(ins_certificate ==''){
			$(".ins_certificateo_error").show();
			counter = 1;
		}else{
			$(".ins_certificate_error").hide();
			
		}
		//alert(counter);
		if(counter > 0){
			//alert('1');
		  return false;
		 
		}else{
			//alert('2');
			$('#inst_step_bank').show();
			$('#inst_step_info').hide();
		}
		
		
	});0
	
	$(document).on("click", "#cause_register", function() {
		var counter = 0;
		$("#inst_step_bank .required").each(function() {
		   // alert($(this).val());
			if ($(this).val() == "") {
				//alert('Y');
				$(this).next( "span.error" ).show();
				counter++;
			}else{
			   //alert('N');
			   $(this).next( "span.error" ).hide();
			}
		});   
		
		var email = $("#inst_step_bank  #bank_email").val();
		//var conf_email = $("#conf_email").val();
		var txt = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (email != '' && !txt.test(email)) {
			$("#bank_email").next( "span.error" ).text('Email is not valid').show();
			counter = 1;
		} else if(email == '') {
			$("#bank_email").next( "span.error" ).text('Email is required').show();
			counter = 1;
		}else{
			$("#bank_email").next( "span.error" ).text('').hide();
			//counter = 0;
		}
		
	
		//alert(counter);
		if(counter > 0){
			//alert('1');
		  return false;
		 
		}else{
			//alert('2');  return false;
			$( "#Causes_register" ).submit();
		}
		
		
	});
	
	
	//Publish cause from my cause page.
	
	$(document).on("click", ".publish_cause_butn", function() {
		
		var causeId = $(this).attr('id');
		var explode = causeId.split('-');
		var cause_id = parseInt(explode[1]);
		//alert(cause_id);
		$("#pub_cause_id").val(cause_id);
	});
	
	$(document).on("click", ".publish_cause", function() {
		
		var causeId = $("#pub_cause_id").val();;
		//alert(causeId); return false;
		$.ajax({
			type: "POST",
			url: base_url+"Admin/publish_cause",
			data: "cause_id="+causeId,
			dataType: 'json',
			cache: false,
			success: function(result){
				if(result == 1){
					window.location = base_url+"Admin/dashboard";
				}else{
					//alert('Error.');
				}
				
			}
		});
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
				url: base_url+"/Admin/add_thanks_card",
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
		else{
			
			//alert('save');
			$.ajax({
				type: "POST",
				url: base_url+"/Admin/update_thanks_card",
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

	$('.popup').click(function(){
		$('.popup').hide();
	});
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
				url: base_url+"/Admin/add_activity_log",
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
				url: base_url+"/Admin/update_activity_log",
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
	/*****------get cause approved id by admin -------*****/
	$(document).on("click", ".aprovecause", function() {
		//alert('causeaproved');
		var cause_id = $(this).attr('id');
		//alert(cause_id);
		var aprove_id = cause_id.split("_");
		//alert(aprove_id);
		var aproveid = aprove_id[1];
		//alert (aproveid);
		$("#cause_aprove_id").val(aproveid);
	    });
   /*****------chnage status when cause approved by admin -------*****/

    $(document).on("click", "#causeaproved", function() {
	    var cause_aprove_id = $("#cause_aprove_id").val();
		//alert(cause_aprove_id);
		var dataString = {'cause_aprove_id':cause_aprove_id};
		$.ajax({
	          type: "POST",
              url: base_url+"Admin/change_cause_status/",
              data:dataString,
              //dataType: 'json',
              cache: false,
              success: function(result){
				 //window.location.reload();
				 window.location = base_url+"Admin/dashboard";
			  //return false;
	           }
           });
	 });
	 
	 
	 ///////////// certificate on change  get data
	 $(document).on("change", "#certificates", function() {
	  //alert("Working"); 
	  var id = $(this).val();
	  var certDivId = $(this).closest('.certificate_form').attr('id');
	  $.ajax({
			type: "POST",
			url: base_url+"Admin/certificate_name",
			data: "id="+id,
			dataType: 'json',
			cache: false,
			success: function(result){
				$.each(result, function(i, item) {
		        // alert(result[i].benefits);
				
		       var corporate_cenefits = result[i].benefits;
			   $('#'+certDivId+' #corporate_benefits').val(corporate_cenefits)
			    //alert(corporate_cenefits);
			   var restrictions = result[i].restrictions;
			    $('#'+certDivId+' #corporate_restrictions').val(restrictions)
			   //alert(restrictions);
		        });
				
		    }
		});
      
    })
  
	
	//Update performance added activity amount
	$(".added_act_amt").focusout(function(){
		var amount = $(this).val();
		var inputId = $(this).attr('id');
		var explode = inputId.split('_');
		var actid = explode[2];
		var dataString = {'actid': actid, 'amount': amount};
		$.ajax({
			type: "POST",
			url: base_url+"Admin/save_activity_amount",
			data: dataString,
			//dataType: 'json',
			cache: false,
			success: function(result){
				//alert(result);
				if(result == 1){
					alert(updated);
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