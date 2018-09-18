<?php 
use Eks\Template;

Template::load('admin/partials/main-menu.php');

$type = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'dashboard';
$action = (array_key_exists('action', $_GET)) ? $_GET['action'] : 'dashboard';
$title = ucwords($type);
$payload = compact('type', 'action', 'title'); ?>

<div class="menu__controls"> <?php
    switch ($type) {
        case 'page':
            Template::load('admin/partials/controls-generic.php', $payload);
            break;
        case 'post':
            Template::load('admin/partials/controls-generic.php', $payload);
            break;            
        case 'skill':
            Template::load('admin/partials/controls-skills.php');
            break;
        default:
            break;
    }
    if ($action === 'new' || $action === 'edit') { ?>
        <hr />
        <p>
            <a href="#editor" class="btn-admin menu-btn active"><i class="far fa-edit"></i> Editor</a>
        </p>
        <p>
            <a href="#seo" class="btn-admin menu-btn"><i class="fab fa-google"></i> SEO</a>
        </p>
        <p>
            <a href="#revisions" class="btn-admin menu-btn"><i class="fas fa-code-branch"></i> Revisions</a>
        </p> <?php
    } ?>
</div>