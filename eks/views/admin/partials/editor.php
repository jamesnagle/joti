<div id="editor" class="row">
    <p>
        <input id="editor__title" name="title" type="text" placeholder="Title" value="<?= (isset($doc)) ? $doc->value('title') : '' ?>" />
    </p>
    <textarea id="editor__body" name="body"><?= (isset($doc)) ? $doc->value('body') : '' ?></textarea> 
</div>