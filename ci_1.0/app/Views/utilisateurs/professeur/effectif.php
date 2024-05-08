<?php
$session = session();

if(isset($session->get('élèves')['chef']))
{
    echo '<h3><u>Elèves du département ' . $session->get('user_data')['professeur']['chef']['nom_département'] . '</u></h3>';
    echo '
    <table>
        <tr>
            <th>Nom</th>
            <th>Instrument</th>
            <th>Cycle</th>
        </tr>
    ';
    foreach ($session->get('élèves')['chef'] as $e)
    {
        echo '
        <tr>
            <td>'. $e["élève"] . '</td>' . '
            <td>'. $e["instrument"] . '</td>' . '
            <td>'. $e["cycle"] . '</td>
        </tr>';
    }
    echo '</table>';
}