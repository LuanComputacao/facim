/**
 * Created by luan on 13/07/16.
 */

var table = document.getElementById('table-pessoas');
formPessoa  = document.forms['form-pessoa'];

populateTable = function (response) {
    content = JSON.parse(response);
    console.log(content);
    if (content.length > 0) {
        content.forEach(function (pessoa, index) {
            var tableRow = document.createElement('tr');
            var td = '';
            if (pessoa.nome)        td += '<td>' + pessoa.nome + '</td>';
            if (pessoa.sobrenome)   td += '<td>' + pessoa.sobrenome + '</td>';
            td += '<td>';
            if (pessoa.rua)         td += pessoa.rua;
            if (pessoa.numero)      td += ', ' + pessoa.numero;
            if (pessoa.bairro)      td += ', ' + pessoa.bairro;
            if (pessoa.cidade)      td += ', ' + pessoa.cidade;
            if (pessoa.uf)          td += ' - ' + pessoa.uf;
            td += '</td>';
            tableRow.innerHTML = td;
            table.appendChild(tableRow);
        });



    } else {
        table.innerHTML = '<td colspan="3"> Não há pessoas cadastradas</td>'
    }
};

ajax("POST", "pessoa", populateTable);

document.getElementById('form-pessoa').onsubmit = function () {

    nome        = formPessoa['nome'].value;
    sobrenome   = formPessoa['sobrenome'].value;
    rua         = formPessoa['rua'].value;
    numero      = formPessoa['numero'].value;
    bairro      = formPessoa['bairro'].value;
    cidade      = formPessoa['cidade'].value;
    uf          = formPessoa['uf'].value;

    if(nome  == null || nome == '') { formErro('nome'); return false; }
    if(sobrenome  == null || sobrenome == '') { formErro('nome'); return false; }
    if (!isNaN(numero)) {formErro('', 'O campo deve conter apenas números')}

    ajax('POST', 'pessoa/create', function (response) {
        console.log(response);
    },
        'nome='+nome+'&'+
        'sobrenome='+sobrenome+'&'+
        'rua='+rua+'&'+
        'numero='+numero+'&'+
        'bairro='+bairro+'&'+
        'cidade='+cidade+'&'+
        'uf='+uf
    );
    formPessoa.reset();

    return false;
};

formErro = function (campo, msg) {
    var msg = msg || null;
    eCampo = document.querySelector("input[name="+campo+"]");
    if (msg != null) {
        title = document.createAttribute('title');
        title.value = msg;
        eCampo.setAttribute(title) ;
    }
    console.log(eCampo);
};
