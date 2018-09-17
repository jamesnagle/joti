<div class="row">
    <div class="block">
        <h2><?= $title ?></h2>
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
                    foreach ($collection as $page) { ?>
                        <tr>
                            <td><?= (!$page->lessons->isEmpty()) ? '<a data-id="' . $page->id . '" class="expander" title="Expand Lessons" aria-expanded="false"><i class="fas fa-plus"></i></a>' : '&nbsp;'; ?></td>
                            <td><?= $page->title ?></td>
                            <td><?= $page->uri() ?></td>
                            <td><?= $page->status ?></td>
                            <td><a href="/admin/?type=<?= $page->type() ?>&action=edit&id=<?= $page->id ?>" title="Edit Page">Edit</a> | <a href="/admin/?type=<?= $page->type ?>&action=destory&id=<?= $page->id ?>" title="Delete Page">Delete</a></td>
                        </tr> <?php
                        foreach ($page->lessons as $lesson) { ?>
                            <tr class="lesson-row skill-<?= $page->id ?>">
                                <td>&nbsp;</td>
                                <td>&mdash; <?= $lesson->title ?></td>
                                <td><?= $lesson->uri() ?></td>
                                <td><?= $lesson->status ?></td>
                                <td><a href="/admin/?type=lesson&action=edit&id=<?= $lesson->id ?>" title="Edit Page">Edit</a> | <a href="/admin/?type=<?= $page->type ?>&action=destory&id=<?= $page->id ?>" title="Delete Page">Delete</a></td>
                            </tr> <?php
                        }
                    }
                } else { ?>
                    <tr>
                        <td colspan="4">Looks like there aren't any pages... bummer.</td>
                    </tr> <?php
                } ?>
            </tbody>
        </table>
    </div>
</div>