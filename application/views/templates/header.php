<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title ?> - Attract</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo assets_url(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="<?php echo assets_url(); ?>/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo assets_url(); ?>/css/chosen.min.css" rel="stylesheet">
    <link href="<?php echo assets_url(); ?>/css/attract.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo assets_url(); ?>/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo assets_url(); ?>/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo assets_url(); ?>/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo assets_url(); ?>/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?php echo assets_url(); ?>/ico/favicon.png">
    
    <script src="<?php echo assets_url(); ?>/js/jquery.min.js"></script>
    <script src="<?php echo assets_url(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo assets_url(); ?>/js/jquery.knob.js"></script>
    <script src="<?php echo assets_url(); ?>/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo assets_url(); ?>/js/jquery.dataTables.fnGetColumnData.js"></script>
    <script src="<?php echo assets_url(); ?>/js/jquery.dataTables.fnFilterClear.js"></script>
    <script src="<?php echo assets_url(); ?>/js/custom.dataTables.js"></script>
    <!-- <script src="<?php echo assets_url(); ?>/js/jquery.jeditable.js"></script> -->
    <script src="<?php echo assets_url(); ?>/js/jquery.chosen.min.js"></script>
    <script src="<?php echo assets_url(); ?>/js/jquery.attract.js"></script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="/">Attract</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php echo ($title == "Tasks" ? "class=\"active\"" : ""); ?>><a href="/user/tasks/">Tasks</a></li>
              <li><a href="#contact">Messages</a></li>
            </ul>
            <ul class="nav pull-right">
            <li id="fat-menu" class="dropdown">
              <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $the_user->username ?> <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">More settings</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="/auth/logout">Log out</a></li>
              </ul>
            </li>
           </ul>
          </div><!--/.nav-collapse -->
          
                    
                  
        </div>
      </div>
    </div>

    <div class="container-fluid">
    	<div class="row-fluid">
      
 
