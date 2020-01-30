var table;
var bootbox;

function init() {
    showForm(false);
    findAll();
}

function showForm(flag) {
    clean();
    if (flag) {
        $("#formularioregistros").show();
        $("#listadoregistros").hide();
        $("#btnGuardar").prop("disable", false);
        $("#btnAgregar").hide();
        $("#btnAgregar2").show();
    } else {
        $("#formularioregistros").hide();
        $("#listadoregistros").show();
        $("#btnAgregar").show();
        $("#btnAgregar2").hide();
    }
}

function clean() {
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#idcategoria").val("");
}

function cancelForm() {
    clean();
    showForm(false);
}

function findAll() {
    console.log("estoy listando");
    table = $("#tblListado").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../controller/CategoriaController.php?op=findAll',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [[0, "desc"]]//Ordenar (columna,orden)
    }).DataTable();
}

function saveorupdate() {
    $("#btnGuardar").prop("disable", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controller/CategoriaController.php?op=saveorupdate",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (eMessege) {
            showForm(false);
            table.ajax.reload();
        }
    });
    clean();
}

function showData(idCategoria) {
    $.post("../controller/CategoriaController.php?op=showData", {idcategoria: idCategoria}, function (getData, status) {
        var data = JSON.parse(getData);
        showForm(true);

        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#idcategoria").val(data.idcategoria);
    });
}

var idcategoriaDefuse;
function confirmDefuse(idCategoria) {
    $("#mensajeDes").html("¿Desea desactivar la Categoria?");
    $("#modal-danger").modal('show');
    idcategoriaDefuse = idCategoria;

}
function defuse() {
    $.post("../controller/CategoriaController.php?op=defuse", {idcategoria: idcategoriaDefuse}, function (eMessege) {
        table.ajax.reload();
    })
}

var idcategoriaActivate;
function confirmActivate(idCategoria) {
    $("#mensajeAct").html("¿Desea activar la Categoria?");
    $("#modal-success").modal('show');
    idcategoriaActivate = idCategoria;
}

function activate() {
    $.post("../controller/CategoriaController.php?op=activate", {idcategoria: idcategoriaActivate}, function (eMessege) {
        table.ajax.reload();
    })
}

var mensaje;
function validator() {
    if ($("#idcategoria").val() == "") {
        $("#title").html('Guardar Categoria');
        $("#question").html('¿Desea Guardar la Categoria?');
        mensaje = 'Categoria Registrada exitosamente!!';
    } else {
        $("#title").html('Actualizar Categoria');
        $("#question").html('¿Desea Actualizar la Categoria?');
        mensaje = 'Categoria Actualizada exitosamente!';
    }
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
});

$('.toastrDefaultSuccess').click(function () {
    toastr.success('Categoria Activada!')
});

$('.toastrDefaultError').click(function () {
    toastr.error('Categoria Desactivada!')
});

$('.swalDefaultSuccess').click(function () {
    Toast.fire({
        type: 'success',
        title: mensaje
    })
});

init();