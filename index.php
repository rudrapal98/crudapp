<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>CRUD app</title>
</head>
<body>
<?php require_once 'process.php' ?>


<!-- Message after each action -->
<?php
  if(isset($_SESSION['message'])): ?>

  <div class="alert alert-<?php echo $_SESSION['msg_type']?>">

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
  </div>


  <!-- Displaying the records in the form of table -->

  <?php endif ?>
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Location</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "crud";
        
        // Create a connection
        $mysqli = new mysqli($servername, $username, $password, $database) or die(mysqli_error($mysqli));
        
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        while($row = mysqli_fetch_assoc($result)){
          echo "<tr>
                  <td>". $row['name'] . "</td>
                  <td>". $row['location'] . "</td>
                  <td> 
                    <a href='index.php?edit=".$row['id']."' class='btn btn-info'>Edit</a> 
                    <a href='process.php?delete=".$row['id']."' class='btn btn-danger'>Delete</a> 
                  </td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <hr>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>



  <!-- Creating the input form -->
  
    <div class="container my-3">
        <form action="process.php" method="POST">
          <input type="hidden" name="id"  value="<?php echo $id; ?>">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" value="<?php echo $name; ?>" name="name" class="form-control" id="name">
            </div>

            <div class="mb-3">
              <label for="location" class="form-label">Location</label>
              <input type="text" value="<?php echo $location; ?>" name="location" class="form-control" id="location">
            </div>
            <?php 
              if($update):
            ?>
              <button type="submit" class="btn btn-info" name="update">update</button>
            <?php else:?>
          <button type="submit" class="btn btn-primary" name="save">Save</button>
          <?php endif; ?>
          </form>
    </div>
  </body>
</html>