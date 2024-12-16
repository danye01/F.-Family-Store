<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Create Sales
                <a href="#"class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertmessage(); ?>

            <form action="orders-code.php" method="POST">

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Select Product</label>
                        <select name="product_id" class="form-select mySelect2">
                            <option value="">-- Select Product --</option>
                            <?php
                                $product = getAll('products');
                                if ($product) 
                                {
                                    if(mysqli_num_rows($product) > 0){
                                        foreach($product as $prodItem){
                                            ?>
                                            <option value="<?= $prodItem['id']; ?>"><?= $prodItem['name']; ?></option>
                                            <?php
                                        }
                                    }else{
                                        echo'<option value="">No product found !</option>';
                                    }
                                }
                                else
                                {
                                    echo'<option value="">Something Went Wrong !</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="">Quantity </label>
                        <input type="number" name="quantity" value="1" class="form-control" />
                    </div>
                    
                    <div class="col-md-2 mb-3 text-end">
                        <br>
                    <button type="submit" name="addItem" class="btn btn-primary ">Add Item</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

<?php include('includes/footer.php'); ?>