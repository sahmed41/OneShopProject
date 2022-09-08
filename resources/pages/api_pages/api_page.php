<?php require_once("../../../_engine/_db_connect.php"); ?>
<?php session_start(); ?>
<h2>OneShop APIs</h2>
<p>OneShop is a product catelogue. In addition, it also provide three different APIs for other system to implement and reduce the development time</p>
<p>The first of three APIs are local amount api which can be used to convert any amount of local currency to a foreign currecy. The second API is product api that can be used to get a list of product based on at least on filter. This can be used for adverticement purposes. Which can be used for future adverticement revenue programs. Third one is the login api which help other system to implement login based on OneShop user database. </p>


<?php if (isset($_SESSION['user_id'])) { ?>
    <!-- This block will be executed only if the session id is available -->
    <?php
        $sql = "SELECT user, app_id, api_key FROM apikey WHERE user='" . $_SESSION['user_id'] . "'";
        $result = $db->query($sql);
        
        if ($result->num_rows > 0) {
        // If the query provided results this block will be executed
            //   output data of each row
         
            echo '<form action="_engine/_create_api_key.php" method="get">';
            echo '<div class="row my-5">';
            echo '<div class="col-4">';
            echo      '<div class="input-group mb-3">';
            echo      '<span class="input-group-text bg-dark text-light" id="basic-addon3">Appid</span>';
            echo      '<input type="text" class="form-control" id="app_id" aria-describedby="basic-addon3" name="app_id">';
            echo      '</div>';
            echo '</div>';
            echo '<div class="col-2">';
            echo '<button type="submit" class="btn btn-dark">Generate API Key</button>';
            echo '</div>';      
            echo '</div>';
            echo '</form>';
          
            echo      '<table class="table w-50 my-5">';
            echo      '<thead>';
            echo          '<tr>';
            echo          '<th scope="col">App ID</th>';
            echo          '<th scope="col">API Key</th>';
            echo          '</tr>';
            echo      '</thead>';
            echo      '<tbody>';
          while ($row = $result->fetch_assoc()) {
            echo    '<tr>';
            echo        '<td>' . $row['app_id'] . '</td>';
            echo        '<td>' . $row['api_key'] . '</td>';
            echo    '</tr>';
        }
           echo     '</tbody>';
           echo     '</table>';
        } else {
        // This block will be executed if the query does not provide any results
        
        echo '<form action="_engine/_create_api_key.php" method="get">';
        echo '<div class="row my-5">';
          echo '<div class="col-4">';
          echo      '<div class="input-group mb-3">';
          echo      '<span class="input-group-text bg-dark text-light" id="basic-addon3">Appid</span>';
          echo      '<input type="text" class="form-control" id="app_id" aria-describedby="basic-addon3" name="app_id">';
          echo      '</div>';
          echo '</div>';
          echo '<div class="col-2">';
          echo '<button type="submit" class="btn btn-dark">Generate API Key</button>';
          echo '</div>';      
          echo '</div>';
          echo '</form>';
          
        }
    ?>

<?php } else { ?>
    <!-- This block will be executed if the seesion id is not available -->
    <button type="button" class="btn btn-dark mt-5 me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Register</button>
    <button type="button" class="btn btn-dark mt-5 me-2" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">Login</button>
<?php } ?>




<?php require_once('../../../_engine/_db_disconnect.php'); ?>

