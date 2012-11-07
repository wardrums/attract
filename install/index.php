<!DOCTYPE html>  
<html lang="en">  
	<head>
	<meta charset="utf-8" />
	<title>Install Attract</title>
	<link href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../assets/css/tablecloth.css" rel="stylesheet">
	<link href="../assets/css/prettify.css" rel="stylesheet"> 
	<link href="../assets/css/chosen.css" rel="stylesheet">
	<link href="../assets/css/attract.css" rel="stylesheet">
	<link type="image/x-icon" href="../assets/favicon/favicon.ico" rel="shortcut icon">
	<link rel="apple-touch-icon" href="../assets/favicon/apple-touch-icon-57x57-precomposed.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="../assets/favicon/apple-touch-icon-72x72-precomposed.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="../assets/favicon/apple-touch-icon-114x114-precomposed.png" />

	
	<script type="text/javascript" src="../assets/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.metadata.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.tablecloth.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.chosen.min.js"></script>
	<script type="text/javascript" src="../assets/js/attract.js"></script>

	</head>
	<body>
		<div class="container">
<?php

 	
 	// Obtain installer's path
 	   
	if(isset($_SERVER['ORIG_PATH_TRANSLATED'])){
	    $rootpath =$_SERVER['ORIG_PATH_TRANSLATED'];
	}else if(isset($_SERVER['PATH_TRANSLATED'])){
	    $rootpath = $_SERVER['PATH_TRANSLATED'];
	}else{
	    $rootpath = $_SERVER['SCRIPT_FILENAME'];
	}
	
	if(substr($rootpath,0,1) == '/'){
		$path = explode("/","$rootpath"); // "/"
	}else if(substr($rootpath,2,1) == "\\"){
		$path = explode("\\","$rootpath"); // "\"
	}else if(substr($rootpath,2,2) == "\\\\"){
		$path = explode("\\\\","$rootpath"); // "\\"
	}else{
		$path = explode("/","$rootpath");
	}	
	
	$rootpath = '';
	for($i=0;$i<count($path)-2;$i++){
	    $rootpath .= "$path[$i]/";
	}
	
	if(substr($rootpath,-1,1) == "/"){
	    $rootpath = substr($rootpath,0,strlen($rootpath)-1);
	}
	
	
	if($rootpath == ''){ ?>
		<p class="warning"><strong>Warning</strong><br />
	    Your webservers rootpath could not be determined.</p>
	    <pre><?php print_r($_SERVER); ?></pre>
		<?php
		exit;
	}
    
    /*if(file_exists("$rootpath/connect.php")){?>
		<p class="warning"><strong>Warning</strong><br />
    	An already existing configuration file has been detected. Delete <i>connect.php</i> in attract's root directory before running this script again.</p>
		<?php
		exit;
	}*/

    if(isset($_POST['stage2'])){
    
    echo "<div class=\"blurb\">";
        
    
	// Name of the file
	$filename = 'attract.sql';
	// MySQL host (needs to be localhost - later to be changed according to MAMP)
	$mysql_host = $_POST['host'].':'.$_POST['port'];
	// MySQL username
	$mysql_username = $_POST['attractUser'];
	// MySQL password
	$mysql_password = $_POST['attractPassword'];
	// Database name
	$mysql_database = 'attract';

	
	//////////////////////////////////////////////////////////////////////////////////////////////
	
	// Connect to MySQL server
	mysql_connect($mysql_host, $mysql_username, $mysql_password) or display_error_and_die('Error connecting to database: ' . mysql_error());
	// Select database
	mysql_select_db($mysql_database) or display_error_and_die('Error selecting MySQL database: ' . mysql_error());
	
	
	// Optionally drop prvious tables
	// TODO: This code is definitely not nice and should be improved
	if (isset($_POST['database_overwrite'])) {
		$query="SET FOREIGN_KEY_CHECKS = 0";
		mysql_query($query) or print(mysql_error());
		echo("Disabling foreign key checks<br/>");
	
		$query="DROP TABLE `scenes`, `shots`, `users`";
		mysql_query($query) or print(mysql_error());
		echo("Dropping previous tables called <i>scenes</i>, <i>shots</i> and <i>users</i><br/>");
		
		$query="SET FOREIGN_KEY_CHECKS = 1";
		mysql_query($query) or print(mysql_error());
		echo("Re-enabling foreign key checks<br/>");
	}
	
	
	// Temporary variable, used to store current query
	$templine = '';
	// Read in entire file
	$lines = file($filename);
	// Loop through each line
	foreach ($lines as $line_num => $line) {
		// Only continue if it's not a comment
		if (substr($line, 0, 2) != '--' && $line != '') {
			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';') {
				// Perform the query
				mysql_query($templine) or print('Error performing query \'<b>' . $templine . '</b>\': ' . mysql_error() . '<br /><br />');
				// Reset temp variable to empty
				$templine = '';
			}
		}
	}
	
		
    echo "OK<br/>";
    
	$conffile = "<?php
