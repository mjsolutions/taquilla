<?php
session_start();
session_destroy();

header("Location: http://localhost/taquilla/index.php");
?>