
<pre>
<!-- <?= print_r($_SESSION['logged_user'])?> -->
</pre>
<?php 
    if($_SESSION['logged_user']['role'] === 'élève')
    {
        // echo APPPATH . 'Views/utilisateurs/élève/navbar.php';
        include_once(APPPATH . 'Views/utilisateurs/élève/navbar.php');
    } 

?>

<h2>Bienvenue <?= $_SESSION['logged_user']['user_data']->prénom_utilisateur?> <?= $_SESSION['logged_user']['user_data']->nom_utilisateur?></h2>
<?php if(isset($_SESSION['logged_user']['chef'])) :?>
    <p>
        <u>Chef du département <?= $_SESSION['logged_user']['chef']->nom_département ?></u>
    </p>
<?php endif;?>
<p>
    Rôle : <?= $_SESSION['logged_user']['role']?>
</p>
<br/><br/>
<form method="post" action="/logout">   
    <input type="submit" value="Déconnexion"/>
</form>
