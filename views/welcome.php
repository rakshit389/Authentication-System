<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
        <?php  if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                if ( !isset($_SESSION['loggedin']) || !isset($_SESSION['username'])) {

                    header("Location: signin.php");
                    exit();
                }
        ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                <div class="content text-white">
                    <h1>Welcome to Our Website</h1>
                    <h5>Hii , <?php echo isset($_SESSION['username'])? $_SESSION['username'] : null ; ?></h5>
                    <a class="text-white" href="signout.php" class="btn btn-danger"><button class="btn btn-success mt-5" >Logout</button></a>
                </div>
                </div>
            </div>
        </div>
        <style>
                body 
                {
                    background-image : url('../assets/bg-imag.avif') ;
                    background-repeat : no-repeat ;
                    background-size : cover;
                    background-position : center ;
                    background-attachment: fixed;
    
                }
        </style>
</body>
</html>