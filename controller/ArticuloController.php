<?php

require "../helper/ArticuloHelper.php";

class ArticuloController {

    public function __construct() {
        
    }

    public function init() {
        $articulo = new ArticuloHelper();
        $articuloModel = new ArticuloModel();

        $articuloModel->setIdArticulo(isset($_POST["idarticulo"]) ? limpiarCadena($_POST["idarticulo"]) : "");
        $articuloModel->setIdCategoria(isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "");
        $articuloModel->setCodigo(isset($_POST["codigo"]) ? limpiarCadena($_POST["codigo"]) : "");
        $articuloModel->setNombre(isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "");
        $articuloModel->setStock(isset($_POST["stock"]) ? limpiarCadena($_POST["stock"]) : "");
        $articuloModel->setDescripcion(isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "");
        $articuloModel->setImagen(isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "");

        switch ($_GET["op"]) {
            case 'saveorupdate':
                if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                    $articuloModel->setImagen($_POST["imagenactual"]);
                } else {
                    $ext = explode(".", $_FILES['imagen']['name']);
                    if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" ||
                            $_FILES['imagen']['type'] == "image/png") {
                        $articuloModel->setImagen(round(microtime(true)) . '.' . end($ext));
                        move_uploaded_file($_FILES['imagen']['tmp_name'], "../files/articulos/" . $articuloModel->getImagen());
                    }
                }

                if (empty($articuloModel->getIdArticulo())) {
                    $rpta = $articulo->create($articuloModel);
                } else {
                    $rpta = $articulo->edit($articuloModel);
                }
                break;

            case 'defuse':
                $rpta = $articulo->defuse($articuloModel);
                break;

            case 'activate':
                $rpta = $articulo->activate($articuloModel);
                break;

            case 'showData':
                $rpta = $articulo->show($articuloModel);
                echo json_encode($rpta);
                break;

            case 'findAll':
                $rpta = $articulo->findAll();
                $data = array();

                while ($reg = $rpta->fetch_object()) {
                    $data[] = array(
                        "0" => ($reg->condicion) ?
                        '<button class="btn btn-primary" onclick="showData(' . $reg->idarticulo . ')">
								<i class="fa fa-pencil-alt"></i></button>' .
                        '  <button class="btn btn-danger" onclick="confirmDefuse(' . $reg->idarticulo . ')">
								<i class="fa fa-times-circle"></i></button>' :
                        '<button class="btn btn-primary" onclick="showData(' . $reg->idarticulo . ')">
								<i class="fa fa-pencil-alt"></i></button>' .
                        '  <button class="btn btn-success" onclick="confirmActivate(' . $reg->idarticulo . ')">
								<i class="fa fa-check"></i></button>',
                        "1" => $reg->nombre,
                        "2" => $reg->categoria,
                        "3" => $reg->codigo,
                        "4" => $reg->stock,
                        "5" => '<img src="../files/articulos/' . $reg->imagen . '" height="45px" width="50px" >',
                        "6" => ($reg->condicion) ? '<span class="btn btn-success">Activada</span>' :
                        '<span class="btn btn-danger">Desactivada</span>'
                    );
                }

                $result = array(
                    "sEcho" => 1,
                    "iTotalRecords" => count($data),
                    "iTotalDisplayRecords" => count($data),
                    "aaData" => $data
                );
                echo json_encode($result);
                break;

            case 'selectCategoria':
                require "../helper/CategoriaHelper.php";

                $categoria = new CategoriaHelper();

                $rpta = $categoria->select();

                while ($reg = $rpta->fetch_object()) {
                    echo '<option value="' . $reg->idcategoria . '">' . $reg->nombre . '</option>';
                }
                break;

            default:
                # code...
                break;
        }
    }

}

$control = new ArticuloController();
$control->init();
?>