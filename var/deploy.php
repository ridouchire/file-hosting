<?php
namespace Deployer;

require 'recipe/common.php';

task('unit-test', function() {
    writeln("running unit-tests");
    run('../vendor/bin/phpunit  ../app/tests');
})->local();

task('build', function() {
    writeln("make release directory");
    run('mkdir release');
    writeln("copy application files in release directory");
    run('cp -R ../app ../css ../templates ../index.php ../install.php ./release');
    writeln("delete unit-tests");
    run('cd release && rm -rf app/tests');
})->local();

task('zip', function() {
    writeln("compress release directory");
    run('cd release && tar -zcvf release.tar.gz ./*');
    writeln("delete temporary files");
    run('cd release && rm -rf app/ css/ templates/ index.php install.php');
})->local();

task('clean', function() {
    writeln("delete relese directory");
    run('rm -rf release');
})->local();

task('success', function() {
    writeln("Release builded in var/release/release.tar.gz");
})->local();

before('build', 'unit-test');
before('build', 'clean');
after('build', 'zip');
after('zip', 'success');
