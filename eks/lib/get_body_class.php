<?php 
function body_class($request) {
    $path_array = explode('/', $request->getUri()->getPath());
    $value = implode('-', array_filter($path_array));
    if ($value === '') {
        $value = 'home';
    }
    echo 'class="' . $value . '"';
}