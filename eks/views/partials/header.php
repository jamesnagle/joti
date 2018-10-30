<?php 
use Eks\Menu; ?>

<header id="nav">
    <div class="container">
        <div class="row">
            <div class="block block__fourth--sm">
                <h1 class="h1__title menu">JRN</h1>
            </div>
            <div class="block block__three-fourth--sm">
                <nav>
                    <ul>
                        <li><a href="/about/" title="Resume, links, that type of stuff">About Me</a></li>
                        <li><a href="/blog/" title="Sometimes I write about things">Blog</a></li>
                        <li>
                            <a title="I've written a few WP plugins">Download Plugins <i class="fas fa-chevron-down"></i></a>
                        </li>                        
                        <li>
                            <a title="How To's about Things">Learn Skills <i class="fas fa-chevron-down"></i></a>
                            <?php Menu::skills(['class' => 'sub-menu']) ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="container">