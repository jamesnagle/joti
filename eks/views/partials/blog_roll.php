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
            foreach($collection as $post) { ?>
                <article>
                    <h2><?= $post['title'] ?></h2>
                    <?= $parsedown->text($post['body']) ?>
                    <a href="<?= $post['slug'] ?>" title="<?= $post['title'] ?>">Read More</a>
                </article> <?php
            }
        } else { ?>
            <p>Well this is embarrassing. It looks like I haven't written anything yet. Check back soon!</p> <?php
        } ?>
    </div>
</div>