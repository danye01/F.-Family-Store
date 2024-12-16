<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit Customers
                <a href="customer.php"class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertmessage(); ?>

            <form action="code.php" method="POST">

            <?php
                $paramValue = checkParamId('id');
                if(!is_numeric($paramValue))
                {
                    echo'<h5>'.$paramValue.'</h5>';
                    return false;
                }

                $customers = getById('customers', $paramValue);
                if($customers['status'] == 200)
                {
                    ?>

                    <input type="hidden" name="customerId" value=" <?= $customers['data']['id']; ?> "/>
                            <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Name*</label>
                        <input type="text" name="name" required value="<?= $customers['data']['name']; ?>" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Email*</label>
                        <input type="email" name="email" value="<?= $customers['data']['email']; ?>" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Phone*</label>
                        <input type="number" name="phone" value="<?= $customers['data']['phone']; ?>" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Status (Unchecked=Active, Checked=Inactive)</label>
                        <br>
                        <input type="checkbox" name="status" value="<?= $customers['data']['status'] == true ? 'checked':''; ?>" style="width:30px;height:30px";>
                    </div>
                    
                    <div class="col-md-6 mb-3 text-end">
                    <button type="submit" name="UpdateCustomer" class="btn btn-primary">Update </button>
                    </div>

                </div>

                    <?php
                }
                else
                {
                    echo'<h5>'.$customers['message'].'</h5>';
                    return false;
                }
            ?>

               
            </form>
        </div>
    </div>
</div>                  
                            
<?php include('includes/footer.php'); ?>