<?php 
// Conexão com o banco de dados
require_once('connect_bd.php');
?>

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
        <!-- font-awesome icons-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Sweet alert -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
    </head>
    <body>

       <?php include_once('side.php'); ?>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Cadastre uma nova área</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Digite os seus dados corretamente</p>
                </div>
            </div>
        </header>
        <!-- Section-->

        <?php
            // Mensagem inserção
            if(isset($_SESSION['msg_query_insert']))
                echo $_SESSION['msg_query_insert'];
                unset($_SESSION['msg_query_insert']);

            // Mensagem update
            if(isset($_SESSION['msg_query_update']))
                echo $_SESSION['msg_query_update'];
                unset($_SESSION['msg_query_update']);

            // Mensagem delete
            if(isset($_SESSION['msg_query_delete']))
                echo $_SESSION['msg_query_delete'];
                unset($_SESSION['msg_query_delete']);
        ?>

        <br>

            <div class="container">

                <!-- Formulario cadastro -->
                <div class="row">
                <div class="table-responsive col-md-6">
                    <form method="post" action="crud/insert/area.php">
                    <p>
                        <div class="form-group">
                            <label>Nome da área</label>
                            <input type="text" name="nome" class="form-control" placeholder="Digite o nome da área" required>
                        </div>
                    </p>
                    <p>
                        <label>Selecione o departamento</label>
                        <select name="departamento" class="form-select" required>
                            <option value="" selected disabled>-</option>
                        <?php 
                        // Query para preencher select
                        $query = $conn->prepare("SELECT * FROM aux_departments ORDER BY name");
                        $query->execute(array());

                        // Fazendo loop no registros, para lista-los
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value = ".$row['idDepartment']."> ".$row['name']." </option>";
                        }
                        ?>
                        </select>
                    </p>
                    <p>
                        <button type="submit" class="btn btn-dark">Realizar cadastro</button>
                    </p>
                    </form>
                </div>

                <!-- Listando registros --> 
                <div class="table-responsive col-md-6">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // Query para trazer registros
                            $query = $conn->prepare("
                            SELECT area.*,dp.name dpt 
                            FROM aux_area area JOIN aux_departments dp ON dp.idDepartment = area.idDepartment
                            ORDER BY dp.name
                            ");
                            $query->execute(array());

                            // Fazendo loop no registros, para lista-los
                            while ($row = $query->fetch(PDO::FETCH_ASSOC)):
                        ?>

                            <!-- O HTML é repetido até acabar a quantidade de registros MySQL -->
                            <tr>
                                <td><?=$row['idArea']?></td>
                                <td><?=$row['dpt']?></td>
                                <td><?=$row['name']?></td>
                                <td>
                                    <a href="editar_areas.php?id=<?=$row['idArea']?>"  class="btn"><i class="fa fa-edit"></i> Editar</a>
                                    <a href="crud/delete/area.php?id=<?=$row['idArea']?>" onclick="return confirm('Você tem certeza que deseja excluir?');" class="btn"><i class="fa fa-trash"></i> Excluir</a>
                                </td>
                            </tr>

                        <?php 
                        // Finalizando loop
                            endwhile; 
                        ?>
                    </tbody>
                    </table>
                </div>
                </div>


            </div>
        </br>

        <!-- Incluindo footer -->
        <?php include_once('footer.php') ?>

    </body>
</html>
