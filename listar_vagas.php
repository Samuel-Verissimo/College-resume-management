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

  <!-- Incluindo side -->
  <?php include_once('side.php'); ?>
  
  <!-- Header-->
  <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
          <div class="text-center text-white">
              <h3 class="display-4 fw-bolder">Listando todas as vagas cadastradas</h3>
              <p class="lead fw-normal text-white-50 mb-0">Não esqueça de enviar o seu melhor curriculo!</p>
          </div>
      </div>
  </header>

  <br/><br/><br/>

  <!-- Principal -->
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Titulo</th>
          <th>Descrição</th>
          <th>Salário</th>
          <th>Status</th>
          <th>Opções</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            // Conexão com o banco de dados
            require_once('connect_bd.php');

            // Query para trazer registros
            $query = $conn->prepare("
            SELECT jobs.idJob id, area.name Area, dpt.name Departamento, jobs.description, jobs.salary, jobs.status
            FROM jobs 
            JOIN aux_area area ON area.idArea = jobs.idArea
            JOIN aux_departments dpt ON dpt.idDepartment = area.idDepartment
            ORDER BY idJob DESC");
            $query->execute(array());

            // Fazendo loop no registros, para lista-los
            while ($row = $query->fetch(PDO::FETCH_ASSOC)):

            if($row['status'] == 1)
              $status = "<button type='button' class='btn btn-danger btn-sm'>Urgente</button>";
            else 
              $status = "<button type='button' class='btn btn-light btn-sm'>-</button>";
          ?>

              <!-- O HTML é repetido até acabar a quantidade de registros MySQL -->
              <tr>
                  <td> <?=$row['id']?> </td>
                  <td> <?=$row['Departamento'] . " - " . $row['Area']?> </td>
                  <td> <?=substr($row['description'], 0, 60) . '...'?> </td>
                  <td> <?=number_format($row['salary'], 2, ',', '.')?> </td>
                  <td><?=$status?></td>
                  <td>
                    <a href="editar_vagas.php?id=<?=$row['id']?>"  class="btn"><i class="fa fa-edit"></i> Editar</a>
                    <a href="crud/delete/vagas.php?id=<?=$row['id']?>" onclick="return confirm('Você tem certeza que deseja excluir?');" class="btn"><i class="fa fa-trash"></i> Excluir</a>
                  </td>
              </tr>

          <?php 
          // Finalizando loop
            endwhile; 

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

      </tbody>
    </table>
  </div>

  <!-- Incluindo footer -->
  <?php include_once('footer.php') ?>

</body>
</html>
