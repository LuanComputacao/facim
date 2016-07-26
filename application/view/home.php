<?php include('head.php'); ?>
    <div class="row">
        <div class="col-1-100 head">
            <h1 class="t-center"><?php echo $title ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-1-100">
            <?php include('formularios/pessoa.php'); ?>
        </div>
    </div>

    <div class="container-table-pessoas">
        <div class="row">
            <div class="col-1-100 t-center">
                <h1>Pessoas</h1>
            </div>
        </div>
        <div class="row">
            <table id="table-pessoas" class=" col-1-100 t-center">
                <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Endereço</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

<?php include('footer.php'); ?>