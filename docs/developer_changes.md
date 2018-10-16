# PHP

### New configuration variables.
``SUPPORT_EMAIL`` - technical support email.

### Changed functions.
```php
-fn_generate_filename($filename, $tempname, $ext, $type);
+fn_generate_filename($ext, $filename, $type);
```

### Changed unit-tests.

```php
-testFnGenerateFilename($name, $temp, $ext, $type, $expected);
+testFngenerateFilename($ext, $name, $type, $expected);
```
