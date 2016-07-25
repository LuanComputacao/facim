<?php include('head.php'); ?>
    <div class="row">
        <div class="col-1-100">
            <h1 class="t-center"><?php echo $title ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-1-100">
            <?php include('formularios/pessoa.php');?>
        </div>
    </div>

    <div class="container-table-pessoas" >
        <div class="row">
            <div class="col-1-100 t-center">
                <h1>Pessoas</h1>
            </div>
        </div>
        <div class="row">
            <table  id="table-pessoas" class=" col-1-100 t-center">
                <thead>
                <td>Nome</td>
                <td>Sobrenome</td>
                <td>Endereço</td>
                </thead>
            </table>
        </div>
    </div>

<?php include('footer.php'); ?>