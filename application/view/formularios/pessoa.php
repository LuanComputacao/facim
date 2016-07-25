<h1 class="t-center ">Cadastrar pessoa</h1>
<form id="form-pessoa" method="post" action="/pessoa/create" onsubmit="return validateForm()">
    <fieldset>
        <legend>Cadastro de pessoas</legend>
        <input placeholder="Nome"       name="nome"          maxlength="24" size="24" type="text"><br/>
        <input placeholder="Sobrenome"  name="sobrenome"     maxlength="24" size="24" type="text"><br/>
    </fieldset>
    <fieldset>
        <legend>Endereço</legend>
        <input placeholder="Rua"    name="rua"     maxlength="24"   size="24"   type="text">
        <input placeholder="Nº"     name="numero"  maxlength="6"    size="6"    type="text"><br/>
        <input placeholder="Bairro" name="bairro"  maxlength="50"   size="50"   type="text"><br/>
        <input placeholder="Cidade" name="cidade"  maxlength="45"   size="45"   type="text">
        <input placeholder="UF"     name="uf"      maxlength="2"    size="2"    type="text"><br/>
    </fieldset>
    <div class="col-1-100 t-center">
        <input type="submit" value="Enviar">
    </div>
</form>