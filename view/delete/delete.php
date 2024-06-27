<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="delete.css" rel="stylesheet">
    <title>delete info</title>
    
</head>
<body>
    <div class="container">
        <a href="../home/home.php" class="link">Home</a>
        <div class="header">
            <h1>Delete Information</h1>
        </div>
        <?php
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=photosinfo', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM images";
            $stmt = $pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $imageData = base64_encode($row['image_data']);
                    ?>
                    <div class="image-card">
                        <div class="image-info">
                            <h2 class="image-title"><?= $row['title'] ?></h2>
                        </div>
                        <form action="../../router/router.php" method="POST">
                            <input type="hidden" name="title" value="<?= $row['title'] ?>">
                            <button class="delete-button" type="submit" name="delete">DELETE</button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="no-images-found">No titles found.</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="no-images-found">Connection error.</div>';
        }
        ?>
    </div>
</body>
</html>
