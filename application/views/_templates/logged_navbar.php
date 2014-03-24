<nav class="navbar navbar-inverse navbar-fixed-top" id="main-nav" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
          <span class="sr-only">Toggle navigation</span>
        </button>
        <a class="navbar-brand" href="<?php echo URL; ?>projects/">Project Diary</a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav">
          <li class=""><a href="<?php echo URL; ?>projects/">Your Projects</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if(isset($_SESSION["user"])){ ?>
            <li><a href="<?php echo URL; ?>home/signout">Sign Out</a></li>
            <?php }else{ ?>
            <li><a href="<?php echo URL; ?>home/signin">Sign In</a></li>
            <?php } ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>
  </nav><!-- /navbar -->