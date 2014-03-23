<div class="container">
    <div>
        <h3>Add a Project</h3>
        <form action="<?php echo URL; ?>projects/addproject" method="POST">
            <label>Name</label>
            <input type="text" name="name" value="" required />
            <input type="submit" name="submit_add_project" value="Submit" />
        </form>
    </div>
    <div>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Created</td>
                <td>Created by</td>
                <td>Last Updated</td>
                <td>Last Updated By</td>
                <td>DELETE</td>
                <td>UPDATE</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($projects as $project) { ?>
                <tr>
                    <td><?php if (isset($project->id)) echo $project->id; ?></td>
                    <td><?php if (isset($project->name)) echo $project->name; ?></td>
                    <td><?php if (isset($project->created)) echo $project->created; ?></td>
                    <td><?php if (isset($project->created_by)) echo $project->created_by; ?></td>
                    <td><?php if (isset($project->updated)) echo $project->updated; ?></td>
                    <td><?php if (isset($project->updated_by)) echo $project->updated_by; ?></td>                    
                    <td><a href="<?php echo URL . 'projects/deleteproject/' . $project->id; ?>">delete</a></td>
                    <td><a href="<?php echo URL . 'projects/updateproject/' . $project->id . '/' . "Hello"; ?>">update</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
