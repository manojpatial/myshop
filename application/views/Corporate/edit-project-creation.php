<?php
		$loginData = $this->session->userdata('logged_in');
		if($loginData !='')
		{ 
			$loginUserId = $loginData['id'];
		}
	
	?>
	<?php	
         $selectid = $this->session->userdata('select_causesid');
           //echo '<pre>'; Print_r($project_data); echo '</pre>';?> 
	 
	<div class='c-creation bottom50'>
	<input type="hidden" value="<?php echo $project_data['0']['id']; ?>" id="projectid">
		<div class='creation-tab'>
		
		  <ul class="nav nav-tabs">
			  <li id="tab_information" class="active"><a data-toggle="tab" href="#information" class="active show"><?php echo $this->lang->line('information_tab'); ?></a></li>
			  <li id="tab_voting"><a data-toggle="tab" href="#voting"><?php echo $this->lang->line('voting_tab'); ?></a></li>
			  <li id="tab_visualization"><a data-toggle="tab" href="#visualization"><?php echo $this->lang->line('visualization_tab'); ?></a></li>
			</ul>
		
		</div>
		<div class="tab-content">
			  <div id="information" class="tab-pane com30 fade in active">
				<div class='container-fluid'>
					<div class='row justify-content-center'>
						<div class='col-lg-8 col-md-12'>
							<form method='post' class='craetion-form'>
								
								<div class='form-row'>
									<label class='col-sm-3'><?php echo $this->lang->line('project_name_label'); ?></label>
									<div class='col-sm-9'><input type='text' id="project_name"  class='form-control' value="<?php echo $project_data['0']['name']; ?>" /></div>
								</div>
								<div class='form-row'>
									<label class='col-sm-3'><?php echo $this->lang->line('project_description_label'); ?></label>
									<div class='col-sm-9'><textarea  id="project_description" class='form-control'><?php echo $project_data['0']['description']; ?></textarea></div>
								</div>
					<div class='form-row'>
					<label class='col-sm-3'><?php echo $this->lang->line('causes_selected_label'); ?></label>
					<div class='col-sm-9'>
					<div class='cadd-more'>
					<?php ///echo $project_data['0']['selected_causes']; ?>
				  <ul id="selected_causes">	
				  
 		          <?php foreach($project_images as $causes){ ?>
				  <li>
				  <div class='over-text'>
				  <div class='dis-text'>
				
				   
				  <p><?php echo $causes['name']; ?></p>
				  <P><?php echo $causes ['description'];?></p>
															
								</div>
								</div>
				<img src='<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $causes['photo']; ?>' />
				 <input name="causes_ids[]" type="hidden" id="causes_ids" value="<?php echo $causes['id'];?>">
								</li>
								
							<?php } ?>
			      	
		    </ul>
			 <a href="#" class='ad-more' class="ad-more" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle" aria-hidden="true" ></i> <?php echo $this->lang->line('add_more_button'); ?></a>
										</div>
									</div>
								</div>
								
								
		 
								
								<div class='row'>
									<div class='col-sm-6'>
										<div class='form-row'>
											<label class='col-sm-6'><?php echo $this->lang->line('donation_label'); ?></label>
											<div class='col-sm-6'>
												<input type="text"  id="donation_amount" class="form-control" placeholder='$'value="<?php echo $project_data['0']['donation_amount']; ?>"  >
											</div>
										</div>
									</div>
									<div class='col-sm-6'>
										<div class='form-row'>
											<label class='col-sm-6'><?php echo $this->lang->line('Show_amount_label'); ?></label>
											<div class='col-sm-6'>
												<input type="checkbox" id="show_amount" name="show_amount" class="form-check-input" value="1"<?php if ($project_data['0']['show_amount'] == 1) { echo "checked='checked'"; } ?>>
												
												
											</div>
										</div>
									</div>
								
									
									
								</div>
								<div class='form-row'>
									<label class='col-sm-3'><?php echo $this->lang->line('voting_starts_label'); ?></label>
									
									<div class='col-sm-4'>
												<?php 
                                       $voting_start= $project_data['0']['voting_start'];
                                         //echo substr($voting_start,0,10); 
                                        //echo substr($voting_start,11,20);
                                       ?>
												 <div class='input-group date' id='datepicker1'>
                                                 <input type='text' class="form-control  dt" id="voting_startdate" value="<?php  echo substr($voting_start,0,10); ?>" />
                                                 <span class="input-group-addon">
                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                 </span>
                                                </div>
											</div>
											<div class='col-sm-4'>
											 <div class='input-group date' id='timepicker1'>
                                             <input type='text' class="form-control" id="voting_starttime" value="<?php  echo substr($voting_start,11,20); ?>"/>
                                             <span class="input-group-addon">
                                             <span class="glyphicon glyphicon-time"></span>
                                             </span>
                                              </div>
												<!--<input type="text" class="form-control dt" placeholder='HH:HH' >-->
											</div>
								</div>
								 
								<div class='form-row'>
									<label class='col-sm-3'><?php echo $this->lang->line('voting_ends_label'); ?></label>
									
										<div class='col-sm-4'>
											<?php 
                                       $voting_end= $project_data['0']['voting_end'];
                                         //echo substr($voting_end,0,10); 
                                        //echo substr($voting_end,11,20);
                                       ?>
											   <div class='input-group date' id='datepicker2'>
                                                 <input type='text' class="form-control  dt"  id="voting_enddate"value="<?php echo substr($voting_end,0,10);?>"/>
                                                 <span class="input-group-addon">
                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                 </span>
                                                </div>
												<!--<input type="text"  id="voting_end" class="form-control dt" placeholder='DD/MM/YY' >-->
											</div>
											<div class='col-sm-4'>
											<div class='input-group date' id='timepicker2'>
                                             <input type='text' class="form-control" id="voting_endtime" value="<?php echo substr($voting_end,11,20);?>" />
                                             <span class="input-group-addon">
                                             <span class="glyphicon glyphicon-time"></span>
                                             </span>
                                              </div>
											</div>
								     </div>
							  
								
								
								
						  <div class='form-row'>
						  
						   <label class='col-sm-3'><?php echo $this->lang->line('donation_frecuency_label'); ?></label>
                          
						   <input type="radio" name="donation_frequency" id="only_one" value="Once"<?php if ($project_data['0']['donation_frequency']=='Once'){ echo "checked";} else {"";}?>>&nbsp;&nbsp;<?php echo $this->lang->line('once_radio_name'); ?>
						     &nbsp;&nbsp; 
						  
						  	<input type="radio" name="donation_frequency" id="every_month" value="month"<?php if ($project_data['0']['donation_frequency']=='month'){ echo "checked";} else {"";}?>>&nbsp;&nbsp; <?php echo $this->lang->line('month_radio_name'); ?>
							 
							 &nbsp;&nbsp; 
						   <input type="radio" name="donation_frequency" id="until" value="Until"<?php if ($project_data['0']['donation_frequency']!='Once' && $project_data['0']['donation_frequency']!='month'){ echo "checked";} else {"";}?>>&nbsp;&nbsp; <?php echo $this->lang->line('until_radio_name'); ?>
						   </div>
						   
									
							<div class='form-row'>
							<div class='col-sm-3'></div>
									<div class='col-sm-4'>
									<?php 
                                       $donation_frequency= $project_data['0']['donation_frequency'];
                                         //echo substr($donation_frequency,0,10); 
                                        //echo substr($donation_frequency,11,20);
                                       ?>
										<div class='input-group date' id='datepicker3'>
                                                 <input type='text' class="form-control  dt" id="donation_date" value="<?php echo substr($donation_frequency,0,10);?>" disabled/>
                                                 <span class="input-group-addon">
                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                 </span>
                                                </div>
									</div>
									<div class='col-sm-4'>
										<div class='input-group date' id='timepicker3'>
                                             <input type='text' class="form-control" id="donation_time" value="<?php echo substr($donation_frequency,11,20);?>" disabled/>
                                             <span class="input-group-addon">
                                             <span class="glyphicon glyphicon-time"></span>
                                             </span>
                                              </div>
									</div>
								</div>
								
								<div class='button-group text-center'>
									<input type="hidden" id="user_id" value="<?php echo $loginUserId; ?>">
									<button type='button' id="submit" class='btn create-btn'><?php echo $this->lang->line('next_button');?></button>
								</div>
								
							</form>	
						</div>
					</div>
				</div>
			  </div>
			  <div id="voting" class="tab-pane com50 fade">
				<div class='container-fluid'>
					<h1 class='body-title text-cyan text-center'><?php echo $this->lang->line('voting_tab_title');?></h1>
					<div class='row justify-content-center'>
						<div class='col-lg-8 col-md-12'>
						 
							<ul class='voting-box'>
							
								<li id="type_1" <?php if ($project_data['0']['donation_type']=='1'){ echo 'class="selected-vote"';} else {"";}?>>
									<h3><?php echo $this->lang->line('voting_type_one');?></h3>
									<div class='vote-ico'><img src='<?php echo base_url();?>assets/images/mayority.png' /></div>
									<p><?php echo $this->lang->line('voting_type_one_des');?></p>
								</li>
								<li id="type_2" <?php if ($project_data['0']['donation_type']=='2'){ echo 'class="selected-vote"';} else {"";}?>>
									<h3><?php echo $this->lang->line('voting_type_two');?></h3>
									<div class='vote-ico'><img src='<?php echo base_url();?>assets/images/best.png' /></div>
									<p><?php echo $this->lang->line('voting_type_two_des');?></p>
								</li>
								<li id="type_3" <?php if ($project_data['0']['donation_type']=='3'){ echo 'class="selected-vote"';} else {"";}?>>
									<h3><?php echo $this->lang->line('voting_type_three');?></h3>
									<div class='vote-ico'><img src='<?php echo base_url();?>assets/images/all.png' /></div>
									<p><?php echo $this->lang->line('voting_type_three_des');?> </p>
								</li>
							</ul>
							<div class="button-group text-center">
							<input type='hidden' class="form-control" id="donation_type" value="<?php echo$project_data['0']['donation_type'];?>">
								<button type="button"  id="votingtpye_submit" class="btn create-btn"><?php echo $this->lang->line('next_button');?></button>
							</div>
						</div>
					</div>
				</div>
			  </div>
			  <div id="visualization" class="tab-pane fade">
				
				
				
			  </div>
		</div>
		
		
	</div>
  
  <!-- Modal popup -->
  <div class="row">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-full">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header right">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
		<div class='corp-photo'>
           <ul>
		   <?php 
 		   foreach($popup_data as $causes){ ?>
			<li>
			<div class='over-text'>
						<div class='on-h-text'>
							<a href='#'><i class="fa fa-search" aria-hidden="true"></i> <?php echo $this->lang->line('details');?></a>
							 
							  <?php if(!empty($selectid) && in_array($causes['id'],$selectid)) { ?>
							
							<a href='JavaScript:Void(0);' id="remove_cause_<?php echo $causes['id']?>"class="removecauses"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $this->lang->line('remove_cause');?></a>
							
							<?php }else { ?>
							<a href='JavaScript:Void(0);' id="select_cause_<?php echo $causes['id']?>"class="selectcauses"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $this->lang->line('add_cause');?></a>
							<?php }?>
						</div>
						<div class='dis-text'>
							<p><?php echo $causes['name']?></p>
                             <p>50.000 USD-20 Schools</p>
						</div> 
					</div>
				<div class='cphoto-box'>
					<img src='<?php echo base_url();?>assets/uploads/cause-picture/<?php echo  $causes['photo'];?>' />
				</div>
			</li>
		   <?php }?>
	
		</ul>
		<div class="row text-center">
		<div class="col-sm-12"><a href='JavaScript:Void(0);' id="popup_id" class="btn create-btn"><?php echo $this->lang->line('finish_stage_button'); ?></a></div>
		</div>
		
		
	   </div>
		 
		 
	
		 
        </div>
      </div>
      
    </div>
  </div>
  </div>
 






