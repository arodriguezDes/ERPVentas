<?php

class ArticuloModel {

    private $idArticulo;
    private $idCategoria;
    private $codigo;
    private $nombre;
    private $stock;
    private $descripcion;
    private $imagen;
    private $condicion;

    public function __construct() {
        
    }
    
    function getIdArticulo() {
        return $this->idArticulo;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getStock() {
        return $this->stock;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function setIdArticulo($idArticulo) {
        $this->idArticulo = $idArticulo;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }
}

?>
