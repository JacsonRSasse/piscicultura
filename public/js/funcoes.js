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
