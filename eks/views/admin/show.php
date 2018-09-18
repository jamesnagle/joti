<?php 
use Eks\Template; ?>

<div class="row">
    <div class="block">
        <h1><?= $title ?></h1>
    </div>
</div>
<div class="row">
    <div class="block">
        <table class="admin-table">
            <thead>
                <th>&nbsp;</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Manage</th>
            </thead>
            <tbody> <?php
                if (!empty($collection)) {
                    Template::load('admin/partials/show-document-rows.php', compact('collection'));
                } else { ?>
                    <tr>
                        <td colspan="4">Looks like there aren't any pages... bummer.</td>
                    </tr> <?php
                } ?>
            </tbody>
        </table>
    </div>
</div>