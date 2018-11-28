 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>



 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>
  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
     
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
  
<script type="text/javascript" src="<?php echo base_url();?>assets/js/corporate.js"></script>
 <script type="text/javascript">
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
                        message: '<?php echo $this->lang->line('name_label_error'); ?>'
                    }
                }
            },
             company: {                
                validators: {
                    notEmpty: {
                        message: '<?php echo $this->lang->line('company_label_error'); ?>'
                    }
                }
            },
			 
		 
			email: {                
                validators: {
                    notEmpty: {
                        message: '<?php echo $this->lang->line('email_label_error'); ?>'
                    },
					 
					 
                }
            },
			conf_email: {              
                validators: {
                    notEmpty: {
                        message: '<?php echo $this->lang->line('confirm_email_error'); ?> '
                    },identical: {
                    field: 'email',
                    message: '<?php echo $this->lang->line('confirm_email_error_msg'); ?>'
                }
                }
            }
		} 
    });
	
	
	///// // ///  change lanuage dropdown menu url   	
   jQuery(document).ready( function() {
   jQuery('#Dropdownlanguage').change( function() {
      location.href = jQuery(this).val();
     });
   });



 
</script>  

 

 
