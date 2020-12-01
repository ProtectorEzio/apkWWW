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
                            <h3>Zaaktualizuj rasę</h3>
                        </div>
                        <?php
                        require 'connect.php';
                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $ID = isset($_GET['ID']) ? $_GET['ID'] : die('ERROR: Record ID not found.');
                        try {
                            $query = "SELECT Rasa, SredniaWaga, SredniWzrost FROM rasyPsow WHERE ID = ?";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindValue(1, $ID);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $Rasa = $row['Rasa'];
                            $SredniaWaga = $row['SredniaWaga'];
                            $SredniWzrost = $row['SredniWzrost'];
                        }

                        // show error
                        catch (PDOException $exception) {
                            die('ERROR: ' . $exception->getMessage());
                        } ?>

                        <?php
                        if ($_POST) {
                            try {
                                $query = "UPDATE rasyPsow set Rasa =:Rasa, SredniaWaga =:SredniaWaga, SredniWzrost =:SredniWzrost WHERE ID = :ID";
                                $stmt = $pdo->prepare($query);
                                $Rasa = $_POST['Rasa'];
                                $SredniaWaga = $_POST['SredniaWaga'];
                                $SredniWzrost = $_POST['SredniWzrost'];
                                $stmt->bindParam(':Rasa', $Rasa);
                                $stmt->bindParam(':SredniaWaga', $SredniaWaga);
                                $stmt->bindParam(':SredniWzrost', $SredniWzrost);
                                $stmt->bindParam(':ID', $ID);
                                if ($stmt->execute()) {
                                    header("Location: index.php");
                                }
                            } catch (PDOException $ex) {
                                die('ERROR: ' . $ex->getMessage());
                            }
                        }
                        ?>
                        <form class="form-horizontal" action="update.php?ID=<?php echo $ID ?>" method="post">
                            <div class="control-group <?php echo !empty($RasaError) ? 'error' : ''; ?>">
                                <label class="control-label">Rasa</label>
                                <div class="controls">
                                    <input name="Rasa" type="text" placeholder="Rasa" value="<?php echo !empty($Rasa) ? $Rasa : ''; ?>">
                                    <?php if (!empty($RasaError)) : ?>
                                        <span class="help-inline"><?php echo $RasaError; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="control-group <?php echo !empty($SredniaWagaError) ? 'error' : ''; ?>">
                                <label class="control-label">Srednia waga</label>
                                <div class="controls">
                                    <input name="SredniaWaga" type="text" placeholder="SredniaWaga" value="<?php echo !empty($SredniaWaga) ? $SredniaWaga : ''; ?>">
                                    <?php if (!empty($SredniaWagaError)) : ?>
                                        <span class="help-inline"><?php echo $SredniaWagaError; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="control-group <?php echo !empty($SredniWzrostError) ? 'error' : ''; ?>">
                                <label class="control-label">SredniWzrost</label>
                                <div class="controls">
                                    <input name="SredniWzrost" type="text" placeholder="SredniWzrost" value="<?php echo !empty($SredniWzrost) ? $SredniWzrost : ''; ?>">
                                    <?php if (!empty($SredniWzrostError)) : ?>
                                        <span class="help-inline"><?php echo $SredniWzrostError; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a class="btn" href="index.php">Back</a>
                            </div>
                        </form>
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