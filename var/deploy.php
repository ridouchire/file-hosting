<?php

namespace Deployer;
require 'recipe/common.php';
define('KERNEL', true);
require '../app/conf.php';

set('release', APP_VERSION);
set('code_path', '/root/current');
set('default_stage', 'staging');
set('build_dir', 'release');

host('demo.ume.69.mu')
    ->user('root')
    ->stage('staging')
    ->set('is_stag', 'Y')
    ->set('web_path', '/var/www/staging');

host('area4japan')
    ->user('root')
    ->stage('production')
    ->set('is_stag', 'N')
    ->set('env_path', '/home/image-hosting')
    ->set('web_path', '/home/image-hosting/web');

function print_text($text, $prefix = '') {
    if ($prefix == 'S') {
        writeln("✔ $text");
    } else {
        writeln("➤ $text");
    }
}

function run_test()
{
    print_text("Running unit-tests...");
    runLocally('../vendor/bin/phpunit  ../app/tests');
    print_text("Tests passed!", 'S');
}

function copy_files()
{
    print_text("Creating directory " . get('build_dir'));
    runLocally(
        'rm -rf '
        . get('build_dir')
        . ' && mkdir '
        . get('build_dir')
    );

    print_text("Copying app files to " . get('build_dir') . " directory");
    runLocally(
        'cp -R ../app ../css ../templates ../index.php ../install.php '
        . get('build_dir')
    );

    print_text('Copying local_conf.php in ' . get('build_dir') . ' archive');
    runLocally('cp ../local_conf.php ' .get('build_dir'));
}

function pack_release()
{
    print_text("Removing unit-tests dir and packing release to archive and removing temp files");
    runLocally("cd " . get('build_dir') . " && rm -rf app/tests && tar -zcvf release.tar.gz ./* && rm -rf app/ css/ templates/ index.php install.php");
}

task('build_release', function() {
    print_text("Building release archive");
    run_test();
    copy_files();
    pack_release();
    print_text("Release archive was builded!", "S");
});

task('upload_code', function() {
    cd(get('code_path'));
    print_text("Uploading release archive to deploy server");
    upload(
        get('build_dir') . "/release.tar.gz",
        get('code_path') . "/" . get('release') . ".tar.gz"
    );
    print_text("Release archive was uploaded to deploy server!", "S");
});

task('restore_app', function() {
    cd(get('web_path'));
    print_text("Copying release archive to production dir and unpacked and removed temp files");
    run(
        "cp " . get('code_path') . "/" . get('release') . ".tar.gz ./"
        . " && tar xvf " . get('release') . ".tar.gz"
        . " && rm " . get('release') . ".tar.gz"
    );

    if (get('is_stag') == 'N') {
        print_text("Removing local_conf.php for production deploy");
        run("rm local_conf.php");
    }
    print_text("App was restored in production directory", "S");
});

task('deploy', function() {
    if (get('is_stag') == 'N') {
        cd(get('env_path'));
        print_text("Restarting container");
        run('docker-compose restart');
    }
    cd(get('web_path'));
    print_text("Running script install");
    run('curl http://localhost/install.php');
    print_text("App was installed!", 'S');
});

before('deploy', 'restore_app');
before('deploy', 'upload_code');
