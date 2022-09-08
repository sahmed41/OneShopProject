

<div class="modal fade" id="product_registration_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="_engine/_product_registration.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">        
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" aria-describedby="emailHelp" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_description" class="form-label">Product Description</label>
                            <textarea class="form-control" id="product_description" rows="3" name="product_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price Befor Discount (LKR)</label>
                            <input type="number" class="form-control" id="price" aria-describedby="emailHelp" name="price" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">discount</label>
                            <input type="number" class="form-control" id="discount" aria-describedby="emailHelp" name="discount" min="0" max="100" value="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_category" class="form-label">Product Category</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" idate="product_category" name="product_category" required>
                                <option value="" selected>Select a category</option>
                                <?php
                                    foreach ($product_categories as $category) {
                                        echo '<option value="' . $category . '">' . $category . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product_image_main" class="form-label">Product Image</label>
                            <input class="form-control" type="file" id="product_image_main" name="product_image_main" value="product_picture" required>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class='btn btn-secondary'>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>