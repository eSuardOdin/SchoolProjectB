<?php
if(isset($_SESSION['demandes']))
{
    echo '<h1>Demandes d\'inscription</h1>';
    echo '<p>Il y a ' . count($_SESSION['demandes']) . ' demandes à traiter.';
}