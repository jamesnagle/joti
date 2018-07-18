<?php 
$parsedown = new Parsedown(); ?>

<div class="row">
    <div class="block">
        <h1><?= $doc->title ?></h1>
        <?= $doc->body ?>
    </div>
</div>
<div class="row">
    <div class="block"><?php
        if (!empty($collection)) {
            foreach($collection as $skill) { ?>
                <article>
                    <h2><?= $skill->title ?></h2>
                    <?= $parsedown->text($skill->body) ?>
                    <a href="<?= $skill->uri() ?>" title="<?= $skill->title ?>">Learn Skill</a>
                </article> <?php
            }
        } else { ?>
            <p>Well this is embarrassing. It looks like I haven't written any skills yet. Check back soon!</p> <?php
        } ?>
    </div>
</div>