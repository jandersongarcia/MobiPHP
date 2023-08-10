<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit762062d3a82dccd9be02252947d342f5
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TelegramBot\\Api\\' => 16,
        ),
        'M' => 
        array (
            'MatthiasMullie\\PathConverter\\' => 29,
            'MatthiasMullie\\Minify\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TelegramBot\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/telegram-bot/api/src',
        ),
        'MatthiasMullie\\PathConverter\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/path-converter/src',
        ),
        'MatthiasMullie\\Minify\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/minify/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Core\\DataBase' => __DIR__ . '/../..' . '/core/class/dataBase.php',
        'Core\\HunterObfuscator' => __DIR__ . '/../..' . '/core/class/hunterObfuscator.php',
        'Core\\Mobi' => __DIR__ . '/../..' . '/core/class/mobi.php',
        'Core\\alerts' => __DIR__ . '/../..' . '/core/class/alerts.php',
        'Core\\components' => __DIR__ . '/../..' . '/core/class/components.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit762062d3a82dccd9be02252947d342f5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit762062d3a82dccd9be02252947d342f5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit762062d3a82dccd9be02252947d342f5::$classMap;

        }, null, ClassLoader::class);
    }
}
