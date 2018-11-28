 <div class='c-account com50'>
		<div class='container-fluid'>
			<div class='row justify-content-center'>
				<div class='col-sm-6'>
					<form action="<?php echo base_url('corporate/corporate_register'); ?>" role="form" class='create-form' method="POST" id="corporate_register" enctype='multipart/form-data'>
					 
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('company_label'); ?></label>
							<div class='col-sm-8'><input type='text' name="company"  class='form-control' /></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('company_logo_label'); ?></label>
							<div class='col-sm-8'>
									<div class="fileselector">
										<span id="uploaded_image" style="display:none;"><img src="" height="100" width="178" id="img-thumbnail" /></span>
										<label class="btn btn-default" for="upload-file-selector">
										<input id="upload-file-selector"  type="file" name="corporateLogo"><?php echo $this->lang->line('upload_picture'); ?></label>
									</div>
								</div>
							<!--<div class='col-sm-8'>
								<div class="fileselector">
									<label class="btn btn-default" for="upload-file-selector">
										<input id="upload-file-selector" type="file">
											Upload Picture
									</label>
								</div>
							</div>-->
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('your_name_label'); ?></label>
							<div class='col-sm-8'><input type='text'  name="name" class='form-control' /></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('your_email_label'); ?></label>
							<div class='col-sm-8'><input type='text'  name ="email" class='form-control' /></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('confirm_email_label'); ?></label>
							<div class='col-sm-8'><input type='text' name="conf_email" class='form-control' /></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-4'><?php echo $this->lang->line('co-workers_emails_label'); ?></label>
							<div class='col-sm-8'>
								<div class="fileselector file-up-btn">
									<label class="btn btn-default" for="upload-file-selector-csv">
										
										<input type='file' id="upload-file-selector-csv"  name="corporate_file" class='form-control' accept=".csv"/>
										<?php echo $this->lang->line('upload_database_label'); ?>
											
									</label>
								</div>
							</div>
						</div>
						<!--<div class='form-row'>
							<label class='col-sm-4'>Add co-workers emails</label>
							<div class='col-sm-8'><input type='file' name="corporate_file" class='form-control' accept=".csv"/></div>
						</div>-->
						 
						 
						<div class='button-group'>
							<label class='col-sm-4'>&nbsp;</label>
							<input type="hidden" name="logoName" id="logoName" value="" >
							<input type='hidden' name="password" id="password" value="<?php echo(mt_rand(1000000,10000000));?>" class='form-control' />
							<button type='submit' class='btn create-btn'><?php echo $this->lang->line('create'); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
