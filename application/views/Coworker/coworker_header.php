<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/coworker.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#logoutid").click(function(){
        $("p").toggle();
    });
});
</script>
</head>

<body>
<!--==========================First page start here!=====================-->
<input type="hidden" value="<?php echo base_url(); ?>" id="base">
<input type="hidden" id="current_language" value="<?php echo $this->lang->line('language_key'); ?>">
<section class='causes-create'> 
	<div class='head-bar'><!--=====Head Bar!================-->
		<div class='container-fluid'>
			<div class='row align-items-center'>
				<div class='col-sm-3'>
					<div class='clyc-box'>
					<a href='<?php echo base_url();?>'>
						<img src='<?php echo base_url();?>assets/images/logo-small.png' />
						<span><?php echo $this->lang->line('co-workers');?></span>
					</a>
				</div>
				</div>
				<div class='col-sm-6'>
					<h1><?php echo $title; ?></h1>
				</div>
				<div class='col-sm-1'>
				<div class="inline-item">
				<select id="Dropdownlanguage">
    
   <option value="<?php echo base_url(); ?>LangSwitch/switchLanguage/english" <?php echo $this->lang->line('language_key') == "English" ? "selected" : "";  ?>>English</option>
   <option value="<?php echo base_url(); ?>LangSwitch/switchLanguage/spanish" <?php echo $this->lang->line('language_key') == "Spanish" ? "selected" : "";  ?>>Español</option>
   <option value="<?php echo base_url(); ?>LangSwitch/switchLanguage/chinese" <?php echo $this->lang->line('language_key') == "Chinese" ? "selected" : "";  ?>>Chinese</option>
   </select>
   </div>
   </div>
				<div class='col-sm-2'>
				<?php $loginData = $this->session->userdata('logged_in');
						if($loginData !='')
						{ 
							$loginUsername = $loginData['name'];
							$loginlogoimage = $loginData['image'];
						?>
					<div class='avt-sec'>
						<span id="logoutid"><?php echo $loginUsername ;?></span>
						<img src="<?php echo base_url();?>assets/images/mptek.jpg" alt="Avatar" class="avatar">
						
					</div>
						<?php }?>
						 
						<p style="display:none; font-size:14px;" ><a href="<?php echo base_url();?>coworker/logout" style="color:white;"><?php echo $this->lang->line('logout'); ?></a></p>
						
				</div>
			</div>
		</div>
	</div><!--=====Head Bar!================-->
	
	