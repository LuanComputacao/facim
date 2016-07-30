/**
 * Created by luan on 13/07/16.
 */

var table = document.getElementById('table-pessoas');
formPessoa = document.forms['form-pessoa'];
var tituloFormulario = {
    editar: 'Editar Pessoa',
    nova:   'Novo cadastro de pessoa'
};
var messages = {
    delete : 'Tem certeza que deseja deletar?'
};
formTitle = document.getElementById('form-title');

populateTable = function (response) {
    content = JSON.parse(response);
    if (content.length > 0) {

        content.forEach(function (pessoa, index) {
            var tableRow = document.createElement('tr');
            tableRow.setAttribute('data-id',pessoa.id);
            var td = '<td>' +
                '<i class=" fa fa-pencil" aria-hidden="true" data-id="'+ pessoa.id +'"></i>' +
                '<i class="fa fa-eraser" aria-hidden="true" data-id="'+ pessoa.id +'"></i>' +
                '</td>';
            if (pessoa.nome) {
                td += '<td>' + pessoa.nome + '</td>';
                tableRow.setAttribute('data-nome',pessoa.nome);
            }
            if (pessoa.sobrenome) {
                td += '<td>' + pessoa.sobrenome + '</td>';
                tableRow.setAttribute('data-sobrenome',pessoa.sobrenome);
            }
            //ENDEREÇO
            td += '<td>';
            if (pessoa.rua) {
                td += pessoa.rua;
                tableRow.setAttribute('data-rua',pessoa.rua);
            } else td += '_ ';
            if (pessoa.numero) {
                td += ', ' + pessoa.numero;
                tableRow.setAttribute('data-numero',pessoa.numero);
            } else td += ', _ ';
            if (pessoa.bairro) {
                td += ', ' + pessoa.bairro;
                tableRow.setAttribute('data-bairro',pessoa.bairro);
            } else td += ', _ ';
            if (pessoa.cidade) {
                td += ', ' + pessoa.cidade;
                tableRow.setAttribute('data-cidade',pessoa.cidade);
            } else td += ', _ ';
            if (pessoa.uf) {
                td += ' - ' + pessoa.uf;
                tableRow.setAttribute('data-uf',pessoa.uf);
            } else td += '- _ ';
            td += '</td>';

            tableRow.innerHTML = td;
            table.appendChild(tableRow);
        });
        activeButtons();
    } else {
        clearTable(true);
    }
};

clearTable = function (noData) {
    var noData = noData || false;
    tableRow = document.createElement('tr');

    head = table.getElementsByTagName('thead')[0].cloneNode(true);

    table.innerHTML = '';

    // Reconstrói a tabela com cabeçalho
    table.appendChild(head);
    if(noData){
        tableRow.innerHTML  = '<td colspan="4"> Não há pessoas cadastradas</td>';
    }

    table.appendChild(tableRow  );
};

clearForm = function () {
    formTitle.innerHTML = tituloFormulario.nova;
    formPessoa.setAttribute('data-action', 'create');
    formPessoa.reset();
};

formErro = function (campo, msg) {
    var msg = msg || null;
    eCampo = document.querySelector("input[name=" + campo + "]");
    if (msg != null) {
        title = document.createAttribute('title');
        title.value = msg;
        eCampo.setAttributeNode(title);
    }
};

activeButtons = function () {
    var aEditors = document.getElementsByClassName('fa-pencil');
    var aEraser = document.getElementsByClassName('fa-eraser');
    for (i = 0; i < aEditors.length; i++) {
        aEditors[i].onclick = editPessoa;
        aEraser[i].onclick = deletePessoa;

    }
};

editPessoa = function () {
    formTitle .innerHTML= tituloFormulario.editar;
    formPessoa.setAttribute('data-action', 'update');
    idPessoa           = this.parentNode.parentNode.getAttribute('data-id');
    nomePessoa         = this.parentNode.parentNode.getAttribute('data-nome');
    sobrenomePessoa    = this.parentNode.parentNode.getAttribute('data-sobrenome');
    ruaPessoa          = this.parentNode.parentNode.getAttribute('data-rua');
    numeroPessoa       = this.parentNode.parentNode.getAttribute('data-numero');
    bairroPessoa       = this.parentNode.parentNode.getAttribute('data-bairro');
    cidadePessoa       = this.parentNode.parentNode.getAttribute('data-cidade');
    ufPessoa           = this.parentNode.parentNode.getAttribute('data-uf');

    formPessoa['id'].value          = idPessoa;
    formPessoa['nome'].value        = nomePessoa;
    formPessoa['sobrenome'].value   = sobrenomePessoa;
    formPessoa['rua'].value         = ruaPessoa;
    formPessoa['numero'].value      = numeroPessoa;
    formPessoa['bairro'].value      = bairroPessoa;
    formPessoa['cidade'].value      = cidadePessoa;
    formPessoa['uf'].value          = ufPessoa;
};

deletePessoa = function () {
    if(confirm(messages.delete)){
        idPessoa = this.parentNode.parentNode.getAttribute('data-id');
        ajax('POST', 'pessoa/delete',
            function (response) {
                clearTable();
                //clearForm();
                ajax("POST", "pessoa", populateTable);
            },
            'id=' + idPessoa
        );
    }
};

submitFormPessoa = function () {

    erro      = false;
    action    = formPessoa.getAttribute('data-action');
    id        = formPessoa['id'].value;
    nome      = formPessoa['nome'].value;
    sobrenome = formPessoa['sobrenome'].value;
    rua       = formPessoa['rua'].value;
    numero    = formPessoa['numero'].value;
    bairro    = formPessoa['bairro'].value;
    cidade    = formPessoa['cidade'].value;
    uf        = formPessoa['uf'].value;

    if (nome == null || nome == '') {
        formErro('nome');
        return false;
    }
    if (sobrenome == null || sobrenome == '') {
        formErro('sobrenome');
        return false;
    }
    if (isNaN(numero) && numero != '') {
        formErro('numero', 'O campo deve conter apenas números');
        return false;
    }

    if(!erro) {
        ajax('POST', 'pessoa/'+ action,
            function (response) {
                clearTable();
                clearForm();
                ajax("POST", "pessoa", populateTable);
            },
            'id=' + id + '&' +
            'nome=' + nome + '&' +
            'sobrenome=' + sobrenome + '&' +
            'rua=' + rua + '&' +
            'numero=' + numero + '&' +
            'bairro=' + bairro + '&' +
            'cidade=' + cidade + '&' +
            'uf=' + uf
        );
    }

    return false;
};

ajax("POST", "pessoa", populateTable);


document.getElementById('submit-form-pessoa').onclick = function () {
    submitFormPessoa();
};