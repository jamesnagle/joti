<?php 
use Eks\Template; ?>
<div class="row title-row">
    <div class="block block__half--xs">
        <h1><?= $title ?></h1>
    </div>
    <div class="block block__half--xs">
        <div class="control-container">
            <label for="control-saving" id="control-saving">saving...</label>
            <label for="control-status">Status:&nbsp;</label>
            <select name="status" id="control-status">
                <option value="private" <?= ($doc->status === 'private') ? 'selected' : '' ?>>Private</option>
                <option value="public" <?= ($doc->status === 'public') ? 'selected' : '' ?>>Public</option>
            </select>
            <label for="control-commit">Commit:&nbsp;</label>
            <a id="control-commit" class="btn-admin btn-sm btn-inline btn-control"><i class="far fa-check-circle"></i></a>
        </div>
    </div>    
</div>
<?php Template::load('admin/partials/editor.php', compact('doc')) ?>

<?php Template::load('admin/partials/seo.php', compact('doc')) ?>

<?php Template::load('admin/partials/revisions.php') ?>