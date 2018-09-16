<?php 
use Eks\Template;

$parsedown = new Parsedown();

$admin_page = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'dashboard';

Template::load('admin/head.php', $data); ?>

<div class="row">
    <div class="block__fourth">
        <div id="logo">
            <a href="/" title="Back to Homepage"><i class="fas fa-home"></i></a>
        </div>
        <nav class="side-nav">
            <ul>
                <li>
                    <a href="/admin/?type=page">Pages</a>
                </li>
                <li>
                    <a href="/admin/?type=post">Posts</a>
                </li>
                <li>
                    <a href="/admin/?type=skill">Skill</a>
                </li>
                <li>
                    <a href="/admin/?type=media">Media</a>
                </li>
                <li>
                    <a href="/admin/?type=user">Users</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>
                    <a href="/logout/">Logout</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="block__three-fourth"> <?php
        switch ($admin_page) {
            case 'page':
                Template::load('admin/page.php');
                break;
            case 'post':
                Template::load('admin/post.php');
                break; 
            case 'skill':
                Template::load('admin/skill.php');
                break;
            case 'media':
                Template::load('admin/media.php');
                break;   
            case 'post':
                Template::load('admin/user.php');
                break;     
            default:
                Template::load('admin/dashboard.php');
                break;
        } ?>
    </div>
</div>

<?php Template::load('admin/footer.php'); ?>