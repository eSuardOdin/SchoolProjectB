<form method="post" action="/">
    <?= csrf_field() ?>
    <label for="login">Login</label>
    <input type="input" name="login" value="<?= set_value('login')?>">
    <br/>

    <label for="password">Password</label>
    <input type="password" name="password" value="<?= set_value('password')?>">
    <br/>

    <input type="submit" name="submit" value="Connect">