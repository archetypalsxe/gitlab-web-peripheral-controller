<?php

    $fileName = shell_exec("scanAndConvert.sh");
    header(
        "Content-Disposition: attachment; filename=\"" .
        basename($fileName) . "\""
    );
    header("Content-Type: application/force-download");
    header("Content-Length: " . filesize($fileName));
    header("Connection: close");

?>
