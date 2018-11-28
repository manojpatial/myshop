<?php 
//echo '<pre>'; print_r($resultData); echo '</pre>';
/* $loginData = $this->session->userdata('logged_in');
$loginId = $loginData['id'];
$projectId = $this->uri->segment(3);
$voting_end = $projectData->voting_end;
$voting_end_exp = explode(' ', $voting_end);
$date = $voting_end_exp[0];
$date_exp = explode('-', $date);
$new_end_date = $date_exp[2].'/'.$date_exp[1].'/'.$date_exp[0]; */
?>


<section class='voting-sec com50'>
<div class='container-fluid'>
		<div class='row voting-main'>
		<?php 
			if($donation_type == 2){
				$i = 1;
				foreach($resultData as $cause) { ?>
					
			 <div class='col-sm-4'>
				<div class='vt-main'>
				<div class="over-text">
						<div class="dis-text">
							<p><?php echo $cause->name; ?></p>
							<!--<p>50.000 USD-20 Schools</p>-->
						</div> 
					</div>
					<img src="<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cause->photo; ?>">
				</div>
				<!--<div class='award-sec'>
				</div>-->
				<div id="number-<?php echo $cause->id; ?>" class='vote-box'>
							<span><?php echo $i; ?></span>
							<img src='<?php echo base_url();?>assets/images/trophy.png' />
						</div>
						<div id="voting_details">
							<?php echo $cause->total_votes; ?>  <?php echo $this->lang->line('vote'); ?>
						</div>
				
			</div>
			  <?php $i++; 
				} 
			} else if($donation_type == 1) { ?>
			 <div class='col-sm-4'>
				<div class='vt-main'>
				<div class="over-text">
						<div class="dis-text">
							<p><?php echo $resultData['1']->name; ?></p>
							<!--<p>50.000 USD-20 Schools</p>-->
						</div> 
					</div>
					<img src="<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $resultData['1']->photo; ?>">
				</div>
				<!--<div class='award-sec'>
				</div>-->
				<div id="number-<?php echo $resultData['1']->id; ?>" class='vote-box'>
							<span>1</span>
							<img src='<?php echo base_url();?>assets/images/trophy.png' />
							 
						</div>
						<div id="voting_details">
							<?php echo $resultData['1']->total_votes; ?> <?php echo $this->lang->line('vote'); ?>
						</div>
				
			</div>
			<?php
			}?>	
			
		</div>
	</div>
</section>


<?php /*?>
<section class='voting-sec com50'>
	<div class="cadd-more visi-photo">
		<ul>
		<?php 
			if($donation_type == 2){
				$i = 1;
				foreach($resultData as $cause) { ?>
					<li>
						<div class="over-text">
							<div class="dis-text"> 
								<p><?php echo $cause->name; ?></p>
								<!--<p>50.000 USD-20 Schools</p>-->
							</div> 
						</div>
						<img src="<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cause->photo; ?>">
						<div id="number-<?php echo $cause->id; ?>" class='vote-box'>
							<span><?php echo $i; ?></span>
							<img src='<?php echo base_url();?>assets/images/trophy.png' />
						</div>
						<div id="voting_details">
							<?php echo $cause->total_votes; ?> Votes
						</div>
					</li>
		  <?php $i++; 
				} 
			} else if($donation_type == 1) { ?>
				<li>
					<div class="over-text">
						<div class="dis-text"> 
							<p><?php echo $resultData['1']->name; ?></p>
							<!--<p>50.000 USD-20 Schools</p>-->
						</div> 
					</div>
					<img src="<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $resultData['1']->photo; ?>">
					<div id="number-<?php echo $resultData['1']->id; ?>" class='vote-box'>
						<span>1</span>
						<img src='<?php echo base_url();?>assets/images/trophy.png' />
					</div>
					<div id="voting_details">
						<?php echo $resultData['1']->total_votes; ?> Votes
					</div>
				</li>
			<?php
			}?>								
		</ul>
	</div>
</section><?php */?>
