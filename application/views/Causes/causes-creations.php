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
		 
	?> 
	<div class='c-creation bottom50'>
		<div class='creation-tab'>
			<ul class="nav nav-tabs">
				<li id="tab_info" class="active"><a data-toggle="tab" href="#info" class="active show"><?php echo $this->lang->line('information'); ?></a></li>
				<li id="tab_step"><a data-toggle="tab" href="#step"><?php echo $this->lang->line('steps');?></a></li>
				<li id="tab_stage" style="display:none;"><a data-toggle="tab" href="#stage"><?php echo $this->lang->line('stages'); ?></a></li>
				<li id="tab_project"><a data-toggle="tab" href="#project"><?php echo $this->lang->line('project'); ?></a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div id="info" class="tab-pane com30 fade in active">
			<form id="cause_form" method="POST" enctype="multipart/form-data">
				<input type="hidden" value="" id="causeid" name="causeid">
				<div id="info_1"  class='container-fluid'>
					<div class='row'>
					<div class='col-md-1'></div>
						<div class='col-md-5'>
							<div class='form-row'>
								<label class='col-sm-4'><?php echo $this->lang->line('certificates_label'); ?>
								</label>
								<div class='col-sm-8'>
									<ul class='simp-btn'>
										<li><a id="add_cert_1" href='javascript:void(0)' class=' add_cert active'>+ <?php echo $this->lang->line('certificate'); ?></a></li>
										<li><a id="add_cert_2" href='javascript:void(0)' class=' add_cert'>+ <?php echo $this->lang->line('certificate'); ?></a></li>
										<li><a id="add_cert_3" href='javascript:void(0)' class=' add_cert'>+ <?php echo $this->lang->line('certificate'); ?></a></li>
										<li><a id="add_cert_4" href='javascript:void(0)' class=' add_cert'>+ <?php echo $this->lang->line('certificate'); ?></a></li>
									</ul>
								</div>
							</div>
							<div class='form-row'>
								<label class='col-sm-4'><?php echo $this->lang->line('services_label'); ?>
								</label>
								<div class='col-sm-8'>
									<ul class='simp-btn'> 
										<li><a id="add_serv_1" href='javascript:void(0)' class='add_serv active'>+ <?php echo $this->lang->line('services'); ?></a></li>
										<li><a id="add_serv_2" href='javascript:void(0)' class='add_serv'>+ <?php echo $this->lang->line('services'); ?></a></li>
										<li><a id="add_serv_3" href='javascript:void(0)' class='add_serv'>+ <?php echo $this->lang->line('services'); ?></a></li>
										<li><a id="add_serv_4" href='javascript:void(0)' class='add_serv'>+ <?php echo $this->lang->line('services'); ?></a></li>
									</ul>
								</div>
							</div>
							<div class='form-row'>
								<label class='col-sm-4'><?php echo $this->lang->line('another_activity'); ?></label>
								<div class='col-sm-8'>
									<input id='another_activity' name='another_activity' type='text' placeholder='' class='form-control' />
								</div>
							</div>
							
							<div class='button-group text-right'>
								<button id="info_next" type='button' class='btn create-btn'><?php echo $this->lang->line('next_button'); ?></button>
							</div>
						</div>
						<div class='col-md-6'>
						<?php 
							for ($x = 1; $x <= 4; $x++) { ?>
							<div id="certificate_form_<?php echo $x; ?>" class='certificate_form craetion-form' style="display:none;">
							<h3 class='col-sm-12 text-center bottom20'><?php echo $this->lang->line('certificate'); ?> <?php echo $x; ?></h3>
								<div class='form-row'>
									<label class='col-sm-4'><?php echo $this->lang->line('certificate'); ?></label>
									<div class='col-sm-8'>
										<select name='certificates[]' id='certificates' class='select_certificate form-control'>
											<!--<option value="">Select your certificate from this list</option>-->
											<option value="1">Certificate 1</option>
											<option value="2">Certificate 2</option>
											<option value="3">Certificate 3</option>
											<option value="4">Certificate 4</option>
											<option value="other">Other</option>
										</select>
									</div>
								</div>
								<div class='form-row'>
									<label class='col-sm-4'><?php echo $this->lang->line('other'); ?> </label>
									<div class='col-sm-8'>
										<input name='other_certificae[]' id='other_certificae' type='text' placeholder='Name of this certificate' class='form-control' disabled/>
									</div>
								</div>
								
								<div class='row'>
									<div class='col-md-6'>
										<div class='form-row'>
											<label class='lb-space'><?php echo $this->lang->line('corporate_benefits'); ?></label>
											<textarea name='corporate_benefits[]' id='corporate_benefits' class='form-control'></textarea>
										</div>
									</div>
									<div class='col-md-6'>
										<div class='form-row'>
											<label class='lb-space'><?php echo $this->lang->line('restrictions'); ?></label>
											<textarea name='corporate_restrictions[]' id='corporate_restrictions' class='form-control'></textarea>
										</div>
									</div>
								</div>
								<div class='form-row'>
									<label class='col-sm-4'><?php echo $this->lang->line('certificate_picture_upload'); ?></label>
									<div class='col-sm-8'>
										<div class="fileselector">
											<span id="uploaded_image_cert_images_<?php echo $x; ?>" style="display:none;">
											<img src="" height="100" width="178" id="img-thumbnail-cert-images-<?php echo $x; ?>" />
											</span>
											<label class="btn btn-default" for="upload-file-selector_<?php echo $x; ?>">
												<input class="upload_certificates_images" id="upload-file-selector_<?php echo $x; ?>" type="file"> 
												<?php echo $this->lang->line('upload_picture'); ?>
											</label>
										</div>
										<input value="" class="certificates_img_input" name="certificates_img[]" id="upload-file-selector-hidden_<?php echo $x; ?>" type="hidden">
									</div>
								</div>
								<div class="button-group text-right">
									<input type="hidden" id="dbCertId_<?php echo $x; ?>" name="cert_ids" class="" value="">
									<button type="button" id="back_cert_<?php echo $x; ?>" class="btn create-btn cert_back"><?php echo $this->lang->line('back_button'); ?></button>
									<button type="button" id="save_cert_<?php echo $x; ?>" class="btn create-btn cert_save"><?php echo $this->lang->line('Save_button'); ?></button>
								</div>
							</div>
							<!---Services---->
							<div id="services_form_<?php echo $x; ?>" class='services_form craetion-form' style="display:none;">
							<h3 class='col-sm-12 text-center bottom20'><?php echo $this->lang->line('service'); ?> <?php echo $x; ?></h3>
								<div class='form-row'>
									<label class='col-sm-4'><?php echo $this->lang->line('service'); ?></label>
									<div class='col-sm-8'>
										<input name='services[]' type='text' placeholder='Name of this certificate' id='service_name' class='form-control service_name' />
									</div>
								</div>
								<div class='form-row'> 
									<label class='col-sm-4'><?php echo $this->lang->line('service_picture_upload'); ?></label>
									<div class='col-sm-8'>
										<div class="fileselector">
											<span id="uploaded_image_serv_images_<?php echo $x; ?>" style="display:none;">
											<img src="" height="100" width="178" id="img-thumbnail-serv-images-<?php echo $x; ?>" />
											</span>
											<label class="btn btn-default" for="upload-file-serv_<?php echo $x; ?>">
												<input class="upload_service_images" id="upload-file-serv_<?php echo $x; ?>" type="file"> 
												
												<?php echo $this->lang->line('upload_picture'); ?>
											</label>
										</div>
										<input value=""  class="services_img_input"  name="service_img[]" id="upload-file-selector-<?php echo $x; ?>" type="hidden">
									</div>
								</div>
								<div class="button-group text-right">
									
									<input type="hidden" id="dbServId_<?php echo $x; ?>" name="serv_ids" class="" value="">
									<button type="button" id="back_cert_<?php echo $x; ?>" class="btn create-btn serv_back"><?php echo $this->lang->line('back_button'); ?></button>
									<button type="button" id="save_cert_<?php echo $x; ?>" class="btn create-btn serv_save"><?php echo $this->lang->line('Save_button'); ?></button>
								</div>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
				<div id="info_2"  class='row justify-content-center' style="display:none;">
					<div class='col-md-8'>
						<div class='craetion-form'>
							<div class='form-row'>
								<label class='col-sm-3'><?php echo $this->lang->line('name_label'); ?></label>
								<div class='col-sm-9'><input id ='cause_name' type='text' class='form-control' name='cause_name' /></div>
							</div>
							<div class='form-row'>
								<label class='col-sm-3'><?php echo $this->lang->line('description_label'); ?></label>
								<div class='col-sm-9'><textarea id ='cause_desc' name ='cause_desc' class='form-control'></textarea></div>
							</div>
							<div class='form-row'>
								<label class='col-sm-3'><?php echo $this->lang->line('impact_label'); ?></label>
								<div class='col-sm-3'>
									<label style="font-size: 14px;"><?php echo $this->lang->line('unit'); ?></label>
									<input id ='sen_unit' name ='sen_unit' type='text' class='form-control' />
								</div>
								<div class='col-sm-2'>
									<label style="font-size: 14px;"><?php echo $this->lang->line('pesimistic_scenario'); ?></label>
									<input id ='pesimistic_scen' name ='pesimistic_scen' type='number' class='form-control' />
								</div>
								<div class='col-sm-2'>
									<label style="font-size: 14px;"><?php echo $this->lang->line('expected_scenario'); ?></label>
									<input id ='expected_scen' name ='expected_scen' type='number' class='form-control' />
								</div>
								<div class='col-sm-2'>
									<label style="font-size: 14px;"><?php echo $this->lang->line('best_scenario'); ?></label>
									<input id ='best_scen' name ='best_scen' type='number' class='form-control' />
								</div>
								
							</div>
							
							<div class='form-row'>
								<label class='col-sm-3'><?php echo $this->lang->line('cause_picture'); ?></label>
								<div class='col-sm-9'>
									<div class="fileselector">
										<p id="instruction"><?php echo $this->lang->line('cause_picture_message'); ?></p>
										<span id="uploaded_image" style="display:none;"><img src="" height="100" width="178" id="img-thumbnail" /></span>
										<label class="btn btn-default" for="upload-file-selector">
											<input id="upload-file-selector" type="file">
											<?php echo $this->lang->line('upload_picture'); ?>
										</label>
									</div>
							</div>
							</div>
							<div class='button-group text-center'>
								<input type="hidden" id="user_id" name="user_id" value="<?php echo $loginUserId; ?>">
								<input type="hidden" name="causePic" id="causePic" value="" >
								<button id='infoprev' type='button' class='btn create-btn'><?php echo $this->lang->line('previous_button'); ?></button>
								<button id='infonext' type='button' class='btn create-btn'><?php echo $this->lang->line('next_button'); ?></button> 
							</div>
						</div>	
					</div>
				</div>
				</form>
			</div><!--Info tab--->
		
			  <div id="step" class="tab-pane com30 fade">
				<div class='com50'> 
					<div class='container-fluid'>
						<h1 class='body-title text-cyan text-center'><?php echo $this->lang->line('top_text_message'); ?></h1>
						<div class='row align-items-center justify-content-end'>
							<div class='col-sm-4'>
								<img src='<?php echo base_url();?>assets/images/stage.jpg' />
							</div>
							<div class='col-sm-4'>
								<p><?php echo $this->lang->line('image_right_text'); ?></p>
							</div>
						</div>
						
						<div class='button-group text-center top50'>
							<button type='button' id="letstart" class='btn creat-btn'><?php echo $this->lang->line('lets_start_button'); ?></button>
						</div>
					</div>
				</div>
			  </div>
			  <div id="stage" class="tab-pane com30 fade">
				<div class='container-fluid'>
					<div id="stage-1" class="stage-section">
						<div class="row">
							<div class="col-sm-6">
								<form method="post" class="steps-form add-stage">
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('stage_name'); ?></label>
										<div class="col-sm-9"><input type="text" id="stage-name" class="form-control" /></div>
									</div>
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('stage_number'); ?></label>
										<div class="col-sm-9"><input type="text" id="stage-number" class="form-control" /></div>
									</div>
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('description'); ?></label>
										<div class="col-sm-9"><textarea class="form-control"  id="stage-description"></textarea></div>
									</div>
									
									
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('activities'); ?></label>
										<div class="col-sm-9 activity-buttons" id="">
											<button id="activitybutton-1" type="button" class="create-activity btn creat-btn"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $this->lang->line('add_activity'); ?></button>
										</div>
										
									</div>
									<div class="form-row">
										<div class="col-sm-7 text-right">
											<a href="JavaScript:Void(0);" class="add-more"> <?php echo $this->lang->line('add_more_button'); ?></a>
										</div>
									</div>
									
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('choose_icon'); ?></label>
										<div class="col-sm-9">
											<ul id="stage-icon" class="icon-list">
												<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>
											</ul>
											<input type="hidden" class="stage-icon-name" value="">
										</div>
									</div>
									<div id="activities-ids"></div>
									<div class="button-group text-center">
										<input type="hidden" class="db-stg-id" value="">
										<button type="button" class="btn create-btn"><?php echo $this->lang->line('previous_stage'); ?></button>
										<button id="next-stage-2" type="button" class="next btn create-btn add-stage-btn"><?php echo $this->lang->line('save_stage'); ?></button>
									</div>
								</form>
							</div>
							<div class="col-sm-6" id="activity-form-section">
								<!--==========Activity  box start here!==================-->
								<div id="activity-form-1" class="activity-box">
								  <div class="modal-dialog modal-md">
									<div class="modal-content">
									  <!-- Modal Header -->
									  <div class="modal-header">
										<h4 class="modal-title"><?php echo $this->lang->line('add_activity'); ?> <span class="form-numb">1</span></h4>
									  </div>

									  <!-- Modal body -->
									  <div class="modal-body">
										
										<form method="post" class="add-activity">
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('activity_name'); ?> </label>
												<div class="col-sm-8">
													<input type="text" id="act-name" class="form-control"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('activity_number'); ?></label>
												<div class="col-sm-8">
													<input type="text" id="act-number" class="form-control"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('description'); ?></label>
												<div class="col-sm-8">
													<textarea id="act-description" class="form-control"></textarea>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('pesimistic_scenario'); ?></label>
												<div class="col-sm-8">
													<input type="text" id="act-pesimistic" class="form-control" placeholder="$"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('expected_scenario'); ?></label>
												<div class="col-sm-8">
													<input type="text" id="act-expected" class="form-control" placeholder="$"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('best_scenario'); ?></label>
												<div class="col-sm-8">
													<input type="text" id="act-best" class="form-control" placeholder="$"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('choose_icon'); ?></label>
												<div class="col-sm-8">
													<ul class="icon-list">
														<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>
													</ul>
												</div>
												<input type="hidden" class="icon-name" value="">
											</div>
											<div class="button-group text-right">
												<input type="hidden" class="db-act-id" value="">
												<button type="button" class="btn create-btn"><?php echo $this->lang->line('Save_button'); ?> </button>
											</div>
										</form>
									  </div>
									</div>
								  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!----- Activity form HTML use in JS for Add more button click ------>
				<div id="js-activity-data" style="display:none;">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title"><?php echo $this->lang->line('add_activity'); ?> <span class="form-numb"></span></h4>
							</div>
							<!-- Modal body -->
							<div class="modal-body">
								<form method="post" class="add-activity">
									<div class="form-row">
										<label class="col-sm-4"><?php echo $this->lang->line('activity_name'); ?> </label>
										<div class="col-sm-8">
											<input type="text" id="act-name" class="form-control"/>
										</div>
									</div>
									<div class="form-row">
										<label class="col-sm-4"><?php echo $this->lang->line('activity_number'); ?></label>
										<div class="col-sm-8">
											<input type="text" id="act-number" class="form-control"/>
										</div>
									</div>
									<div class="form-row">
										<label class="col-sm-4"><?php echo $this->lang->line('description'); ?></label>
										<div class="col-sm-8">
											<textarea id="act-description" class="form-control"></textarea>
										</div>
									</div>
									<div class="form-row">
										<label class="col-sm-4"><?php echo $this->lang->line('pesimistic_scenario'); ?></label>
										<div class="col-sm-8">
											<input type="text" id="act-pesimistic" class="form-control" placeholder="$"/>
										</div>
									</div>
									<div class="form-row">
										<label class="col-sm-4"><?php echo $this->lang->line('expected_scenario'); ?></label>
										<div class="col-sm-8">
											<input type="text" id="act-expected" class="form-control" placeholder="$"/>
										</div>
									</div>
									<div class="form-row">
										<label class="col-sm-4"><?php echo $this->lang->line('best_scenario'); ?></label>
										<div class="col-sm-8">
											<input type="text" id="act-best" class="form-control" placeholder="$"/>
										</div>
									</div>
									<div class="form-row">
										<label class="col-sm-4"><?php echo $this->lang->line('choose_icon'); ?></label>
										<div class="col-sm-8">
											<ul class="icon-list">
												<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>
											</ul>
										</div>
										<input type="hidden" class="icon-name" value="">
									</div>
									<div class="button-group text-right">
										<input type="hidden" class="db-act-id" value="">
										<button type="button" class="btn create-btn"><?php echo $this->lang->line('Save_button'); ?> </button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!----- Activity form HTML use in JS for Add more button click END------>
				<!----- Stage+activity form HTML use in JS for Add more button click START------>
				<div id="js-stage-form" style="display:none;">
					<div class="row">
							<div class="col-sm-6">
								<form method="post" class="steps-form add-stage">
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('stage_name'); ?></label>
										<div class="col-sm-9"><input type="text" id="stage-name" class="form-control" /></div>
									</div>
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('stage_number'); ?></label>
										<div class="col-sm-9"><input type="text" id="stage-number" class="form-control" /></div>
									</div>
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('description'); ?></label>
										<div class="col-sm-9"><textarea class="form-control"  id="stage-description"></textarea></div>
									</div>
									
									
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('activities'); ?></label>
										<div class="col-sm-9 activity-buttons" id="">
											<button id="activitybutton-1" type="button" class="create-activity btn creat-btn"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $this->lang->line('add_activity'); ?></button>
										</div>
										
									</div>
									<div class="form-row">
										<div class="col-sm-7 text-right">
											<a href="JavaScript:Void(0);" class="add-more"> <?php echo $this->lang->line('add_more_button'); ?></a>
										</div>
									</div>
									
									<div class="form-row">
										<label class="col-sm-3"><?php echo $this->lang->line('choose_icon'); ?></label>
										<div class="col-sm-9">
											<ul id="stage-icon" class="icon-list">
												<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>
												<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>
											</ul>
											<input type="hidden" class="stage-icon-name" value="">
										</div>
									</div>
									<div id="activities-ids"></div>
									<div class="button-group text-center">
										<input type="hidden" class="db-stg-id" value="">
										
										<button id=""  type="button" class="prev btn create-btn"><?php echo $this->lang->line('previous_stage'); ?></button>
										<button id="next-stage-2" type="button" class="next btn create-btn add-stage-btn"><?php echo $this->lang->line('save_stage'); ?></button>
										<button id="finish-stages" type="button" class="btn create-btn"><?php echo $this->lang->line('finish_stage_button'); ?></button>
									</div>
								</form>
							</div>
							
							<div class="col-sm-6" id="activity-form-section">
								<!--==========Activity  box start here!==================-->
								<div id="activity-form-1" class="activity-box">
								  <div class="modal-dialog modal-md">
									<div class="modal-content">
									  <!-- Modal Header -->
									  <div class="modal-header">
										<h4 class="modal-title"><?php echo $this->lang->line('add_activity'); ?> <span class="form-numb">1</span></h4>
									  </div>

									  <!-- Modal body -->
									  <div class="modal-body">
										
										<form method="post" class="add-activity">
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('activity_name'); ?> </label>
												<div class="col-sm-8">
													<input type="text" id="act-name" class="form-control"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('activity_number'); ?></label>
												<div class="col-sm-8">
													<input type="text" id="act-number" class="form-control"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('description'); ?></label>
												<div class="col-sm-8">
													<textarea id="act-description" class="form-control"></textarea>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('pesimistic_scenario'); ?></label>
												<div class="col-sm-8">
													<input type="text" id="act-pesimistic" class="form-control" placeholder="$"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('expected_scenario'); ?></label>
												<div class="col-sm-8">
													<input type="text" id="act-expected" class="form-control" placeholder="$"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('best_scenario'); ?></label>
												<div class="col-sm-8">
													<input type="text" id="act-best" class="form-control" placeholder="$"/>
												</div>
											</div>
											<div class="form-row">
												<label class="col-sm-4"><?php echo $this->lang->line('choose_icon'); ?></label>
												<div class="col-sm-8">
													<ul class="icon-list">
														<li><a href="JavaScript:Void(0);" id="fa-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-user"><i class="fa fa-user" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-file-text"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-users"><i class="fa fa-users" aria-hidden="true"></i></a></li>
														<li><a href="JavaScript:Void(0);" id="fa-sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a></li>
													</ul>
												</div>
												<input type="hidden" class="icon-name" value="">
											</div>
											<div class="button-group text-right">
												<input type="hidden" class="db-act-id" value="">
												<button type="button" class="btn create-btn"><?php echo $this->lang->line('Save_button'); ?> </button>
											</div>
										</form>
									  </div>
									</div>
								  </div>
								</div>
							</div>
						</div>
					</div>
					<!----- Stage+activity form HTML use in JS for Add more button click END------>
				
				
				
			  </div>
			  <div id="project" class="tab-pane fade project">
					
			  </div>
		</div>
	</div>
</section>
