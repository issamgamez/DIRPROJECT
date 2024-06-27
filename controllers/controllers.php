<?php
    namespace DIRPROJECT\CONTROLLERS;
    use DIRPROJECT\MODELS;
    use DIRPROJECT\MODELS\modelsphotos;

    require('../models/models.php');
    class controllersphotos{
        private $NewImage;
        public function __construct()
        {
            $this->NewImage = new modelsphotos();
        }

        public function AddPhotoInfo($imageData,$title,$description,$map,$city){
            $new = $this->NewImage->AddPhotoInfo($imageData,$title,$description,$map,$city);
            if($new){
                return true;
            }else{
                return false;
            }
        }

        // update info
        public function update($title,$city,$image,$desc,$map){
            if($this->NewImage->update($title,$city,$image,$desc,$map)){
                return true;
            }else{
                return false;
            }
        }

        // delet info
        public function delete($title){
            return $this->NewImage->delete($title);
        }

    }

 $x = new controllersphotos();
?> 