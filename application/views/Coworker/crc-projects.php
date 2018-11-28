<?php
//echo '<pre>'; print_r($projects); echo '</pre>'; 

?>

<section class='csr-p'>
		<div class='container-fluid'>
			<div class='row justify-content-center'>
			<?php 
			foreach($projects as $project)
			{
				$voting_end = $project['voting_end'];
				$voting_end_exp = explode(' ', $voting_end);
				$date = $voting_end_exp[0];
				$date_exp = explode('-', $date);
				$new_end_date = $date_exp[2].'/'.$date_exp[1].'/'.$date_exp[0];
				$time = $voting_end_exp[1];
				$voting_type = $project['donation_type'];
				$type_text = ''; 
				if($voting_type == 1){
					$type_text = $this->lang->line('voting_type_one_des');
				}
				else if($voting_type == 2){
					$type_text = $this->lang->line('voting_type_two_des');
				}
				else if($voting_type == 3){
					$type_text = $this->lang-line('voting_type_three_des');
				}else{
					
				}
				?>
				<div class='col-md-6 col-sm-12'>
					<div class='csr-wrap text-center'>
						<h1 class='body-title text-cyan'><?php echo $project['name']; ?></h1>
						<p><?php echo $project['description']; ?></p>
						<h2 class='small-title text-cyan'><?php echo $this->lang->line('voting_ends_at'); ?>  <?php echo $time; ?>  <?php echo $this->lang->line('the'); ?>  <?php echo $new_end_date; ?> </h2>
						<p><?php echo $type_text; ?>:</p>
						<h2 class='small-title text-cyan'><?php echo $this->lang->line('donation_amount'); ?> <?php echo  $project['donation_amount'];?></h2>
						<div class='button-group top50'>
						<?php if(count($project['vote_data']) > 0 )
						{?>
							<button class='btn creat-btn'><a href="<?php echo base_url('Coworker/view_result')?>/<?php echo $project['id']; ?>"><?php echo $this->lang->line('view_result_button');?></a></button>
						<?php
						}
						else{ ?>
							<button class='btn creat-btn'><a href="<?php echo base_url('Coworker/voting')?>/<?php echo $project['id']; ?>"><?php echo $this->lang->line('vote_now_button');?></a></button>
							
						<?php }?>
						</div>
					</div>
					
				</div>
				
	  <?php } ?>
			</div>
		</div>
</section>