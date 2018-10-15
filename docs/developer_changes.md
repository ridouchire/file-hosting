# PHP

### New functions.
``fn_move_uploaded_file_to_dir($temp_path, $path)`` - Move uploaded file to directory.

### Changed functions.
```php
-fn_generate_filename($filename, $tempname, $ext, $type);
+fn_generate_filename($ext, $filename, $type);
```

### New unit-tests.

``testFnSetNotification($type, $message, $expected)`` - test for fn_set_notification.
        
### Changed unit-tests.

```php
-testFnGenerateFilename($name, $temp, $ext, $type, $expected);
+testFngenerateFilename($ext, $name, $type, $expected);
```

### New configuration variables.
``SUPPORT_EMAIL`` - technical support email.
``DEBUG`` - if true then display debug messages, otherwise there is no.
``DEVELOPMENT`` - if true then developer mode is enabled.
