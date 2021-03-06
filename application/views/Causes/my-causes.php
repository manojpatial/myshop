<?php
//echo '<pre>'; print_r($my_causes); echo '</pre>';
?>
	<div class='create-causes com50'>
		<div class='container-fluid'>
			<h1 class='body-title'><?php echo $this->lang->line('my_cause_heading'); ?></h1>
			<div class='create-causes'>
				<?php if(!empty($my_causes)) { ?>
				<ul>
				<?php
					$total = count($my_causes);
					foreach($my_causes as $cause){
						//echo '<pre>'; print_r($cause['status']); echo '</pre>';
					?>
						<li class='created-causes'>
						<?php if($cause['status'] == 3) { ?>
							<a href="<?php echo base_url();?>Causes/update_performance/<?php echo $cause['id'];?>">
						<?php } else { ?>
						<a href="<?php echo base_url();?>Causes/edit_cause/<?php echo $cause['id'];?>">
						<?php } ?>
								<div class='cause-photo'><img src='<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cause['photo'];?>' /></div>
								<div class='cause-des'>
									<h4><?php echo $cause['name'];?></h4>
								</div>
							</a>
							<div class='cause-des light'>
								<?php if($cause['status'] == 1) { ?>
								<h4><span class="publish_cause_butn" id="causeid-<?php echo $cause['id'];?>"><?php echo $this->lang->line('my_cause_publish'); ?></span></h4>
								<?php } else if($cause['status'] == 2) { ?>
								<h4><?php echo $this->lang->line('my_cause_review'); ?></h4>
								<?php } else if($cause['status'] == 3) { ?>
								<h4><?php echo $this->lang->line('update_performance'); ?></h4>
								<?php } ?>
							</div>
							<div id="pop_approve">
							<?php if($cause['status'] == 3 && $cause['pop_approve'] == 0){ ?>
								<input type="hidden" class="approve_pop" id="cause_pop_<?php echo $cause['id'];?>" value="<?php echo $cause['id'];?>" />
							<?php } ?>
							</div>
						</li>
						<?php if($cause['status'] == 3 && $cause['pop_approve'] == 0){ ?>
						<!---popup code for Approved Cause--->
						<div id="approve_pop_<?php echo $cause['id']; ?>" class="popup_appr">
							<span class="helper"></span>
							<div class="popup_body">
								<!--<div class="popupCloseButton">X</div>-->
								Cause: <?php echo $cause['name']; ?><br><br>
								CLYC.me will be looking for donations now! <br><br>Every time you recieve a donation you must update the information <br><br>within the Cause and upload pictures of the performance to keep <br><br>your donors informed and happy!<br><br>
								<div class='pop_buttons'>
								
								<input type="hidden" value="<?php echo $cause['id']; ?>" id="appr_cause_id">
								<button id="" type="button" class="approve_cause btn create-btn">Got It!</button>
								</div>
							</div>
						</div>
					<?php
					}
					
					}
					?>
					<li><a href='<?php echo base_url('Causes/causescreation');?>'><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $this->lang->line('my_cause_create'); ?></a></li>
					</ul>
					<!---popup code --->
					<div class="popup">
						<span class="helper"></span>
						<div class="popup_body">
							<!--<div class="popupCloseButton">X</div>-->
							<?php echo $this->lang->line('my_cause_popup_message'); ?>
							<div class='pop_buttons'>
							<button id="" type="button" class="back_but btn create-btn"><?php echo $this->lang->line('my_cause_back'); ?></button>
							<input type="hidden" value="" id="pub_cause_id">
							<button id="" type="button" class="publish_cause btn create-btn"><?php echo $this->lang->line('publish_cause'); ?></button>
							</div>
						</div>
					</div>
					
				<?php
				}
				else{
				?>
				<p class='text-center'><?php echo $this->lang->line('cause_message'); ?></p>
				<ul style="padding-top:20px;">
					<li><a href='<?php echo base_url('Causes/causescreation');?>'><i class="fa fa-plus" aria-hidden="true"></i><?php echo $this->lang->line('my_cause_create'); ?> </a></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</section>