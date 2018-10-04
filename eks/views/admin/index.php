<?php 
use Eks\Template;
use Eks\Models\Document;
use Eks\Controllers\AdminController;

$parsedown = new Parsedown();

$type = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'dashboard';
$action = (array_key_exists('action', $_GET)) ? $_GET['action'] : 'show';
$id = (array_key_exists('id', $_GET)) ? $_GET['id'] : null;

$controller = new AdminController($response);

Template::load('admin/head.php', $data); 

Template::load('admin/sidebars.php', $data); ?>

<div id="admin-body"> <?php
    switch ($type) {
        case 'dashboard':
            Template::load('admin/dashboard.php');
            break;
        case 'media':
            Template::load('admin/media.php');
            break;   
        case 'user':
            Template::load('admin/user.php');
            break;     
        default:
            $controller->method($_SERVER['REQUEST_METHOD'])->type($type)->action($action)->get($id);
            break;
    } ?>
</div>

<?php Template::load('admin/footer.php'); ?>