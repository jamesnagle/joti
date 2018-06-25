<?php
/**
 * Always .Gitignore
 **/ 
$creds = import(EKS_DIRECTORY . 'creds.php');

return [
    'database' => [
        'local'      => $creds['local']['database'],
        'production' => $creds['production']['database']
    ],
    /**
     * Manually load files in below array. Files need access to $app
     */
    'bootstrap' => [
        'routes.php'
    ]
];