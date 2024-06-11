<?php
$session = session(); 

?>
<a href="/menu">Retour</a>
<?php if(!isset($_SESSION['promotion']) || !$_SESSION['promotion']['statut']): ?>
    <form method="post" action="/inscription/demande_promotion">
        <input type="hidden" name="id_cycle" id="id_cycle" value="<?php echo $session->get('promotion')['id']; ?>"/>
        <label for="demande_promotion">Demande de promotion : </label>
        <input type="submit" name="demande_promotion" id="demande_promotion" value ="<?php echo $session->get('promotion')['nom']; ?>"/>
    </form>

<?php else: ?>
    <h2>Vous avez déjà une demande de promotion en cours pour le cycle <?php echo $session->get('promotion')['nom']; ?></h2>
<?php endif; ?>

<?php
// $session->remove('promotion');
