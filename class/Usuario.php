<?php

// Poderia se chamar "PersisteUsuario.php", pois abaixo dos geters e seters ficariam os selects
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

	// Pode-se crir "n"	 functions que seriam os selects e esta classe poderia se chamar PersisteUsuario.php
	
	// "static", pois não utiliza "this"
	// Retorna uma lista de registros
	public static function getList() {
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario desc");
	}

// Retorna uma lista de registros que contenham o texto pesquisado
	public static function search($txtPesq) {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin DESC", array(
		':SEARCH'=>"%".$txtPesq."%"));	
	}

	// Retorna somente um registro
	public function login($login, $senha) {
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
			":LOGIN"=>$login, ":SENHA"=>$senha));

		if (count($results) > 0) {
			// $row = $results[0];
			// $this->setIdusuario($row['idusuario']);
			// $this->setDeslogin($row['deslogin']);
			// $this->setDessenha($row['dessenha']);
			// $this->setDtcadastro(new DateTime($row['dtcadastro']));

			$this->setData($results[0]);

		} else {
			throw new Exception("Login ou senha inválido(s)", 1);			
		}
	}

	// Retorna somente um registro
	public function loadById($id) {
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));

		// if (isset($results)) {} também poderia ser...
		if (count($results) > 0) {

			// Substituídos pela function setData()			
			// $row = $results[0];
			// $this->setIdusuario($row['idusuario']);
			// $this->setDeslogin($row['deslogin']);
			// $this->setDessenha($row['dessenha']);
			// $this->setDtcadastro(new DateTime($row['dtcadastro']));

			$this->setData($results[0]);

		} else {
			throw new Exception("Usuário Não Localizado!", 1);			
		}
	}

	public function setData($dados) {
		$this->setIdusuario($dados['idusuario']);
		$this->setDeslogin($dados['deslogin']);
		$this->setDessenha($dados['dessenha']);
		$this->setDtcadastro(new DateTime($dados['dtcadastro']));
	}

	public function insert() {
		$sql = new Sql();

		// sp = stored procedure, usuarios = tabela, insert = comando
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			":LOGIN"=>$this->getDeslogin(), 
			":SENHA"=>$this->getDessenha()));

		if (count($results) > 0) {
			$this->setData($results[0]);
		}
	}

	public function update($login, $senha) {	
		// Não se usou o construtor, pois antes necessita-se estar com o registro ID na memória e como utilizou-se a funcção
		// loadById(), ela carrega todas as informações e se faz necessário os comandos abaixo para sobrepor 		
		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA, dtcadastro = CURRENT_TIMESTAMP WHERE idusuario = :ID", array(
			":LOGIN"=>$this->getDeslogin(),
			":SENHA"=>$this->getDessenha(),
			":ID"=>$this->getIdusuario()
		));
	}

	// Método construtor, serve para toda a clase Usuario.php e se não precisar da informação, fica com ""
	public function __construct($login = "", $senha = "") {
		$this->setDeslogin($login);
		$this->setDessenha($senha);
	}


	// Esta função (método) sempre será executada, tendo encontrado o registro ou não!

	// Lógica feita antes de aprender o comando "throw new Exception" acima
	// public function __toString() {
	// 	if ($this->getIdusuario() !== null) {
	// 		return json_encode(array(
	// 			"idusuario"=>$this->getIdusuario(), 
	// 			"deslogin"=>$this->getDeslogin(),
	// 			"dessenha"=>$this->getDessenha(),
	// 			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
	// 		));
	// 	} 
	// 	else {
	// 		// return json_encode(array(0, "Registro Nao localizado!", 0, 0));
	// 		return json_encode(array(
	// 			"idusuario"=>"0", 
	// 			"deslogin"=>"0",
	// 			"dessenha"=>"0",
	// 			"dtcadastro"=>0
	// 		));
	// 	}
	// }

	public function __toString() {	
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(), 
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

}

?>