<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcfd073a64df71adc120c7eb50324bc1b
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcfd073a64df71adc120c7eb50324bc1b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcfd073a64df71adc120c7eb50324bc1b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
