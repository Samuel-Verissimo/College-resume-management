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
$query = $conn->prepare("SELECT area.*,dp.name dpt, dp.idDepartment iDdpt 
FROM aux_area area 
JOIN aux_departments dp ON dp.idDepartment = area.idDepartment
WHERE idArea = " .$id. "
ORDER BY dp.name");
$query->execute(array());
$row = $query->fetch(PDO::FETCH_ASSOC);
?>
    
<div class="container">
    <form method="post" action="crud/update/area.php">
        <p>
        <input type="hidden" value="<?=$row['idArea']?>" name="idAtual">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" value="<?=$row['name']?>" name="nome" class="form-control">
        </div>
        </p>
        <p>
            <label>Selecionar outro departamento?</label>
            <select name="departamento" class="form-select" required>
                <option value="<?=$row['iDdpt']?>" selected> <?=$row['dpt']?> </option>
            <?php 
            // Query para preencher select
            $query = $conn->prepare("SELECT * FROM aux_departments WHERE idDepartment NOT IN (".$row['iDdpt'].") ORDER BY name");
            $query->execute(array());

            // Fazendo loop no registros, para lista-los
            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo "<option value = ".$row['idDepartment']."> ".$row['name']." </option>";
            }
            ?>
            </select>
        </p>

        <p>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a type="button" href="cadastrar_areas.php" class="btn btn-secondary">Voltar</a>
        </p>
    </form>
</div>

</body>
</html>