<?php 
function bootstrap_app($files_to_bootstrap, $app) {
    foreach ($files_to_bootstrap as $filename) {
        $full_path = EKS_DIRECTORY . $filename;
        if (file_exists($full_path)) {
            include $full_path;
        } else {
            throw new \Exception("Bootstrapped file {$full_path} not found");
        }
    }
}