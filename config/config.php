<?php

$_config = [

    /**
     * STANDARD LANGUAGE
     */
    'language' => 'pr-br',

    /**
     * CONTACT SYSTEM WITH THE TELEGRAM BOT
     */
    'botFather' => [
        'token' => '6009722740:AAEAaIwcPZgFm1XbpUQMwxsqCBvEw-lBSYc',
        'update_id' => '5778065856'
    ],

    /**
     * MYSQL BANK CONNECTION DATA
     */
    'connection' => [
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => ''
    ]
];

define('CONFIG', $_config);