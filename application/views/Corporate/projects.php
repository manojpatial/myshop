<div class="col-md-12 row">
	<div class="col-md-2 sidebar">
		<ul>
			<li><a href='<?php echo base_url();?>/Corporate/projects' id="allcause_button" class=""><?php echo $this->lang->line('all');?></a></li>
			<li><a href='#' data-toggle="modal" data-target="#myModal_filter" class=""><?php echo $this->lang->line('filter');?></a></li>
			<li><a href='JavaScript:Void(0);' id="Selected_id" class=""><?php echo $this->lang->line('selected');?></a>
			</li>
		</ul>
	</div>
	<div class="col-md-10"> 
		<div class='corp-photo'>
		<?php	
			$selectid= $this->session->userdata('select_causesid');
			if($this->session->flashdata('message_error'))  { 
				echo '<div class="alert alert-danger fade in" style="margin-top:18px;">	<a href=""  onclick="myFunction()" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'. $this->session->flashdata('message_error').'</div>'; 
			} 
			?>
			<ul id="allcause-section">
			<?php 
			  foreach($causes_data as $causes){
				   //echo '<pre>'; print_r($causes); print_r($causes_data); ?>
				<li>
					<div class='over-text'>
						<div class='on-h-text'>
							<a target='_blank' href='<?php echo base_url();?>Corporate/view/<?php echo $causes['id']; ?>'><i class="fa fa-search" aria-hidden="true"></i> <?php echo $this->lang->line('details');?></a>
							<?php if(!empty($selectid) && in_array($causes['id'],$selectid)) { ?>
							<a href='JavaScript:Void(0);' id="get_cause_<?php echo $causes['id']?>"class="removecauses"><i class="fa fa-close" aria-hidden="true"></i> <?php echo $this->lang->line('remove_cause');?></a>
							<?php } else {?>
							<a href='JavaScript:Void(0);' id="get_cause_<?php echo $causes['id']?>"class="selectcauses"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $this->lang->line('add_cause');?></a>
							<?php } ?>
						</div>
						<div class='dis-text'>
							<p><?php echo $causes['name']?></p>
							 <!--<p>50.000 USD-20 Schools</p>-->
						</div> 
					</div>
					<div class='cphoto-box'>
					   <img src='<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $causes['photo'];?>' />
					</div>
				</li>
			   <?php }?>
			</ul>
			<ul id="Selectedcause_image"></ul>
			<ul id="filter_section"></ul>
		</div>
		<div class="row text-center">
			<div class="col-sm-12" style="padding:40px;"><a href="<?php echo base_url('Corporate/project_creation'); ?>"class="btn create-btn"><?php echo $this->lang->line('continue_button');?></a></div>
		</div>
	</div>
</div>
	<!--model pupop for filter-->
  <!-- Modal -->
<div class="modal fade" id="myModal_filter" role="dialog">
    <div class="modal-dialog Filter">
      <!-- Modal content-->
		<div class="modal-content cyan-bg">
			<div class="modal-body">
			  <!--==========================First page start here!=====================-->
				 
					<div class='container'>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div class='row'>
							<div class='col-sm-8'>
								<form action="#" role="form" method='post' class='login-form'  id="filter_form">
								<div class='form-row'>
										<label class='col-sm-4'><?php echo $this->lang->line('ngo_name');?></label>
										<div class='col-sm-8'><input type='text' id="ngo_name"   class='form-control' /></div>
								</div>
								<div class='form-row'>
									<label class='col-sm-4'><?php echo $this->lang->line('cause_name');?></label>
									<div class='col-sm-8'><input type='text'  id="cause_name" class='form-control' /></div>
								</div>
								<div class='form-row'>
									<label class='col-sm-4'><?php echo $this->lang->line('type_of_certificate');?></label>
									 <div class='col-sm-8'>
										<label><input type="radio" id="radio1" name="certificate_type" value="Certificate 1">Donation Certificate type 1</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label><input type="radio" id="radio2" name="certificate_type" value="Certificate 2">Donation Certificate type 2</label>
										<label><input type="radio" id="radio1" name="certificate_type" value="Certificate 3">Donation Certificate type 3</label>
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label><input type="radio" id="radio2" name="certificate_type" value="Certificate 4">Donation Certificate type 4</label>
									 </div>
								</div>
								<div class='form-row'>
								<label class='col-sm-4'><?php echo $this->lang->line('type_of_services');?></label>
							   <div class='col-sm-8'><input type='text' id="services_type"  class='form-control' /></div>
								</div>
								<div class='button-group text-right'>
									<button type='button' id="filter_Send" class='btn create-btn'><?php echo $this->lang->line('send_button');?></button>
								</div>
							</form>
							</div>
						</div>
					</div>
				 
			</div>
		</div>
    </div>
</div>