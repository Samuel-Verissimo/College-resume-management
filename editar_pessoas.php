<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição com PHP</title>
    <!-- CSS bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
</head>
<body>

<br>
<h3 class="text-center">Preencha o formulário para editar os dados dessa pessoa!</h3>
<hr>

<?php 

// Conexão com o banco de dados
require_once('connect_bd.php');

// Pegando ID vindo da URL via GET
$idPessoa = $_GET['id'];

// Trazendo registros desse usuário
$query = $conn->prepare("SELECT * FROM people WHERE idPerson = " .$idPessoa);
$query->execute(array());
$row = $query->fetch(PDO::FETCH_ASSOC);
?>
    
<div class="container">
    <form method="post" action="crud/update/pessoas.php">
        <p>
        <input type="hidden" value="<?=$row['idPerson']?>" name="idAtual">
        <div class="form-group">
            <label>Nome completo</label>
            <input type="text" value="<?=$row['fullName']?>" name="nome" class="form-control">
        </div>
        </p>
        <p>
        <div class="form-group">
            <label>Contato</label>
            <input type="text" value="<?=$row['contact']?>" name="contato" class="form-control">
        </div>
        </p>
        <p>
        <div class="form-group">
            <label>Login</label>
            <input type="text" value="<?=$row['login']?>" name="login" class="form-control">
        </div>
        </p>
        <p>
        <div class="form-group">
            <label>Senha</label>
            <input type="text" value="<?=$row['password']?>" name="senha" class="form-control">
        </div>
        </p>
        <p>
        <div class="form-group">
            <label>Curriculo</label>
            <input type="text" value="<?=$row['resume']?>" name="cv" class="form-control" disabled>
        </div>
        </p>

        <p>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a type="button" href="listar_pessoas.php" class="btn btn-secondary">Voltar</a>
        </p>
    </form>
</div>

</body>
</html>