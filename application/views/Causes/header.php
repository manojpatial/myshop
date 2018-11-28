<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php //echo $this->lang->line('welcome'); ?> <?php echo $title; ?></title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/cause.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--==========================First page start here!=====================-->
<section class='causes-create'>
<input type="hidden" id="base" value="<?php echo base_url(); ?>">
<input type="hidden" id="current_language" value="<?php echo $this->lang->line('language_key'); ?>">
	<div class='head-bar'><!-- ===== Head Bar! ================ -->
		<div class='container-fluid'>
			<div class='row align-items-center'>
				<div class='col-sm-3'>
					<div class='clyc-box'>
					<a href='<?php echo base_url();?>causes'>
						<img src='<?php echo base_url();?>assets/images/logo-small.png' />
						<span><?php echo $this->lang->line('cause'); ?></span>
					</a> 
				</div>
				</div>
				<div class='col-sm-6'>
				
					<h1><?php //echo $this->lang->line('welcome'); ?> <?php echo $title; ?></h1>
				</div> 
				<div class='col-sm-1'><div class="inline-item">
			<select id="Dropdownlanguage">
   
   <option value="<?php echo base_url(); ?>LangSwitch/switchLanguage/english" <?php echo $this->lang->line('language_key') == "English" ? "selected" : "";  ?>>English</option>
   <option value="<?php echo base_url(); ?>LangSwitch/switchLanguage/spanish" <?php echo $this->lang->line('language_key') == "Spanish" ? "selected" : "";  ?>>Español</option>
   <option value="<?php echo base_url(); ?>LangSwitch/switchLanguage/chinese" <?php echo $this->lang->line('language_key') == "Chinese" ? "selected" : "";  ?>>Chinese</option>
   </select>
   </div></div>
				<div class='col-sm-2'>
				
					<?php $loginData = $this->session->userdata('logged_in');
						if($loginData !='')
						{ 
							$loginUsername = $loginData['name'];
							$loginlogoimage = $loginData['image'];
						?>
							<div class='avt-sec'>
							
								<a href="JavaScript:void(0);"><?php echo $loginUsername; ?></a>
								<img src="<?php echo base_url();?>assets/uploads/institution-logo/<?php echo $loginlogoimage ;?>" alt="Avatar" class="avatar">
							</div>
				  <?php } ?>
					
					<ul class="menus" style="display:none;">
						<li><a href="<?php echo base_url();?>causes/logout"><?php echo $this->lang->line('logout'); ?></a></li>
					</ul>
					
				</div>
			</div>
		</div>
	</div><!--=====Head Bar!================-->