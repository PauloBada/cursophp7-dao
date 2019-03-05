
<?php

require_once("config.php");


// Substituídos pela classe "Usuarios.php"
// $sql = new Sql();
// $usuarios = $sql->select("SELECT * FROM tb_usuarios");
// echo json_encode($usuarios);

// ==== Busca usuário específico
$pesquisa = new Usuario();
$idPesq = 24;
$pesquisa->loadById($idPesq);
echo $pesquisa;				

// Lógica feita antes de aprender o comando "throw new Excpetion" em Usuario.php
// $pesquisa = new Usuario();
// $idPesq = 24;
// $pesquisa->loadById($idPesq);
// $volta = json_decode($pesquisa, true);
// if ($volta["idusuario"] != "0") {
// 	echo $pesquisa;				
// } else {
// 	echo "Registro $idPesq não localizado! Verifique!";
// }

// ===== Busca todos os usuários
// Como getList() não retorna variáveis através de "this", deve-se chamar direto e não deve instanciar com "new"
// $pesquisa = Usuario::getList();
// echo json_encode($pesquisa);				

// ===== Busca todos os usuários que tenham determinado texto
// $pesquisa = Usuario::search("Tarr");
// echo json_encode($pesquisa);				

// ===== Busca usuário por usuário e senha
// $pesquisa = new Usuario();
// $loginPesq = "PAULO TARRAGO";
// $senhaPesq = 'tutasi';
// $pesquisa->login($loginPesq, $senhaPesq);
// echo $pesquisa;				



?>