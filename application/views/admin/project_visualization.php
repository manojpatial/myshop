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
				
				<h2 class='small-title text-cyan'>Voting Ends at <?php  echo substr($voting_end,11,20); ?> the <?php  echo substr($voting_end,0,10); ?></h2>
				
				<?php $donation_type = $visualization_data['0']['donation_type']; 
				 
				if($donation_type == 1){
					$donation_text = 'The Cause with the most number of votes will win';
				}
				else if($donation_type == 2){
					$donation_text = 'The 3 first Causes will get the donation as a ponderation of the votes';
				}
				else if($donation_type == 3){
					$donation_text = 'All Causes will get a donation as ponderation of the votes';
				}else{
					
				}
				
				
				
				?>
		      
				<p><?php echo $donation_text;?></p>
				<h2 class='small-title text-cyan'>Donation Amount: $<?php echo $visualization_data['0']['donation_amount']; ?> <small>(Visible)</small></h2>
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
		  <a href="<?php echo base_url(); ?>/admin/dashboard" class="btn creat-btn">Back to panel</a>
					               
					
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
	
	 
			