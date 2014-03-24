<div class="container">
    <div class="title">
        <h1 class="projectTitle"><?php echo $user->username ?> Projects</h1>
    </div>
    <div class="projects row">

        <?php if($projects !== false){foreach ($projects as $project) { ?>
            <div class="project col-xs-12 col-md-4" onclick="window.location='<?php echo URL; ?>diary/<?php echo $project->id; ?>'";>
                <div class="projectWrapper">
                    <div class="projectInfo">
                        <img src="<?php echo URL; ?>public/img/notebook.png">
                    </div>
                    <h3 class="projectHeader"><?php echo $project->name ?></h3>
                </div>
            </div>     
        <?php }} ?>
    </div>
</div>


