<article class='parameters'>
    <h3>Mes paramètres</h3>
    <dl>
        <?php $user = $lesInformations->fetch_assoc(); ?>
        <dt>Pseudo</dt>
        <dd><?php echo $user['alias'] ?></dd>
        <dt>Email</dt>
        <dd><?php echo $user['email'] ?></dd>
        <dt>Nombre de message</dt>
        <dd><?php echo $user['totalpost'] ?></dd>
        <dt>Nombre de "J'aime" donnés </dt>
        <dd><?php echo $user['totalgiven'] ?></dd>
        <dt>Nombre de "J'aime" reçus</dt>
        <dd><?php echo $user['totalreceived'] ?></dd>
    </dl>

</article>
