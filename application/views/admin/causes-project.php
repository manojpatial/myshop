<?php 
//echo '<pre>'; print_r($thanks_card); echo '</pre>';
//echo '<pre>'; print_r($activity_data); echo '</pre>';
if(!empty($stage_data) && !empty($cause_data)){ ?>
<link href="<?php echo base_url();?>/assets/css/circle.css" rel="stylesheet" type="text/css">
<div id="project-page" class='container-fluid' style="background:linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url('<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cause_data->photo; ?>') no-repeat;">
	<div class='row com50' id="stage-listing">
		<div id="thanks-card" class='col-lg-4 col-md-3'>
			<?php if($cause_data->status == 3){ 
			if(!empty($thanks_card))
			{ ?>
				<ul id="thanks-card-ul" class="simp-btn">
					<?php
					$i =1;
					foreach($thanks_card as $thanks){ ?>
						<li class="active"><a id="add_thanks_<?php echo $i; ?>" href="javascript:void(0)" class="add_thanks thanks_card_butn">
							<?php echo $thanks['name'].' '.$this->lang->line('thanks_card'); ?></a>
						</li>
					<?php
					$i++;
					}
					?>
					<li class=""><a id="add_thanks_<?php echo $i; ?>" href="javascript:void(0)" class="add_thanks thanks_card_butn">
					+<?php echo $this->lang->line('thanks_card'); ?></a></li>
				</ul>
				<!---popup code --->
				<div id="thanks-popup-section" class="">
				<?php
				$i =1;
				foreach($thanks_card as $thanks){ ?>
					<div id="pop_id_<?php echo $i; ?>" class="popup">
						<div class="popup_body">
							<!--<div class="popupCloseButton">X</div>-->
							<span><?php echo $this->lang->line('thanks_card'); ?></span>
							<div class="form-row">
								<div class="col-sm-12"><textarea class="form-control"  id="message"><?php echo $thanks['message'];?></textarea></div>
							</div>
							<div class="form-row">
								<label class="col-sm-12 text-left"><?php echo $this->lang->line('only_visible'); ?></label>
								<div class="col-sm-12 text-left">
									<select id="donor-list">
										<option value=""><?php echo $this->lang->line('donors_list'); ?></option>
										<?php
										foreach($cause_donors AS $don){ ?>
											<option value="<?php echo $don['user_id'];?>" <?php echo $don['user_id'] == $thanks['user_id'] ? 'selected' : '';   ?>><?php echo $don['name'];?></option>
								<?php	}	?>
									</select>
								</div>
							</div>
							<div class='pop_buttons'>
								<button id="" type="button" class="back_but btn create-btn"><?php echo $this->lang->line('cancel'); ?></button>
								<input type="hidden" value="<?php echo $thanks['cause_id'];?>" id="cause_id">
								<input type="hidden" value="" id="card_id">
								<input type="hidden" value="<?php echo $thanks['id'];?>" id="db_card_id">
								<button id="" type="button" class="save_thanks_card btn create-btn"><?php echo $this->lang->line('finish_thanks_card'); ?></button>
							</div>
						</div>
					</div>
				<?php
				$i++;
				} ?>
				<div id="pop_id_<?php echo $i; ?>" class="popup">
					<div class="popup_body">
						<!--<div class="popupCloseButton">X</div>-->
						<span><?php echo $this->lang->line('thanks_card'); ?></span>
						<div class="form-row">
							<div class="col-sm-12"><textarea class="form-control"  id="message"></textarea></div>
						</div>
						<div class="form-row">
							<label class="col-sm-12 text-left"><?php echo $this->lang->line('only_visible'); ?></label>
							<div class="col-sm-12 text-left">
								<select id="donor-list">
									<option value=""><?php echo $this->lang->line('donors_list'); ?></option>
									<?php
									foreach($cause_donors AS $don){ ?>
										<option value="<?php echo $don['user_id'];?>"><?php echo $don['name'];?></option>
									<?php	
									}
									?>
								</select>
							</div>
						</div>
						<div class='pop_buttons'>
							<button id="" type="button" class="back_but btn create-btn"><?php echo $this->lang->line('cancel'); ?></button>
							<input type="hidden" value="<?php echo $cause_data->id; ?>" id="cause_id">
							<input type="hidden" value="" id="card_id">
							<input type="hidden" value="" id="db_card_id">
							<button id="" type="button" class="save_thanks_card btn create-btn"><?php echo $this->lang->line('finish_thanks_card'); ?></button>
						</div>
					</div>
				</div>
				</div>
				<?php
			}else
			{
			?>
			<ul id="thanks-card-ul" class="simp-btn">
				<li class=""><a id="add_thanks_1" href="javascript:void(0)" class="add_thanks thanks_card_butn">
				+<?php echo $this->lang->line('thanks_card'); ?></a></li>
			</ul>
			<!---popup code --->
			<div id="thanks-popup-section" class="">
				<div id="pop_id_1" class="popup">
					<div class="popup_body">
						<!--<div class="popupCloseButton">X</div>-->
						<span><?php echo $this->lang->line('thanks_card'); ?></span>
						<div class="form-row">
							<div class="col-sm-12"><textarea class="form-control"  id="message"></textarea></div>
						</div>
						<div class="form-row">
							<label class="col-sm-12 text-left"><?php echo $this->lang->line('only_visible'); ?></label>
							<div class="col-sm-12 text-left">
								<select id="donor-list">
									<option value=""><?php echo $this->lang->line('donors_list'); ?></option>
									<?php
									foreach($cause_donors AS $don){ ?>
										<option value="<?php echo $don['user_id'];?>"><?php echo $don['name'];?></option>
									<?php	
									}
									?>
								</select>
							</div>
						</div>
						<div class='pop_buttons'>
							<button id="" type="button" class="back_but btn create-btn"><?php echo $this->lang->line('cancel'); ?></button>
							<input type="hidden" value="<?php echo $cause_data->id; ?>" id="cause_id">
							<input type="hidden" value="" id="card_id">
							<input type="hidden" value="" id="db_card_id">
							<button id="" type="button" class="save_thanks_card btn create-btn"><?php echo $this->lang->line('finish_thanks_card'); ?></button>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<span class="add_more_span"><a href="javascript:void(0)" class="thanks_add_more"><?php echo $this->lang->line('add_card'); ?></a></span>
			<?php	
			}?>
		</div><!----Thanks card ----->
		<div class='col-lg-4 col-md-6'>
			<h1 class='body-title scholar-color text-center'><?php echo $cause_data->name;?></h1>
			<p class='text-center bottom30'><?php echo $cause_data->description;?></p>
			<ul id="stage-timeline" class="timeline">
			<?php foreach($stage_data as $stage){	?>
				<li id="timeline_stage_<?php echo $stage['stage_id'];?>">
					<div class="timeline-badge"><a href="JavaScript:void(0);" id="stage_<?php echo $stage['stage_id'];?>" class="stage_icon"><i class="fa <?php echo $stage['stage_icon'];?>" aria-hidden="true"></i></a></div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title"><?php echo $stage['stage_name'];?></h4>
						</div>
					</div>
					<div class='timeline-right'>
						<h4 class="timeline-title">
							<?php
							$newArray = array();
							foreach ($activity_data as $entry=>$value) {
								//echo '<pre>'; print_r($value['stage_id']); echo '</pre>';
								if($value['stage_id'] == $stage['stage_id']){
									$newArray[$entry] = $value;
								}
							}
							//echo '<pre>'; print_r($newArray); echo '</pre>';
							$pesimistic = 0;
							$expect = 0;
							$best = 0;
							foreach($newArray as $arr){
								$pesimistic += $arr['act_pesimistic_scenario'];
								$expect += $arr['act_expected_scenario'];
								$best += $arr['act_best_scenario'];
							}?>
							<span class="cost pesimistic_cost"> <?php echo number_format((float)$pesimistic, 2, '.', '').' USD'; ?></span>
							<span class="cost expect_cost" style="display:none;"> <?php echo number_format((float)$expect, 2, '.', '').' USD'; ?></span>
							<span class="cost best_cost" style="display:none;"> <?php echo number_format((float)$best, 2, '.', '').' USD'; ?></span>
					 	</h4>
					</div>
				</li>
			<?php
			}
			?>
			</ul>
		</div>
		<div class='col-lg-4 col-md-3 text-center expected_scenario'>
			<p><?php echo $this->lang->line('expected_scenario'); ?></p>
			<?php
				$i = 1;
				foreach($stage_data as $stage){ ?>
				<ul class='exp-icon <?php echo $i == 1 ? 'scenario_ul_show' : '' ?>' id="scenario_<?php echo $stage['stage_id']; ?>">
					<li id='scn_pesimistic'; class='selected-ic'>
						<img src='<?php echo base_url();?>assets/images/man-user.png' class='grey'/>
						<img src='<?php echo base_url();?>assets/images/man-user-selected.png' class='blue show'/>
						<p><?php echo $cause_data->pesimistic_scenario.' '.$cause_data->unit; ?></p>
					</li>
					<li id='scn_expect'>
						<img src='<?php echo base_url();?>assets/images/multiple-users-silhouette.png' class='blue'/>
						<img src='<?php echo base_url();?>assets/images/multiple-users-unsel.png' class='grey show'/>
						<p><?php echo $cause_data->expected_scenario.' '.$cause_data->unit; ?></p>
					</li>
					<li id='scn_best'>
						<img src='<?php echo base_url();?>assets/images/users-group.png' class='grey show'/>
						<img src='<?php echo base_url();?>assets/images/users-group-selected.png'  class='blue'/>
						<p><?php echo $cause_data->best_scenario.' '.$cause_data->unit; ?></p>
					</li>
				</ul>
				<?php $i++; 
				} ?>
			<div class="certificate_sec">
				<p><?php echo $this->lang->line('certifications'); ?></p>
				<div class="timeline-badge">
					<a href="JavaScript:void(0);" id="" class="certificate_icon"><i class="fa fa-file-text" aria-hidden="true"></i></a>
				</div>
				<span><?php echo $cause_data->another_activity; ?></span>
			</div>
		</div>
	</div><!--Row--->
	<!--- Certificate section ----->
	<div class='row com50' id='certificates-listing'>
		<div class='col-lg-3 col-md-3 text-center'>
		<div class='institution-logo'>
		<img src='<?php echo base_url();?>assets/uploads/institution-logo/<?php echo $cause_userdata['cause_logo']; ?>'>
		</div>
		<div class='institution-text'>
			<span><?php echo $this->lang->line('institution_label'); ?>:</span><br><?php echo $cause_userdata['cause_institution']; ?>
		</div>
		</div>
		<div class='col-lg-9 col-md-9'>
		<?php //echo '<pre>'; print_r($cert_data); ?>
			<div id='certificates-area'>
				<?php foreach($cert_data as $cert){ ?>
				<div class='box row'>
					<div class='box1 title col-lg-3 col-md-3  text-right'><?php echo $this->lang->line('certificate'); ?> </div>
					<div class='box1 cert_image  col-lg-3 col-md-3'><img src='<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cert['cert_image']; ?>' class='cert_image'></div>
					<div class='box1 cert_info col-lg-6 col-md-6'>
					<?php 
						if($cert['cert_name'] == 'Other'){
							echo  $cert['cert_other']; 
						}else 
						{
							echo  $cert['cert_name']; 
						}?>
						<div class='cert_corpo'>
							<strong><?php echo $this->lang->line('corporate_benefits'); ?>:<br></strong>
							<?php echo  $cert['cert_corporate_benefits']; ?>
						</div>
						<div class='cert_serv '>
							<strong><?php echo $this->lang->line('restrictions'); ?>:<br></strong>
							<?php echo  $cert['cert_restrictions']; ?>
						</div>
					</div>
				</div>
				<?php
				}?>
			</div>
			<div id='service-area'>
				<?php foreach($serv_data as $serv){ ?>
				<div class='box row'>
					<div class='box1 title col-lg-3 col-md-3  text-right'><?php echo $this->lang->line('service'); ?> </div>
					<div class='box1 col-lg-3 col-md-3'><img src='<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $serv['service_image']; ?>' class='service_image'></div>
					<div class='box1 cert_info col-lg-6 col-md-6'>
						<?php echo  $serv['service_name']; ?>
					</div>
				</div>
				<?php
				}?>
			</div>
		</div>
		<div class='col-lg-12 col-md-12'><button id="back-cert" type="button" class="btn creat-btn"><?php echo $this->lang->line('back_button'); ?></button></div>
	</div>
		<!--- Activity section on click of Stage name ---->
		<div class='container-fluid'>
		<?php
		//Activities for selected stage
		$i = 1;
		foreach($stage_data as $stage){ ?>
		<div class='row c-finish act_timeline' id = "act_stage_<?php echo $stage['stage_id']; ?>">
			<div class='col-lg-4 col-md-3'>
				<div class='selected-ico'>
					<div class='sel-icon'>
						<i class="fa fa-file-text" aria-hidden="true"></i>
					</div>
					<h3 class='sel-title'><?php echo $stage['stage_name']; ?></h3>
				</div>
			</div>
			<div class='col-lg-8 col-md-9 top50'>
			<?php
			$cost = 0;
			foreach($activity_data as $act){
				//echo $stage['stage_id'].'='. $act['stage_id']; echo '<br>';
				if($stage['stage_id'] == $act['stage_id'])
				{
					$cost += $act['act_pesimistic_scenario'];
					$cost += $act['act_expected_scenario'];
					$cost += $act['act_best_scenario'];
					$act_amount = $act['act_added_amount'];
					$act_cost = $cost;
					$percentage = ceil(($act_amount/$act_cost)*100);
					?>
					<div class='row'>
						<div class='col-md-8'>
							<ul class="timeline timenew">
								<li>
									<div class="timeline-badge c100 p<?php echo $percentage; ?> big">
										<i class="fa  <?php echo $act['act_icon'];?>" aria-hidden="true"></i>
										<div class="slice">
											<div class="bar"></div>
											<div class="fill"></div>
										</div>
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
										  <h4 class="timeline-title"><?php echo $act['act_name'];?></h4>
										</div>
									</div>
									<div class='timeline-right'><h4 class="timeline-title"><?php echo $act['act_description'];?></h4></div>
								   <p class='amt'><?php if($cause_data->status == 3){ ?>
									<input type="text" name="activity_amt" id="activity_amt_<?php echo $act['act_id'];?>" class="added_act_amt" value="<?php echo $act['act_added_amount'];?>"> USD / 
									<?php } ?><?php echo number_format((float)$cost, 2, '.', '').' USD'; ?></p>
								</li>
							</ul>
						</div>
						<div class='col-md-4'>
						<?php if($cause_data->status == 3){ ?>
							<ul id="act_id_<?php echo $act['act_id']; ?>" class='simp-btn'>
							<?php
								$i = 1;										
								for ($x = 0; $x <= 3; $x++) { 
								//echo $act['log_data'][$x]['description'];
								?>
									<li class="<?php echo (isset($act['log_data'][$x]['description']) && $act['log_data'][$x]['description'] !='') ? 'active' : ''; ?>">
										<a id="add_actlog_<?php echo $i; ?><?php echo $act['act_id']; ?>" href='javascript:void(0)' class=' add_actlog active'>
									<?php 
									if(isset($act['log_data'][$x]['description']) && $act['log_data'][$x]['description'] !='')
									{
										echo $act['log_data'][$x]['description'];
									}else{ ?>
									+ <?php echo $this->lang->line('add_activity_log'); ?>
								<?php } ?>
										</a>
									</li>
									<!--- Pop up ---->
									<div id="pop_actlog_<?php echo $i; ?><?php echo $act['act_id']; ?>" class="popup activity_pop">
										<div class="popup_body">
											<!--<div class="popupCloseButton">X</div>-->
											<span><?php echo $act['act_name']; ?></span>
											<div class="form-row">
												<div class="col-sm-12">
											<textarea class="form-control"  id="description"><?php 
												if(isset($act['log_data'][$x]['description']) && $act['log_data'][$x]['description'] !='')
												{
													echo $act['log_data'][$x]['description'];
												}?>
											</textarea></div>
											</div>
											<div class="form-row">
												<div class="fileselector" id="image-<?php echo $act['act_id']; ?>" >
													<?php
													if(isset($act['log_data'][$x]['image']) && $act['log_data'][$x]['image'] !=''){ ?>
													<img src="<?php echo base_url();?>assets/uploads/activity-photo/<?php echo $act['log_data'][$x]['image']; ?>">
													<?php } else { ?>
													<label class="btn btn-default" for="upload-file-<?php echo $act['act_id']; ?>-<?php echo $i; ?>">
														<input id="upload-file-<?php echo $act['act_id']; ?>-<?php echo $i; ?>" type="file" class="upload-file-act">
														<?php echo $this->lang->line('upload_picture_funded'); ?>
													</label>
													<?php } ?>
												</div>
											</div>
											<div class='pop_buttons'>
											<button id="" type="button" class="cancel_but btn create-btn"><?php echo $this->lang->line('cancel'); ?></button>
											<input type="hidden" value="<?php echo $cause_data->id;?>" id="cause_id">
											<input type="hidden" value="" id="act_log_id">
											<input type="hidden" value="<?php echo $act['act_id']; ?>" id="act_id">
											<input type="hidden" value="<?php 
												echo isset($act['log_data'][$x]['image']) && $act['log_data'][$x]['image'] !='' ? $act['log_data'][$x]['image'] : ''; ?>" id="act_image_name">
											<input type="hidden" value="<?php 
												echo isset($act['log_data'][$x]['id']) && $act['log_data'][$x]['id'] !='' ? $act['log_data'][$x]['id'] : ''; ?>" id="db_actlog_id">
											<button id="" type="button" class="save_act_log btn create-btn"><?php echo $this->lang->line('Save_button'); ?></button>
											</div>
										</div>
									</div>
								<?php
								$i++;
								}
								?>
							</ul>
						<?php }	?>
						</div>
					</div>
				<?php 
				}
				$cost = 0;
			}
			?>
			</div>
		<div class='col-lg-12 col-md-12'><button type="button" class="btn creat-btn back_to_stage"><?php echo $this->lang->line('back_button'); ?></button></div>
		</div>
		<?php $i++;
		} ?>
	<div class='row com50'>
		<div class='col-lg-4 col-md-3'><a href="<?php echo base_url(); ?>admin/dashboard" class="btn creat-btn">Back to panel</a></div>
		<div class='col-lg-4 col-md-6'></div>
		<div class='col-lg-4 col-md-3'><button id="finish-cause-<?php echo $cause_data->id;?>" type="button" class="finish-cause btn creat-btn">
		<?php echo $this->lang->line('finish_cause_button'); ?></button></div>
	</div>
</div>
<?php } else{ ?>
<div id="project-page" class='container-fluid com50' style="">		
	<div class='row'>
		<div class='col-lg-12 col-md-12 text-center'>
			<h4><?php echo $this->lang->line('project_default_msg'); ?></h4>
		</div>
	</div>
</div>
<?php
}
?>