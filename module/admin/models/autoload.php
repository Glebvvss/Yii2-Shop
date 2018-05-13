<?php

//import all files from directory
$dir = scandir(__DIR__);
foreach ($dir as $file) {
    $extension = explode('.', $file );
	if ($file != '.' && $file != '..' && $file != 'autoload.php' && $extension[1]) {
		include $file;
	}
}

?>