<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcffa3cd8d4c5f952d154e49b5ead9dd8
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcffa3cd8d4c5f952d154e49b5ead9dd8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcffa3cd8d4c5f952d154e49b5ead9dd8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcffa3cd8d4c5f952d154e49b5ead9dd8::$classMap;

        }, null, ClassLoader::class);
    }
}
