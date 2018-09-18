<div id="seo" class="row">
    <p>
        <span class="mock-serp-title"></span><br />
        <span class="mock-serp-description"></span>
    </p>
    <p>
        <span class="seo-title-friendliness-bar"></span>

        <input id="seo__title" name="seo_title" type="text" placeholder="Title" value="<?= (isset($doc->seoMeta)) ? $doc->seoMeta->title : '' ?>" />
    </p>
    <p>
        <span class="seo-description-friendliness-bar"></span>
        <textarea id="seo__description" name="seo_description"><?= (isset($doc->seoMeta)) ? $doc->seoMeta->description : '' ?></textarea>
    </p>
    <p>
        <input type="radio" name="seo_index" id="seo-do-index" value="1" <?= (isset($doc->seoMeta) && $doc->seoMeta->index === 1) ? 'checked' : '' ?> /> Index this document<br />
        <input type="radio" name="seo_index" id="seo-dont-index" value="0" <?= (isset($doc->seoMeta) && $doc->seoMeta->index === 0) ? 'checked' : '' ?> /> No-Index this document
    </p>   
    <p>
        <input type="radio" name="seo_nofollow" id="seo-do-follow" value="1" <?= (isset($doc->seoMeta) && $doc->seoMeta->nofollow === 1) ? 'checked' : '' ?> /> Follow this document<br />
        <input type="radio" name="seo_nofollow" id="seo-dont-follow" value="0" <?= (isset($doc->seoMeta) && $doc->seoMeta->nofollow === 0) ? 'checked' : '' ?> /> No-Follow this document
    </p>        
</div>