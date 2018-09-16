<?php 
require dirname(__FILE__) . '/constants.php';

foreach (glob(EKS_DIRECTORY . 'lib/*.php') as $filename) {
    include $filename;
}

foreach (glob(EKS_DIRECTORY . 'models/*.php') as $filename) {
    include $filename;
}

foreach (glob(EKS_DIRECTORY . 'controllers/*.php') as $filename) {
    include $filename;
}