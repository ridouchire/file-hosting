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
    ->set('stag_path', '/var/www/staging');

host('ume.69.mu')
    ->user('root')
    ->stage('prod')
    ->set('prod_path', '/var/www/html');

task('deploy:release', function() {
    $stag = ask('Is staging deploying? [Y]', false);
    run('../vendor/bin/phpunit  ../app/tests');
    run('rm -rf release && mkdir release');
    run('cp -R ../app ../css ../templates ../index.php ../install.php ./release');
    if ($stag == 'Y') {
        write('copy local_conf.php in release archive');
        run('cp ../local_conf.php ./release');
    }
    run("cd release && rm -rf app/tests && tar -zcvf release.tar.gz ./* && rm -rf app/ css/ templates/ index.php install.php");
})->local()->desc('Run unit-tests and build release archive');

task('deploy:update_code', function() {
    $release   = get('release');
    $code_path = get('code_path');
    cd($code_path);
    upload("release/release.tar.gz", "$code_path/$release.tar.gz");
})->desc("Upload release archive to remote host");

task('deploy:restore', function() {
    $stag_path = get('stag_path');
    $code_path = get('code_path');
    $release   = get('release');
    cd($stag_path);
    run("rm -rf ./*");
    run("cp $code_path/$release.tar.gz ./ && tar xvf $release.tar.gz && rm $release.tar.gz && rm -rf files");
    run('php install.php && rm install.php');
})->desc("Unpack app archive and install app");

task('deploy', function() {
    run('/etc/init.d/nginx restart');
    run('/etc/init.d/php7.2-fpm restart');
});

before('deploy', 'deploy:release');
after('deploy:release', 'deploy:update_code');
after('deploy:update_code', 'deploy:restore');
