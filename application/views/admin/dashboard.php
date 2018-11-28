<div class='container-fluid'>
	<div class="row topbar" style="background-color: #868181;
    padding: 10px;
    color: #ffff;"> 
	    <div class="col-md-3">
	        <span>Institutions</span>
	    </div>
	    <div class="col-md-3">
	         <span>Causes</span>
	    </div>
	    <div class="col-md-3">
	        <span>Company</span>
	    </div>
	    <div class="col-md-3">
	      <span>Project</span>
	   </div>
    </div>
	 
	<div class="row">
       <div class="col-md-3 border-right">
		<ul class="list">
		<?php foreach($institution_data as $institution){?>
		<li><?php echo  $institution['meta_value'];?> <a href="<?php echo base_url();?>admin/institution/<?php echo $institution['user_id']; ?>"> <i class="fa fa-search right"></i> </a></li>
		
		<?php }?>
		</ul>
		</div>
      <div class="col-md-3 border-right">
			<ul class="list">
			<?php foreach ($causes_data as $causes){?>
			 
			<li><?php echo $causes['name']; ?>
			
			<a href="<?php echo base_url();?>admin/causes/<?php echo $causes['id']; ?>"> <i class="fa fa-search right"></i> </a>
			
			<a href="" data-toggle="modal" data-target="#modelcauseaprove" id="cause_<?php echo $causes['id'];?>" class="aprovecause">
			<?php if($causes['status']=='2') {?>
			<i class="fa fa-hourglass" aria-hidden="true" ></i>
			<?php }?>
			</a>
			<?php if ($causes['status']=='3'){ ?>
			<i class="fa fa-check" aria-hidden="true"></a></i>
			<?php }?>
			
			</li>
		    
			<?php }?>
			</ul>
	  </div>
      <div class="col-md-3 border-right">
			<ul class="list">
			<?php foreach ($corporate_companydata as $company){?>
		 <li><?php echo $company['meta_value']; ?><a href="<?php echo base_url()?>admin/company/<?php echo $company['user_id'];?>"> <i class="fa fa-search right"></i></a></li>
		  
			<?php }?>
			</ul>
	  </div>
	  <div class="col-md-3 border-right">
	 
	 
	 
			<ul class="list">
			<?php foreach ($project_data as $projects){?>
			<li>
			
			 <?php echo $projects['name']; ?><a href="<?php echo base_url()?>admin/project/<?php echo $projects['id'];?>"><i class="fa fa-search right"> </i></a>
			 </li>
			 <?php } ?>
		
			</ul>
	  </div>
    </div>
	
	</div>
	
<!-------------popup cause aprrove---------------->	
<div class="modal fade" id="modelcauseaprove" role="dialog">
    <div class="modal-dialog aprove">
      <!-- Modal content-->
       <div class="modal-content">
	   <section class='cyan-bg com30'>
       <div class="modal-body">
		 
			<div class='row justify-content-center'>
			<h6 class="inspectcompanylogo" style="padding:50px;"> Cause Aprove ?</h6>
				<div class='col-sm-8'>
					  <div class='button-group center'>
					  <button type="button" class="btn creat-btn" data-dismiss="modal">Cancel</button>
					  <input type="hidden" id="cause_aprove_id" value="" >
		             <button type='submit' id="causeaproved" class='btn creat-btn' data-dismiss="modal" >Aprove</button>
					</div>
				</div>
			</div>
		 
			<!---<div class='row justify-content-center'>
			<h6 class="inspectcompanylogo" style="padding:50px;"> Cause has been already Aproved </h6>
				<div class='col-sm-8'>
					  <div class='button-group center'>
					  <button type="button" class="btn creat-btn" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div--->
		  
		  
		 	 
		</div>
        </div>
	 </section>
     </div>
    </div>
  </div>
	








