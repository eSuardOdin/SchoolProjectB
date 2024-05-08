<?php
echo '
    <form method="get" action="' . $_SESSION['action_result']['adresse'] . '">
        <input type="submit" value="Retour">
    <form/>
    <p><strong>'. $_SESSION['action_result']['message'] .'</strong></p>
    ';

    session()->remove('action_result');