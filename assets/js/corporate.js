//image uplaod 
$(document).ready(function() {
	//alert('hello');
	var base_url = $('#base').val(); 
	//alert('base_url');
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
		if(fsize > 2000000)
		{
			alert("Image File Size is very big");
		}
		else
		{
		form_data.append("file", document.getElementById('upload-file-selector').files[0]);
		$.ajax({
			//url: "/clyc/corporate/upload_corporate_logo/",
			url: base_url+"corporate/upload_corporate_logo",
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
	           // var Url = '<?php echo base_url();?>/assets/uploads/corporate-logo/'+imageName;
				var Url = base_url+'assets/uploads/corporate-logo/'+imageName;
				
			   $('#uploaded_image').show();
			  
			   $("#img-thumbnail").attr("src",Url);
			   $("#logoName").val(imageName);
			}
	   });
	  }
	});
	
	//select cause onclick
	    //$(".selectcauses").on('click', function(){
		$('body').on('click', '.selectcauses', function (){
	      var id= $(this).attr('id') 
	      var idParts = id.split("_");
	      var causeId = idParts[2];
	      //alert(causeId);
	      var dataString = {'cause_id': causeId};
	        $.ajax({
	          type: "POST",
	        //url: "<?php echo base_url();?>Corporate/selectcauses/",
              url: base_url+"Corporate/selectcauses/",
             data: dataString,
             //dataType: 'json',
             cache: false,
             success: function(result){
				alert('Added');
				$("#"+id).removeClass("selectcauses");
				$("#"+id).addClass("removecauses");
				$("#"+id).html('<i class="fa fa-close" aria-hidden="true"></i> remove Cause');
				
				//alert(result);
	         }
         });
        });

      //Remove cause onclick
	   // $(".removecauses").on('click', function(){
		$('body').on('click', '.removecauses', function (){
	       var rid= $(this).attr('id') 
	       var idParts = rid.split("_");
	       var removeId = idParts[2];
	        //alert(removeId);
	       var dataString = {'remove_id': removeId};
	         $.ajax({
	         type: "POST",
	        //url: "<?php echo base_url();?>Corporate/removecauses/",
	         url: base_url+"Corporate/removecauses/",
	         data: dataString,
	         //dataType: 'json',
	         cache: false,
	         success: function(result){
				alert('Removed');
				$("#"+rid).removeClass("removecauses");
				$("#"+rid).addClass("selectcauses");
				$("#"+rid).html('<i class="fa fa-plus" aria-hidden="true"></i> Add Cause');
				//alert(result);
	       }
          });
        });
		
		
	


   //Save Project info into database..
	
	$(document).on("click", "#submit", function() {
		//alert('helo');
		var user_id = $("#user_id").val();
		var project_id = $("#projectid").val();
		var project_name = $("#project_name").val();
		var project_description = $("#project_description").val();
		//var selected_causes = $("#selected_causes").val();
		var causes_ids = [];            
        $("input[name^=causes_ids]").each(function(){
            causes_ids.push($(this).val());
        });
		 
		//alert(causes_ids);
		console.log(causes_ids);
		
		var donation_amount = $("#donation_amount").val();
		var voting_startdate = $("#voting_startdate").val();
		var voting_starttime = $("#voting_starttime").val();
		var voting_enddate = $("#voting_enddate").val();
		var voting_endtime = $("#voting_endtime").val();
		//var show_amount = $("#show_amount").val();
		var donation_frequency = $('input[name=donation_frequency]:checked').val();
		//alert(donation_frequency);
		var donation_date = $("#donation_date").val();
		var donation_time = $("#donation_time").val();
		var donation_type = $("#donation_type").val();
		if($('input[name="show_amount"]').is(':checked'))
         {
			var show_amount = 1;
		 }else {
			var show_amount = 0;
		 }
	  
		var dataString = {'user_id': user_id, 'project_name': project_name, 'project_description': project_description, 'causes_ids': causes_ids, 'donation_amount': donation_amount, 'voting_startdate': voting_startdate, 'voting_starttime': voting_starttime,'voting_enddate': voting_enddate,
		'voting_endtime': voting_endtime,'show_amount': show_amount,'donation_frequency': donation_frequency,'donation_date': donation_date,'donation_time': donation_time,'donation_type': donation_type,'project_id':project_id};
	
		if(project_name==''||project_description==''||donation_amount==''||donation_frequency=='')
		{
			alert("Please Fill All Fields");
		}
		else
		{
			
			//alert(project_id);
			if(project_id=='')
			{
				 
		    $.ajax({
				type: "POST",
				url: base_url+"corporate/project_submit",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(result){  
				$("#tab_voting, #tab_voting a").addClass('active');
				$("#tab_voting").addClass('active show');
				$("#information").removeClass('active show');
				$("#tab_information, #tab_information a").removeClass('active show');	
				$("#voting").addClass('active show');
				$("#projectid").val(result);
					//alert(result);
			  
				}
			  });
            }
           else
		   {
			   $.ajax({
				type: "POST",
				url: base_url+"corporate/project_submit_update_info",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(result){
				 
				$("#tab_voting, #tab_voting a").addClass('active');
				$("#tab_voting").addClass('active show');
				$("#information").removeClass('active show');
				$("#tab_information, #tab_information a").removeClass('active show');	
				$("#voting").addClass('active show');
				}
			  });
			   
		   }			  
		}
	 });
	 
  
 
  
	 
 ////////////////////on change attribute 
   $('input[name=donation_frequency]').change(function(){
      var value = $('input[name=donation_frequency]:checked' ).val();
      //alert(value);
	  if(value == 'Until')
	   {
	  $('#donation_date').prop("disabled", false); 
	  $('#donation_time').prop("disabled", false);
	   }
	  else
	   {
	  $('#donation_date').prop("disabled", true); 
	  $('#donation_time').prop("disabled", true);
	   }
       });

	   
       //////////// popup id on click 
   $(document).on("click", "#popup_id", function() {
	     //alert('popupid');
		$.ajax({
			type: "POST",
			url: base_url+"corporate/popup_data",	
			dataType: 'json',
			cache: false,
			success: function(result){
					//alert(result);
				var html='';
				$.each(result, function(i, item) {
				//alert(result[i].name);
				html +='<li><div class="over-text"><div class="dis-text"><p>'+result[i].name+'</p>'+result[i].description+'</div></div><img src="'+base_url+'assets/uploads/cause-picture/'+result[i].photo+'"><input name="causes_ids[]" type="hidden" id="causes_ids" value="'+result[i].id+'"></li>';
		
				});
				
				$("#selected_causes").html(html);
				$(".close").click();
		   
			}
		});
    });  
		
	/////donation type on click 
	$(document).on("click", ".voting-box li", function() {
	 //alert('dation type');
	   $('.voting-box li').removeClass('selected-vote');
	   $(this).addClass('selected-vote');
	   var type_id= ($(this).attr('id')); 
	   var split_id = type_id.split("_");
	   var typeid = split_id[1];
	   //alert(typeid);
		$("#donation_type").val(typeid);
	});
			
	         
	  /////////////donation voting type submit button
	   
    $(document).on("click", "#votingtpye_submit", function() {
	    //alert('votingtpye_submit');
		var project_id = $("#projectid").val();
		//alert(project_id);
		var donation_type = $("#donation_type").val();
		//alert(donation_type);
		var dataString = {'project_id': project_id, 'donation_type': donation_type,};
		
		if(donation_type=='')
		{
			alert("Please select a Donation type");
		}
		else{
		 $.ajax({
	          type: "POST",
              url: base_url+"Corporate/voting_type/",
              data: dataString,
              //dataType: 'json',
              cache: false,
              success: function(result){
				  //alert(result);
				//$("#projectid").val(result); 
				$("#tab_visualization, #tab_visualization a").addClass('active'); 
				$("#tab_visualization").addClass('active show');
				$("#voting").removeClass('active show');
				$("#tab_voting, #tab_voting a").removeClass('active show');
				$("#visualization").addClass('active show');
				$("#visualization").html(result);
                 //alert(result);				
	              }
              });
		 }
		}); 
		
		
		
	//////////// popup id on click 
   $(document).on("click", "#Selected_id", function() {
	 //alert('Selected_id');
		$.ajax({
			type: "POST",
			url: base_url+"corporate/popup_data",	
			dataType: 'json',
			cache: false,
			success: function(result){
				var html='';
				$.each(result, function(i, item) {
                    //alert(result[i].name);
					
					//html +='<li id="li_'+result[i].id+'"><div class="over-text"><div class="dis-text"><p>'+result[i].name+'</p>'+result[i].description+'</div></div><img src="'+base_url+'assets/uploads/cause-picture/'+result[i].photo+'"><input name="causes_ids[]" type="hidden" id="causes_ids" value="'+result[i].id+'"><a href="#" id="remove_cause_'+result[i].id+'" class="removecauses_sel">X</a></li>';
					
					
					html +='<li id="li_'+result[i].id+'"><a href="JavaScript:Void(0);" id="get_cause_'+result[i].id+'" class="removecauses_sel"><i class="fa fa-close" aria-hidden="true"></i></a><div class="over-text"><div class="on-h-text"></div><div class="dis-text"><p>'+result[i].name+'</p><p>50.000 USD-20 Schools</p></div> </div><div class="cphoto-box"><img src="'+base_url+'assets/uploads/cause-picture/'+result[i].photo+'"></div></li>';
                });
				$("#Selectedcause_image").html(html);
				$("ul#Selectedcause_image").show();
				$("ul#allcause-section").hide();
				$("ul#filter_section").hide();
			   
			   
			  
			}
			});
		}); 
		
		
  //////////// all cause  button on click 
    /* $(document).on("click", "#allcause_button", function(){
		//alert('allcause_button');
		$.ajax({
		type: "POST",
		url: base_url+"corporate/popup_data",	
		dataType: 'json',
		cache: false,
		success: function(result){ 
			var html='';
			$.each(result, function(i, item) {
				//alert(result[i].name);
				
				 html +='<li id="li_'+result[i].id+'"><div class="over-text"><div class="dis-text"><p>'+result[i].name+'</p>'+result[i].description+'</div></div><img src="'+base_url+'assets/uploads/cause-picture/'+result[i].photo+'"><input name="causes_ids[]" type="hidden" id="causes_ids" value="'+result[i].id+'"><a href="#" id="remove_cause_'+result[i].id+'" class="removecauses_sel">X</a></li>';
			
			   });
		   $("#Selectedcause_image").hide(html);
		   $("ul#allcause-section").show();
		   $('ul#allcause-section').removeClass('style','');
		   $("ul#filter_section").hide();
			}
		});
   
	});  */

