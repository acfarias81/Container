<?php

	// Verifica se os campos foram preenchidos
	if(!empty($_POST['username']) && !empty($_POST['password'])) {
		// Conexão com o banco de dados
		$conn = new mysqli('localhost', 'antonio', '2308', 'dados');
		if($conn->connect_error) {
			die('Erro ao conectar ao banco de dados: ' . $conn->connect_error);
		}
		// Verifica se o usuário já existe
		$stmt = $conn->prepare('SELECT * FROM usuarios WHERE username = ?');
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0) {
			echo 'Nome de usuário já cadastrado.';
		} else {
			// Insere o usuário no banco de dados
			$stmt = $conn->prepare('INSERT INTO usuarios (username, password) VALUES (?, ?)');
			$stmt->bind_param('ss', $_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT));
			if($stmt->execute()) {
				echo 'Usuário cadastrado com sucesso.';
			} else {
				echo 'Erro ao cadastrar usuário.';
			}
		}
	} else {
		echo 'Por favor preencha todos os campos.';
	}
?>
