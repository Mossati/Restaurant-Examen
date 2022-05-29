<?php
//customer / index.php
include_once '../inc.db.php';
include_once 'functions.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    //iemand heeft dit gepost!
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])){
        //alle velden bestaan en zijn ingevuld?
        //check of ze wel waarden hebben:
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        //check of ze leeg zijn:
        if(empty($name) OR empty($email) OR empty($phone)){
            echo "Alle velden zijn verplicht!<br>";
        }
        else{
            $id = createCustomer($pdo, $name, $email, $phone);
            //echo $id;
            if(is_numeric($id)){
                echo "Klant met succes toegevoegd!<br>";
                }
                else{
                    echo "Daar ging wat fout: " . $id . "<br>";
                }
            }
        }
    }

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $del = deleteCustomer($pdo, $id);
    if (is_numeric($del)){
        echo "Klant met succes verwijderd!<br>";
    }
    else{
        echo "Daar ging wat fout: " . $del . "<br>";
        }
    }
$customers = customerList($pdo);

//var_dump($customers);
?>
<form method="post" action="index.php">
Name: <input type="text" name="name"><br>
Email: <input type="text" name="email"><br>
Phone: <input type="text" name="phone"><br>
<input type="submit" value="New!">
</form>
<hr>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>phone</th>
        <th>actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($customers as $c){
        ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['name'] ?></td>
            <td><?= $c['email'] ?></td>
            <td><?= $c['phone'] ?></td>
            <td><a  href="index.php?delete=<?= $c['id'] ?>">delete</a> | <a href="edit.php?id=<?= $c['id'] ?>">edit</a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<h1>Hello, world!</h1>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>

