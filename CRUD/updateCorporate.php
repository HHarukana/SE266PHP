<?php

    include __DIR__. '/model/model_Corporate.php';
    include __DIR__. '/functions.php';
    
    
    $action = filter_input(INPUT_GET, 'action');
    $id = filter_input(INPUT_GET, 'id');
    
    $read = readCorp($id);
    
      
        if($action == 'update'){

            $corp = $read['corp'];
            $email = $read['email'];
            $zipcode = $read['zipcode'];
            $owner = $read['owner'];
            $phone = $read['phone'];

        }
        else{

            $corp = "";
            $email = "";
            $zipcode = "";
            $owner = "";
            $phone = "";

        }
    
    if (isPostRequest() && isset($corp, $email, $owner, $zipcode, $phone))
    {
        $id = filter_input(INPUT_POST, 'id');
        $corp = filter_input(INPUT_POST, 'corp');
        $email = filter_input(INPUT_POST, 'email');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $owner = filter_input(INPUT_POST, 'owner');
        $phone = filter_input(INPUT_POST, 'phone');
        $corps = updateCorp ($id, $corp, $email, $zipcode, $owner, $phone);
        
        
    }
    
    $corps = updateCorp ($id, $corp, $email, $zipcode, $owner, $phone);
    
    
?>

<html lang="en">
    
<head>
    
  <title>Update Corporation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
   
<div class="container">
    
  <h2>Update Corporation</h2>
  
  <form class="form-horizontal" action="updateCorporate.php" method="post">
      
     <input type="hidden" name="id" value="<?php echo $id; ?>">
      
    <div class="form-group">
      <label class="control-label col-sm-2" for="corporation name">Corporation Name:</label>
      <div class="col-sm-10">
        <!--<input type="text" class="form-control" id="corp" name="corp" >-->
            <input type="text"  name="corp" value="<?php echo $read['corp']; ?>">
      </div>
    </div>
      
    <div class="form-group">
      <label class="control-label col-sm-2" for="corporate email">Corporate Email:</label>
      <div class="col-sm-10">          
        <!--<input type="text" class="form-control" id="email" name="email">-->
            <input type="text"  name="email" value="<?php echo $read['email']; ?>">
      </div>
    </div>
      
    <div class="form-group">
      <label class="control-label col-sm-2" for="corporate zip">Corporate Zip Code:</label>
      <div class="col-sm-10">          
         <!--<input type="text" class="form-control" id="zip" name="zip">-->
          <input type="text"  name="zipcode" value="<?php echo $read['zipcode']; ?>">
      </div>
    </div>
      
    <div class="form-group">
      <label class="control-label col-sm-2" for="corporate owner">Corporation Owner:</label>
      <div class="col-sm-10">          
        <!--<input type="text" class="form-control" id="owner" name="owner">-->
          <input type="text"  name="owner" value="<?php echo $read['owner']; ?>">
      </div>
    </div>
      
    <div class="form-group">
      <label class="control-label col-sm-2" for="corporate phone">Corporate Phone Number:</label>
      <div class="col-sm-10">          
        <!--<input type="text" class="form-control" id="phone" name="phone">-->
          <input type="text"  name="phone" value="<?php echo $read['phone']; ?>">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Update Corporation</button>
        <?php
            if (isPostRequest()) {
                echo "Corporation Updated";
                
            }
        ?>
      </div>
    </div>
  </form>
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./view.php">Return</a></div>
</div>

</body>
</html>

