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
<h3 class="text-center">Preencha o formulário para editar os dados dessa vaga!</h3>
<hr>

<?php 

// Conexão com o banco de dados
require_once('connect_bd.php');

// Pegando ID vindo da URL via GET
$idVaga = $_GET['id'];

// Trazendo registros desse usuário
$query = $conn->prepare("
SELECT 
jobs.idJob id, 
area.name Area, 
area.idArea idArea,
dpt.idDepartment idDpt,
dpt.name Departamento, 
jobs.description, 
jobs.salary, 
jobs.status
FROM jobs 
JOIN aux_area area ON area.idArea = jobs.idArea
JOIN aux_departments dpt ON dpt.idDepartment = area.idDepartment
WHERE idJob = " .$idVaga. "");
$query->execute(array());
$row = $query->fetch(PDO::FETCH_ASSOC);
?>
    
<div class="container">
    <form method="post" action="crud/update/vagas.php">
        <p>
            <input type="hidden" value="<?=$row['id']?>" name="idAtual">
            <label>Selecionar outro departamento?</label>
            <select name="departamento" class="form-select" required>
                <option value="<?=$row['idArea']?>" selected> <?=$row['Departamento'] . " - " . $row['Area']?> </option>
            </select>
        </p>
        <p>
        <div class="form-group">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao" cols="30" rows="10" required><?=$row['description']?></textarea>
        </div>
        </p>
        <p>
            <div class="form-group">
                <label>Salário</label>
                <input type="text" value="<?=$row['salary']?>" name="salario" class="form-control">
            </div>
        </p>
        <p>
            <label>Selecionar alterar o status?</label>
            <select name="departamento" class="form-select" required>
                <option value="<?=$row['status']?>" selected> <?=$row['status']?> </option>
            </select>
        </p>
      
        <p>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a type="button" href="listar_vagas.php" class="btn btn-secondary">Voltar</a>
        </p>
    </form>
</div>

</body>
</html>