////// ajex  Remove near li image and data		
	$('body').delegate('.removecauses_sel','click',function(e){
			//alert('Remove');
	       var rid= $(this).attr('id') 
	       var idParts = rid.split("_");
	       var removeId = idParts[2];
	        //alert(removeId);
	       var dataString = {'remove_id': removeId};
	        $.ajax({
				type: "POST",
				//url: "<?php echo base_url();?>Corporate/removecauses/",
				url: base_url+"Corporate/removecauses/",
				data: dataString,
				//dataType: 'json',
				cache: false,
				success: function(result){
					//alert('helo');
					$("#li_"+removeId).remove();
				}
            });
        });
 

  /////////////visulization save  button
    $(document).on("click", "#visulization_save", function() {
	   // alert('visulization_save');
		var project_id = $("#visualizationid").val();
		//alert(project_id);
		var dataString = {'project_id': project_id};
			$.ajax({
				type: "POST",
				url: base_url+"Corporate/visulization_save/",
				data: dataString,
				//dataType: 'json',
				cache: false,
				success: function(result){
					window.location.replace(base_url+"Corporate/myprojects");
				}
            });
	}); 
		
	/////////////visulization publish  button
    $(document).on("click", "#visulization_publish", function() {
	   // alert('visulization_save');
		var project_id = $("#visualizationid").val();
		//alert(project_id);
		var dataString = {'project_id': project_id};
			$.ajax({
				type: "POST",
				url: base_url+"Corporate/visulization_publish/",
				data: dataString,
				//dataType: 'json',
				cache: false,
				success: function(result){
					window.location.replace(base_url+"Corporate/myprojects");
				}
            });
	}); 
	       
  ////// delete project 
   $(document).on("click", ".deleteProject", function() {
	   //alert('Are you sure you want to delete the project');
	    var id = $(this).attr("id");
		//alert(id);
		 $.ajax({
	          type: "POST",
              url: base_url+"Corporate/delete_project/",
              data:{'id':id},
              dataType: 'json',
              cache: false,
              success: function(result){
	            }
            });
		}); 
		
	//////// Filter form 
    $(document).on("click", "#filter_Send", function() {
	    //alert('filter_Send');
		var ngo_name = $("#ngo_name").val();
		//alert(ngo_name);
		var cause_name = $("#cause_name").val();
		//alert(cause_name);
		var services_type = $("#services_type").val();
		//alert(services_type);
		var certificate_type_val = $('input[name=certificate_type]:checked').val();
		//alert(certificate_type_val);
		if (certificate_type_val == null){
			var certificate_type = '';
		}else{
			var certificate_type = certificate_type_val;
		}
		var dataString = {'ngo_name':ngo_name, 'cause_name':cause_name,'services_type':services_type,'certificate_type':certificate_type,};
		
		$.ajax({
	        type: "POST",
            url: base_url+"Corporate/filter_form_send/",
            data:dataString,
            dataType: 'json',
            cache: false,
            success: function(result){
				var html='';
				$.each(result, function(i, item) {
                    //alert(result[i].name);
					//html +='<li id="li_'+result[i].id+'"><div class="over-text"><div class="on-h-text"><a href="JavaScript:Void(0);" id="get_cause_'+result[i].id+'" class="removecauses_sel"><i class="fa fa-close" aria-hidden="true"></i></a></div><div class="dis-text"><p>'+result[i].name+'</p><p>50.000 USD-20 Schools</p></div> </div><div class="cphoto-box"><img src="'+base_url+'assets/uploads/cause-picture/'+result[i].photo+'"></div></li>';
					
					html +='<li><div class="over-text"><div class="on-h-text"><a target="_blank" href="'+base_url+'/Corporate/view/'+result[i].id+'"><i class="fa fa-search" aria-hidden="true"></i> Details</a><a href="JavaScript:Void(0);" id="get_cause_1" class="selectcauses"><i class="fa fa-plus" aria-hidden="true"></i> Add Cause</a>	</div><div class="dis-text"><p>'+result[i].name+'</p><p>50.000 USD-20 Schools</p></div></div><div class="cphoto-box"><img src="'+base_url+'assets/uploads/cause-picture/'+result[i].photo+'"></div></li>';
                });
				$("#allcause-section").html(html);
				$('#myModal_filter').modal('toggle');
	        }
        });
			
	});
  
	
