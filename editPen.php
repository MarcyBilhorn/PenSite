<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>My Collection - Update Pen</title>
     <link rel="stylesheet" type="text/css" href="penSite.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>

<?php

    require_once('connectvars.php');
    require_once('Item.php');
    require_once('FountainPen.php');

          // Connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_POST['submit'])) {
        // Get ink info from form
        $brandId = mysqli_real_escape_string($dbc, trim($_POST['brand_id']));
        $color = mysqli_real_escape_string($dbc, trim($_POST['color']));
        $name = mysqli_real_escape_string($dbc, trim($_POST['item_name']));
        $penId = mysqli_real_escape_string($dbc, trim($_POST['item_id']));

        $new_pen = new FountainPen;

        // Set object variables
        $new_pen->setBrandId($brandId);
        $new_pen->setColor($color);
        $new_pen->setName($name);
        $new_pen->setItemId($penId);
        $description = $new_pen->formatDescription();
        $new_pen->setDescription($description);

        echo $new_pen->getBrandId();

        // Update pen to database
        $new_pen->updateItem();

        mysqli_close($dbc);

        // Return user to index.php
        $return_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
        header('Location: ' . $return_url);

    } else { 
        // Get pen info

        $itemID = $_GET['item_id'];

        $query = "SELECT name, brand_id, color FROM item_info where item_id = " . $itemID;

        $data = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($data);
        $total = mysqli_num_rows($data);
        
        if ($total != 1) {
            echo '<p>Error: Pen not found</p>';
        } else {
            $name = $row['name'];
            $brandId = $row['brand_id'];
            $color = $row['color'];
           
        }
    }
?>

   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
        <h3 class="text-center">Update Pen:</h3>
        <div class="form-group">
            <label for="item_name" class="control-label col-sm-2">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="item_name" value="<?php if (!empty($name)) echo $name; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="color" class="control-label col-sm-2">Color:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="color" value="<?php if (!empty($color)) echo $color; ?>" />
            </div>
        </div>
        <?php
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "SELECT brand_name, brand_id FROM brand_info ORDER BY brand_name";
            $data = mysqli_query($dbc, $query);
            
            if (mysqli_num_rows($data) > 0) {
        ?>
        <div class="form-group">
            <label for="brand_id" class="control-label col-sm-2">Brand:</label>
            <div class="col-sm-10">
                <select name="brand_id">
        <?php
            while ($row = mysqli_fetch_array($data)) {
                echo '<option value="' . $row['brand_id'] . '" ';

                 if (!empty($brandId) && $brandId == $row['brand_id']) {
                    echo 'selected="selected"';
                }
                
                echo '>' . $row['brand_name'] . '</option>';
            }
        ?>
                </select>
            </div>
        </div>
        <?php
            }
            
        mysqli_close($dbc);       
        ?>
        <input type="hidden" name="item_id" value="<?php if (!empty($itemID)) echo $itemID; ?>" />
        <p class='centerButtonCushion'></p>
        <span class="centerButton">
            <input type="submit" value="Save Pen" class="btn btn-primary" name="submit" />
        </span>
    </form>



</body>
</HTML>