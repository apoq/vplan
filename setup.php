<?php
/**
 * Application build script
 */

define('DS', DIRECTORY_SEPARATOR, true);

$pfx = __DIR__;
$propelBinPath = $pfx . '/vendor/bin/propel';

/**
 * Recursive chmod
 *
 * @param string  $path
 * @param integer $perms
 */
function chmod_r($path, $perms = 0777) {
    $dir = new DirectoryIterator($path);
    foreach ($dir as $item) {
        chmod($item->getPathname(), $perms);
        if ($item->isDir() && !$item->isDot()) {
            chmod_r($item->getPathname());
        }
    }
}

/**
 * Run composer install
 */
function vp_runcomposer()
{
    echo '-- Running composer install' . PHP_EOL;
    exec('php composer.phar install');
}

/**
 * Configure propel
 */
function vp_config()
{
    global $propelBinPath;

    echo '-- Syncing propel config' . PHP_EOL;
    exec('php ' . $propelBinPath . ' config:convert');
}

/**
 * Run migrations
 */
function vp_migrate()
{
    global $propelBinPath;

    echo '-- Running migrations' . PHP_EOL;
    exec('php ' . $propelBinPath . ' migration:diff');
    exec('php ' . $propelBinPath . ' migrate');
}

/**
 * Generate propel models
 */
function vp_build_models()
{
    global $propelBinPath;

    echo '-- Generating models' . PHP_EOL;
    exec('php ' . $propelBinPath . ' model:build');
}

/**
 * Create missing directories and persist permissions
 *
 * @param integer $perms
 */
function vp_set_permissions($perms = 0777)
{
    global $pfx;

    echo '-- Setting up permissions' . PHP_EOL;

    $pathes = [
        DS.'cache'.DS.'views',
    ];

    foreach ($pathes as $path) {
        echo 'Setting chmod for: ' . $path . PHP_EOL;
        if (!file_exists($pfx . $path)) {
            mkdir($pfx . $path, $perms, true);
        }

        chmod_r($pfx . $path, $perms);
    }
}

vp_runcomposer();
vp_config();
vp_migrate();
vp_build_models();
vp_runcomposer();
vp_set_permissions();