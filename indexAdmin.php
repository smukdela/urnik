<?php 
session_start();

	include("connection.php");
	include("functions.php");
    include("sestanki.php");
    include("urniki.php");

	$user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$ime_sestanka = $_POST['ime_sestanka'];
		$datum_sestanka = $_POST['datum_sestanka'];
		$ura_sestanka = $_POST['ura_sestanka'];
		if(!empty($ime_sestanka) && !empty($datum_sestanka) && !empty($ura_sestanka))
		{
			$query = "insert into sestanki (ime_sestanka, datum_sestanka, ura_sestanka) values ('$ime_sestanka','$datum_sestanka','$ura_sestanka')";
			mysqli_query($con, $query);
            header("Location: indexAdmin.php#sestanki");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>eAsistent</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none"></span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/guest.jpg" alt="..." /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#domov">Domov</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#koledar">Koledar</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#sestanki">Sestanki</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#urnik">Urnik</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Odjava</a></li>
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="domov">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        Pozdravljeni,
                        <span class="text-primary"> <?php echo $user_data['ime']; ?></span>
                    </h1><br>
                    <div class="subheading mb-5">
                        <span class="text-primary">ADMIN</span>
                    </div>
                    <p class="lead mb-5"></p>
                </div>
            </section>
            <hr class="m-0" />
            <!-- KOLEDAR-->
            <section class="resume-section" id="koledar">
                <div class="resume-section-content">
                    <h2 class="mb-5">Koledar</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Prihodnji sestanki</h3><br>
                            <div class="subheading mb-3">

                                <div class="container">
                                    <div class="row">
                                    <div class="col-sm-8">
                                        <?php echo $deleteMsg??''; ?>
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead><tr>
                                            <th>S.N</th>
                                            <th>Ime Sestanka</th>
                                            <th>Datum Sestanka</th>
                                            <th>Ura sestanka</th>
                                        </thead>
                                        <tbody>
                                    <?php
                                        if(is_array($fetchData)){      
                                        $sn=1;
                                        foreach($fetchData as $data){
                                        ?>
                                        <tr>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $data['ime_sestanka']??''; ?></td>
                                        <td><?php echo $data['datum_sestanka']??''; ?></td>
                                        <td><?php echo $data['ura_sestanka']??''; ?></td>
                                        </tr>
                                        <?php
                                        $sn++;}}else{ ?>
                                        <tr>
                                            <td colspan="8">
                                        <?php echo $fetchData; ?>
                                            </td>
                                        <tr>
                                        <?php
                                        }?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- SESTANKI-->
            <section class="resume-section" id="sestanki">
                <div class="resume-section-content">
                    <h2 class="mb-5">Sestanki</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1 subheading mb-3 ">
                        <form method="post" class="signin-form">
                            <div class="form-group mb-3">
                            <label class="label" >Ime sestanka:</label>
                            <input type="text" name="ime_sestanka" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                            <label class="label" >Datum sestanka:</label>
                            <input type="text" name="datum_sestanka" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                            <label class="label">Ura sestanka:</label>
                            <input type="text" name="ura_sestanka" class="form-control" required>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Dodaj sestanek</button>
                            </div>
                            <div class="form-group d-md-flex">
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- URNIK-->
            <section class="resume-section" id="urnik">
                <div class="resume-section-content">
                    <h2 class="mb-5">Urnik</h2>                    
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8">
                                        <?php echo $deleteMsg??''; ?>
                                <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead><tr>
                                            <th>S.N</th>
                                            <th>Področje</th>
                                            <th>Dopoldanska izmena</th>
                                            <th>Popoldanska izmena</th>
                                            <th>Malica</th>
                                        </thead>
                                        <tbody>
                                    <?php
                                        if(is_array($fetchDataU)){      
                                        $sn=1;
                                        foreach($fetchDataU as $dataU){
                                        ?>
                                        <tr>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $dataU['urnik_id']??''; ?></td>
                                        <td><?php echo $dataU['dop_izmena']??''; ?></td>
                                        <td><?php echo $dataU['pop_izmena']??''; ?></td>
                                        <td><?php echo $dataU['malica']??''; ?></td>
                                        </tr>
                                        <?php
                                        $sn++;}}else{ ?>
                                        <tr>
                                            <td colspan="8">
                                        <?php echo $fetchDataU; ?>
                                    </td>
                                        <tr>
                                        <?php
                                        }?>
                                        </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </section>
            <hr class="m-0" />
            <hr class="m-0" />
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>