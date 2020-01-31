<?php 
require '../global/Conexion.php';
require '../model/ArticuloModel.php';
require '../interface/ArticuloInterface.php';

class ArticuloHelper implements ArticuloInterface{

	public function __construct(){

	}

	public function create($articulo){
		$sql = "INSERT INTO articulo (idcategoria, codigo, nombre, stock, descripcion, imagen, condicion)
				VALUES ('" . $articulo->getIdCategoria() . "', '" . $articulo->getCodigo() . "',
						'" . $articulo->getNombre() . "', '" . $articulo->getStock() . "', 
						'" . $articulo->getDescripcion() . "', '" . $articulo->getImagen() . "', 
						'1') ";
		return ejecutarConsulta($sql);
	}

	public function edit($articulo){
		$sql = "UPDATE articulo 
				SET idcategoria = '" . $articulo->getIdCategoria() . "', codigo = '" . $articulo->getCodigo() . "',
					nombre = '" . $articulo->getNombre() . "', stock = '" . $articulo->getStock() . "',
					descripcion = '" . $articulo->getDescripcion() . "', imagen = '" . $articulo->getImagen() . "'
				WHERE idarticulo = '" . $articulo->getIdArticulo() . "' ";
		return ejecutarConsulta($sql);
	}

	public function activate($articulo){
		$sql = "UPDATE articulo SET condicion = '1'
				WHERE idarticulo = '" . $articulo->getIdArticulo() . "' ";
		return ejecutarConsulta($sql);
	}

	public function defuse($articulo){
		$sql = "UPDATE articulo SET condicion = '0' 
				WHERE idarticulo = '" . $articulo->getIdArticulo() . "' ";
		return ejecutarConsulta($sql);
	}

	public function show($articulo){
		$sql = "SELECT * FROM articulo 
				WHERE idarticulo = '" . $articulo->getIdArticulo() . "' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function findAll(){
		$sql = "SELECT 
					a.idarticulo,
					c.nombre as categoria,
					a.codigo, 
		        	a.nombre, 
		        	a.stock, 
		        	a.descripcion, 
		        	a.imagen, 
		        	a.condicion 
				FROM articulo a
				INNER JOIN categoria c ON a.idcategoria = c.idcategoria";
		return ejecutarConsulta($sql);
	}	
}

 ?>