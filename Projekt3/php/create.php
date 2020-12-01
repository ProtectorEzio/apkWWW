<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuda Świata</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="pageSize">
        <div>
            <header>
                <nav class="navbar navbar-expand-md navbar-light">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link topMenuLinks" href="../index.html">Strona główna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link topMenuLinks" href="../pages/wykonal.html">Wykonał</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link topMenuLinks" href="../pages/linki.html">Wykorzystane źródła</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link topMenuLinks" href="index.php">Lista ras psów</a>
                        </li>
                    </ul>
                </nav>
                <hr class="greenbar">
            </header>
            <main>
                <div class="container">
                    <div class="row">
                        <h3>Dodaj Rase</h3>
                    </div>
                    <form class="form-horizontal" action="create.php" method="post">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">ID</label>
                            <div class="col-sm-5">
                                <input name="ID" type="text" class="form-control" placeholder="wpisz ID rasy" value="<?php echo !empty($ID) ? $ID : ''; ?>">
                                <?php if (!empty($IDError)) : ?>
                                    <span class="text-danger"><?php echo $IDError; ?> </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <form class="form-horizontal" action="create.php" method="post">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Rasa</label>
                                <div class="col-sm-5">
                                    <input name="Rasa" type="text" class="form-control" placeholder="wpisz nazwe rasy" value="<?php echo !empty($Rasa) ? $Rasa : ''; ?>">
                                    <?php if (!empty($RasaError)) : ?>
                                        <span class="text-danger"><?php echo $RasaError; ?> </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-1 control-label">Średnia Waga</label>
                                <div class="col-sm-5">
                                    <input name="SredniaWaga" type="text" class="form-control" placeholder="podaj srednia wage" value="<?php echo !empty($SredniaWaga) ? $SredniaWaga : ''; ?>">
                                    <?php if (!empty($SredniaWagaError)) : ?>
                                        <span class="text-danger"><?php echo $SredniaWagaError; ?> </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-1 control-label">Średni wzrost</label>
                                <div class="col-sm-5">
                                    <input name="SredniWzrost" type="text" class="form-control" placeholder="podaj sredni wzrost" value="<?php echo !empty($SredniWzrost) ? $SredniWzrost : ''; ?>">
                                    <?php if (!empty($SredniWzrostError)) : ?>
                                        <span class="text-danger"><?php echo $SredniWzrostError; ?> </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Utwórz</button>
                                <a class="btn" href="index.php">Cofnij</a>
                            </div>
                        </form>
                        <?php
                        require 'connect.php';
                        if (!empty($_POST)) {
                            // wykonywania programy w przypadku istnienia wartości w tablicy POST 
                            $IDError = null;
                            $RasaError = null;
                            $SredniaWagaError = null;
                            $SredniWzrostError = null;
                            $SredniaDlugoscError = null;

                            // wartości tablicy POST
                            $ID = $_POST['ID'];
                            $Rasa = $_POST['Rasa'];
                            $SredniaWaga = $_POST['SredniaWaga'];
                            $SredniWzrost = $_POST['SredniWzrost'];

                            // walidacja kolejnych zmiennych pól formularza
                            $valid = true;
                            if (empty($ID)) {
                                $IDError = 'wprowadź numer ID';
                                $valid = false;
                            }

                            if (empty($Rasa)) {
                                $RasaError = 'wprowadź nazwe rasy';
                                $valid = false;
                            }
                            if (empty($SredniaWaga)) {
                                $SredniaWagaError = 'wprowadź srednia wage';
                                $valid = false;
                            }
                            if (empty($SredniWzrost)) {
                                $SredniWzrostError = 'Wprowadź sredni wzrost';
                                $valid = false;
                            }
                            // wprowadź dane
                            if ($valid) {
                                echo "ok- wprowadzenie";
                                $pdo = Database::connect();
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "INSERT INTO rasyPsow (ID,Rasa,SredniaWaga,SredniWzrost) values(?,?,?,?)";
                                $q = $pdo->prepare($sql);
                                $q->execute(array($ID, $Rasa, $SredniaWaga, $SredniWzrost));
                                Database::disconnect();
                                header("Location: index.php");
                            }
                        }
                        ?>

                </div>
            </main>
        </div>
        <footer>
            <div>
                <div class="bottomLinksCont text-center">
                    <div>
                        <span>
                            <a href="../index.html" class="bottomMenuLinks linksMargin">Strona główna</a>
                            <a href="../pages/wykonal.html" class="bottomMenuLinks linksMargin">Wykonał</a>
                            <a href="../pages/linki.html" class="bottomMenuLinks linksMargin">Żródła</a>
                            <a href="index.php" class="bottomMenuLinks linksMargin">Lista ras psów</a>
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.4 .1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>