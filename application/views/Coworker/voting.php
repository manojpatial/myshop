<?php 

//echo '<pre>'; print_r($projectData); echo '</pre>'; 
$loginData = $this->session->userdata('logged_in');
$loginId = $loginData['id'];
$projectId = $this->uri->segment(3);

$voting_end = $projectData->voting_end;
$voting_end_exp = explode(' ', $voting_end);
$date = $voting_end_exp[0];
$date_exp = explode('-', $date);
$new_end_date = $date_exp[2].'/'.$date_exp[1].'/'.$date_exp[0];
?>

<section class='voting-sec com50'>
	<div class='container-fluid'>
		<div class='row voting-main'>
		<?php 
			foreach($causesData as $cause) { ?>
			<div class='col-sm-4'>
				<div class='vt-main'>
				<div class="over-text">
						<div class="dis-text">
							<p><?php echo $cause['name']; ?></p>
							<!--<p>50.000 USD-20 Schools</p>-->
						</div> 
					</div>
					<img src="<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cause['photo']; ?>">
				</div>
				<!--<div class='award-sec'>
				</div>-->
				<div id="number-<?php echo $cause['id']; ?>" class='vote-box' >
						<span>?</span>
						<img src='<?php echo base_url();?>assets/images/trophy.png' />
				</div>
				
			</div>
			<?php } ?>
			<!--<div class='col-sm-4'>
				
			</div>
			<div class='col-sm-4'>
				
			</div>--->
		</div>
	</div>

	<div class="cadd-more visi-photo">
		<?php /*?><ul>
		<?php 
			foreach($causesData as $cause) { ?>
				<li>
					<div class="over-text">
						<div class="dis-text">
							<p><?php echo $cause['name']; ?></p>
							<!--<p>50.000 USD-20 Schools</p>-->
						</div> 
					</div>
					<img src="<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cause['photo']; ?>">
					<div id="number-<?php echo $cause['id']; ?>" class='vote-box'>
						<span>?</span>
						<img src='<?php echo base_url();?>assets/images/trophy.png' />
					</div>
				</li>
				 
	  <?php } ?>
 	  
		</ul><?php 
		*/?>
		<div class="hover_bkgr_fricc">
			<span class="helper"></span>
			<div>
				<div class="popupCloseButton">X</div>
				<ul class="voting-option">
				<?php if($projectData->donation_type == 1) { ?>
				<li id="vote-4" class="vote-cir-individual"><span><?php echo $this->lang->line('vote'); ?></span></li>
				<?php } else if($projectData->donation_type == 2){ ?>
					<li id="vote-1" class="vote-cir"><span>1</span></li>
					<li id="vote-2" class="vote-cir"><span>2</span></li>
					<li id="vote-3" class="vote-cir"><span>3</span></li>
				<?php } ?>
				</ul>
				<input type="hidden" value="" id="causeid">
			</div>
		</div>
		<div class='container-fluid'>
			<input type="hidden" value="" id="invote-1">
			<input type="hidden" value="" id="invote-2">
			<input type="hidden" value="" id="invote-3">
			<input type="hidden" value="" id="invote-4">
			<input type="hidden" value="<?php echo $projectData->donation_type; ?>" id="voting-type">
			<input type="hidden" value="<?php echo $projectId; ?>" id="project_id">
			<input type="hidden" value="<?php echo $loginId; ?>" id="user_id">
			<div class='button-group text-right top30'>
				<button type='button' id="vote-submit" class='btn create-btn btn-disable'><?php echo $this->lang->line('submit_button');?></button>
			</div>
		</div>	
	</div>
	
	<div id="voting_thanks" class="popup">
		<span class="helper"></span>
		<div class="popup_body">
			<!--<div class="popupCloseButton">X</div>-->
			<h2><?php echo $this->lang->line('thanks_msg'); ?></h2>
			<p><?php echo $this->lang->line('result_available_date_msg'); ?> <?php echo $new_end_date; ?></p>
			<div class='pop_buttons'>
			<!--<button id="" type="button" class="back_but btn create-btn"><?php echo $this->lang->line('back_button'); ?></button>-->
			<a href ="<?php echo base_url(); ?>Coworker/crcprojects" class="back_but btn creat-btn"><?php echo $this->lang->line('back_button'); ?></a>
			
			</div>
		</div>
	</div>
</section>