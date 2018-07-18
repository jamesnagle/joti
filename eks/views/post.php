<?php 
use Eks\Template;

$parsedown = new Parsedown();

Template::load('head.php', $data); ?>

<div class="row">
    <div class="block">
        <?php echo $parsedown->text($doc->body); ?>
    </div>
</div>

<?php Template::load('footer.php'); ?>