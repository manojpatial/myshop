<div class='c-account com50'>
		<div class='container-fluid'>
			<div class='col-sm-12'>
			
			<div class='button-group'style="padding-bottom: 30px;">
				<a href="<?php echo base_url();?>admin/add_certificate" class='btn create-btn'>Add certificate</a>
					</div>
			</div>
		<div class='col-sm-12'>
		<?php
			if($this->session->flashdata('delete_message_success'))  { 
               echo '<div class="alert alert-success fade in" style="margin-top:18px;">
       <a href="" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
       <strong> Success!</strong>  '. $this->session->flashdata('delete_message_success').'
      </div>';		  

                            } 
                    ?>
		<table class="table table-hover">
         <thead>
          <tr>
         <th>Certificate Name</th>
         <th>Corporate Benefits</th>
         <th>Restrictions</th>
		 <th>Edit</th>
         <th>Delete</th>
         </tr>
        </thead>
       <tbody>
	   <?php foreach($certificate_data as $cer){?>
        <tr>
        <td><?php echo $cer['certificate_name'];?> </td>
        <td><?php echo $cer['benefits'];?></td>
        <td><?php echo $cer['restrictions'];?></td>
		<td><a href="<?php echo  base_url();?>admin/edit_certificate/<?php echo $cer['id'];?>">Edit</a>
		
		</td>
		<td><a href="<?php echo  base_url();?>admin/del_certificate/<?php echo $cer['id'];?>/manage_certificates/manage_certificate">delete</a></td>
		 
      </tr>
	  <?php } ?>
      
      </tbody>
      </table>
				</div>
			
		</div>
	</div>
</section>



   


 
              
 
 




   