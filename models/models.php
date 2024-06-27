<?php
    namespace DIRPROJECT\MODELS;

    use DIRPROJECT\CONTROLLERS\controllersphotos;
    use PDO;
    use PDOException;

    class modelsphotos{
        private $my_db;
        public function __construct()
        {
            try{
                // connect 
                $this->my_db = new PDO('mysql:host=localhost;dbname=mysql', 'root','');
                // create db and use it
                $this->my_db->query("CREATE DATABASE if not EXISTS photosinfo");
                $this->my_db->query("use photosinfo");

                // create table of images
                $this->my_db->query("CREATE TABLE if not EXISTS images (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    image_data longblob,
                    title varchar(255) UNIQUE,
                    description text,
                    locationmap varchar(255),
                    city varchar(255),
                    PRIMARY KEY (id)
                );
                ");

            }catch(PDOException $er){
                echo 'EROOR :' .$er->getMessage();
            }
        } 
        
        // insert photo info
        public function AddPhotoInfo($imageData,$title,$description,$map,$city){
            try{
            $add = $this->my_db->prepare("INSERT INTO images (image_data, title, description, locationmap, city) VALUES (:imageData, :title, :description, :map, :city)");
            $add->bindParam(':imageData', $imageData, PDO::PARAM_LOB);
            $add->bindParam(':title', $title, PDO::PARAM_STR);
            $add->bindParam(':description', $description, PDO::PARAM_STR);
            $add->bindParam(':map', $map, PDO::PARAM_STR);
            $add->bindParam(':city', $city, PDO::PARAM_STR);
            return $add->execute();
        }catch(PDOException){
            // echo $r;
    }

    }

    // update info
    public function update($title,$city,$image,$desc,$map){
        $update = $this->my_db->prepare("UPDATE images SET image_data = :image ,description=:description, locationmap=:map, city=:city WHERE title=:title");
        $update->bindParam(':image', $image, PDO::PARAM_LOB);
        $update->bindParam(':title', $title, PDO::PARAM_STR);
        $update->bindParam(':description', $desc, PDO::PARAM_STR);
        $update->bindParam(':map', $map, PDO::PARAM_STR);
        $update->bindParam(':city', $city, PDO::PARAM_STR);
        return $update->execute();
    }

    // delete info
    public function delete($title){
        return $this->my_db->query("DELETE FROM images WHERE title='".$title."'");
    }
}


?>