$(document).ready(function() {
	var base_url = $('#base').val();
	//alert(base_url); 
	//Upload Institution logo using AJAX on Registration page
	$(document).on("change", "#upload-file-selector-reg", function() {
	
		var name = document.getElementById("upload-file-selector-reg").files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{ 
		   alert("Invalid Image File");
		} 
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("upload-file-selector-reg").files[0]);
		var f = document.getElementById("upload-file-selector-reg").files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert("Image File Size is very big");
		}
		else
		{
			form_data.append("file", document.getElementById('upload-file-selector-reg').files[0]);
			$.ajax({
				url: base_url+"Causes/upload_institution_logo",
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
		   alert("Invalid Image File");
		}  
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("upload-file-selector-reg_vali").files[0]);
		var f = document.getElementById("upload-file-selector-reg_vali").files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert("Image File Size is very big");
		}
		else
		{
			form_data.append("file", document.getElementById('upload-file-selector-reg_vali').files[0]);
			$.ajax({
				url: base_url+"Causes/upload_institution_logo",
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
		   alert("Invalid Image File");
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("upload-file-selector").files[0]);
		var f = document.getElementById("upload-file-selector").files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 5000000)
		{
			alert("Image size should be less than 5MB");
		}
		else
		{
			form_data.append("file", document.getElementById('upload-file-selector').files[0]);
			$.ajax({
				url: base_url+"Causes/upload_cause_picture",
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
		   alert("Invalid Image File");
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById(divId).files[0]);
		var f = document.getElementById(divId).files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert("Image File Size is very big");
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
		   alert("Invalid Image File");
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById(divId).files[0]);
		var f = document.getElementById(divId).files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert("Image File Size is very big");
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
	 
	 //click  Done button certification form to cause..
	$(document).on("click", ".cert_save", function() {
		var divId = $(this).attr("id");
		var explode = divId.split('_');
		var rowid = explode[2];
		
		var name = $("#certificate_form_"+rowid+" .select_certificate option:selected").text();
		//alert(name); return false;
		//var certificates = $("#certificate_form_"+rowid+" #certificates").text();
		var other_certificae = $("#certificate_form_"+rowid+" #other_certificae").val();
		var corporate_benefits = $("#certificate_form_"+rowid+" #corporate_benefits").val();
		var corporate_restrictions = $("#certificate_form_"+rowid+" #corporate_restrictions").val();
		var imagename = $("#certificate_form_"+rowid+" #upload-file-selector-hidden_"+rowid).val();
		var dbCertId = $("#certificate_form_"+rowid+" #dbCertId_"+rowid).val();
		
		
		var dataString = {'certificates_name': name, 'other_certificae': other_certificae, 'corporate_benefits': corporate_benefits, 'corporate_restrictions': corporate_restrictions, 'imagename': imagename,'dbCertId': dbCertId};
		//alert(dataString);
		if(name=='' || other_certificae=='' || corporate_benefits=='' || corporate_restrictions=='' || imagename=='')
		{
			alert("Please Fill All Fields");
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
					$("#add_cert_"+rowid).text(name);
					$("#certificate_form_"+rowid+" #dbCertId_"+rowid).val(result);
					$("#add_cert_"+rowid).addClass('active');
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
					$("#add_cert_"+rowid).text(name);
					$(".certificate_form").hide();
					$(".services_form").hide();
				}
			});
		}
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
			alert("Please Fill All Fields1");
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
			alert("Please Fill All Fields");
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
			alert("Please Fill All Fields");
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
		var htmls = '<br><button id="activitybutton-'+newid+'" type="button" class="create-activity btn creat-btn"><i class="fa fa-plus" aria-hidden="true"></i> Add Activity </button>';
		
		$("#"+stageDivId+" .activity-buttons").append(htmls);
		$("#"+stageDivId+" .activity-box").hide();
		// Create form 
		
		var html = '<div id="activity-form-'+newid+'" class="activity-box">';
				  html += '<div class="modal-dialog modal-md">';
					html += '<div class="modal-content">';
					  html += '<div class="modal-header">';
					  html += '<h4 class="modal-title">Add Activity <span class="form-numb">'+newid+'</span></h4>';
					  html += '</div>';
					 html += '<div class="modal-body">';
						
						html += '<form method="post" class="add-activity">';
							html += '<div class="form-row">';
								html += '<label class="col-sm-4">Activity Name</label>';
								html += '<div class="col-sm-8">';
									html += '<input type="text" id="act-name" class="form-control"/>';
								html += '</div>';
							html += '</div>';
							html += '<div class="form-row">';
								html += '<label class="col-sm-4">Activity number</label>';
								html += '<div class="col-sm-8">';
									html += '<input type="text" id="act-number" class="form-control"/>';
								html += '</div>';
							html += '</div>';
							html += '<div class="form-row">';
								html += '<label class="col-sm-4">Description</label>';
								html += '<div class="col-sm-8">';
									html += '<textarea id="act-description"  class="form-control"></textarea>';
								html += '</div>';
							html += '</div>';
							html += '<div class="form-row">';
								html += '<label class="col-sm-4">Pesimistic Scenario</label>';
								html += '<div class="col-sm-8">';
									html += '<input type="text" id="act-pesimistic" class="form-control" placeholder="$"/>';
								html += '</div>';
							html += '</div>';
							html += '<div class="form-row">';
								html += '<label class="col-sm-4">Expected Scenario</label>';
								html += '<div class="col-sm-8">';
									html += '<input type="text" id="act-expected" class="form-control" placeholder="$"/>';
								html += '</div>';
							html += '</div>';
							html += '<div class="form-row">';
								html += '<label class="col-sm-4">Best Scenario</label>';
								html += '<div class="col-sm-8">';
									html += '<input type="text" id="act-best" class="form-control" placeholder="$"/>';
								html += '</div>';
							html += '</div>';
							html += '<div class="form-row">';
								html += '<label class="col-sm-4">Choose an icon</label>';
								html += '<div class="col-sm-8">';
									html += '<ul class="icon-list">';
										html += '<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>';
										html += '<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>';
										html += '<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>';
										html += '<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>';
										html += '<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>';
										html += '<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>';
									html += '</ul>';
									html += '<input type="hidden" class="icon-name" value="">';
									
								html += '</div>';
							html += '</div>';
							html += '<div class="button-group text-right">';
							html += '<input type="hidden" class="db-act-id" value="">';
								html += '<button type="button" class="btn create-btn">Done</button>';
							html += '</div>';
						html += '</form>';
					  html += '</div>';
					 html += '</div>';
				   html += '</div>';
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
			alert("Please Fill All Fields");
		}
		else if(iconName == ''){
			alert("Please select an icon for activity");
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
	
	// Add new stage on the click of NEXT button
	
	$(document).on("click", ".next.btn.create-btn", function() {
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
			alert('Please add Cause information before create a stage');
			return false;
		}
		else if(db_act_ids == ''){
			
			alert('Please add an activity for this stage.');
			return false;
		}
		var dataString = {'stg_name': stageName, 'stg_number': stageNumber, 'stg_desc': stageDescription, 'icon_name': iconName, 'cause_id': causeId, 'db_stg_id': dbStgId, 'db_act_ids': db_act_ids};
		if(stageName==''||stageNumber==''||stageDescription=='')
		{
			alert("Please Fill All Fields");
		}
		else if(iconName == ''){
			alert("Please select an icon for stage");
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
						
						// set new stage HTML
						var html = '<div id="stage-'+newid+'" class="stage-section">';
							html +='<div class="row">';
								html +='<div class="col-sm-6">';
									html +='<form method="post" class="steps-form add-stage">';
										html +='<div class="form-row">';
											html +='<label class="col-sm-3">Stage Name</label>';
											html +='<div class="col-sm-9"><input type="text" id="stage-name" class="form-control" /></div>';
										html +='</div>';
										html +='<div class="form-row">';
											html +='<label class="col-sm-3">Stage Number</label>';
											html +='<div class="col-sm-9"><input type="text" id="stage-number" class="form-control" /></div>';
										html +='</div>';
										html +='<div class="form-row">';
											html +='<label class="col-sm-3">Description</label>';
											html +='<div class="col-sm-9"><textarea class="form-control"  id="stage-description"></textarea></div>';
										html +='</div>';
										html +='<div class="form-row">';
											html +='<label class="col-sm-3">Activities<br /><small>(The more activities, the more transparent your cause will look)</small></label>';
											html +='<div class="col-sm-9 activity-buttons" id="">';
												html +='<button id="activitybutton-1" type="button" class="create-activity btn creat-btn"><i class="fa fa-plus" aria-hidden="true"></i> Add Activity </button>';
											html +='</div>';
											
										html +='</div>';
										html +='<div class="form-row">';
											html +='<div class="col-sm-7 text-right">';
													html +='<a href="JavaScript:Void(0);" class="add-more"> Add More</a>';
											html +='</div>';
										html +='</div>';
										
										html +='<div class="form-row">';
											html +='<label class="col-sm-3">Choose an icon</label>';
											html +='<div class="col-sm-9">';
												html +='<ul id="stage-icon" class="icon-list">';
													html +='<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>';
													html +='<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>';
													html +='<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>';
													html +='<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>';
													html +='<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>';
													html +='<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>';
												html +='</ul>';
												html +='<input type="hidden" class="stage-icon-name" value="">';
											html +='</div>';
										html +='</div>';
										html +='<div id="activities-ids">';
										
										html +='</div>';
										html +='<div class="button-group text-center">';
										html += '<input type="hidden" class="db-stg-id" value="">';
											html +='<button id="prev-stage-'+(newid-1)+'"  type="button" class="prev btn create-btn">Previous Stage</button>';
											html +='<button id="next-stage-'+nextId+'" type="button" class="next btn create-btn" style="margin-left: 5px;">Next</button>';
											html +='<button id="finish-stages" type="button" class="btn create-btn">Finish</button>';
										html +='</div>';
										
									html +='</form>';
								html +='</div>';
								
								html +='<div class="col-sm-6" id="activity-form-section">';
									html +='<div id="activity-form-1" class="activity-box">';
									  html +='<div class="modal-dialog modal-md">';
										html +='<div class="modal-content">';
										  html +='<div class="modal-header">';
										  html +='<h4 class="modal-title">Add Activity <span class="form-numb">1</span></h4>';
										  html +='</div>';
										  html +='<div class="modal-body">';
											
											html +='<form method="post" class="add-activity">';
												html +='<div class="form-row">';
													html +='<label class="col-sm-4">Activity Name</label>';
													html +='<div class="col-sm-8">';
														html +='<input type="text" id="act-name" class="form-control"/>';
													html +='</div>';
												html +='</div>';
												html +='<div class="form-row">';
													html +='<label class="col-sm-4">Activity number</label>';
													html +='<div class="col-sm-8">';
														html +='<input type="text" id="act-number" class="form-control"/>';
													html +='</div>';
												html +='</div>';
												html +='<div class="form-row">';
													html +='<label class="col-sm-4">Description</label>';
													html +='<div class="col-sm-8">';
														html +='<textarea id="act-description" class="form-control"></textarea>';
													html +='</div>';
												html +='</div>';
												html +='<div class="form-row">';
													html +='<label class="col-sm-4">Pesimistic Scenario</label>';
													html +='<div class="col-sm-8">';
														html +='<input type="text" id="act-pesimistic" class="form-control" placeholder="$"/>';
													html +='</div>';
												html +='</div>';
												html +='<div class="form-row">';
													html +='<label class="col-sm-4">Expected Scenario</label>';
													html +='<div class="col-sm-8">';
														html +='<input type="text" id="act-expected" class="form-control" placeholder="$"/>';
													html +='</div>';
												html +='</div>';
												html +='<div class="form-row">';
													html +='<label class="col-sm-4">Best Scenario</label>';
													html +='<div class="col-sm-8">';
														html +='<input type="text" id="act-best" class="form-control" placeholder="$"/>';
													html +='</div>';
												html +='</div>';
												html +='<div class="form-row">';
													html +='<label class="col-sm-4">Choose an icon</label>';
													html +='<div class="col-sm-8">';
														html +='<ul class="icon-list">';
															html +='<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>';
															html +='<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>';
															html +='<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>';
															html +='<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>';
															html +='<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>';
															html +='<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>';
														html +='</ul>';
													html +='</div>';
													html +='<input type="hidden" class="icon-name" value="">';
												html +='</div>';
												html +='<div class="button-group text-right">';
												html +='<input type="hidden" class="db-act-id" value="">';
													html +='<button type="button" class="btn create-btn">Done</button>';
												html +='</div>';
											html +='</form>';
											
										  html +='</div>';
										html +='</div>';
									  html +='</div>';
									html +='</div>';
								html +='</div>';
							html +='</div>';
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
					var html = '<div id="stage-'+newid+'" class="stage-section">';
						html +='<div class="row">';
							html +='<div class="col-sm-6">';
								html +='<form method="post" class="steps-form add-stage">';
									html +='<div class="form-row">';
										html +='<label class="col-sm-3">Stage Name</label>';
										html +='<div class="col-sm-9"><input type="text" id="stage-name" class="form-control" /></div>';
									html +='</div>';
									html +='<div class="form-row">';
										html +='<label class="col-sm-3">Stage Number</label>';
										html +='<div class="col-sm-9"><input type="text" id="stage-number" class="form-control" /></div>';
									html +='</div>';
									html +='<div class="form-row">';
										html +='<label class="col-sm-3">Description</label>';
										html +='<div class="col-sm-9"><textarea class="form-control"  id="stage-description"></textarea></div>';
									html +='</div>';
									html +='<div class="form-row">';
										html +='<label class="col-sm-3">Activities<br /><small>(The more activities, the more transparent your cause will look)</small></label>';
										html +='<div class="col-sm-9 activity-buttons" id="">';
											html +='<button id="activitybutton-1" type="button" class="create-activity btn creat-btn"><i class="fa fa-plus" aria-hidden="true"></i> Add Activity </button>';
										html +='</div>';
										
									html +='</div>';
									html +='<div class="form-row">';
										html +='<div class="col-sm-7 text-right">';
												html +='<a href="JavaScript:Void(0);" class="add-more"> Add More</a>';
										html +='</div>';
									html +='</div>';
									
									html +='<div class="form-row">';
										html +='<label class="col-sm-3">Choose an icon</label>';
										html +='<div class="col-sm-9">';
											html +='<ul id="stage-icon" class="icon-list">';
												html +='<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>';
												html +='<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>';
												html +='<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>';
												html +='<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>';
												html +='<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>';
												html +='<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>';
											html +='</ul>';
											html +='<input type="hidden" class="stage-icon-name" value="">';
										html +='</div>';
									html +='</div>';
									html +='<div id="activities-ids">';
									
									html +='</div>';
									html +='<div class="button-group text-center">';
									html += '<input type="hidden" class="db-stg-id" value="">';
										html +='<button id="prev-stage-'+(newid-1)+'"  type="button" class="prev btn create-btn">Previous Stage</button>';
										html +='<button id="next-stage-'+nextId+'" type="button" class="next btn create-btn" style="margin-left: 5px;">Next</button>';
										html +='<button id="finish-stages" type="button" class="btn create-btn">Finish</button>';
									html +='</div>';
									
								html +='</form>';
							html +='</div>';
							
							html +='<div class="col-sm-6" id="activity-form-section">';
								html +='<div id="activity-form-1" class="activity-box">';
								  html +='<div class="modal-dialog modal-md">';
									html +='<div class="modal-content">';
									  html +='<div class="modal-header">';
									  html +='<h4 class="modal-title">Add Activity <span class="form-numb">1</span></h4>';
									  html +='</div>';
									  html +='<div class="modal-body">';
										
										html +='<form method="post" class="add-activity">';
											html +='<div class="form-row">';
												html +='<label class="col-sm-4">Activity Name</label>';
												html +='<div class="col-sm-8">';
													html +='<input type="text" id="act-name" class="form-control"/>';
												html +='</div>';
											html +='</div>';
											html +='<div class="form-row">';
												html +='<label class="col-sm-4">Activity number</label>';
												html +='<div class="col-sm-8">';
													html +='<input type="text" id="act-number" class="form-control"/>';
												html +='</div>';
											html +='</div>';
											html +='<div class="form-row">';
												html +='<label class="col-sm-4">Description</label>';
												html +='<div class="col-sm-8">';
													html +='<textarea id="act-description" class="form-control"></textarea>';
												html +='</div>';
											html +='</div>';
											html +='<div class="form-row">';
												html +='<label class="col-sm-4">Pesimistic Scenario</label>';
												html +='<div class="col-sm-8">';
													html +='<input type="text" id="act-pesimistic" class="form-control" placeholder="$"/>';
												html +='</div>';
											html +='</div>';
											html +='<div class="form-row">';
												html +='<label class="col-sm-4">Expected Scenario</label>';
												html +='<div class="col-sm-8">';
													html +='<input type="text" id="act-expected" class="form-control" placeholder="$"/>';
												html +='</div>';
											html +='</div>';
											html +='<div class="form-row">';
												html +='<label class="col-sm-4">Best Scenario</label>';
												html +='<div class="col-sm-8">';
													html +='<input type="text" id="act-best" class="form-control" placeholder="$"/>';
												html +='</div>';
											html +='</div>';
											html +='<div class="form-row">';
												html +='<label class="col-sm-4">Choose an icon</label>';
												html +='<div class="col-sm-8">';
													html +='<ul class="icon-list">';
														html +='<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>';
														html +='<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>';
														html +='<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>';
														html +='<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>';
														html +='<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>';
														html +='<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>';
													html +='</ul>';
												html +='</div>';
												html +='<input type="hidden" class="icon-name" value="">';
											html +='</div>';
											html +='<div class="button-group text-right">';
											html +='<input type="hidden" class="db-act-id" value="">';
												html +='<button type="button" class="btn create-btn">Done</button>';
											html +='</div>';
										html +='</form>';
										
									  html +='</div>';
									html +='</div>';
								  html +='</div>';
								html +='</div>';
							html +='</div>';
						html +='</div>';
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
			dataType: 'json',
			cache: false,
			success: function(result){
				if(result == 0){
					window.location = base_url+"Admin/dashboard";
				}else{
					alert('Error.');
				}
				
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
		var inputId = $(this).attr('id');
		var explode_inputId = inputId.split('-');
		var act_id = explode_inputId[2];
		//alert(inputId);
		var name = document.getElementById(inputId).files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{
		   alert("Invalid Image File");
		} 
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById(inputId).files[0]);
		var f = document.getElementById(inputId).files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert("Image File Size is very big");
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
					$("#image-"+act_id).html(html);
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
			url: base_url+"Causes/publish_cause",
			data: "cause_id="+causeId,
			dataType: 'json',
			cache: false,
			success: function(result){
				if(result == 1){
					window.location = base_url+"Causes/mycause";
				}else{
					alert('Error.');
				}
				
			}
		});
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
	
  
	//Menu show/hide
	$(document).on("click", ".avt-sec a", function() {
		$('.menus').toggle();
	
	});
	
}); 