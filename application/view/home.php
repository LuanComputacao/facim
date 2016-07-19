<?php include('head.php'); ?>

    <div class="container">
        <div class="row">
            <h1>Teste</h1>
        </div>
        <div class="row">
            <ul>
                <?php foreach ($pessoas as $ket => $value) : ?>
                    <li><?php echo $value['nome'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

<?php include('footer.php'); ?>