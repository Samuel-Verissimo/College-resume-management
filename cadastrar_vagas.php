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

        <br>
            <div class="container">
            <form method="post" action="crud/insert/vagas.php">
            <p>
                <label>Selecione o departamento / área</label>
                <select name="area" class="form-select" required>
                <?php 
                // Conexão com o banco de dados
                require_once('connect_bd.php');

                // Query para preencher select
                $query = $conn->prepare("
                SELECT area.idArea id, dpt.name Departamento, area.name Area 
                FROM aux_area area 
                JOIN aux_departments dpt ON dpt.idDepartment = area.idDepartment
                ORDER BY Departamento, Area");
                $query->execute(array());

                // Fazendo loop no registros, para lista-los
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value = ".$row['id']."> ".$row['Departamento']. " - " .$row['Area']." </option>";
                }
                ?>
                </select>
            </p>
            <p>
            <div class="form-group">
                <label>Descrição</label>
                <textarea class="form-control" name="descricao" cols="30" rows="10" placeholder="Escreva detalhadamente a descrição dessa vaga..." required></textarea>
            </div>
            </p>
            <p>
            <div class="form-group">
                <label>Salário</label>
                <input type="number" name="salario" class="form-control" placeholder="Digite uma média salárial" required>
            </div>
            </p>
            <p>
                <label>Selecionar o estado dessa vaga</label>
                <select name="status" class="form-select" required>
                    <option value="0">Sem urgência</option>
                    <option value="1">Com Urgência</option>
                </select>
            </p>
           
            <p>
                <button type="submit" class="btn btn-dark">Realizar cadastro</button>
            </p>

            </form>
            </div>
        </br>

        
        <!-- Incluindo footer -->
        <?php include_once('footer.php') ?>
        
    </body>
</html>
