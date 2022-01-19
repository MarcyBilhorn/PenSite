<?php
    require_once('connectvars.php');
    
    class Ink extends Item {

        // The purpose of this function is to set the description for ink
        public function formatDescription() {
            return $this->name . " ink";
        }

        // The purpose of this function is to add a new ink to the database
        public function addNewItem() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO item_info (brand_id, color, category, name, description) VALUES ($this->brandId, '$this->color', 'Ink', '$this->name', '$this->description')";
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }

    }
?>