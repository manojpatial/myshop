<div class='c-account com50'>
	<div class='container-fluid'>
	<?php 
		if($this->session->flashdata('message_success')) {
			echo '<div class="alert alert-success fade in" style="margin-top:18px;">
			<a href="" class="close"  onclick="myFunction()" data-dismiss="alert" aria-label="close" title="close">×</a>
			<strong> Success!</strong>  '. $this->session->flashdata('message_success').'
			</div>'; 
		} 				
		if($this->session->flashdata('message_error'))  { 
			echo '<div class="alert alert-danger fade in" style="margin-top:18px;">
			<a href="" class="close" onclick="myFunction()"  data-dismiss="alert" aria-label="close" title="close">×</a>
			<strong>Error! </strong>  '. $this->session->flashdata('message_error').'
			</div>'; 
		}
	?>
		<form action="<?php echo base_url('Causes/register'); ?>" role="form" class='create-form' method="POST" id="Causes_register">
			<div  id = "inst_step_basic"  class='row justify-content-center'>
				<div class='col-sm-6'>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_label'); ?></label>
						<div class='col-sm-8'><input name="institution" type='text' class='form-control required' id="institution"/><span class="error"><?php echo $this->lang->line('institution_error'); ?></span></div>
					 </div>
					   <div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_logo_label'); ?><br /> <small><?php echo $this->lang->line('institution_logo_help'); ?></small></label>
							<div class='col-sm-8'>
								<div class="fileselector">
									<span id="uploaded_image" style="display:none;"><img src="" height="100" width="178" id="img-thumbnail" /></span>
									<label class="btn btn-default" for="upload-file-selector-reg">
									<input id="upload-file-selector-reg"  type="file" name="causeLogo"><?php echo $this->lang->line('institution_picture_upload'); ?></label>
								</div>
								<span class="logo_error"><?php echo $this->lang->line('institution_logo_error'); ?> </span>
							</div>
							
						</div>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_name_label'); ?></label>
						<div class='col-sm-8'><input type='text' name="name" id="name" class='form-control required' /><span class="error"><?php echo $this->lang->line('institution_name_error'); ?></span></div>
					</div>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_your_email_label'); ?></label>
						<div class='col-sm-8'><input type='text' name="email" id="email" class='form-control required' /><span class="error"><?php echo $this->lang->line('institution_your_email_error'); ?></span></div>
					</div>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_confirm_email_label'); ?></label>
						<div class='col-sm-8'><input type='text' name="conf_email" id="conf_email" class='form-control required' /><span class="error"><?php echo $this->lang->line('institution_confirm_email_error'); ?></span></div>
					</div>
					<div class='button-group text-center'>
						<button id='inst_next_1' type='button' class='btn create-btn'><?php echo $this->lang->line('next'); ?></button>
					</div>
				</div>
			</div>
			<div  id = "inst_step_info" class='row justify-content-center'  style="display:none">
				<div class='col-sm-6'>
						<strong class='form-heading col-sm-4 text-center'><?php echo $this->lang->line('institution_information_title'); ?></strong>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('institution_legal_name_label'); ?></label>
							<div class='col-sm-8'><input name="ins_legal_name" type='text' class='form-control required' id="ins_legal_name"/><span class="error"><?php echo $this->lang->line('institution_legal_name_error'); ?></span></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('institution_social_number_label'); ?></label>
							<div class='col-sm-8'><input name="ins_social_name" type='text' class='form-control required' id="ins_social_name"/><span class="error">Social<?php echo $this->lang->line('institution_social_number_error'); ?></span></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('institution_line_business_label'); ?></label>
							<div class='col-sm-8'><input name="ins_line_business" type='text' class='form-control required' id="ins_line_business"/><span class="error"><?php echo $this->lang->line('institution_line_business_error'); ?></span></div>
						</div>
						<strong class='form-heading col-sm-4 text-center'><?php echo $this->lang->line('institution_legal_representative_title'); ?></strong>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('institution_legal_rep_name_label'); ?></label>
							<div class='col-sm-8'><input name="rep_legal_name" type='text' class='form-control required' id="rep_legal_name"/><span class="error"><?php echo $this->lang->line('institution_legal_rep_name_error'); ?></span></div> 
						</div>
						<!--<div class='form-row'>
							<label class='col-sm-4'>Social Name</label>
							<div class='col-sm-8'><input name="rep_social_name" type='text' class='form-control required' id="rep_social_name"/><span class="error">Representative  Social Name is required</span></div>
						</div>-->
						
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('institution_social_number_label'); ?></label>
							<div class='col-sm-8'><input name="rep_social_number" type='text' class='form-control required' id="rep_social_number"/><span class="error"><?php echo $this->lang->line('institution_social_number_error'); ?></span></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('institution_address_label'); ?></label>
							<div class='col-sm-8'><input name="rep_address" type='text' class='form-control required' id="rep_address"/><span class="error"><?php echo $this->lang->line('institution_address_error'); ?></span></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('institution_phone_label'); ?></label>
							<div class='col-sm-8'><input name="rep_phone" type='text' class='form-control required' id="rep_phone"/><span class="error"><?php echo $this->lang->line('institution_phone_error'); ?></span></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('institution_email_label'); ?></label>
							<div class='col-sm-8'><input name="rep_email" type='text' class='form-control required' id="rep_email"/><span class="error"><?php echo $this->lang->line('institution_your_email_error'); ?></span></div>
						</div>
						<div class='button-group text-center'>
							<button id='inst_next_2' type='button' class='btn create-btn'><?php echo $this->lang->line('next'); ?></button>
						</div>
					
					</div>
				
				<div class='col-sm-4'>
					<div class='form-row'>
					<label class='col-sm-4'><?php echo $this->lang->line('institution_val_certi_label'); ?><br /> <small><?php echo $this->lang->line('institution_val_certi_help'); ?></small></label>
						<div class='col-sm-8'>
							<div class="fileselector">
								<span id="uploaded_image_validity" style="display:none;"><img src="" height="100" width="178" id="img-thumbnail-validity" /></span>
								<label class="btn btn-default" for="upload-file-selector-reg_vali">
								<input id="upload-file-selector-reg_vali"  type="file" name="validity_certificate"><?php echo $this->lang->line('institution_picture_upload'); ?></label>
							</div>
							<span class="ins_certificateo_error"><?php echo $this->lang->line('institution_val_certi_error'); ?> </span>
						</div>
					</div>
				</div>
			</div>
			
			<div  id = "inst_step_bank"  class='row justify-content-center'  style="display:none">
				<div class='col-sm-6'>
					<strong class='form-heading col-sm-4 text-center'><?php echo $this->lang->line('institution_bank_title'); ?></strong>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_bank_account_label'); ?></label>
						<div class='col-sm-8'><input name="account_number" type='text' class='form-control required' id="account_number"/><span class="error"><?php echo $this->lang->line('institution_bank_account_error'); ?></span></div>
					</div>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_bank_name_label'); ?></label>
						<div class='col-sm-8'><input name="bank_name" type='text' class='form-control required' id="bank_name"/><span class="error"><?php echo $this->lang->line('institution_bank_namet_error'); ?></span></div>
					</div>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_legal_name_label'); ?></label>
						<div class='col-sm-8'><input name="bank_legal_name" type='text' class='form-control required' id="bank_legal_name"/><span class="error"><?php echo $this->lang->line('institution_legal_name_error'); ?></span></div>
					</div>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_social_number_label'); ?></label>
						<div class='col-sm-8'><input name="bank_social_number" type='text' class='form-control required' id="bank_social_number"/><span class="error"><?php echo $this->lang->line('institution_social_number_error'); ?></span></div>
					</div>
					<div class='form-row'>
						<label class='col-sm-4'><?php echo $this->lang->line('institution_email_label'); ?></label>
						<div class='col-sm-8'><input name="bank_email" type='text' class='form-control required' id="bank_email"/><span class="error"><?php echo $this->lang->line('institution_your_email_error'); ?></span></div>
					</div>
					
					<div id="create_inst" class='button-group'>
						<label class='col-sm-4'>&nbsp;</label>
						<input type="hidden" name="logoName" id="logoName" value="" >
						<input type="hidden" name="ins_certificate" id="ins_certificate" value="" >
						<input type='hidden' name="password" id="password" value="<?php echo(mt_rand(10000,999999));?>" class='form-control' />
						<button id="cause_register" type='submit' class='btn create-btn'><?php echo $this->lang->line('create'); ?> Create Account</button>
					</div>
				</div>
			</div>
		</form>
	