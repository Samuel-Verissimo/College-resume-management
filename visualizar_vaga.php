<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Projeto PHP</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Sweet alert -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
    </head>
    <body>

    <!-- Incluindo side -->
    <?php include_once('side.php'); ?>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Faça o cadastro de uma vaga</h1>
                <p class="lead fw-normal text-white-50 mb-0">Digite os seus dados corretamente</p>
            </div>
        </div>
    </header>
    <!-- Section-->

    <?php 
    // Conexão com o banco de dados
    require_once('connect_bd.php');

    // Pegando ID vindo da URL via GET
    $idVaga = $_GET['vaga'];

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

    <?php
        // Mensagem inserção
        if(isset($_SESSION['msg_query_insert']))
            echo $_SESSION['msg_query_insert'];
            unset($_SESSION['msg_query_insert']);
    ?>

    <br>
    
    <div class="container">
        <form method="post" action="crud/insert/inscricao_vaga.php">
        <input type="hidden" value="<?=$row['idArea']?>" name="idAtual">
            <p>
                <label>Departamento - área</label>
                <select class="form-select" disabled>
                    <option value="<?=$row['idArea']?>" selected> <?=$row['Departamento'] . " - " . $row['Area']?> </option>
                </select>
            </p>
            <p>
            <div class="form-group">
                <label>Descrição da vaga</label>
                <input class="form-control" value="<?=$row['description']?>" disabled>
            </div>
            </p>
            <p>
                <div class="form-group">
                    <label>Salário</label>
                    <input type="text" value="<?=$row['salary']?>" class="form-control" disabled>
                </div>
            </p>
            <p>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" value="<?=$row['status']?>" class="form-control" disabled>
                </div>
            </p>
        
            <p>
                <button type="submit" class="btn btn-warning">Quero me inscrever!</button>
                <a type="button" href="home.php" class="btn btn-secondary">Voltar</a>
            </p>
        </form>
    </div>

    <!-- Incluindo footer -->
    <?php include_once('footer.php') ?>
        
    </body>
</html>
    