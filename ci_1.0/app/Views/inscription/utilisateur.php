<form method="post" action ="inscription/utilisateur">
    <label for="nom">Nom : </label>
    <input type="text" name="nom"/>
    <label for="prénom">Prénom : </label>
    <input type="text" name="prénom"/>

    <select id="famille_instrument">
    <?php
        if(isset($_SESSION['famille_instrument']))
        {
            foreach ($_SESSION['famille_instrument'] as $famille) {
                echo '
                <option value="' . $famille . '">' . $famille . '</option>
                ';
            }
        }
    ?>
    </select>
</form>