<?php

    require '../config/function.php';


    $paramResultId = checkParamId('id');
    if(is_numeric( $paramResultId)){

        $adminId = validate($paramResultId);

        $admin = getById('admins', $adminId);
        if($admin['status'] == 200)
        {
            $adminDeleteRes = delete('admins', $adminId);
            if($adminDeleteRes)
            {
                redirect('admins.php', 'Admin Deleted Successfully.');
            }
            else
            {
                redirect('admins.php', 'Something Went Wrong.');
            }
        }
        else
        {
            redirect('admins.php', $admin['message']);
        }
        echo 'Something Went Wrong.';

    }else{
        redirect('admins.php', 'Something Went Wrong.');
    }
?>