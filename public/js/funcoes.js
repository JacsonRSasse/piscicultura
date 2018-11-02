$(document).ready(function() {
    $('.collapsible').collapsible();
    $('#consulta_padrao>tbody>tr').click(function(){
        selecionaLinha(this);
    });
    $('#seleciona_tudo').click(function(){
        var oTable = document.getElementById('consulta_padrao');
        var aLinha = oTable.getElementsByTagName('tr');
        var bCheck = this.checked;
        this.checked = !bCheck;
        $.each(aLinha, function(){ selecionaLinha(this, bCheck); });
    });
    $('#example').DataTable();
});

function selecionaLinha(oLinha, bCheckTodos){
    debugger;
    var bCheck = oLinha.firstElementChild.firstElementChild.firstElementChild.checked;
    if(bCheck != bCheckTodos) {
        oLinha.firstElementChild.firstElementChild.firstElementChild.checked = !bCheck;
    }
    ativaOuNaoAcaoGrid();
}

function ativaOuNaoAcaoGrid(){
    var aAcaoGrid = document.getElementsByClassName('acoes_com_grid');
    var oTable = document.getElementById('consulta_padrao');
    var aLinha = oTable.getElementsByTagName('tr');
    var aBotoes   = aAcaoGrid[0].getElementsByTagName('a');
    var bCheck = false;
    $.each(aLinha, function(){
        if(this.firstElementChild.firstElementChild.firstElementChild.checked && !bCheck){
            bCheck = true;
        }
    });
    $.each(aBotoes, function() {
        if(bCheck){
            this.classList.remove('disabled');
        } else {
            this.classList.add('disabled');
        }
    });
}

$( function() {
    $( ".draggable" ).draggable();
} );

function adicionaClassDraggable(){
    $(".draggable").on('mousedown', this, function(){
        $( ".draggable" ).parent().draggable({ disabled: false });
    });
    $(".draggable").on('mouseup', this, function(){
        $( ".draggable" ).parent().draggable({ disabled: true });
    });
}

function abrirJanela(){
//	$.get('/getJson', function(xRetorno){
//            debugger;
//            var oInput = document.createElement('input');
//            oInput.name = 'input_'+xRetorno.nome;
//            oInput.value = xRetorno.nome;
//            document.body.appendChild(oInput);
//            
//	});
    var oDivPai = document.createElement('div');
    oDivPai.className = 'janela';
    
    var oDiv = criaCabecalho();
    oDivPai.appendChild(oDiv);
    document.body.appendChild(oDivPai);
    adicionaClassDraggable();
}

function criaCabecalho(){
    var oCabecalho = document.createElement('div');
    oCabecalho.className = 'draggable';
    return oCabecalho;
    
}
