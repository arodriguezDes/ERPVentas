<?php 

class CategoriaModel{
	private $idCategoria;
	private $nombre;
	private $descripcion;
	private $condicion;

	public function __construct(){

	}

	public function getIdCategoria(){
		return $this->idCategoria;
	}

	public function setIdCategoria($idCategoria){
		$this->idCategoria = $idCategoria;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getDescripcion(){
		return $this->descripcion; 
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function getCondicion(){
		return $this->condicion;
	}

	public function setCondicion($condicion){
		$this->condicion = $condicion; 
	}
}

 ?>
