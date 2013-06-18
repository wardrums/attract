		<div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Show title</li>
              <li <?php echo ($title == "Shots" ? "class=\"active\"" : ""); ?>><a href="/shots">Shots</a></li>
              <li <?php echo ($title == "Scenes" ? "class=\"active\"" : ""); ?>><a href="/scenes">Scenes</a></li>
              <li><a href="#">Sequences</a></li>
              <li><a href="#">Stats</a></li>
              
              <?php if($is_admin == TRUE): ?>
              <li class="nav-header">Admin</li>
              <li <?php echo ($title == "Users" ? "class=\"active\"" : ""); ?>><a href="/admin/users">User management</a></li>
              <li <?php echo ($title == "Shot stages" ? "class=\"active\"" : ""); ?>><a href="/admin/shot_stages">Shot stages</a></li>
              <li><a href="#">Show management</a></li>
              <?php endif ?>

            </ul>
          </div><!--/.well -->
        </div><!--/span-->