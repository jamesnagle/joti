<?php 
require dirname(__FILE__) . '/constants.php';

foreach (glob(EKS_DIRECTORY . '/lib/*.php') as $filename) {
    include $filename;
}