<?php 

interface CategoriaInterface{
	public function create($categoria);
	public function edit($categoria);
	public function activate($categoria);
	public function defuse($categoria);
	public function show($categoria);
	public function findAll();
	public function select();
}

 ?>