<?php 
namespace Eks;

use Eks\Models\Document;

class Menu {

    public static function skills($args = []) { 

        $class = '';
        if (array_key_exists('class', $args)) {
            $class = $args['class'];
        }

        $skills = Document::where([
            ['type', '=', 'post'],
            ['category_id', '=', 4],
            ['status', '=', 'public']
        ])->with('lessons')->get();
        ?>
        <div class="<?= $class ?>"> <?php
            foreach ($skills as $skill) { ?>
                <div class="col">
                    <a class="skill" href="<?= $skill->uri() ?>" title="<?= $skill->title ?>"><strong><?= $skill->title ?></strong></a> <?php
                    if ($skill->lessons) { ?>
                        <ul> <?php
                            foreach($skill->lessons as $lesson) { ?>
                                <li>
                                    <a href="<?= $lesson->uri() ?>" title="<?= $lesson->title ?>"><?= $lesson->title ?></a>
                                </li> <?php
                            } ?>
                        </ul> <?php
                    } ?>
                </div> <?php
            } ?>
        </div> <?php 
    }
}