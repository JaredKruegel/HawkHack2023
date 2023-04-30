<?php 
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $id = $_SESSION['user_id'];

    // $query = "select * from food where user_id = '$id' limit 1";
    // $result = mysqli_query($con,$query);
    // if($result && mysqli_num_rows($result) > 0)
    // {
    //     $food_data = mysqli_fetch_assoc($result);
    // }

    $query = "select * from food where user_id = '$id'";
    $queryresult = mysqli_query($con,$query);

    // while ($result = mysqli_fetch_array($queryresult))
    // {
    //     echo $result['food_name'];
    //     echo "<br>";
    // }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Page</title>
        <style>
            body {
        background-color: #fff8d6;
        font-family: Arial, sans-serif;
      }
      .dashboard {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
      }
      .people {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #617a55;
      }
      .rectangle7 {
        width: 100%;
        height: 10px;
        background-color: #a4d0a4;
        margin-bottom: 20px;
      }
      .avatar {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        height: 200px;
        width: 200px;
        background-color: #f7e1ae;
        border-radius: 50%;
      }
      .frame10067,
      .frame100672,
      .frame100673 {
        height: 90%;
        width: 90%;
        border: 2px solid #617a55;
        border-radius: 50%;
      }
      .rectangle9 {
        width: 100%;
        height: 10px;
        background-color: #a4d0a4;
        margin-bottom: 20px;
      }
      .suggestedrecipes {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #617a55;
      }
      .image {
        width: 400px;
        height: 300px;
        margin-bottom: 20px;
      }
      .image2,
      .image4 {
        max-width: 100%;
        max-height: 100%;
      }
      .image3 {
        width: 400px;
        height: 300px;
        margin-bottom: 20px;
        background-color: #f7e1ae;
      }
        </style>
    </head>

    <body>
        <div class="dashboard">
        <h1>Hello <?php echo $user_data['user_name']; ?></h1>
        <h3>Food</h3>
        <a href="addfood.php"><h2>Add Food</h2></a>
        <a href="logout.php"><h2>Logout</h2></a>
        <?php 
            while ($result = mysqli_fetch_array($queryresult))
            {
                echo "<p>Food Name: ";
                echo $result['food_name'];
                echo "</p>";
                echo "<p>Food Recipe: ";
                echo $result['food_recipe'];
                echo "</p>";
                echo "<hr>";
            }
        ?>


        </div>
    </body>
</html>




