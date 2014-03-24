<div id="sidr">
  <!-- Your content -->
  <ul>
  	<?php 
  		  $user_id = 1;
        $side_model = $this->loadModel('UserProjectsModel');
        $userProjects = $side_model->getUserOwnRecentProjects($user_id);
  	?>
  	<?php foreach ($userProjects as $project) { ?>
  		<li><a href="<?php echo URL; ?>diary/projectdiary/<?php echo $project->id ?>"><?php  echo $project->name ?></a></li>
  	<?php } ?>
  </ul>
</div>