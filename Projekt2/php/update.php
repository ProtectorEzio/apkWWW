<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>HTML5 + CSS3 + BOOTSTRAP4</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <section class="pageSize">
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler xx" type="button" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="navbar-toggler-icon"></div>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="link" href="views/wykonał.html">Wykonał</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <hr class="Bgreen_bar" />
        </header>
        <main style="text-align: center;">
        <div class="container">
     
     <div class="span10 offset1">
         <div class="row">
             <h3>Update a Student</h3>
         </div>
         <?php
    require 'connect.php';
    $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $indeks=isset($_GET['indeks']) ? $_GET['indeks'] : die('ERROR: Record ID not found.');
    try {
        $query = "SELECT imie, nazwisko, email, mobile FROM student WHERE indeks = ?";
        $stmt = $pdo->prepare( $query );
        $stmt->bindValue(1, $indeks);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $imie = $row['imie'];
        $nazwisko = $row['nazwisko'];
        $email = $row['email'];
        $mobile = $row['mobile'];
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }?>

<?php
    if($_POST){
        try{
            $query= "UPDATE student set imie =?,nazwisko =?, email =?, mobile =? WHERE indeks = ?";
            $stmt = $pdo->prepare( $query );
            $imie=htmlspecialchars(strip_tags($_POST['imie']));
            $nazwisko=htmlspecialchars(strip_tags($_POST['nazwisko']));
            $email=htmlspecialchars(strip_tags($_POST['email']));
            $mobile=htmlspecialchars(strip_tags($_POST['mobile']));
            $stmt->bindParam('imie',$imie);
            $stmt->bindParam('nazwisko',$nazwisko);
            $stmt->bindParam('email',$email);
            $stmt->bindParam('mobile',$mobile);
            if($stmt->execute()){
                header("Location: index.php");
            }
        }catch(PDOException $ex)
            {
                die('ERROR: ' . $ex->getMessage());
            }
        }
?>
         <form class="form-horizontal" action="update.php?indeks=<?php echo $indeks?>" method="post">
           <div class="control-group <?php echo !empty($imieError)?'error':'';?>">
             <label class="control-label">Imię</label>
             <div class="controls">
                 <input name="imie" type="text" placeholder="Imię" value="<?php echo !empty($imie)?$imie:'';?>">
                 <?php if (!empty($imieError)): ?>
                     <span class="help-inline"><?php echo $imieError;?></span>
                 <?php endif;?>
             </div>
           </div>
           <div class="control-group <?php echo !empty($nazwiskoError)?'error':'';?>">
             <label class="control-label">Nazwisko</label>
             <div class="controls">
                 <input name="nazwisko" type="text"  placeholder="Nazwisko" value="<?php echo !empty($nazwisko)?$nazwisko:'';?>">
                 <?php if (!empty($nazwiskoError)): ?>
                     <span class="help-inline"><?php echo $nazwiskoError;?></span>
                 <?php endif;?>
             </div>
           </div>
           <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
             <label class="control-label">Email</label>
             <div class="controls">
                 <input name="email" type="text"  placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                 <?php if (!empty($emailError)): ?>
                     <span class="help-inline"><?php echo $emailError;?></span>
                 <?php endif;?>
             </div>
           </div>
           <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
             <label class="control-label">Numer</label>
             <div class="controls">
                 <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                 <?php if (!empty($mobileError)): ?>
                     <span class="help-inline"><?php echo $mobileError;?></span>
                 <?php endif;?>
             </div>
           </div>
           <div class="form-actions">
               <button type="submit" class="btn btn-success">Update</button>
               <a class="btn" href="index.php">Back</a>
             </div>
         </form>
     </div>
      
</div> <!-- /container -->

        </main>
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
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>

</html>