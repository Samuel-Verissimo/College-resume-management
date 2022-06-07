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

       <?php include_once('side.php'); ?>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Faça o seu cadastro</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Digite os seus dados corretamente</p>
                </div>
            </div>
        </header>
        <!-- Section-->

        <br>
            <div class="container"> 
            <form method="post" enctype="multipart/form-data" action="crud/insert/pessoas.php">
            <p>
            <div class="form-group">
                <label>Nome completo</label>
                <input type="text" name="nome" class="form-control" placeholder="Digite o seu nome completo" required>
            </div>
            </p>
            <p>
            <div class="form-group">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control" placeholder="Digite o seu telefone">
            </div>
            </p>
            <p>
            <div class="form-group">
                <label>Login</label>
                <input type="text" name="login" class="form-control" placeholder="Digite o seu login" required>
            </div>
            </p>
            <p>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" placeholder="Digite a sua senha" required>
            </div>
            </p>
            <p>
            <div class="mb-3">
                <label for="formFileDisabled" class="form-label">Importe o seu CV</label>
                <input type="file" name="image" class="form-control" value="" required>
            </div>
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
