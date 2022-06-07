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
    </head>
    <body>

       <!-- Incluindo side -->
       <?php include_once('side.php'); ?>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h3 class="display-4 fw-bolder">Dê uma olhadinha em nossas VAGAS</h3>
                    <p class="lead fw-normal text-white-50 mb-0">Não esqueça de enviar o seu melhor curriculo!</p>
                </div>
            </div>
        </header>
        

        <!-- Vagas-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                <?php 
                // Conexão com o banco de dados
                require_once('connect_bd.php');

                // Query para trazer registros
                $query = $conn->prepare("
                SELECT jobs.idJob id, area.name Area, dpt.name Departamento, jobs.description, jobs.salary, jobs.status,  (SELECT COUNT(jobs_people.idJobsPeople) FROM jobs_people WHERE jobs_people.idJob = jobs.idJob) qtd_inscricoes
                FROM jobs 
                JOIN aux_area area ON area.idArea = jobs.idArea
                JOIN aux_departments dpt ON dpt.idDepartment = area.idDepartment
                ORDER BY idJob DESC");
                $query->execute(array());

                // Fazendo loop no registros, para lista-los
                while ($row = $query->fetch(PDO::FETCH_ASSOC)):

                if($row['status'] == 1)
                    $status = "<div class='badge bg-danger text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>Urgente</div>";
                else 
                    $status = "";
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <?=$status?>
                            <img class="card-img-top" src="https://jcconcursos.com.br/media/_versions/noticia/vagas-abertas-azul_widelg.jpg" alt="..." />
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder"><?=$row['Departamento']?></h5>
                                        <?=$row['qtd_inscricoes']?> inscrições
                                    </div>
                                    <code>R$  <?=number_format($row['salary'], 2, ',', '.')?> </code>
                                </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="visualizar_vaga.php?vaga=<?=$row['id']?>">Visualizar vaga</a></div>
                            </div>
                        </div>
                    </div>
                <?php 
                    // Finalizando loop
                    endwhile; 
                ?>

                    
                </div>
            </div>
        </section>



        <!-- Incluindo footer -->
        <?php include_once('footer.php') ?>
    </body>
</html>
