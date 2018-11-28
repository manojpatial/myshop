//image uplaod 
$(document).ready(function() {
	//alert('hello');
	var base_url = $('#base').val();
	//alert('base_url');
	
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
              url: base_url+"Admin/selectcauses/",
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
	         url: base_url+"Admin/removecauses/",
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
				url: base_url+"Admin/project_submit",
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
				url: base_url+"Admin/project_submit_update_info",
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
			url: base_url+"Admin/popup_data",	
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
		   alert(typeid);
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
              url: base_url+"Admin/voting_type/",
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
			url: base_url+"Admin/popup_data",	
			dataType: 'json',
			cache: false,
			success: function(result){
				var html='';
				$.each(result, function(i, item) {
					
					html +='<li id="li_'+result[i].id+'"><div class="over-text"><div class="on-h-text"><a href="JavaScript:Void(0);" id="get_cause_'+result[i].id+'" class="removecauses_sel"><i class="fa fa-close" aria-hidden="true"></i></a></div><div class="dis-text"><p>'+result[i].name+'</p><p>50.000 USD-20 Schools</p></div> </div><div class="cphoto-box"><img src="'+base_url+'assets/uploads/cause-picture/'+result[i].photo+'"></div></li>';
                });
				$("#Selectedcause_image").html(html);
				$("ul#Selectedcause_image").show();
				$("ul#allcause-section").hide();
				$("ul#filter_section").hide();
			   
			   
			  
			}
			});
		}); 
		


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
				url: base_url+"Admin/removecauses/",
				data: dataString,
				//dataType: 'json',
				cache: false,
				success: function(result){
					//alert('helo');
					$("#li_"+removeId).remove();
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
              url: base_url+"Admin/delete_project/",
              data:{'id':id},
              dataType: 'json',
              cache: false,
              success: function(result){
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

		 
	
		
		
		
		
		
//////////form validation
	
    $('#corporate_register').bootstrapValidator({
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
                        message: 'The  Name is required and cannot be empty'
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
    });
}); 
