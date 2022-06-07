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
              <h3 class="display-4 fw-bolder">Listando todas as pessoas cadastradas</h3>
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
          <th>Nome</th>
          <th>Contato</th>
          <th>Login</th>
          <th>Senha</th>
          <th>Curriculo</th>
          <th>Opções</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            // Conexão com o banco de dados
            require_once('connect_bd.php');

            // Query para trazer registros
            $query = $conn->prepare("SELECT * FROM people ORDER BY idPerson");
            $query->execute(array());

            // Fazendo loop no registros, para lista-los
            while ($row = $query->fetch(PDO::FETCH_ASSOC)):

            // Exibindo curriculo
            if($row['resume'] != '')
              $curriculo = "<a href='assets/uploads/".$row['resume']."'><img style='widht: 50px; height: 50px;' src='https://cdn-icons-png.flaticon.com/512/345/345609.png' alt='Curriculo'></a>";
            else
              $curriculo = "<a href='#'><img style='widht: 50px; height: 50px;' src='https://icon-library.com/images/prohibited-icon/prohibited-icon-4.jpg' alt='Curriculo'></a>";
          ?>

              <!-- O HTML é repetido até acabar a quantidade de registros MySQL -->
              <tr>
                  <td><?=$row['idPerson']?></td>
                  <td><?=$row['fullName']?></td>
                  <td><?=$row['contact']?></td>
                  <td><?=$row['login']?></td>
                  <td><?=$row['password']?></td>
                  <td><?=$curriculo?></td>
                  <td>
                    <a href="editar_pessoas.php?id=<?=$row['idPerson']?>"  class="btn"><i class="fa fa-edit"></i> Editar</a>
                    <a href="crud/delete/pessoas.php?id=<?=$row['idPerson']?>" onclick="return confirm('Você tem certeza que deseja excluir?');" class="btn"><i class="fa fa-trash"></i> Excluir</a>
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
