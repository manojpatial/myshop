<div class='container-fluid com50 visual-sec'>
     <?php if(!empty($visualization_data))
                                            { ?>
		<div class='row justify-content-center'>
		<?php foreach ($visualization_data as $projects){ ?>
			<div class='col-lg-6 col-md-10'>
				<h1 class='body-title text-cyan'><?php echo $visualization_data['0']['name']; ?>
				</h1>
				<p><?php echo $visualization_data['0']['description']; ?></p>
				
				<?php $voting_end = $visualization_data['0']['voting_end']; ?>
				
				<h2 class='small-title text-cyan'><?php echo $this->lang->line('voting_ends_at'); ?> <?php  echo substr($voting_end,11,20); ?> <?php echo $this->lang->line('the'); ?><?php  echo substr($voting_end,0,10); ?></h2>
				
				<?php $donation_type = $visualization_data['0']['donation_type']; 
				 
				if($donation_type == 1){
					$donation_text = $this->lang->line('voting_type_one_des') ;
				}
				else if($donation_type == 2){
					$donation_text =  $this->lang->line('voting_type_two_des');
				}
				else if($donation_type == 3){
					$donation_text = $this->lang->line('voting_type_three_des');
				}else{
					
				}
				
				?>
		      
				<p><?php echo $donation_text;?></p>
				<h2 class='small-title text-cyan'><?php echo $this->lang->line('donation_amount'); ?><?php echo $visualization_data['0']['donation_amount']; ?> <small><?php echo $this->lang->line('visible'); ?></small></h2>
				<div class="cadd-more visi-photo">
						<ul>
						<?php foreach($project_images as $causes){ ?>
							<li>
								
								<div class="over-text">
									<div class="dis-text">
										<p><?php echo $causes['name']; ?></p>
										<p><?php echo $causes ['description'];?></p>
									</div>
								</div>
								<img src='<?php echo base_url();?>assets/uploads/cause-picture/<?php echo $causes['photo']; ?>' />
								<input name="causes_ids[]" type="hidden" id="causes_ids" value="<?php echo $causes['id'];?>">
							</li>
							<?php }?>
							
							
							
						</ul>
					</div>
				<div class="button-group top30 text-center">
		  <input type="hidden" value="<?php echo $visualization_data['0']['id']; ?>" id="visualizationid">
					<button type="button" id="visulization_save" class="btn creat-btn"><?php echo $this->lang->line('Save_button'); ?></button> <button type="button" id="visulization_publish"  class="btn creat-btn"><?php echo $this->lang->line('my_cause_publish'); ?></button>
				</div>	
		</div>
		<?php }
		?>
	</div>
	<?php } else { ?>
	
	<div class='row justify-content-center'>
		<div class='col-lg-6 col-md-10'>
		<p>Please create Project to view your Visulization</p>
		</div>
		</div>
		<?php } ?>
	</div>
	
	 
			