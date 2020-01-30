<?php 
require '../helper/CategoriaHelper.php';

class CategoriaController{

	public function __construct(){

	}

	public function init(){

		$categoria = new CategoriaHelper();
		$categoriaModel = new CategoriaModel();

		$prueba = $_POST['nombre'];

		$categoriaModel->setIdCategoria(isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "");
		$categoriaModel->setNombre(isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "");
		$categoriaModel->setDescripcion(isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "");

		switch($_GET["op"]){
			case 'saveorupdate':
				if (empty($categoriaModel->getIdCategoria())) {
					$rpta = $categoria->create($categoriaModel);
					echo ($rpta) ? "Categoria registrada exitosamente!" : "Categoria no registrada!";
				}else{
					$rpta = $categoria->edit($categoriaModel);
					echo ($rpta) ? "Categoria actualizada exitosamente!" : "Categoria no actualizada!";
				}
			break;

			case 'activate':
				$rpta = $categoria->activate($categoriaModel);
				echo ($rpta) ? "Categoria activada!" : "Categoria no activada";
			break;

			case 'defuse':
				$rpta = $categoria->defuse($categoriaModel);
				echo ($rpta) ? "Categoria desactivada" : "Categoria no desactivada";
			break;

			case 'showData':
				$rpta = $categoria->show($categoriaModel);
				echo json_encode($rpta);
			break;

			case 'findAll':
				$rpta = $categoria->findAll();
				$data = array();

				while ($reg = $rpta->fetch_object()) {
					$data[] = array( 
							"0" => ($reg->condicion) ? 
								'<button class="btn btn-primary" onclick="showData('.$reg->idcategoria.')">
								<i class="fa fa-pencil-alt"></i></button>' .
								'  <button class="btn btn-danger" onclick="confirmDefuse('.$reg->idcategoria.')">
								<i class="fa fa-times-circle"></i></button>'
								:
								'<button class="btn btn-primary" onclick="showData('.$reg->idcategoria.')">
								<i class="fa fa-pencil-alt"></i></button>' .
								'  <button class="btn btn-success" onclick="confirmActivate('.$reg->idcategoria.')">
								<i class="fa fa-check"></i></button>',
							"1" => $reg->nombre,
							"2" => $reg->descripcion,
							"3" => ($reg->condicion) ? '<span class="btn btn-success">Activada</span>' : 
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

			default:
				echo "ha ocurrido un error";

		}
	}
}

$control = new CategoriaController();
$control->init();

?>