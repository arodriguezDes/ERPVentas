<?php 

interface ArticuloInterface{
	public function create($articulo);
	public function edit($articulo);
	public function activate($articulo);
	public function defuse($articulo);
	public function show($articulo);
	public function findAll();	
}
 ?>