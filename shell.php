<?php
$health_path = "checkExplorer.php";
echo shell_exec('php '.escapeshellarg($health_path));
