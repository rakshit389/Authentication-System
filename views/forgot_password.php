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
    <?php require('../helper/ForgotPasswordValidation.php')  ?>
    <h1 class="text-center mt-5 mb-3 p-3" >Reset Password</h1>
     <div class="container border border-light rounded shadow" style="max-width:60vh;min-height:30vw">
        <form name="signup-form" class="mt-4"  method="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate >
              <div>
                  <label class="h4 p-2" for="emailid">Email address</label>
                  <input type="email" name="userid" class="form-control p-2"  value="<?php echo isset($_POST['userid']) ? $_POST['userid'] : null  ; ?>"  id="emailid" aria-describedby="emailHelp" placeholder="Enter email"  required>
                  <span class="text-danger" ><?php  echo isset($useridErr)? $useridErr : null  ?></span>
                  <span class="text-danger" ><?php  echo isset($userExistErr)? $userExistErr : null  ?></span>
                </div>
              <div class="d-flex flex-row justify-content-between mt-5">
                  <button type="submit" name="send_mail"  class="btn btn-lg btn-success p-2">Send Email</button>
              </div>
              <div class="mt-4 text-success" >
                <span><?php echo isset($sendmailInfo) ? $sendmailInfo: null ; ?></span>
              </div>
          </form>
     </div>
     <style>
         body {
                font-family: Georgia ;
            }
     </style>

</body>
</html>