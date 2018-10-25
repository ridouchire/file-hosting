<?php

namespace Deployer;
require 'recipe/common.php';
define('KERNEL', true);
require '../app/conf.php';

set('release', APP_VERSION);
set('code_path', '/root/current');
set('default_stage', 'staging');

host('demo.ume.69.mu')
    ->user('root')
    ->stage('staging')
    ->set('is_stag', 'Y')
    ->set('web_path', '/var/www/staging');

host('ume.69.mu')
    ->user('root')
    ->stage('prod')
    ->set('is_stag', 'N')
    ->set('web_path', '/var/www/html');

function print_text($text) {
    writeln("➤ $text");
}

function run_test()
{
    print_text("Running unit-tests...");
    runLocally('../vendor/bin/phpunit  ../app/tests');
}

function copy_files()
{
    print_text("Removed and create directory 'release'");
    runLocally('rm -rf release && mkdir release');
    print_text("Copy app files to release directory");
    runLocally('cp -R ../app ../css ../templates ../index.php ../install.php ./release');
    print_text('copy local_conf.php in release archive');
    runLocally('cp ../local_conf.php ./release');
}

function pack_release()
{
    print_text("Removed unit-tests dir and pack release to archive and removed temp files");
    runLocally("cd release && rm -rf app/tests && tar -zcvf release.tar.gz ./* && rm -rf app/ css/ templates/ index.php install.php");
}

task('deploy:release', function() {
    run_test();
    copy_files();
    pack_release();
})->desc('Run unit-tests and build release archive');

task('deploy:update_code', function() {;
    $release   = get('release');
    $code_path = get('code_path');
    print_text("Moved to code dir");
    cd($code_path);
    print_text("Uploaded release archive to code dir");
    upload("release/release.tar.gz", "$code_path/$release.tar.gz");
})->desc("Upload release archive to remote host");

task('deploy:restore', function() {
    $code_path = get('code_path');
    $release   = get('release');
    cd(get('web_path'));
    print_text("Removed outdated app files in production dir");
    run("rm -rf ./*");
    print_text("Copied release archive to production dir and unpacked and removed temp files");
    run("cp $code_path/$release.tar.gz ./ && tar xvf $release.tar.gz && rm $release.tar.gz");
    print_text("Run install script");
    run('php install.php && rm install.php');
    if (get('is_stag') == 'N') {
        print_text("Removed local_conf.php");
        run("rm local_conf.php");
    }
})->desc("Unpack app archive and install app");

task('deploy', function() {
    print_text("Restart php-fpm instance");
    run('/etc/init.d/php7.2-fpm restart');
});

before('deploy', 'deploy:restore');
before('deploy', 'deploy:update_code');
