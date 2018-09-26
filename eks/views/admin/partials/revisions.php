<div id="revisions" class="row">
    <div class="block"> <?php 
        if (isset($doc)) { 
            if (!$doc->revisions->isEmpty()) {
                foreach ($doc->revisions as $revision) {
                    echo $revision->toHTML();
                }
            } else { ?>
                <p>No revisions yet... time to get writing!</p> <?php
            }
        } else { ?>
            <p>Hmmm... Something went wrong</p> <?php
        } ?>
    </div>
</div>