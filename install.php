<?php

require __DIR__.'/app/conf.php';

echo "==============\n";
echo 'Installation '.APP_VERSION."\n";
echo "-------------\n";

if (is_dir(__DIR__.'/files') == true) {
    echo "Directory '/files' already exists\n";
} else {
    echo "Create directory ./files \n";
    try {
        mkdir(__DIR__.'/files');
    } catch (Exception $e) {
        echo "Cannot create directory /files!\n Check permission on read/write for ./".__DIR__."\n";
    }
}

echo "-------------\n";
echo "Set permission for directory ./files \n";
try {
    chmod(__DIR__.'/files', 0777);
} catch (Exception $e) {
    echo "Cannot set permission for directory /files \n";
}

echo "-------------\n";
echo "Installation completed \n";
echo "==============\n";
