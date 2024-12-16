<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Add Product
                <a href="products.php"class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertmessage(); ?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

                <div class="row">
                
                <div class="col-md-12 mb-3">
                    <label>Select Category</label>
                        <select name="category_id" class=" col-md-4 mb-3 mySelect2" id="form-select ">
                            <option value="">Select Category</option>
                            <?php
                                $categories = getAll('categories');
                                if($categories)
                                {
                                    if(mysqli_num_rows($categories) > 0)
                                    {
                                        foreach($categories as $cateItem){
                                            echo'<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';
                                        }
                                    }
                                    else
                                    {
                                        echo'<option value="">No Categories Found !</option>';
                                    }
                                }
                                else
                                {
                                    echo'<option value="">Something Went Wrong !</option>';
                                }
                            ?>
                        </select>
                </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Product Name*</label>
                        <input type="text" name="name" required class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Description </label>
                        <textarea name="description" class="form-control" row="3"></textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Price*</label>
                        <input type="text" name="price" required class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Quantity*</label>
                        <input type="text" name="quantity" required class="form-control">
                    </div>

                   <!--<div class="col-md-4 mb-3">
                        <label for="">Image*</label>
                        <input type="file" name="image" class="form-control">
                    </div> -->



                    <div class="col-md-6">
                        <label>Status (Unchecked = Available, Checked = Unavailable)</label>
                        <br>
                        <input type="checkbox" name="status" style="width:30px;height:30px";>
                    </div>
                    
                    <div class="col-md-3 mb-3 text-end">
                    <button type="submit" name="saveProduct" class="btn btn-primary">Add</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>                  
                            
<?php include('includes/footer.php'); ?>