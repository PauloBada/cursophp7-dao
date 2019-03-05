<?php

class Usuario {
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario() {
		return $this->idusuario;
	}

	public function setIdusuario($usuario) {
		$this->idusuario = $usuario;
	}

	public function getDeslogin() {
		return $this->deslogin;
	}

	public function setDeslogin($login) {
		$this->deslogin = $login;
	}

	public function getDessenha() {
		return $this->dessenha;
	}

	public function setDessenha($senha) {
		$this->dessenha = $senha;
	}

	public function getDtcadastro() {
		return $this->dtcadastro;
	}

	public function setDtcadastro($dataTime) {
		$this->dtcadastro = $dataTime;
	}

	public function loadById($id) {
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));

		// if (isset($results)) {} também poderia ser...
		if (count($results) > 0) {
			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		} 
	}

	// Esta função (método) sempre será executada, tendo encontrado o registro ou não!
	public function __toString() {
		if ($this->getIdusuario() !== null) {
			return json_encode(array(
				"idusuario"=>$this->getIdusuario(), 
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
		} 
		else {
			// return json_encode(array(0, "Registro Nao localizado!", 0, 0));
			return json_encode(array(
				"idusuario"=>"0", 
				"deslogin"=>"0",
				"dessenha"=>"0",
				"dtcadastro"=>0
			));
		}
	}
}

?>