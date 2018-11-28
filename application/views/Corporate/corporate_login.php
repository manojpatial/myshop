<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>::::</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body class='cyan-bg'>
<!--==========================First page start here!=====================-->
<section class='causes-log'>
	<div class='container'>
		<div class='row justify-content-center'>
		<ul class="lang_menus">
						<li><a href='<?php echo base_url(); ?>LangSwitch/switchLanguage/english'>English</a></li>
						<li><a href='<?php echo base_url(); ?>LangSwitch/switchLanguage/spanish'>Español </a></li>
						<li><a href='<?php echo base_url(); ?>LangSwitch/switchLanguage/chinese'>Chinese </a></li>
					</ul>
			<div class='col-sm-4'>
				<div class='clyc-box'>
					<a href='<?php echo base_url();?>'>
						<img src='<?php echo base_url();?>assets/images/logo.png' />
						<span><?php echo $this->lang->line('corporate'); ?></span>
					</a>
				</div>
			</div>
		</div>
		<div class='row top50 justify-content-center'>
			<div class='col-sm-6'>
				  <?php 
					if($this->session->flashdata('message_error'))  { 

						echo '<div class="alert alert-danger fade in" style="margin-top:18px;"><a href=""  onclick="myFunction()" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong> Error! </strong>  '. $this->session->flashdata('message_error').'</div>'; 
					
					}else if($this->session->flashdata('message_success')){
						
						echo '<div class="alert alert-success fade in" style="margin-top:18px;">
						<a href="" class="close"  onclick="myFunction()" data-dismiss="alert" aria-label="close" title="close">×</a><strong> Success!</strong>  '. $this->session->flashdata('message_success').'
						</div>'; 
					}
					else{
						echo '';
					}		
					?>
				<form action="<?php echo base_url('Corporate/corporate_login'); ?>" role="form" method='post' class='login-form' id="corporate">
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('login_email_label'); ?></label>
						<div class='col-sm-8'><input type='text' name="email" id="email" class='form-control' /></div>
					</div>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('login_password_label'); ?></label>
						<div class='col-sm-8'><input type='password' name="password" id="password" class='form-control' /></div>
					</div>
					<div class='form-row'>
						<label class='col-sm-12'><a href='<?php echo base_url('Corporate/corporate_register'); ?>'><?php echo $this->lang->line('login_create_account'); ?></a></label>
						
					</div>
					<div class='button-group text-right'>
						
						<button type='submit' class='btn log-btn'><?php echo $this->lang->line('login_button'); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>

<script type="text/javascript">
$(document).ready(function() {
    // Generate a simple captcha
   // function randomNumber(min, max) {
//        return Math.floor(Math.random() * (max - min + 1) + min);
//    };
   // $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));
 
	
    $('#corporate').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
           
             password: {                
                validators: {
                    notEmpty: {
                        message: '<?php echo $this->lang->line('password_required_error'); ?>'
                    }
                }
            },
			 
		 
			email: {                
                validators: {
                    notEmpty: {
                        message: '<?php echo $this->lang->line('email_required_error'); ?>'
                    },
					 
					 
                }
            },
			 
		} 
    });
}); 

 
</script>  

</body>
</html>
