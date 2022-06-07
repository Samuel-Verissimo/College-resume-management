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
<h3 class="text-center">Preencha o formulário para editar os dados desse departamento!</h3>
<hr>

<?php 

// Conexão com o banco de dados
require_once('connect_bd.php');

// Pegando ID vindo da URL via GET
$id = $_GET['id'];

// Trazendo registros desse usuário
$query = $conn->prepare("SELECT * FROM aux_departments WHERE idDepartment = " .$id);
$query->execute(array());
$row = $query->fetch(PDO::FETCH_ASSOC);
?>
    
<div class="container">
    <form method="post" action="crud/update/departamento.php">
        <p>
        <input type="hidden" value="<?=$row['idDepartment']?>" name="idAtual">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" value="<?=$row['name']?>" name="nome" class="form-control">
        </div>
        </p>

        <p>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a type="button" href="cadastrar_departamentos.php" class="btn btn-secondary">Voltar</a>
        </p>
    </form>
</div>

</body>
</html>