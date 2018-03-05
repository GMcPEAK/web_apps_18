<?php
$file = 'stuffp.html';
$current = file_get_contents($file);
file_put_contents($file, $current.$_POST["thingy"]."</br>");
echo $file;
?>