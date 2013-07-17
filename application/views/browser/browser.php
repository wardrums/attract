<h1><?=$virtual_root?></h1>
<h2><?='/'.$path_in_url?></h2>
<ul class="files">
<?php
    $prefix = $controller.'/'.$virtual_root.'/'.$path_in_url;
    if (!empty($dirs)) foreach( $dirs as $dir )
        echo '<li class="dir"><i class="icon-folder-close"></i> ' . anchor($prefix.$dir['name'], $dir['name'], array('class' => 'browser_link')) . '</li>';

    if (!empty($files)) foreach( $files as $file )
        echo '<li class="file" path="' . $path_in_url.$file['name'] . '"><i class="icon-file"></i> ' . anchor($prefix.$file['name'], $file['name'], array('class' => 'browser_link')) . '</li>';
?>
</ul>