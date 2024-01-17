<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;

class Filters extends BaseConfig
{
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => AuthFilter::class, // Tambahkan alias 'auth'
    ];

    // File: app/Config/Filters.php

public $globals = [
    'before' => [
        'auth' => ['except' => ['login']],
    ],
    'after' => [
        'toolbar',
    ],
];


    public $methods = [];

    public $filters = [];
}
$psr4 = [
    'App' => APPPATH,  // ...
    'Config' => APPPATH . 'Config',
    'App\Filters' => APPPATH . 'Filters',  // Pastikan ini ada
];
