<!--====================Cause Creation step!=======================-->
	<?php
		$loginData = $this->session->userdata('logged_in');
		if($loginData !='')
		{ 
			$loginUserId = $loginData['id'];
		}
		if($this->session->userdata('cause_id') !='')
		{ 
			$cause_id = $this->session->userdata('cause_id');
		}
		// echo '<pre>'; print_r($certificates_data); echo '------------------------</pre>';
		// echo '<pre>'; print_r($services_data); echo '------------------------</pre>';
		 // echo '<pre>'; print_r($activity_data); echo '</pre>';
	?>
	<div class='c-creation bottom50'>
	
		<div class='creation-tab'>
			<ul class="nav nav-tabs">
			  <li id="tab_info" class="active"><a data-toggle="tab" href="#info" class="active show">Information</a></li>
			  <li id="tab_stage"><a data-toggle="tab" href="#stage">Stages</a></li>
			  <li id="tab_project"><a data-toggle="tab" href="#project">Project</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div id="info" class="tab-pane com30 fade in active">
				<form id="cause_form" method="POST" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $cause_data->id; ?>" id="causeid">
				<div id="info_1"  class='container-fluid'>
					<div class='row'>
					<div class='col-md-1'></div>
						<div class='col-md-5'>
							<div class='form-row'>
								<label class='col-sm-4'>Certificates<br />
									<small>Add all certificates you will provide your donors after donating.</small>
								</label>
								<div class='col-sm-8'>
									<ul class='simp-btn'>
										<li><a id="add_cert_1" href='javascript:void(0)' class=' add_cert <?php echo (isset($certificates_data[0]) && $certificates_data[0] !='') ? 'active' : ''; ?>'><?php echo (isset($certificates_data[0]) && $certificates_data[0] !='') ? $certificates_data[0]['cert_name'] : '+ Certificate'; ?></a></li>
										<li><a id="add_cert_2" href='javascript:void(0)' class=' add_cert <?php echo (isset($certificates_data[1]) && $certificates_data[1] !='') ? 'active' : ''; ?>'><?php echo (isset($certificates_data[1]) && $certificates_data[1] !='') ? $certificates_data[1]['cert_name'] : '+ Certificate'; ?></a></li>
										<li><a id="add_cert_3" href='javascript:void(0)' class=' add_cert <?php echo (isset($certificates_data[2]) && $certificates_data[2] !='') ? 'active' : ''; ?>'><?php echo (isset($certificates_data[2]) && $certificates_data[2] !='') ? $certificates_data[2]['cert_name'] : '+ Certificate'; ?></a></li>
										<li><a id="add_cert_4" href='javascript:void(0)' class=' add_cert <?php echo (isset($certificates_data[3]) && $certificates_data[3] !='') ? 'active' : ''; ?>'><?php echo (isset($certificates_data[3]) && $certificates_data[3] !='') ? $certificates_data[3]['cert_name'] : '+ Certificate'; ?></a></li>
									</ul>
								</div>
							</div>
							<div class='form-row'>
								<label class='col-sm-4'>Services<br />
									<small>Add all certificates you will provide your donors after donating.</small>
								</label>
								<div class='col-sm-8'>
									<ul class='simp-btn'> 
										<li><a id="add_serv_1" href='javascript:void(0)' class='add_serv <?php echo (isset($services_data[0]) && $services_data[0] !='') ? 'active' : ''; ?>'><?php echo (isset($services_data[0]) && $services_data[0] !='') ? $services_data[0]['service_name'] : '+ Services'; ?></a></li>
										<li><a id="add_serv_2" href='javascript:void(0)' class='add_serv <?php echo (isset($services_data[1]) && $services_data[1] !='') ? 'active' : ''; ?>'><?php echo (isset($services_data[1]) && $services_data[1] !='') ? $services_data[1]['service_name'] : '+ Services'; ?></a></li>
										<li><a id="add_serv_3" href='javascript:void(0)' class='add_serv <?php echo (isset($services_data[2]) && $services_data[2] !='') ? 'active' : ''; ?>'><?php echo (isset($services_data[2]) && $services_data[2] !='') ? $services_data[2]['service_name'] : '+ Services'; ?></a></li>
										<li><a id="add_serv_4" href='javascript:void(0)' class='add_serv <?php echo (isset($services_data[3]) && $services_data[3] !='') ? 'active' : ''; ?>'><?php echo (isset($services_data[3]) && $services_data[3] !='') ? $services_data[3]['service_name'] : '+ Services'; ?></a></li>
									</ul>
								</div>
							</div>
							<div class='form-row'>
								<label class='col-sm-4'>Another Activity</label>
								<div class='col-sm-8'>
									<input value='<?php echo $cause_data->another_activity; ?>' id='another_activity' name='another_activity' type='text' placeholder='Name of this certificate' class='form-control' />
								</div>
							</div>
							
							<div class='button-group text-right'>
							<a href="<?php echo base_url(); ?>/admin/dashboard" class="btn creat-btn">Back to panel</a>
								<button id="info_next" type='button' class='btn create-btn'>Next</button>
							</div>
						</div>
						<div class='col-md-6'>
						<?php $i = 0;
							for ($x = 1; $x <= 4; $x++) { ?>
							<div id="certificate_form_<?php echo $x; ?>" class='certificate_form craetion-form' style="display:none;">
								<div class='form-row'>
									<label class='col-sm-4'>Certificate</label>
									<div class='col-sm-8'>
										<select name='certificates[]' id='certificates' class='select_certificate form-control'>
											<option value="">Select your certificate from this list</option>
											<option value="1" <?php echo (isset($certificates_data[$i]['cert_name']) && $certificates_data[$i]['cert_name'] =='Certificate 1') ?  'selected' : ''; ?> >Certificate 1</option>
											<option value="2" <?php echo (isset($certificates_data[$i]['cert_name']) && $certificates_data[$i]['cert_name'] =='Certificate 2') ?  'selected' : ''; ?>>Certificate 2</option>
											<option value="3" <?php echo (isset($certificates_data[$i]['cert_name']) && $certificates_data[$i]['cert_name'] =='Certificate 3') ?  'selected' : ''; ?>>Certificate 3</option>
											<option value="4" <?php echo (isset($certificates_data[$i]['cert_name']) && $certificates_data[$i]['cert_name'] =='Certificate 4') ?  'selected' : ''; ?>>Certificate 4</option>
										</select>
									</div>
								</div>
								<div class='form-row'>
									<label class='col-sm-4'>Other</label>
									<div class='col-sm-8'>
										<input name='other_certificae[]' id='other_certificae' type='text' placeholder='Name of this certificate' class='form-control' value='<?php echo (isset($certificates_data[$i]['cert_other']) && $certificates_data[$i]['cert_other'] !='') ?  $certificates_data[$i]['cert_other'] : ''; ?>'/>
									</div>
								</div>
								
								<div class='row'>
									<div class='col-md-6'>
										<div class='form-row'>
											<label class='lb-space'>Corporate Benefits</label>
											<textarea name='corporate_benefits[]' id='corporate_benefits' class='form-control'> <?php echo (isset($certificates_data[$i]['cert_corporate_benefits']) && $certificates_data[$i]['cert_corporate_benefits'] !='') ?  $certificates_data[$i]['cert_corporate_benefits'] : ''; ?></textarea>
										</div>
									</div>
									<div class='col-md-6'>
										<div class='form-row'>
											<label class='lb-space'>Restrictions</label>
											<textarea name='corporate_restrictions[]' id='corporate_restrictions' class='form-control'><?php echo (isset($certificates_data[$i]['cert_restrictions']) && $certificates_data[$i]['cert_restrictions'] !='') ?  $certificates_data[$i]['cert_restrictions'] : ''; ?></textarea>
										</div>
									</div>
								</div>
								<div class='form-row'>
									<label class='col-sm-4'>Upload a picture of this certificate</label>
									<div class='col-sm-8'>
										<div class="fileselector">
											<?php
											if(isset($certificates_data[$i]['cert_image']) && $certificates_data[$i]['cert_image'] !=''){
												$imgUrl = base_url(). 'assets/uploads/cause-picture/'.$certificates_data[$i]['cert_image'];
												$hide_img = '';
											}else{
												$imgUrl = '';
												$hide_img = 'hide_img';
											} ?>
											<span id="uploaded_image_cert_images_<?php echo $x; ?>" class="<?php echo $hide_img; ?>">
												<img src="<?php echo $imgUrl; ?>" height="100" width="178" id="img-thumbnail-cert-images-<?php echo $x; ?>" />
											</span>
											<label class="btn btn-default" for="upload-file-selector_<?php echo $x; ?>">
												<input class="upload_certificates_images" id="upload-file-selector_<?php echo $x; ?>" type="file">
												Upload Picture
											</label>
										</div>
										<input value="<?php echo (isset($certificates_data[$i]['cert_image']) && $certificates_data[$i]['cert_image'] !='') ?  $certificates_data[$i]['cert_image'] : ''; ?>" class="certificates_img_input" name="certificates_img[]" id="upload-file-selector-hidden_<?php echo $x; ?>" type="hidden">
									</div>
								</div>
								<div class="button-group text-right">
									<input type="hidden" id="dbCertId_<?php echo $x; ?>" name="cert_ids" class="" value="<?php echo (isset($certificates_data[$i]['cert_id']) && $certificates_data[$i]['cert_id'] !='') ?  $certificates_data[$i]['cert_id'] : ''; ?>">
									<button type="button" id="save_cert_<?php echo $x; ?>" class="btn create-btn cert_save">Done</button>
								</div>
							</div>
							<!---Services---->
							<div id="services_form_<?php echo $x; ?>" class='services_form craetion-form' style="display:none;">
								<div class='form-row'>
									<label class='col-sm-4'>Service </label>
									<div class='col-sm-8'>
										<input name='services[]' type='text' placeholder='Name of this certificate' value='<?php echo (isset($services_data[$i]['service_name']) && $services_data[$i]['service_name'] !='') ?  $services_data[$i]['service_name'] : ''; ?>' id='service_name' class='form-control service_name' />
									</div>
								</div>
								<div class='form-row'>
									<label class='col-sm-4'>Upload a picture of a bill with this service</label>
									<div class='col-sm-8'>
										<div class="fileselector">
											<?php
											if(isset($services_data[$i]['service_image']) && $services_data[$i]['service_image'] !=''){
												$imgUrl = base_url(). 'assets/uploads/cause-picture/'.$services_data[$i]['service_image'];
												$hide_img = '';
											}else{
												$imgUrl = '';
												$hide_img = 'hide_img';
											} ?>
											<span id="uploaded_image_serv_images_<?php echo $x; ?>"  class="<?php echo $hide_img; ?>">
											<img src="<?php echo $imgUrl; ?>" height="100" width="178" id="img-thumbnail-serv-images-<?php echo $x; ?>" />
											</span>
											<label class="btn btn-default" for="upload-file-serv_<?php echo $x; ?>">
												<input class="upload_service_images" id="upload-file-serv_<?php echo $x; ?>" type="file"> 
												Upload Picture
											</label>
										</div>
										<input value="<?php echo (isset($services_data[$i]['service_image']) && $services_data[$i]['service_image'] !='') ?  $services_data[$i]['service_image'] : ''; ?>"  class="services_img_input"  name="service_img[]" id="upload-file-selector-<?php echo $x; ?>" type="hidden">
									</div>
								</div>
								<div class="button-group text-right">
									<input type="hidden" id="dbServId_<?php echo $x; ?>" name="serv_ids" class="" value="<?php echo (isset($services_data[$i]['serv_id']) && $services_data[$i]['serv_id'] !='') ?  $services_data[$i]['serv_id'] : ''; ?>">
									<button type="button" id="save_cert_<?php echo $x; ?>" class="btn create-btn serv_save">Done</button>
								</div>
							</div>
						<?php $i++; } ?>
						</div>
					</div>
				</div>
				<div id="info_2" class='row justify-content-center' style="display:none;">
					<div class='container-fluid'>
						<div class='row justify-content-center'>
							<div class='col-md-8'>
								<form method='post' class='craetion-form'>
									<div class='form-row'>
										<label class='col-sm-3'>Name of the Cause</label>
										<div class='col-sm-9'><input id ='cause_name'  type='text' class='form-control' value="<?php echo $cause_data->name; ?>" name='cause_name'/></div>
									</div>
									<div class='form-row'>
										<label class='col-sm-3'>Cause Description<br /><small>(100 words max)</small></label>
										<div class='col-sm-9'><textarea id ='cause_desc' name ='cause_desc' class='form-control'><?php echo $cause_data->description; ?></textarea></div>
									</div>
									<div class='form-row'>
										<label class='col-sm-3'>Impact<br /><small>(Who and how much people will benefit from your project)</small></label>
										<div class='col-sm-3'>
											<label style="font-size: 14px;">Unit</label>
											<input id ='sen_unit' name ='sen_unit' type='text' class='form-control' value="<?php echo $cause_data->unit; ?>"/>
										</div>
										<div class='col-sm-2'>
											<label style="font-size: 14px;">Pesimistic Scenario</label>
											<input id ='pesimistic_scen' name ='pesimistic_scen' type='text' class='form-control' value="<?php echo $cause_data->pesimistic_scenario; ?>"/>
										</div>
										<div class='col-sm-2'>
											<label style="font-size: 14px;">Expected Scenario</label>
											<input id ='expected_scen' name ='expected_scen' type='text' class='form-control' value="<?php echo $cause_data->expected_scenario; ?>"/>
										</div>
										<div class='col-sm-2'>
											<label style="font-size: 14px;">Best Scenario</label>
											<input id ='best_scen' name ='best_scen' type='text' class='form-control' value="<?php echo $cause_data->best_scenario; ?>"/>
										</div>
										
									</div>
									<div class='form-row'>
										<label class='col-sm-3'>Cause Picture<br /><small>(JPG, PNG, less then 30MB)</small></label>
										<div class='col-sm-9'>
											<div class="fileselector">
												<span id="uploaded_image"><img src="<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $cause_data->photo; ?>" height="100" width="178" id="img-thumbnail" /></span>
												<label class="btn btn-default" for="upload-file-selector">
													<input id="upload-file-selector" type="file">Upload Picture
												</label>
											</div>
										</div>
									</div>
									<div class='button-group text-center'>
										<input type="hidden" id="user_id" value="<?php echo $cause_data->user_id; ?>">
										<input type="hidden" name="causePic" id="causePic" value="<?php echo $cause_data->photo;?>" >
										<a href="<?php echo base_url(); ?>/admin/dashboard" class="btn creat-btn">Back to panel</a>
										<button id='infoprev' type='button' class='btn create-btn'>Prev</button>
										<button id='editinfonext' type='button' class='btn create-btn'>Next</button>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
				</form>
			</div><!--Info tab--->
			<div id="stage" class="tab-pane com30 fade">
				<div class='container-fluid'>
				<?php 
				$i = 1;
				foreach($stage_data as $stage) { ?>
					<div id="stage-<?php echo $i; ?>" class="stage-section" style="display:<?php echo $i == 1 ? 'block' : 'none'; ?>">
						
						<div class="row">
							<div class="col-sm-6">
								<form method="post" class="steps-form add-stage">
									<div class="form-row">
										<label class="col-sm-3">Stage Name</label>
										<div class="col-sm-9"><input type="text" id="stage-name" class="form-control" value="<?php echo $stage['stage_name']; ?>"/></div>
									</div>
									<div class="form-row">
										<label class="col-sm-3">Stage Number</label>
										<div class="col-sm-9"><input type="text" id="stage-number" class="form-control" value="<?php echo $stage['stage_number']; ?>"/></div>
									</div>
									<div class="form-row">
										<label class="col-sm-3">Description</label>
										<div class="col-sm-9"><textarea class="form-control"  id="stage-description"><?php echo $stage['stage_description']; ?></textarea></div>
									</div>
									
									
									<div class="form-row">
										<label class="col-sm-3">Activities<br /><small>(The more activities, the more transparent your cause will look)</small></label>
										<div class="col-sm-9 activity-buttons" id="">
										<?php 
										$j = 1;
										foreach($activity_data as $activity) { 
											if($activity['stage_id'] == $stage['stage_id'])
											{
										?>
											<button id="activitybutton-<?php echo $j; ?>" type="button" class="create-activity btn creat-btn"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $activity['act_name']; ?> </button>
											
										<?php $j++; }
										}
										?>
										</div>
										
									</div>
									<div class="form-row">
										<div class="col-sm-7 text-right">
												<a href="JavaScript:Void(0);" class="add-more"> Add More</a>
										</div>
									</div>
									
									<div class="form-row">
										<label class="col-sm-3">Choose an icon</label>
										<div class="col-sm-9">
											<ul id="stage-icon" class="icon-list">
												<li><a href="JavaScript:Void(0);" id="fa-calendar" class="<?php echo $stage['stage_icon'] == 'fa-calendar' ? 'iactive': ''; ?>"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o" class="<?php echo $stage['stage_icon'] == 'fa-lightbulb-o' ? 'iactive': ''; ?>"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-user" class="<?php echo $stage['stage_icon'] == 'fa-user' ? 'iactive': ''; ?>"><i class="fa fa-user" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-file-text" class="<?php echo $stage['stage_icon'] == 'fa-file-text' ? 'iactive': ''; ?>"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-users" class="<?php echo $stage['stage_icon'] == 'fa-users' ? 'iactive': ''; ?>"><i class="fa fa-users" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"class="<?php echo $stage['stage_icon'] == 'fa-sticky-note-o' ? 'iactive': ''; ?>"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>
											</ul>
											<input type="hidden" class="stage-icon-name" value="<?php echo $stage['stage_icon']; ?>">
										</div>
									</div>
									<div id="activities-ids">
									
								 <?php 	$j = 1;
										foreach($activity_data as $activity) { 
											if($activity['stage_id'] == $stage['stage_id'])
											{
										?>
											<input type="hidden" value="<?php echo $activity['act_id']; ?>" name="act_ids[]">
											
										<?php $j++; 
											}
										}
										?>
									</div>
									<div class="button-group text-center">
									
									  
										<input type="hidden" class="db-stg-id" value="<?php echo $stage['stage_id']; ?>">
										<?php if($i > 1) {?>
										<button type="button" id="prev-stage-<?php echo $i-1; ?>" class="prev btn create-btn">Previous Stage</button>
										<?php 
										}else{ ?>
										<button type="button" class="btn create-btn">Previous Stage</button>
										<?php	
										}?>
										<button id="next-stage-<?php echo $i+1; ?>" type="button" class="next btn create-btn">Next</button>
										<button id="finish-stages" type="button" class="btn create-btn">Finish</button>
									</div>
									
								</form>
							</div>
							
							<div class="col-sm-6" id="activity-form-section">
								<!--==========Activity  box start here!==================-->
								<?php 
								$j = 1;
								foreach($activity_data as $activity) { 
								if($activity['stage_id'] == $stage['stage_id'])
								{
								?>
								<div id="activity-form-<?php echo $j; ?>" class="activity-box">
								  <div class="modal-dialog modal-md">
									<div class="modal-content">

									  <!-- Modal Header -->
									  <div class="modal-header">
									  <h4 class="modal-title">Add Activity <span class="form-numb"><?php echo $j; ?></span></h4>
									  </div>

									  <!-- Modal body -->
									  <div class="modal-body">
										
										<form method="post" class="add-activity">
											<div class="form-row">
												<label class="col-sm-4">Activity Name</label>
												<div class="col-sm-8">
													<input type="text" id="act-name" class="form-control"value="<?php echo $activity['act_name']; ?>" />
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4">Activity number</label>
												<div class="col-sm-8">
													<input type="text" id="act-number" class="form-control" value="<?php echo $activity['act_number']; ?>"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4">Description</label>
												<div class="col-sm-8">
													<textarea id="act-description" class="form-control"><?php echo $activity['act_description']; ?></textarea>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4">Pesimistic Scenario</label>
												<div class="col-sm-8">
													<input type="text" id="act-pesimistic" class="form-control" placeholder="$" value="<?php echo $activity['act_pesimistic_scenario']; ?>"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4">Expected Scenario</label>
												<div class="col-sm-8">
													<input type="text" id="act-expected" class="form-control" placeholder="$" value="<?php echo $activity['act_expected_scenario']; ?>"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4">Best Scenario</label>
												<div class="col-sm-8">
													<input type="text" id="act-best" class="form-control" placeholder="$" value="<?php echo $activity['act_best_scenario']; ?>"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4">Choose an icon</label>
												<div class="col-sm-8">
													<ul class="icon-list">
														<li><a href="JavaScript:Void(0);" id="fa-calendar" class="<?php echo $activity['act_icon'] == 'fa-calendar' ? 'iactive': ''; ?>"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o" class="<?php echo $activity['act_icon'] == 'fa-lightbulb-o' ? 'iactive': ''; ?>"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-user" class="<?php echo $activity['act_icon'] == 'fa-user' ? 'iactive': ''; ?>"><i class="fa fa-user" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-file-text" class="<?php echo $activity['act_icon'] == 'fa-file-text' ? 'iactive': ''; ?>"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-users" class="<?php echo $activity['act_icon'] == 'fa-users' ? 'iactive': ''; ?>"><i class="fa fa-users" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o" class="<?php echo $activity['act_icon'] == 'fa-sticky-note-o' ? 'iactive': ''; ?>"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>
													</ul>
												</div>
												<input type="hidden" class="icon-name" value="<?php echo $activity['act_icon']; ?>">
											</div>
											<div class="button-group text-right">
											<input type="hidden" class="db-act-id" value="<?php echo $activity['act_id']; ?>">
												<button type="button" class="btn create-btn">Done</button>
											</div>
										</form>
										
									  </div>
									</div>
								  </div>
								</div>
								<?php 
								$j++; 
								}
								} ?>
							</div>
						</div>
					</div>
				<?php $i++; } //end stage_data loop ?>
				</div>
			  </div>
			  <div id="project" class="tab-pane fade project">
					
			  </div>
		</div>
	</div>
</section>
