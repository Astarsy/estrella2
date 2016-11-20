<?php
namespace Deployer;
require 'recipe/common.php';

// Configuration
set('repository', 'git@github.com:Astarsy/estrella2.git');
set('shared_files', []);
set('shared_dirs', []);
set('writable_dirs', []);

// Servers

// server('prod', 'tkaniestrella.ru')
//     ->user('u0087171')
//     ->password('cP2u!c!q')
//     ->set('deploy_path', '~/')
//     ->set('branch','master');

server('vps', 'gladkov.xyz')
    ->user('webuser')
    ->password('123')
    ->set('deploy_path', '~/');

// Tasks

// desc('Restart PHP-FPM service');
// task('php-fpm:restart', function () {
//     // The user must have rights for restart service
//     // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
//     run('sudo systemctl restart php-fpm.service');
// });
// after('deploy:symlink', 'php-fpm:restart');

desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

after('deploy', 'success');