<?php
// Configuração de conexão com o banco de dados
$servername = "localhost";
$username = "antonio";
$password = "2308";
$dbname = "dados";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificando as credenciais do usuário
if(isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM usuarios WHERE user ='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        // Redirecionar para a página principal se o usuário estiver cadastrado e as credenciais estiverem corretas
        header("Location: index.html");
        exit();
    } else {
        // Exibir mensagem de erro se o usuário não estiver cadastrado ou as credenciais estiverem incorretas
        //echo "Por favor, verifique seu nome de usuário e senha e tente novamente.";
        header("Location: principal.html");
    }
}

$conn->close();
?>