/////////////// Date and time picker

 $(function() {              
         
           $('#datepicker1').datetimepicker({
                 format: 'YYYY-MM-DD'
           });
		   $('#timepicker1').datetimepicker({
                    format: 'HH:mm:ss'
                });
				
			$('#datepicker2').datetimepicker({
                 format: 'YYYY-MM-DD'
           });
		   $('#timepicker2').datetimepicker({
                    format: 'HH:mm:ss'
                });	
				
		 $('#datepicker3').datetimepicker({
                 format: 'YYYY-MM-DD'
           });
		   $('#timepicker3').datetimepicker({
                    format: 'HH:mm:ss'
                });	
        });  

		 
		//Project View: Show scenario UL and activity UL on click of stage icon
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
	//Project View: hide scenario UL and activity UL on click of stage icon and show stage listing
	$(document).on("click", ".back_to_stage", function() {
		$('#stage-listing').show();
		//$('.timeline-badge').removeClass('badge_selected');
		
		//$(".exp-icon").removeClass('scenario_ul_show');
		$(".act_timeline").removeClass('activity_ul_show');
		
	});
	//Project View: Show price with stage icon on click of scenario_ul icon
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
		
		
	//Load project section from a view template using AJAX
	/* $(document).on("click", ".ad-more", function() {
		//var cause_id = $("#causeid").val();
		//alert(cause_id);
		$.ajax({
			type: "POST",
			url: base_url+"Corporate/get_view_ajax",
			//data: "cause_id="+cause_id,
			dataType: 'html',
			cache: false,
			success: function(result){
				//alert(result);
				$("#myModal .modal-body").html(result);
			}
		});
		
	}); */
		
	//Project Section: show certificate section
	$(document).on("click", ".certificate_icon", function() {
		$('#certificates-listing').css('display','block');
		$('#stage-listing').hide();
	});
	//Project Section: show certificate section
	$(document).on("click", "#back-cert", function() {
		$('#certificates-listing').css('display','none');
		$('#stage-listing').show();
	});
		
	//Menu show/hide
	$(document).on("click", ".avt-sec a", function() {
		$('.menus').toggle();
	
	});
//////////form validation
	
    /**---$('#corporate_register').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {               
                validators: {
                    notEmpty: {
                        message: '<?php echo $this->lang->line('password_required_error'); ?>'
                    }
                }
            },
             company: {                
                validators: {
                    notEmpty: {
                        message: 'The company is required and cannot be empty'
                    }
                }
            },
			 
		 
			email: {                
                validators: {
                    notEmpty: {
                        message: 'The Email is required and cannot be empty'
                    },
					 
					 
                }
            },
			conf_email: {              
                validators: {
                    notEmpty: {
                        message: 'The confrm email is required and cannot be empty '
                    },identical: {
                    field: 'email',
                    message: 'The Email   and its confirm Email are not the same'
                }
                }
            }
		} 
    });----**/
}); 
