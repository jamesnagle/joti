<?php 
use Eks\Template;

Template::load('head.php', $data); ?>

<div class="row">
    <div class="block">
        <h1>404 - Oh No!</h1>
    </div>
</div>

<?php Template::load('footer.php', $data); ?>