<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Driver
    |--------------------------------------------------------------------------
    |
    | The Laravel queue API supports a variety of back-ends via an unified
    | API, giving you convenient access to each back-end using the same
    | syntax for each one. Here you may set the default queue driver.
    |
    | Supported: "sync", "beanstalkd", "sqs", "iron"
    |
    */

    'default' => 'sqs',

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sqs',
        ],

        'redis' => [
            'driver' => 'redis',
            'host'   => '127.0.0.1',
            'port'   => 6379,
            'queue'  => 'tms'
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host'   => 'localhost',
            'queue'  => 'default',
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key'    => 'AKIAILVBLTKQ24T2CSSA',
            'secret' => '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',
            'queue'  => 'https://sqs.us-east-1.amazonaws.com/187114360716/tms-development-sa',
            'region' => 'us-east-1',
        ],

        'iron' => [
            'driver'  => 'iron',
            'project' => '53022a3c4ebc36000500001a',
            'token'   => 'x8MZefZKYAMwyhoGg6DvZRx5bng',
            'queue'   => 'photoshop-template-queue',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control which database and table are used to store the jobs that
    | have failed. You may change them to any database / table you wish.
    |
    */

    'failed' => [
        'database' => 'mysql', 'table' => 'failed_jobs',
    ],

];
