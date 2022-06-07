<?php 
session_start();

// Verificando se usuário está logado
if(!isset($_SESSION["nome"]) || !isset($_SESSION["login"]))
{
    // Usuário não logado! Redireciona para a página de login
    header("Location: login/login.php");
    exit;
}
?>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="home.php"><b><?=$_SESSION['nome']?></b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="home.php">Vagas</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="cadastrar_pessoas.php">Cadastrar Usuários</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="cadastrar_vagas.php">Cadastrar Vagas</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="cadastrar_departamentos.php">Cadastrar Departamento</a></li>
                        <li><a class="dropdown-item" href="cadastrar_areas.php">Cadastrar Área</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Listas</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="listar_pessoas.php">Pessoas cadastradas</a></li>
                        <li><a class="dropdown-item" href="listar_vagas.php">Vagas cadastradas</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Meu perfil</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="login/logout.php">Deslogar</a></li>
                    </ul>
                </li>
            </ul>

            <?php 
                // Conexão com o banco de dados
                require_once('connect_bd.php');

                // Query para trazer inscrição do usuário logado
                $query = $conn->prepare("SELECT COUNT(*) as qtd FROM jobs_people WHERE idPerson = " . $_SESSION['id_usuario']);
                $query->execute(array());
                $row = $query->fetch(PDO::FETCH_ASSOC);
            ?>

            <button class="btn btn-outline-dark" type="button">
                <i class="bi bi-check-circle-fill me-1"></i>
                Minhas inscrições
                <span class="badge bg-dark text-white ms-1 rounded-pill"><?=$row['qtd']?></span>
            </button>
           

        </div>
    </div>
</nav>