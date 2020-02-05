<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Nemanja">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Е-маил - Ажурирање</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 bg-light mt-4 rounded">
        <h3 class="text-center p-2">Ажирирај е-маил</h3>
        
        <form action="" method="post" class="p-3" id="reg-box">
          
          <div class="form-group">
            <input type="text" name="email" class="form-control form-control-lg rounded-0" placeholder="Тренутни е-маил" required>
          </div>
          <div class="form-group">
            <input type="email" name="newemail" class="form-control form-control-lg rounded-0" placeholder="Нови е-маил" required>
          </div>
          <div class="form-group">
            <input type="password" name="pass" class="form-control form-control-lg rounded-0" placeholder="Потврдите шифру" required>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" id="update" value="Ажурирај" class="btn btn-primary btn-block btn-lg rounded-0">
          </div>
          <div class="text-center">
          	<img src="loader.gif" id="loader" width="100" style="display:none;">
          	<h5 class="text-center text-danger" id="msg"></h5>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#update").click(function(e){
        if(document.getElementById('reg-box').checkValidity()){
          e.preventDefault();
          $("#loader").show();
          $.ajax({
            url:'newAction.php',
            method:'post',
            data:$("#reg-box").serialize(),
            success:function(response){
              $("#msg").html(response);
              $("#loader").hide();
              $("#reg-box")[0].reset();
            }
          });
        }
        return true;
      });
    })
  </script>
</body>

</html>