<div class='inst-sec-admin'>
	<div class='container-fluid'>
		<div class='row'>
			<div class='col-sm-2 col-2 fst-col'>institution</div>
			<div class='col-sm-2 col-2 second-col'>
			<ul class="bank-dt">
				<li>institution</li>
				<li>Institution logo</li>
				 </ul>
	
				 
			</div>
			<div class='col-sm-8 col-8'><?php echo $institute_data['0']['institution'];?>
			<div class='logo-photo'><img src="<?php echo base_url();?>assets/uploads/institution-logo/<?php echo $institute_data['0']['institutionlogo']; ?>"   alt="image">
			</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-2 col-2 fst-col'>Admin</div>
			<div class='col-sm-2 col-2 second-col'>
			<ul class="bank-dt">
				<li>Admin Name</li>
				<li>Admin Email</li>
				 </li>
			</div>
			<div class='col-sm-8 col-8'>
			<ul class="bank-dt">
			<li><?php echo $institute_data['0']['name']?></li>
			
			<li><?php echo $institute_data['0']['email'];?></li>
			</ul>
			 
			</div>
		</div>
		
		<div class='row'>
			<div class='col-sm-2 col-2 fst-col'>Information</div>
			<div class='col-sm-2 col-2 second-col'>
			 <ul class="bank-dt">
				<li>Legal Name </li>
				<li>line of business</li>
				<li>Validity of certificate</li>
				 </ul>
			</div>
			<div class='col-sm-8 col-8'>
			<ul class="bank-dt">
			<li><?php echo $institute_data['0']['legalname'];?></i>
			
			<li><?php echo $institute_data['0']['business'];?></li>
			</ul>
			<div class='logo-photo'>
			<img src="<?php echo base_url();?>assets/uploads/institution-logo/<?php echo $institute_data['0']['ins_certificate']; ?>"   alt="image">
			 </div>
			</div>
		</div>
		
		
		<div class='row'>
			<div class='col-sm-2 col-2 fst-col'>legal representative</div>
			<div class='col-sm-2 col-2 second-col'>
			<ul class="bank-dt">
				<li>Name </li>
				<li>Social Number</li>
				<li>Phone</li>
				<li>Email</li>
				</ul> 
			</div>
			<div class='col-sm-8 col-8'>
			<ul class="bank-dt">
			<li><?php echo $institute_data['0']['repname'];?></li>
			<li><?php echo $institute_data['0']['repnumber'];?></li>
			<li><?php echo $institute_data['0']['repphone'];?></li>
			<li><?php echo $institute_data['0']['repemail'];?></li>
			</ul>
			</div>
		</div>
		
		
		<div class='row'>
			<div class='col-sm-2 col-2 fst-col'>Bank info</div>
			<div class='col-sm-2 col-2 second-col'>
			<ul class="bank-dt">
				<li>Account number</li>
				<li>Bank</li>
				<li>Bank legal Name</li>
				<li>Social Number</li>
				<li>Email</li>
				 
			</div>
			<div class='col-sm-8 col-8'>
			<ul class="bank-dt">
			
			<li><?php echo $institute_data['0']['accountnumber'];?></li>
			<li><?php echo $institute_data['0']['bank_name'];?></li>
			<li><?php echo $institute_data['0']['bank_legal_name'];?></li>
			<li><?php echo $institute_data['0']['bank_social_number'];?></li>
			<li><?php echo $institute_data['0']['bank_email'];?></li>
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

