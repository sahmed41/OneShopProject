<?php

 $pages = glob('C:\xampp\htdocs\resources\pages\*.php', GLOB_BRACE);

 foreach ($pages as $page) {
     echo $page . '<br>';
 }
?>