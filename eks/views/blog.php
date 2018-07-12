<?php 
use Eks\Template;

Template::load('head.php', $data);

Template::load('partials/blog_roll.php', $data);

Template::load('footer.php'); ?>