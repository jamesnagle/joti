<?php 
use Eks\Template;

Template::load('admin/partials/main-menu.php');

$admin_page = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'dashboard';?>

<div class="menu__controls"> <?php
    switch ($admin_page) {
        case 'skill':
            Template::load('admin/partials/controls-skills.php');
            break;
        default:
        $title = ucwords($admin_page); ?>
        <p>
            <a href="/admin/?type=<?= $admin_page ?>&action=new" class="admin-btn" title="Create a new <?= $title ?>"><i class="far fa-plus-square"></i> New <?= $title ?></a>
        </p> <?php
            break;
    } ?>
</div>