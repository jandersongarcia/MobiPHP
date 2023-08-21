<?php

$_config = [

    /**
     * STANDARD LANGUAGE
     */
    'language' => 'en',

    /**
     * DATABASE CONNECTION SETTINGS
     */
    'database' => [
        'use' => true, // Indicates if database will be used
        'type' => 'mysql', // Default database type (mysql, postgresql, sqlite)
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database_name' => 'mobi_tasks'
    ],

    /**
     * CONTACT SYSTEM WITH THE TELEGRAM BOT
     */
    'telegram_bot' => [
        'token' => 'YOUR_TELEGRAM_BOT_TOKEN',
        'update_id' => 'YOUR_TELEGRAM_BOT_UPDATE_ID'
    ]

];

define('CONFIG', $_config);
