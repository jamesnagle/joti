<?php 
foreach ($collection as $doc) { ?>
    <tr class="lesson-row skill-<?= $parent_id?>">
        <td>&nbsp;</td>
        <td>&mdash; <?= $doc->title ?></td>
        <td><?= $doc->uri() ?></td>
        <td><?= $doc->status ?></td>
        <td><a href="<?= $doc->uri('edit') ?>" title="Edit Page">Edit</a> | <a href="<?= $doc->uri('destroy') ?>" title="Delete Page">Delete</a></td>
    </tr> <?php
}