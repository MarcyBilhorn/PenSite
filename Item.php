<?php
    require_once('connectvars.php');

    class Item {
        protected $itemId;
        protected $brandId;
        protected $color;
        protected $description;
        protected $name;
        protected $brandName;

        // Setters
        public function setItemId($itemId) {
            $this->itemId = $itemId;
        }

        public function setBrandId($brandId) {
            $this->brandId = $brandId;
        }

        public function setColor($color) {
            $this->color = $color;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setBrandName($brandName) {
            $this->brandName = $brandName;
        }

        // Getters
        public function getItemId() {
            return $this->itemId;
        }

        public function getBrandId() {
            return $this->brandId;
        }

        public function getColor() {
            return $this->color;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getName() {
            return $this->name;
        }

        public function getBrandName() {
            return $this->brandName;
        }

        // Functions

        // The purpose of this function is to set the description
        public function formatDescription() {
            return 'This is a description';
        }

        // The purpose of this function is to add a new Item to the database
        public function addNewItem() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO item_info (brand_id, color, category, name, description) VALUES ($this->brandId, '$this->color', 'Category', '$this->name', 'Description')";
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }

        // The purpose of this function is to update an item in database
        public function updateItem() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "UPDATE item_info SET brand_id=$this->brandId, color='$this->color', name='$this->name', description='$this->description' WHERE item_id = $this->itemId";
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }
    }

?>