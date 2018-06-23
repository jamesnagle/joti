<?php 
use Template\Template;

Template::load('header.php'); ?>

<div class="row center">
    <div class="block flex header">
        <div>
            <a href="" title="DL that Résumé"><i class="fas fa-file-pdf"></i></a>
            <a href="" title="Mah GitHub"><i class="fab fa-github-alt"></i></a>
            <a href="" title="I can has GitLab"><i class="fab fa-gitlab"></i></a>
        </div>
        <h1 class="h1__title"><span class="mright">James</span><span class="mleft">Nagle</span></h1>
        <div>
            <a href="" title="Dat Insta tho"><i class="fab fa-instagram"></i></a>
            <a href="" title="Twittaa"><i class="fab fa-twitter"></i></a>
            <a href="" title="Been YouTube'in, since been YouTube'in"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

<?php Template::load('partials/about_me.php') ?>

<?php Template::load('partials/skills_expertise.php') ?>

<div class="row">
    <div class="block block__half--sm">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam natus reprehenderit dolores in perspiciatis eaque fuga molestias officiis voluptate quas!</p>
        <a href="#" class="btn">Buttom Normal</a>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam <a href="#" class="btn">Button Inline</a> quod iure officiis, nisi odit?</p>
    </div>
    <div class="block block__half--sm">
        <p>Paragraph Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio, suscipit?</p>
        <p>Lorem ipsum dolor sit amet <a href="#" title="Blah">consectetur</a> adipisicing elit. Magnam, ipsam?</p>
        <ul>
            <li>Lorem ipsum dolor sit amet.</li>
            <li>Lorem ipsum dolor sit amet.</li>
            <li>Lorem ipsum dolor sit amet.</li>
            <li>Lorem ipsum dolor sit amet.</li>
            <li>Lorem ipsum dolor sit amet.</li>
        </ul>
        <ol>
            <li>Lorem ipsum dolor sit amet.</li>
            <li>Lorem ipsum dolor sit amet.</li>
            <li>Lorem ipsum dolor sit amet.</li>
            <li>Lorem ipsum dolor sit amet.</li>
            <li>Lorem ipsum dolor sit amet.</li>
        </ol>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing.</p>
        <p><strong>Lorem ipsum dolor</strong> sit amet consectetur adipisicing elit. Qui, porro. Cum laboriosam quidem dignissimos quod!</p>
    </div>
</div>

<?php Template::load('footer.php'); ?>