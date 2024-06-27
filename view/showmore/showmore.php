<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./showmore.css">
    <title>Image Details</title>
</head>
<body>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Database connection using PDO
        $pdo = new PDO('mysql:host=localhost;dbname=photosinfo', 'root', '');

        $sql = "SELECT * FROM images WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $imageData = base64_encode($row['image_data']);
                $title = $row['title'];
                $description = $row['description'];
                $map = $row['locationmap'];
                $city = $row['city'];
                ?>
                <div class="show">
                    <div class="container">
                       <div class="image-container">
                            <a><img src="data:image/jpeg;base64, <?php echo $imageData ?>" alt="Image"></a>
                        </div>
                        <div class="information">
                            <h2><?php echo $title ?></h2>
                            <h4 id="text_to" class="description"><?php echo '<p>'.$description.'</p>' ?></h4>
                            <p><?php echo $city ?></p>
                            <a href="<?php echo $map ?>" target="_blank">MAPS OF <?php echo strtoupper($title) ?></a>
                            <button id="speak-button">Listen</button>
                        </div>
                    </div>
                </div>
                <?php
            }
        } 
    }
    ?>
</body>
</html>
<script>
        let utterance = null; // Variable pour stocker l'objet d'utterance

        if ('speechSynthesis' in window) {
            const speakButton = document.getElementById('speak-button');

            // Set the language to French (France)
            const language = 'fr-FR';

            // Text element to be spoken
            const textElement = document.getElementById('text_to');

            // Event listener pour le bouton click
            speakButton.addEventListener('click', () => {
                if (utterance) {
                    // Si une synthèse vocale est déjà en cours, l'annuler
                    speechSynthesis.cancel();
                }

                const text = textElement.textContent; // Get the text from the element
                utterance = new SpeechSynthesisUtterance(text);

                // Set the language for the utterance
                utterance.lang = language;

                // Utiliser la synthèse vocale du navigateur
                speechSynthesis.speak(utterance);
            });

            // Gestionnaire d'événements pour arrêter la synthèse vocale avant de quitter la page
            window.addEventListener('beforeunload', () => {
                if (utterance) {
                    speechSynthesis.cancel();
                }
            });
        }
    </script>