var table;

function init() {
    showForm(false);
    findAll();    

    reloadSelect();
    $("#imagenmuestra").hide();
}

function clean() {
    $("#codigo").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#stock").val("");
    $("#imagen").val("");
    $("#idarticulo").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#print").hide();
    reloadSelect();
}

function reloadSelect() {
    $.post("../controller/ArticuloController.php?op=selectCategoria", function (options) {
        $("#idcategoria").html(options);
        $("#idcategoria").selectpicker('refresh');
    });
}

function showForm(flag) {
    clean();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnAgregar").hide();
        $("#btnAgregar2").show();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnAgregar").show();
        $("#btnAgregar2").hide();
    }
}

function cancelform() {
    claan();    
    showForm(false);
}

function findAll() {
    table = $("#tbllistado").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "Bfrtip",
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: "../controller/ArticuloController.php?op=findAll",
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[0, "desc"]]
    }).DataTable();
}

function saveorupdate() {    
    $("#btnGuardar").prop("disabled", false);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controller/ArticuloController.php?op=saveorupdate",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {            
            showForm(false);
            tabla.ajax.reload();
        }
    });
    clean();    
}

function show(idArticulo) {
    $.post("../ajax/ArticuloController.php?op=showData", {idarticulo: idArticulo}, function (getData, status) {
        data = JSON.parse(getData);
        showForm(true);        

        $("#idcategoria").val(data.idcategoria);
        $("#idcategoria").selectpicker('refresh');
        $("#codigo").val(data.codigo);
        $("#nombre").val(data.nombre);
        $("#stock").val(data.stock);
        $("#descripcion").val(data.descripcion);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/articulos/" + data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#idarticulo").val(data.idarticulo);
        getBarcode();
    });
}

var idArticuloDefuse;
function confirmDefuse(idArticulo) {
    $("#mensajeDes").html("¿Desea desactivar el Articulo?");
    $("#modal-danger").modal('show');
    idArticuloDefuse = idArticulo;

}

function defuse() {
    $.post("../controller/ArticuloController.php?op=defuse", {idarticulo : idArticuloDefuse}, function (eMessege) {
        table.ajax.reload();
    })
}

var idArticuloActivate;
function confirmActivate(idArticulo) {
    $("#mensajeAct").html("¿Desea activar el Articulo?");
    $("#modal-success").modal('show');
    idArticuloActivate = idArticulo;
}

function activate() {
    $.post("../controller/CategoriaController.php?op=activate", {idarticulo : idArticuloActivate}, function (eMessege) {
        table.ajax.reload();
    })
}

function getBarcode() {
    codigo = $("#codigo").val();
    JsBarcode("#barcode", codigo);
    $("#print").show();
}

function print() {
    $("#print").printArea();
}

init();




