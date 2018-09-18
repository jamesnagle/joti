<div id="editor" class="row">
    <p>
        <input id="editor__title" name="title" type="text" placeholder="Title" value="<?= (isset($doc)) ? $doc->title : '' ?>" />
    </p>
    <textarea id="editor__body" name="body"><?= (isset($doc)) ? $doc->body : '' ?></textarea>
</div>