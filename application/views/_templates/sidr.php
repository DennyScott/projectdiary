<div id="sidr">
  <!-- Your content -->
  <ul>
  	<?php foreach ($sideProjs as $project) { ?>
  		<li><a href="<?php echo URL; ?>diary/projectdiary/<?php echo $project->id ?>"><?php  echo $project->name ?></a></li>
  	<?php } ?>
  </ul>
</div>