\$server = '$_POST[host]';
\$user = '$_POST[attractUser]';
\$pass = '$_POST[attractPassword]';
try {
	\$dbh = new PDO('mysql:host='.\$server.';dbname=attract', \$user, \$pass, array(
    	PDO::ATTR_PERSISTENT => true
    ));
} catch (PDOException \$e) {
	print \"Error!: \" . \$e->getMessage() . \"<br/>\";
	die();
}
?>";
    
    if(!function_exists("file_put_contents")){
	
		function file_put_contents($file,$data){
		    $f = fopen($file,"w+") or die("$file can not open");
		    fwrite($f,$data);
		    fclose($f);
		}
    }
    
    
    file_put_contents("$rootpath/app/db.php",$conffile);
    
    if (file_exists("$rootpath/app/db.php")) {

    	echo "<br />Config file creation: OK<br /><hr>";
    	echo "Setup completed successfully, you can now go to <a href=\"../#\">attract</a>!";
    }
    else {
	echo "<p class=\"warning\"><strong>Warning</strong><br />";
    	echo "<br />Config file creation: seems to have FAILED somewhere <br/>";
    	echo "Generating config file: if creation fails make sure the webserver has permission to write to $rootpath<br/><br/>";
    	echo "Setup unsuccessful, please go back to <a href=\"javascript:history.go(-1)\">attract install</a>";
	echo "</p>";
	
    }
    
    
    
    if(isset($_SERVER['PATH_INFO'])){$uploadPath = $_SERVER['PATH_INFO'];}
    if(isset($_SERVER['REQUEST_URI'])){$uploadPath = $_SERVER['REQUEST_URI'];}
    $uploadPath = str_replace("install/index.php","upload.pl?test",$uploadPath);
	$uploadPath = "http://$_SERVER[SERVER_NAME]$uploadPath";
    // echo $uploadPath . " ...";
    
    
    echo "</div>";
    
    } else {
?>

<?php
error_reporting(0);
?>

<section>
				<div class="page-header">
					<h1>Attract <small>task tracking of steel</small></h1>
				</div>
<div class="row">
<div class="span6 offset3">

		<p>Welcome to the Attract installer. This script will create <strong>db.php</strong> which is attract's config file. It will also configure your database, creating the tables required by the application. Be sure to provide an existing database name.</p>


		    <form class="form-horizontal" action="index.php" method="post">
		    	<div class="control-group">
			    	<label class="control-label" for="inputHost">Database Host (IP)</label>
			    	<div class="controls">
				    	<input type="text" id="inputHost" name="host" value="localhost">
				    </div>
				 </div>
			    <div class="control-group">
			    	<label class="control-label" for="inputPort">Port</label>
		    		<div class="controls">
			    		<input type="text" id="inputPort" name="port" placeholder="3306">
			    	</div>
			    </div>
			    <div class="control-group">
			    	<div class="controls">
				    	<label class="checkbox">
					    	<input type="checkbox" name="database_overwrite" value="true" /> Overwrite existing Attract DB
					    </label>
					    
					</div>
			    </div>
			    <div class="control-group">
			    	<label class="control-label" for="inputUsername">DB Username</label>
		    		<div class="controls">
			    		<input type="text" id="inputUsername" name="attractUser" value="root">
			    	</div>
			    </div>
			    <div class="control-group">
			    	<label class="control-label" for="inputPassword">DB Password</label>
		    		<div class="controls">
			    		<input type="password" id="inputPassword" name="attractPassword" value="root">
			    	</div>
			    </div>
			    <div class="control-group">
			    	<div class="controls">
			    		<input type="hidden" name="stage2" value="true">
			    		<button type="submit" class="btn">Install Attract!</button>
			    	</div>
			    </div>
		    </form>		


</div>
</div>
</section>
		</div>
	
	
	</body>
</html>

<?php
    }
# //  function to display error message when setup failed
function display_error_and_die($error_msg) {
	echo "<p class=\"warning\"><strong>Warning</strong><br />";
	echo "<br/>$error_msg<br/>";
	echo "Setup unsuccessful, please go back to <a href=\"javascript:history.go(-1)\">attract install</a>";
	echo "</p>";
	die();
}
?>
