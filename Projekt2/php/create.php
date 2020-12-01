<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuda Świata</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="pageSize">
        <div>
            <header>
                <nav class="navbar navbar-expand-md navbar-light">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link topMenuLinks" href="index.html">Strona główna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link topMenuLinks" href="pages/wykonal.html">Wykonał</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link topMenuLinks" href="pages/linki.html">Wykorzystane źródła</a>
                        </li>
                    </ul>
                </nav>
                <hr class="greenbar">
            </header>
            <main>
                <div class="container">
                    <div class="row">
                        <h3>New Student</h3>
                    </div>
                    <form class="form-horizontal" action="create.php" method="post">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Indeks</label>
                            <div class="col-sm-5">
                                <input name="indeks" type="text" class="form-control"
                                    placeholder="wpisz indeks studenta"
                                    value="<?php echo !empty($indeks)?$indeks:'';?>">
                                <?php if (!empty($indeksError)): ?>
                                <span class="text-danger"><?php echo $indeksError;?> </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Imię</label>
                            <div class="col-sm-5">
                                <input name="imie" type="text" class="form-control" placeholder="wpisz imię studenta"
                                    value="<?php echo !empty($imie)?$imie:'';?>">
                                <?php if (!empty($imieError)): ?>
                                <span class="text-danger"><?php echo $imieError;?> </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-sm-1 control-label">Nazwisko</label>
                            <div class="col-sm-5">
                                <input name="nazwisko" type="text" class="form-control"
                                    placeholder="wpisz nazwisko studenta"
                                    value="<?php echo !empty($nazwisko)?$nazwisko:'';?>">
                                <?php if (!empty($nazwiskoError)): ?>
                                <span class="text-danger"><?php echo $nazwiskoError;?> </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-sm-1 control-label">E-mail</label>
                            <div class="col-sm-5">
                                <input name="email" type="text" class="form-control" placeholder="wpisz e-mail studenta"
                                    value="<?php echo !empty($email)?$email:'';?>">
                                <?php if (!empty($emailError)): ?>
                                <span class="text-danger"><?php echo $emailError;?> </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-sm-1 control-label">Telefon</label>
                            <div class="col-sm-5">
                                <input name="mobile" type="text" class="form-control"
                                    placeholder="wpisz telefon mobile studenta"
                                    value="<?php echo !empty($email)?$email:'';?>">
                                <?php if (!empty($mobileError)): ?>
                                <span class="text-danger"><?php echo $mobileError;?> </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Create</button>
                            <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                    <?php 
                 require 'connect.php';
                  if ( !empty($_POST)) {
                    // wykonywania programy w przypadku istnienia wartości w tablicy POST 
                    $indeksError = null;
                    $imieError= null;
                    $nazwiskoError = null;
                    $emailError = null;
                    $mobileError = null;
                   
                    // wartości tablicy POST
                    $indeks = $_POST['indeks'];
                    $imie = $_POST['imie'];
                    $nazwisko = $_POST['nazwisko'];
                    $email = $_POST['email'];
                    $mobile = $_POST['mobile'];
                    
                    // walidacja kolejnych zmiennych pól formularza
                    $valid = true;
                    if (empty($indeks)) {
                        $indeksError = 'wprowadź numer indeksu';
                        $valid = false;
                    }
                     if (empty($imie)) {
                      $imieError = 'wprowadź imie studenta';
                        $valid = false;
                    }
                      if (empty($nazwisko)) {
                       $nazwiskoError = 'wprowadź nazwisko studenta';
                        $valid = false;
                    }
                      if (empty($email)) {
                        $emailError = 'Wprowadź adress email';
                        $valid = false;
                    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
                        $emailError = 'wprowadź poprawny adres email';
                        $valid = false;
                    }
                     if (empty($mobile)) {
                        $mobileError = 'wprowadź numer telefonu';
                        $valid = false;
                    }
                       // wprowadź dane
                    if ($valid) {
                        echo "ok- wprowadzenie";
                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO student (indeks,imie,nazwisko,email,mobile) values(?,?,?,?,?)";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($indeks,$imie, $nazwisko, $email,$mobile));
                        Database::disconnect();
                        header("Location: index.php");
                    }
                }
            ?>

                </div> <!-- /container -->
            </main>
        </div>
        <footer>
            <div>
                <div class="bottomLinksCont text-center">
                    <div>
                        <span>
                            <a href="index.html" class="bottomMenuLinks linksMargin">Strona główna</a>
                            <a href="pages/wykonal.html" class="bottomMenuLinks linksMargin">Wykonał</a>
                            <a href="pages/linki.html" class="bottomMenuLinks linksMargin">Żródła</a>
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.4 .1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>