/**
 * Created by luan on 13/07/16.
 */

var table = document.getElementById('table-pessoas');
formPessoa = document.forms['form-pessoa'];

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
            }
            if (pessoa.numero) {
                td += ', ' + pessoa.numero;
                tableRow.setAttribute('data-numero',pessoa.numero);
            }
            if (pessoa.bairro) {
                td += ', ' + pessoa.bairro;
                tableRow.setAttribute('data-bairro',pessoa.bairro);
            }
            if (pessoa.cidade) {
                td += ', ' + pessoa.cidade;
                tableRow.setAttribute('data-cidade',pessoa.cidade);
            }
            if (pessoa.uf) {
                td += ' - ' + pessoa.uf;
                tableRow.setAttribute('data-uf',pessoa.uf);
            }
            td += '</td>';

            tableRow.innerHTML = td;
            table.appendChild(tableRow);
        });
        activeButtons();
    } else {
        table.innerHTML = '<td colspan="3"> Não há pessoas cadastradas</td>'
    }
};

clearTable = function () {
    head = table.getElementsByTagName('thead')[0].cloneNode(true);
    table.innerHTML = '';
    table.appendChild(head);
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
    for (i = 0; i < aEditors.length; i++) {
        aEditors[i].onclick = editPessoa;
    }
};

editPessoa = function () {
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



ajax("POST", "pessoa", populateTable);

document.getElementById('form-pessoa').onsubmit = function () {

    erro = false;
    nome = formPessoa['nome'].value;
    sobrenome = formPessoa['sobrenome'].value;
    rua = formPessoa['rua'].value;
    numero = formPessoa['numero'].value;
    bairro = formPessoa['bairro'].value;
    cidade = formPessoa['cidade'].value;
    uf = formPessoa['uf'].value;

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
        ajax('POST', 'pessoa/create',
            function (response) {
                clearTable();
                ajax("POST", "pessoa", populateTable);
                formPessoa.reset();
            },
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
