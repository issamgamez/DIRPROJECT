<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
    <link rel="stylesheet" href="home.css">
    <title>DRAA TAFILALT</title>
</head>
<body>
    <!-- -------- home ------------- -->
    <section class="header">
      <img class="img_back" src="../images/back11.jpg" alt="">
        <div class="content">
            <nav>
                <a href=""><img src="../images/logo.png" alt=""></a>
                <div id="nav_links" class="nav_links">
                  <i class="fa-solid fa-xmark" onclick="hide_menu()"></i>
                  <ul>
                    <li><a href="">HOME</a></li>
                    <li><a data-toggle="modal" data-target="#myModal"><button class="button" data-modal="modalTwo">LOGIN</button></a></li>
                    <li><a href="#galerry">GALERRY</a></li>
                  </ul>
                </div>
                <i class="fa-solid fa-bars" onclick="open_menu()"></i>
              </nav> 
              <input type="text" id="titleFilter" placeholder=" Image City">
              <div class="title_text">
                <h1>DRAA TAFILALT</h1>
                <p>The Draa-Tafilalet region has a unique and special <br> place in Moroccan history rich in events <br> and iconic figures</p>
                <a class="btn_contact" href="https://visitdraatafilalet.com/">More</a>
            </div>
          </div>
    </section> 
    <!-- ------------- galerry------------ -->
    <section id="galerry" class="galerry">
    <?php
try {
    // Database connection using PDO
    $pdo = new PDO('mysql:host=localhost;dbname=photosinfo', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Retrieve images and information from the database
    $sql = "SELECT * FROM images";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imageData = base64_encode($row['image_data']);

            // Add a data-title attribute to store the image title
            echo '<div class="show">';
            echo '<div class="image-container">';
            echo '<a href="../showmore/showmore.php?id=' . $row['id'] . '">';
            echo '<img src="data:image/jpeg;base64, ' . $imageData . '" alt="Image" title="' . $row['city'] . '" data-title="' . $row['city'] . '">';
            echo '</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="no-images-found">No images found.</div>';
    }
} catch (PDOException $e) {
    echo '<div class="no-images-found">Connexion Error.</div>';
}
?>
</section>
    <!-- ------------------ login ------------------ -->
    <section class="login">
      <div id="modalTwo" class="modal">
        <div class="modal-content">
              <div class="contact-form">
                <span class="close">&times;</span>
                <form action="../../router/router.php" method="POST">
                  <h2>LOGIN</h2>
                  <div>
                    <input type="text" name="name" placeholder="Full name" require value="<?php if(isset($_COOKIE['user'])){echo $_COOKIE['user'];} ?>"/>
                    <input type="password" name="pwd" placeholder="passowrd" require value="<?php if(isset($_COOKIE['pwd'])){echo $_COOKIE['pwd'];} ?>"/>
                  </div>
                  <button class="button" type="submit" name="login" href="">Submit</button>
                </form>
              </div>
            </div>
          </div>
    </section>
    <!-- js -->
    <script src="home.js"></script>
  </body>
</html>