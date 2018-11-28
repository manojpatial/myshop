<?php 
//echo '<pre>'; print_r($cause_data); echo '</pre>';
//echo '<pre>'; print_r($activity_data); echo '</pre>';
if(!empty($stage_data) && !empty($cause_data)){ ?>
<div id="project-page" class='container-fluid' style="background:linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url('<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cause_data->photo; ?>') no-repeat;">
	<div class='row com50' id="stage-listing">
		<div class='col-lg-4 col-md-3'></div>
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
			<p>Expected Scenario</p>
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
				<p>Certifications</p>
				<div class="timeline-badge">
					<a href="JavaScript:void(0);" id="" class="certificate_icon"><i class="fa fa-file-text" aria-hidden="true"></i></a>
				</div>
				<span><?php echo $cause_data->another_activity; ?></span>
			</div>
		</div>
	</div><!--Row--->
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
				<a href="JavaScript:void(0);" class="back_to_stage">Back to top</a>
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
					?>
					<div class='row'>
						<div class='col-md-8'>
							<ul class="timeline timenew">
								<li>
									<div class="timeline-badge"><i class="fa  <?php echo $act['act_icon'];?>" aria-hidden="true"></i></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
										  <h4 class="timeline-title"><?php echo $act['act_name'];?></h4>
										</div>
									</div>
									<div class='timeline-right'><h4 class="timeline-title"><?php echo $act['act_description'];?></h4></div>
								  <p class='amt'><?php echo number_format((float)$cost, 2, '.', '').' USD'; ?></p>
								</li>
							</ul>
						</div>
						<div class='col-md-4'>
							<div class='up-file'>
								<div class="fileselector" id="image-<?php echo $act['act_id']; ?>" >
									<?php if($act['activity_photo'] == '') { ?>
									<label class="btn btn-default" for="upload-file-<?php echo $act['act_id']; ?>">
										<input id="upload-file-<?php echo $act['act_id']; ?>" type="file" class="upload-file-act">
										Upload a Picture <br />of this activity<br /> when funded
									</label>
									<?php }else{ ?>
										<img src="<?php echo base_url();?>assets/uploads/activity-photo/<?php echo $act['activity_photo']; ?>">
									<?php
									} ?>
								</div>
							</div>
						</div>
					</div>
				<?php 
				}
				$cost = 0;
			}
			?>
			</div>
		</div>
		<?php $i++;
		} ?>
	<div class='row com50'>
		<div class='col-lg-4 col-md-3'></div>
		<div class='col-lg-4 col-md-6'></div>
		<div class='col-lg-4 col-md-3'><button id="finish-cause-<?php echo $cause_data->id;?>" type="button" class="finish-cause btn creat-btn">Finish Cause</button></div>
	</div>
</div>
<?php } else{ ?>
<div id="project-page" class='container-fluid com50' style="">		
	<div class='row'>
		<div class='col-lg-12 col-md-12 text-center'>
			<h4>Please assign minimum one stage for see preview of your cause.</h4>
		</div>
	</div>
</div>
<?php
}
?>