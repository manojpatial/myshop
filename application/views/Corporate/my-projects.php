<div class='create-proyctes com50'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-6'>
					<h1 class='body-title text-center'><?php echo $this->lang->line('my_projects'); ?></h1>
					<?php if(!empty($project_data)) { ?>
					
					<ul class='proyects-create'>
					
					<?php foreach ($project_data as $projects){?>
					<li>
					<a href="<?php echo base_url();?>Corporate/edit_project_creation/<?php echo $projects['id'];?>">
			         <?php echo $projects['name']; ?><br>
					 <?php echo $projects ['description'];?><br>
					 <?php echo $projects['donation_amount']; ?><br>
					 <?php //echo $projects['selected_causes']; ?><br>
					</a>
					</li>
					<a href='JavaScript:Void(0);' id="<?php echo $projects['id']; ?>"class="deleteProject"><?php echo $this->lang->line('delete_button'); ?></a>
					<?php } ?>
						<li><a href="<?php echo base_url('Corporate/projects')?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $this->lang->line('create'); ?></a></li>
						
					</ul>
					<?php
				}
				else{
				?>
				<p class='text-center'><?php echo $this->lang->line('project_msg') ?></p>
				<ul class='proyects-create'>
					<li><a href='<?php echo base_url('Corporate/projects');?>'><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $this->lang->line('create'); ?></a></li>
					 
				</ul>
				<?php }?>
				</div>
				<div class='col-md-6'>
					<h1 class='body-title text-center'><?php echo $this->lang->line('available_causes')?></h1>
					<div class='cause-img'>
						<img src='<?php echo base_url();?>assets/images/cause-photo.jpg' />
					</div>
				</div>
			</div>
		</div>
	</div>
</section>






