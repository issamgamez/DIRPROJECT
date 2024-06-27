<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-image: url('../view/images/back11.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            padding: 10% 20%;
        }
        .addYes{
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #000;
            background-color: green;
            border-radius: 5px;
            margin: 5% 10%;
  
        }
        .addNo{
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #000;
            background-color: red;
            border-radius: 5px;
            margin: 5% 10%;
        }
        .Show{
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #000;
            background-color:burlywood;
            border-radius: 5px;
            margin: 5% 10%;
            text-transform: uppercase;

        }
    </style>
</head>
<body>
    
</body>
</html>
<?php

    use DIRPROJECT\CONTROLLERS;
    use DIRPROJECT\CONTROLLERS\controllersphotos;

    require("../controllers/controllers.php");
    
    
        // testing admin 
        if(isset($_POST['login'])){
            if($_POST['name'] == 'admin' && $_POST['pwd'] == 'admin2023'){
                setcookie('user',$_POST['name'],time()+60,'/');
                setcookie('pwd',$_POST['pwd'],time()+60,'/');
                header('location:../view/UploadImages/upload_form.html');
                
            }else{
                echo "<div class='Show' >You can just show images.</div>";
                header("Refresh: 3;url=../view/home/home.php");
            }
        }

        // upload image info
        if (isset($_POST['upload'])) {
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            $title = $_POST['title'];
            $description = $_POST['description'];
            $map = $_POST['map'];
            $city = $_POST['city'];
            $add = new controllersphotos();
            if($add->AddPhotoInfo($imageData,$title,$description,$map,$city)){
                echo " <div class='addYes'> Uploaded Successfully.</div> ";
                header("Refresh: 3;url=../view/UploadImages/upload_form.html");
                
            }else{
                echo "<div class='addNo' >Uploaded Warning.</div>";
                header("Refresh: 3;url=../view/UploadImages/upload_form.html");
            }
        }

        // update info
        if(isset($_POST['update'])){
            $title = $_POST['old_title'];
            $image = file_get_contents($_FILES['NewImage']['tmp_name']);
            $city = $_POST['Newcity'];
            $map = $_POST['NewMap'];
            $desc = $_POST['NewDescription'];

            $update = new controllersphotos();
            if($update->update($title,$city,$image,$desc,$map)){
                echo " <div class='addYes'> Update Successfully.</div> ";
                header("Refresh: 3;url=../view/update/update.html");
            }else{
                echo "<div class='addNo' >Update Warning.</div>";
                header("Refresh: 3;url=../view/update/update.html");
            }
        }

        // delete info
        if(isset($_POST['delete'])){
            $delete = new controllersphotos();
            if($delete->delete($_POST['title'])){
                echo  " <div class='addYes'> DELETE Successfully.</div> ";
                header("Refresh: 3;url=../view/delete/delete.php");
            }else{
                echo "<div class='addNo' >DELETE Warning.</div>";
                header("Refresh: 3;url=../view/delete/delete.php");
            }
        }
?>