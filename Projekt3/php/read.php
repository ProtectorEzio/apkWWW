<?php
require 'connect.php';
$ID = null;
if (!empty($_GET['ID'])) {
    $ID = $_REQUEST['ID'];
}

if (null == $ID) {
    header("Location: index.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM rasyPsow where ID= ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($ID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
?>

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
            <main class="text-center">
                <div class="container">

                    <div class="span10 offset1">
                        <div class="row">
                            <h3>Przegladaj rasy psów</h3>
                        </div>

                        <div class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">ID</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <?php echo $data['ID']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Rasa</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <?php echo $data['Rasa']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Srednia waga</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <?php echo $data['SredniaWaga']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Sredni wzrost</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <?php echo $data['SredniWzrost']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <a class="btn" href="index.php">Back</a>
                            </div>


                        </div>
                    </div>

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