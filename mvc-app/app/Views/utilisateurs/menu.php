
<pre>
<!--<?= print_r($_SESSION['logged_user'])?>-->
</pre>
<h2>Bienvenue <?= $_SESSION['logged_user']['user_data']->prénom_utilisateur?> <?= $_SESSION['logged_user']['user_data']->nom_utilisateur?></h2>
<p>
    Rôle : <?= $_SESSION['logged_user']['role']?>
</p>
<br/><br/>
<form method="post" action="/logout">   
    <input type="submit" value="Déconnexion"/>
</form>
