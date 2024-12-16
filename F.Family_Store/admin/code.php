<?php 

    include('../config/function.php');

    if(isset($_POST['saveAdmin']))
    {
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);
        $phone = validate($_POST['phone']);
        $is_ban = isset($_POST['is_ban']) == true ? 1:0;

        if($name != '' && $email != '' && $password != '' ){

            $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
                if($emailCheck){
                    if(mysqli_num_rows($emailCheck) > 0){
                        redirect('admins_create.php','Email Already used');
                    }
                }

                $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

                $data = [
                    'name' => $name,
                    'email'=> $email,
                    'password'=> $bcrypt_password,
                    'phone' => $phone,
                    'is_ban' => $is_ban		
                ];
                
                $result = insert('admins', $data);
                 
                if($result){
                    redirect('admins.php', 'Admin created Successfully! ');
                }else {
                    redirect('admins_create.php', 'Something went Wrong! ');
                }

        }else {
            redirect('admins_create.php', 'please fill required fields');
        }
        
    }

    if(isset($_POST['updateAdmin']))
    {   
        $adminId = validate($_POST['adminId']);
        
        $adminData = getbyId('admins', $adminId);
        if($adminData['status'] != 200)
        {
            redirect('admins-edit.php?id=',$adminId, 'Please fill required fields. ');
        }
        
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);
        $phone = validate($_POST['phone']);
        $is_ban = isset($_POST['is_ban']) == true ? 1:0 ;


        $EmailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id != '$adminId'";
        $checkResult = mysqli_query($conn, $EmailCheckQuery);
        if($checkResult) {
            if(mysqli_num_rows($checkResult) > 0){
                redirect('admins-edit.php?id=', $adminId, 'Email is already used');
            }
        }

        if($password != ''){
            $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        } else{
            $hashedpassword = $adminData ['data']['password'];
        }


        if($name != '' && $email != '' )
        {
            $data = [
                'name' => $name,
                'email' => $email,
                'password' =>  $hashedpassword,
                'phone' => $phone,
                'is_ban' => $is_ban	
            ];
            $result = update('admins',$adminId, $data);

            if ($result) {
                redirect('admins.php?id=', 'Admin Updated Successfully! ');
            }else{
                redirect('admins.edit.php?id=', 'Something went wrong. ');
            }
        } 
        else {
            redirect('admins-create.php', 'Please fill required fields. ');
        }
    }

    if(isset($_POST['saveCategory']))
    {
        $name = validate($_POST['name']);
        $description = validate($_POST['description']);
        $status = validate($_POST['status']) == true ? 1:0;
        
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status		
        ];
        
        $result = insert('categories', $data);
         
        if($result){
            redirect('categories.php', 'Category created Successfully! ');
        }else {
            redirect('categories-create.php', 'Something went Wrong! ');
        }
    }

    if(isset($_POST['updateCategory']))
    {   
        $name = validate($_POST['name']);
        $categoryId = validate($_POST['categoryId']);
        $description = validate($_POST['description']);
        $status = validate($_POST['status']) == true ? 1:0;
        
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status		
        ];
        
        $result = update('categories',$categoryId, $data);
         
        if($result){
            redirect('categories.php', 'Category Updated Successfully! ');
        }else {
            redirect('categories-edit.php?id='.$categoryId,'Something went Wrong! ');
        }
    }

    if(isset($_POST['saveProduct']))
    {
        
        $category_id = validate($_POST['category_id']);

        $name = validate($_POST['name']);
        
        $description = validate($_POST['description']);

        $price = validate($_POST['price']);

        $quantity = validate($_POST['quantity']);

        $status = isset($_POST['status']) == true ? 1:0;

        if($_FILES['image']['size'] > 0)
       {
            $path = "../assets/uploads/products";
            $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            $filename = time() .'.'. $image_ext;

            move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);

         $finalImage = "assets/uploads/products/".$filename;
       }
        else
        {
            $finalImage = '';
        }
        

        $data = [
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'price'=> $price,
            'quantity'=> $quantity,
            'image'=> $finalImage,
            'status' => $status,	
        ];
        
        $result = insert('products', $data);
         
        if($result){
            redirect('products.php', 'Product Created Successfully! ');
        }else {
            redirect('products-create.php', 'Something went Wrong! ');
        }
    }

    if(isset($_POST['updateProduct']))
    {
        $product_id = validate($_POST['product_id']);
        $productData = getById('products',$product_id);
        if(!$productData)
        {
            redirect('products.php', 'No product found!');
        }

        $category_id = validate($_POST['category_id']);

        $name = validate($_POST['name']);
        
        $description = validate($_POST['description']);

        $price = validate($_POST['price']);

        $quantity = validate($_POST['quantity']);

        $status = isset($_POST['status']) == true ? 1:0;


        if($_FILES['image']['size'] > 0)
       {
            $path = "../assets/uploads/products";
            $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            $filename = time() .'.'. $image_ext;

            move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);

         $finalImage = "../assets/uploads/products".$filename;

         $deleteImage = "../".$productData['data']['image'];
         if(file_exists($deleteImage)){
            unlink($deleteImage);
         }
       }
        else
        {
            $finalImage = $productData['data']['image'];
        }
        

        $data = [

            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'price'=> $price,
            'quantity'=> $quantity,
            'image'=> $finalImage,
            'status' => $status		
        ];
        
        $result = update('products', $product_id, $data);
         
        if($result){
            redirect('products.php' ,'Product Updated Successfully! ');
        }else {
            redirect('products-edit.php?id='.$product_id, 'Something went Wrong! ');
        }
    }
    
    if(isset($_POST['saveCustomer']))
    {
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $phone = validate($_POST['phone']);
        $status = isset($_POST['status']) ? 1:0;

        if($name != '')
        {
            $emailCheck = mysqli_query($conn,"SELECT * FROM customers WHERE email='$email'");
            if($emailCheck)
            {
                if(mysqli_num_rows($emailCheck) > 0)
                {
                    redirect('customer.php','Email is already Exist');
                }
            }

            $data = [
                'name'=> $name,
                'email'=> $email,
                'phone'=> $phone,
                'status'=> $status  
            ];

            $result = insert('customers', $data);
            if($result)
            {
                redirect('customer.php','Customer Created Successfully !!');
            }
            else
            {
                redirect('customer.php','Something Went Wrong');
            }
        }
        else
        {
            redirect('customer.php','Please fill required fields');
        }
    }

    if(isset($_POST['UpdateCustomer']))
    {                                                      
        $customerId = validate($_POST['customerId']);         
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $phone = validate($_POST['phone']);
        $status = isset($_POST['status']) ? 1:0;

        if($name != '')
        {
            $emailCheck = mysqli_query($conn,"SELECT * FROM customers WHERE email='$email' AND id !='$customerId'");
            if($emailCheck)
            {
                if(mysqli_num_rows($emailCheck) > 0)
                {
                    redirect('customers-edit.php?id='.$customerId ,'Email is already Exist');
                }
            }

            $data = [
                'name'=> $name,
                'email'=> $email,
                'phone'=> $phone,
                'status'=> $status  
            ];

            $result = update('customers',$customerId,$data);
            if($result)
            {
                redirect('customers-edit.php?id='.$customerId,'Customer Updated Successfully !!');
            }
            else
            {
                redirect('customers-edit.php?id='.$customerId,'Something Went Wrong');
            }
        }
        else
        {
            redirect('customers-edit.php?id='.$customerId,'Please fill required fields');
        }
    }
?>