<?php
session_start();
header( 'Location: login.php?rand=' . rand( 1 , 100 ) , true , 303 );
?>