<div class='inst-sec-admin'>
	<div class='container-fluid'>
		 <div class='row'>
			<div class='col-sm-2 col-2 fst-col'></div>
			<div class='col-sm-2 col-2 second-col'>
			<ul class="bank-dt">
				<li>Company</li>
				<li>Company's Logo
				<br /> <small>(PNG less then 100kb)</small></li>
				</ul>
	
				 
			</div>
			<div class='col-sm-8 col-8'>
			 
			<?php echo $company_data['0']['corpname']; ?>
			<div class='logo-photo' data-toggle="modal" data-target="#myModalcompany"><img src="<?php echo base_url();?>assets/uploads/corporate-logo/<?php echo $company_data['0']['logo']; ?>" alt="image" id="companylogo" >
			</div>
			 
			
			</div>
		</div>
		
		<div class='row'>
			<div class='col-sm-2 col-2 fst-col'></div>
			<div class='col-sm-2 col-2 second-col'>
			<ul class="bank-dt">
				<li>Your Name</li>
				<li>Your Email</li>
				 </ul>
	
				 
			</div>
			<div class='col-sm-8 col-8'>
			<ul class="bank-dt">
			<li><?php echo $company_data['0']['name']; ?></li>
			<li><?php echo $company_data['0']['email']; ?></li>
			</ul>
			</div>
		</div>
		
		<div class='row'>
			<div class='col-sm-2 col-2 fst-col'>
			<a href="<?php echo base_url(); ?>/admin/dashboard" class="btn creat-btn">Back to panel</a>
			</div>
			<div class='col-sm-2 col-2 second-col'></div>
			<div class='col-sm-8 col-8'>
			</div>
		</div>
	</div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="myModalcompany" role="dialog">
    <div class="modal-dialog company">
      <!-- Modal content-->
       <div class="modal-content">
	   <section class='cyan-bg com30'>
       <div class="modal-body">
		<h6 class="inspectcompanylogo"> Inspect company logo</h6>
		<div class='container'>
			<div class='row justify-content-center'>
				<div class='col-sm-8'>
				 
					<div class='form-row text-center'>
					 
					<div class="fileselector company">
					  <span id="change_image"><img src="<?php echo base_url();?>assets/uploads/corporate-logo/<?php echo $company_data['0']['logo']; ?>" height="100" width="178" id="img-thumbnail" /></span>
					  <label class="btn btn-default" for="companychangelogo">
					  <input id="companychangelogo"  type="file">Change Logo
					    </label> 
						 
						</div>
						</div>
					  <div class='button-group center'>
					  <input type="hidden" name="companylogo" id="companylogo" value="" >
					  <input type="hidden" name="comapny_user_id" id="comapny_user_id" value="<?php echo $company_data['0']['user_id']; ?>" >
					  <button type="button" class="btn creat-btn" data-dismiss="modal">Cancel</button>
		            <button type='submit' id="companylogochange" class='btn creat-btn'  data-dismiss="modal">Save</button>
					</div>
				 
			</div>
		   </div>
		   </div>
         </div>
		 </section>
      </div>
    </div>
  </div>