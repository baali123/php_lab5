<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitea88d0a8b049105286937e0f259be9e7
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'View\\' => 5,
        ),
        'M' => 
        array (
            'Model\\' => 6,
        ),
        'C' => 
        array (
            'Controller\\' => 11,
            'Config\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'View\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/View',
        ),
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Model',
        ),
        'Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Controller',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Config',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitea88d0a8b049105286937e0f259be9e7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitea88d0a8b049105286937e0f259be9e7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitea88d0a8b049105286937e0f259be9e7::$classMap;

        }, null, ClassLoader::class);
    }
}
