<?php 
use Eks\Template;

foreach ($collection as $doc) { ?>
    <tr>
        <td><?= (!$doc->lessons->isEmpty()) ? '<a data-id="' . $doc->id . '" class="expander" title="Expand Lessons" aria-expanded="false"><i class="fas fa-plus"></i></a>' : '&nbsp;'; ?></td>
        <td><?= $doc->title ?></td>
        <td><?= $doc->uri() ?></td>
        <td><?= $doc->status ?></td>
        <td><a href="<?= $doc->uri('edit') ?>" title="Edit Page">Edit</a> | <a href="<?= $doc->uri('destroy') ?>" title="Delete Page">Delete</a></td>
    </tr> <?php
    Template::load('admin/partials/show-lesson-rows.php', [
        'parent_id'     => $doc->id,
        'collection'    => $doc->lessons
    ]);
}