<?php 
require dirname(__FILE__) . '/constants.php';

/**
 * Load all PHP files in ./eks/lib
 */
foreach (glob(EKS_DIRECTORY . 'lib/*.php') as $filename) {
    include $filename;
}