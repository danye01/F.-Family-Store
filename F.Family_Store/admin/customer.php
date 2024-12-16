<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Customers
                <a href="customers-create.php"class="btn btn-primary float-end">Add Customer</a>
            </h4>
        </div>
        <div class="card-body">
        <?php alertmessage(); ?>
        <?php
            $customers = getAll('customers');
            if (!$customers) {
                echo '<h4>Something went wrong </h4>';
                return false;
            }
            if(mysqli_num_rows($customers) > 0)
            {
          
            ?>              

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php foreach($customers as $Item) : ?>            
                    <tr>
                        <td><?= $Item ['id']?></td>
                        <td><?= $Item ['name']?></td>
                        <td><?= $Item ['email']?></td>
                        <td><?= $Item ['phone']?></td>
                        <td>
                            <?php
                                if  ( $Item ['status'] == 1){
                                    echo '<span class="badge bg-danger">Inactive</span>';
                                }
                                else
                                {
                                    echo '<span class="badge bg-primary">Active</span>';
                                }
                            ?>
                        </td>

                        <td>
                            <a href="customers-edit.php?id=<?= $Item ['id']; ?>"class="btn btn-success btn-sm">Edit</a>
                            <a href="customers-delete.php?id=<?= $Item ['id']; ?>" 
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete ?')"
                            >
                            Delete</a>
                        </td>
                    </tr> 
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
                    }
                    else{
                        ?>
                        <tr>
                            <h4 clas="mb-0">No records found</h4>
                        </tr>
                        <?php
                    }

                    ?>
        </div>
    </div>
</div>                  
                            
<?php include('includes/footer.php'); ?>
    