<?php

//import all files from directory
$dir = scandir(__DIR__);
foreach ($dir as $file) {
	if ($file != '.' && $file != '..' && $file != 'autoload.php') {
		include $file;
	}
}

?>