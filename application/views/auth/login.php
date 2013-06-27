<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Attract</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div class="container">
	<?php $attributes = array('class' => 'form-signin'); ?>
	<?php echo form_open("auth/login", $attributes);?>
        <h2 class="form-signin-heading"><?php echo lang('login_heading');?></h2>
        <p><?php echo lang('login_subheading');?></p>
		<div id="infoMessage"><?php echo $message;?></div>
		
		<?php $identity['class'] = 'input-block-level'; ?>
		<?php $identity['placeholder'] = 'Email address'; ?>
		<?php echo form_input($identity);?>

		<?php $password['class'] = 'input-block-level' ?>
		<?php $password['placeholder'] = 'Password'; ?>
		<?php echo form_input($password);?>
		
		<label class="checkbox">
			<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
			<?php echo lang('login_remember_label', 'remember');?>
		</label>
		
		
		<?php $attributes = array(
			'class' => 'btn btn-large btn-primary btn-block',
			'name' => 'submit',
			'value' => 'login'
		); ?>
  		<?php echo form_submit($attributes)?>

      <?php echo form_close();?>

    </div> <!-- /container -->

  </body>
</html>

