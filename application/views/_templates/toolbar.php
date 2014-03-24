        <div class="navbar navbar-default control-panel">
            <div class="container">
              <div class="pull-left projectManagement">
                    <a class="add-garden" id="simple-menu" href="#sidr"><i class="fa fa-mail-reply"></i> See Projects</a>
                </div>
                <div class="pull-right projectManagement">
                    <a class="add-garden"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i></a>
                    <a class="add-garden"  data-toggle="modal" data-target="#addUser"><i class="fa fa-user"></i></a>
                    <a class="settings"><i class="fa fa-cogs"></i></a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Project Name</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo URL; ?>projects/addproject" method="POST">
                   <label for="name">Name</label>
                   <input type="text" name="name" id="name" value="" required />
               
           </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="submit_add_project" value="Submit" />
            </form>
             </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo URL; ?>projects/addproject" method="POST">
                   <label for="name">Name</label>
                   <input type="text" name="name" id="name" value="" required />
               </form>
           </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="submit_add_project" value="Submit" />

             </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->