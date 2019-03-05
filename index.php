<?php

require_once("config.php");

// Substituídos pela classe "Usuarios.php"
// $sql = new Sql();
// $usuarios = $sql->select("SELECT * FROM tb_usuarios");
// echo json_encode($usuarios);

$pesquisa = new Usuario();
$idPesq = 4;
$pesquisa->loadById($idPesq);

$volta = json_decode($pesquisa, true);

if ($volta["idusuario"] != "0") {
	echo $pesquisa;				
} else {
	echo "Registro $idPesq não localizado! Verifique!";
}


 
?>