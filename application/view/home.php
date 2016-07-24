<?php include('head.php'); ?>


    <div class="row">
        <h1><?php echo $title ?></h1>
    </div>
    <div class="row">
        <table class="col-1-100 t-center">
            <thead>
            <?php foreach ($pessoas[0] as $index => $pessoa) : ?>
                <td><?php echo $index; ?></td>
            <?php endforeach; ?>
            </thead>
            <tr>
                <?php foreach ($pessoas as $index => $pessoa) : ?>
                    <?php foreach ($pessoa as $prop => $value) : ?>
                        <td><?php echo $value ?></td>

                    <?php endforeach; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>

    <div class="row">Segunda Tabela</div>

<?php include('footer.php'); ?>