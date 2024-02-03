<h2>Bienvenue <?= esc($_SESSION['nom']) . ' ' . esc($_SESSION['prénom'])?></h2>
<br/><br/>
<form method="post" action="/logout">
    <input type="submit" value="Déconnexion"/>
</form>
