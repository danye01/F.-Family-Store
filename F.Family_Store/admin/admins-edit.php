
<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0"> Edit Admin
                <a href="admins.php"class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertmessage(); ?>

            <form action="code.php" method="POST">

            <?php 
                if(isset($_GET['id']))
                {
                    if($_GET['id'] != ''){

                        $adminId = $_GET['id'];

                    }else{
                        echo'<h5>No id found</h5>';
                        return false;
                    }
                }
                else{
                    echo'<h5>No id in params</h5>';
                    return false;
                }

                $adminData = getById('admins', $adminId );
                if($adminId)
                {
                    if($adminData['status'] == 200)
                    {
                        ?>
                         
            <input type="hidden" name="adminId" value="<?=$adminData['data']['id']; ?>">
            <div class="row">
            <div class="col-md-12 mb-3">
                <label for="">Name *</label>
                <input type="text" name="name" required value="<?=$adminData['data']['name']; ?>" class="form-control" />
            </div>

            <div class="col-md-6 mb-3">
                <label for="">Email *</label>
                <input type="email" name="email" required value="<?=$adminData['data']['email']; ?>" class="form-control" />
            </div>

            <div class="col-md-6 mb-3">
                <label for="">Password *</label>
                <input type="password" name="password"  class="form-control" />
            </div>

            <div class="col-md-6 mb-3">
                <label for="">Phone Number *</label>
                <br>
                <input type="number" name="phone" required value="<?=$adminData['data']['phone']; ?>" class="form-control" />
            </div>
                        
            <div class="col-md-3 mb-3">
                <label for="">Is Ban</label>
                <input type="checkbox" name="is_ban" <?=$adminData['data']['is_ban'] == true ? 'checked':''; ?> style="width: 20px; height: 20px;" />
            </div>

            <div class="col-md-12 mb-3 text-end">
                <button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
            </div>
            </div>
        </form>
                        <?php
                    }
                    else
                    {
                        echo'<h5>'.$adminData['message'].'</h5>';
                    }
                }
                else{
                    echo'Something Went Wrong ! ';
                    return false;
                }
           ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>