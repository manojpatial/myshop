<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
			  <li id="tab_information" class="active"><a data-toggle="tab" href="#information" class="active show">Information</a></li>
			  <li id="tab_voting"><a data-toggle="tab" href="#voting">Voting</a></li>
			  <li id="tab_visualization"><a data-toggle="tab" href="#visualization">Visualization</a></li>
			</ul>
		
		</div>
		<div class="tab-content">
			  <div id="information" class="tab-pane com30 fade in active">
				<div class='container-fluid'>
					<div class='row justify-content-center'>
						<div class='col-lg-8 col-md-12'>
							<form method='post' class='craetion-form'>
								
								<div class='form-row'>
									<label class='col-sm-3'>Name of the Project</label>
									<div class='col-sm-9'><input type='text' id="project_name"  class='form-control' value="<?php echo $project_data['0']['name']; ?>" /></div>
								</div>
								<div class='form-row'>
									<label class='col-sm-3'>Project Description<br />
                                     <small>(100 words max)</small></label>
									<div class='col-sm-9'><textarea  id="project_description" class='form-control'><?php echo $project_data['0']['description']; ?></textarea></div>
								</div>
					<div class='form-row'>
					<label class='col-sm-3'>Causes Selected</label>
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
			 <a href="#" class='ad-more' class="ad-more" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Add More</a>
										</div>
									</div>
								</div>
								
								
		 
								
								<div class='form-row'>
									<div class='col-sm-6'>
										<div class='form-row'>
											<label class='col-sm-6'>Donation</label>
											<div class='col-sm-6'>
												<input type="text"  id="donation_amount" class="form-control" placeholder='$'value="<?php echo $project_data['0']['donation_amount']; ?>"  >
											</div>
										</div>
									</div>
									<div class='col-sm-6'>
										<div class='form-row'>
											<label class='col-sm-6'>Show amount to Co-workers?</label>
											<div class='col-sm-6'>
												<input type="checkbox" id="show_amount" name="show_amount" class="form-check-input" value="1"<?php if ($project_data['0']['show_amount'] == 1) { echo "checked='checked'"; } ?>>
												
												
											</div>
										</div>
									</div>
								
									
									
								</div>
								<div class='form-row'>
									<label class='col-sm-3'>Voting Starts</label>
									
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
									<label class='col-sm-3'>Voting Ends</label>
									
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
						  
						   <label class='col-sm-3'>Donation Frecuency</label>
                          
						   <input type="radio" name="donation_frequency" id="only_one" value="Once"<?php if ($project_data['0']['donation_frequency']=='Once'){ echo "checked";} else {"";}?>>&nbsp;&nbsp;Once
						     &nbsp;&nbsp; 
						  
						  	<input type="radio" name="donation_frequency" id="every_month" value="month"<?php if ($project_data['0']['donation_frequency']=='month'){ echo "checked";} else {"";}?>>&nbsp;&nbsp; Every month
							 
							 &nbsp;&nbsp; 
						   <input type="radio" name="donation_frequency" id="until" value="Until"<?php if ($project_data['0']['donation_frequency']!='Once' && $project_data['0']['donation_frequency']!='month'){ echo "checked";} else {"";}?>>&nbsp;&nbsp; Until
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
								<a href="<?php echo base_url(); ?>/admin/dashboard" class="btn creat-btn">
					                 Back to panel</a>
									<input type="hidden" id="user_id" value="<?php echo $project_data['0']['user_id']; ?>">
									<button type='button' id="submit" class='btn creat-btn'>Save</button>
								</div>
								
							</form>	
						</div>
					</div>
					
					 
								 
				</div>
			  </div>
			  <div id="voting" class="tab-pane com50 fade">
				<div class='container-fluid'>
					<h1 class='body-title text-cyan text-center'>How will the company define<br /> what causes donate to?</h1>
					<div class='row justify-content-center'>
						<div class='col-lg-8 col-md-12'>
						 
							<ul class='voting-box' >
							
								<li id="type_1" <?php if ($project_data['0']['donation_type']=='1'){ echo 'class="selected-vote"';} else {"";}?>>
									<h3>Mayority</h3>
									<div class='vote-ico'><img src='<?php echo base_url();?>assets/images/mayority.png' /></div>
									<p>The Cause with the most number of votes will win</p>
								</li>
								<li id="type_2" <?php if ($project_data['0']['donation_type']=='2'){ echo 'class="selected-vote"';} else {"";}?>>
									<h3>Best3</h3>
									<div class='vote-ico'><img src='<?php echo base_url();?>assets/images/best.png' /></div>
									<p>The 3 first Causes will get the donation as a ponderation of the votes</p>
								</li>
								 <li id="type_3" <?php if ($project_data['0']['donation_type']=='3'){ echo 'class="selected-vote"';} else {"";}?>>
									<h3>Sociocracy</h3>
									<div class='vote-ico'><img src='<?php echo base_url();?>assets/images/all.png' /></div>
									<p>Innovattive decision making process that create a productive organistion ambients </p>
								</li> 
								 
							 
								
							</ul>
							
							
							<div class="button-group text-center">
							<a href="<?php echo base_url(); ?>/admin/dashboard" class="btn creat-btn">
					                 Back to panel</a>
							<input type='hidden' class="form-control" id="donation_type" value="<?php echo$project_data['0']['donation_type'];?>">
								<button type="button"  id="votingtpye_submit" class="btn creat-btn">Save</button>
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
							<a href='#'><i class="fa fa-search" aria-hidden="true"></i> Details</a>
							 
							  <?php if(!empty($selectid) && in_array($causes['id'],$selectid)) { ?>
							
							<a href='JavaScript:Void(0);' id="remove_cause_<?php echo $causes['id']?>"class="removecauses"><i class="fa fa-plus" aria-hidden="true"></i> Remove Cause</a>
							
							<?php }else { ?>
							<a href='JavaScript:Void(0);' id="select_cause_<?php echo $causes['id']?>"class="selectcauses"><i class="fa fa-plus" aria-hidden="true"></i> Add Cause</a>
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
		<div class="col-sm-12"><a href='JavaScript:Void(0);' id="popup_id" class="btn create-btn">Finish</a></div>
		</div>
		
		
	   </div>
		 
		 
	
		 
        </div>
      </div>
      
    </div>
  </div>
  </div>
 






