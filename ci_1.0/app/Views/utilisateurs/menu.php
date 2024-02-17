
<!--<pre>
 <?= print_r($_SESSION)?> 
</pre>
-->

<!-- NAVBAR DES ROLES -->
<?php
// Si l'utilisateur est élève
    if(isset($_SESSION['user_data']['élève']))
    {
        $_SESSION['user_data']['role'] = 'élève';
        echo '
        <table>
            <tr>
                <td><a href="/">Menu</a></td>
                <td><a href="/planning">Planning</a></td>
            </tr>
        </table>
        ';
    }
// Si l'utilisateur est professeur
    elseif($_SESSION['user_data']['role'] === 'professeur')
    {
        echo '
        <table>
            <tr>
                <td><a href="">Menu</a></td>
                <td><a href="/planning">Planning</a></td>
                <td><a href="">Examens</a></td> ';

        // Si le professeur est chef
        if(isset($_SESSION['user_data']['chef']))
        {
            echo '
            <td><a href="">Professeurs</a></td>
            <td><a href="/eleves">Elèves</a></td>
            <td><a href="/cours">Cours</a></td>
            <td><a href="">Demandes</a></td>
            ';
        }
        echo '
            </tr>
        </table>
        ';
    }
?>

<!-- Body du menu (infos diverses) -->
<h2>Bienvenue <?= $_SESSION['user_data']['prénom_utilisateur']?> <?= $_SESSION['user_data']['nom_utilisateur']?></h2>
<?php if(isset($_SESSION['user_data']['professeur']['chef'])) :?>
    <p>
        <u>Chef du département </u>
    </p>

<?php else :?>
    <p>
        Rôle : <?= $_SESSION['user_data']['role']?>
    </p>
<?php endif;?>
<br/><br/>
<form method="post" action="/logout">   
    <input type="submit" value="Déconnexion"/>
</form>
