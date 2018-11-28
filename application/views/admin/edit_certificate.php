
 <div class='c-account com50'>
		<div class='container-fluid'>
			<div class='row justify-content-center'>
			
				<div class='col-sm-8'>
				<?php
			if($this->session->flashdata('edit_message_success'))  { 
               echo '<div class="alert alert-success fade in" style="margin-top:18px;">
       <a href="" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
       <strong> Success!</strong>  '. $this->session->flashdata('edit_message_success').'
      </div>';		  

                            } 
                    ?>
					<form action="<?php echo base_url(); ?>admin/edit_certificate/<?php echo $certificate['0']['id'];?>" role="form" class='create-form' method="POST" id="certificate" enctype='multipart/form-data'>
						<div class='form-row'>
							<label class='col-sm-3'>Certificate Name</label>
							<div class='col-sm-9'><input type='text' name="certificate_name"  value="<?php echo $certificate['0']['certificate_name'];?>" class='form-control' required/></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-3'>Corporate Benefits</label>
							<div class='col-sm-9'>
							<textarea name="benefits" id="benefits" class="form-control" required> <?php echo $certificate['0']['benefits'];?></textarea></div>
						</div>
						<div class='form-row'>
							<label class='col-sm-3'>Restrictions</label>
							<div class='col-sm-9'>
							
							<textarea name="restrictions" id="restrictions" class="form-control" required> <?php echo $certificate['0']['restrictions'];?></textarea>
							</div>
						</div>
						<div class='button-group'>
							<label class='col-sm-3'>&nbsp;</label>
							<button type='submit' class='btn create-btn'>submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>



   