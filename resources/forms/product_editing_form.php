
<?php 
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
} 



?>
<?php
    $sql = "SELECT product_id, product_name, product_description, product_price, discsount, Category, product_image, added_on, seller FROM products WHERE product_id ='". $product_id ."'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
    // Capturing db input to variables
        while($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $discsount = $row['discsount'];
            $p_category = $row['Category'];
            $product_image = $row['product_image'];
        }
    } else {
        echo "<h2>Something is wrong</h2>";
    }
?>
    

    <?php  
    echo '<div class="container">';   
    echo '<h1>Edit Product: ' . $product_name . '</h1>';  
    echo '<img src="resources/pictures/product_images/' . $product_image . '" class="w-25 prodect_image">';
    echo '<form action="_engine/_product_edit.php?product_image=' . $product_image . ' " method="POST" enctype="multipart/form-data">';
        echo    '<input type="hidden" id="custId" name="product_id" value="' . $product_id . '">';
        echo    '<div class="modal-body">';
                echo '<div class="mb-3">';
                echo    '<label for="product_name" class="form-label">Product Name</label>';
                    
                    echo '<input type="text" class="form-control" id="product_name" aria-describedby="emailHelp" name="product_name" value="'. $product_name . '" required>';
                    
                echo '</div>';
                echo '<div class="mb-3">';
                    echo '<label for="product_description" class="form-label">Product Description</label>';
                    echo '<textarea class="form-control" id="product_description" rows="3" name="product_description" required>' . $product_description . '</textarea>';
                echo '</div>';
                echo '<div class="mb-3">';
                    echo '<label for="price" class="form-label">Price Brfore Dsicount (LKR)</label>';
                    echo '<input type="number" class="form-control" id="price" aria-describedby="emailHelp" name="price" value="'. $product_price . '" min="1" required>';
                echo '</div>';
                echo '<div class="mb-3">';
                    echo '<label for="discount" class="form-label">discount</label>';
                    echo '<input type="number" class="form-control" id="discount" aria-describedby="emailHelp" name="discount" min="0" max="100" value="'. $discsount . '" required>';
                echo '</div>';
                echo '<div class="mb-3">';
                    echo '<label for="product_category" class="form-label">Product Category</label>';
                    echo '<select class="form-select form-select-sm" aria-label=".form-select-sm example" idate="product_category" name="product_category" required>';
                        echo '<option selected value="' . $p_category . '">' . $p_category . '</option>';
                        
                            foreach ($product_categories as $category) {
                                echo '<option value="' . $category . '">' . $category . '</option>';
                            }
                        
                    echo '</select>';
                echo '</div>';
                echo '<div class="mb-3">';
                    echo '<label for="product_image" class="form-label">Product Image</label>';
                    echo '<input class="form-control" type="file" id="product_image" name="product_image">';
                echo '</div>';
                
            echo '</div>';
            echo '<div class="modal-footer">';
            echo    '<input type="reset" class="btn btn-dark">';
            echo    '<button type="submit" class="btn btn-dark">Save</button>';
            echo '</div>';
        echo '</form>';
        echo '<div>';
    ?>