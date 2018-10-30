<?php 
use Eks\Template;

$parsedown = new Parsedown();

Template::load('head.php', $data); ?>

<div class="row center">
    <div class="block flex header">
        <h1 class="h1__title">JRN</h1>
    </div>
</div>

<div class="row">
    <div class="block">
        <div class="form-container">
            <form action="/login/" method="POST">
                <label for="user-input">Username: *</label>
                <input id="user-input" type="text" name="username" />
                <label for="password-input">Password: *</label>
                <input id="password-input" type="password" name="password" />
                <input type="hidden" name="form" value="login" />
                <input type="submit" value="Login" />
            </form>
        </div>
    </div>
</div>

<?php Template::load('footer.php', $data); ?>