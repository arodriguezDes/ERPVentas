<?php
require '../global/Conexion.php';
require '../model/CategoriaModel.php';
require '../interface/CategoriaInterface.php';

class CategoriaHelper implements CategoriaInterface {

    public function __construct() {
        
    }

    public function activate($categoria) {
        $sql = "UPDATE categoria 
                SET condicion = '1' 
                WHERE idcategoria = '" . $categoria->getIdCategoria() . "' ";
        return ejecutarConsulta($sql);
    }

    public function create($categoria) {
        $sql = "INSERT INTO categoria(nombre, descripcion, condicion)
                VALUES( '" . $categoria->getNombre() . "', '" . $categoria->getDescripcion() . "',
                        '1')";
        return ejecutarConsulta($sql);
    }

    public function defuse($categoria) {
        $sql = "UPDATE categoria
                SET condicion = '0' 
                WHERE idcategoria = '" . $categoria->getIdCategoria() . "' ";
        return ejecutarConsulta($sql);
    }

    public function edit($categoria) {
        $sql = "UPDATE categoria
                SET nombre = '" . $categoria->getNombre() . "',
                    descripcion = '" . $categoria->getDescripcion() . "'
                WHERE idcategoria = '" . $categoria->getIdCategoria() . "' ";
        return ejecutarConsulta($sql);        
    }

    public function findAll() {
        $sql = "SELECT * FROM categoria";
        return ejecutarConsulta($sql);
    }

    public function select() {
        $sql = "SELECT * FROM categoria
                WHERE condicion = 1 ";
        return ejecutarConsulta();
    }

    public function show($categoria) {
        $sql = "SELECT * FROM categoria
                WHERE idcategoria = '" . $categoria->getIdCategoria() . "' ";
        return ejecutarConsultaSimpleFila($sql);
    }

}

?>