<?php

    require '../config/function.php';

    a

    $paramResultId = checkParamId('id');
    if(is_numeric( $paramResultId)){

        $customerId = validate($paramResultId);

        $customers = getById('customers', $customerId);

        if($customers['status'] == 200)
        {
            $respose = delete('customers', $customerId);
            if($respose)
            {
                redirect('customer.php', 'Customers Deleted Successfully.');
            }
            else
            {
                redirect('customer.php', 'Something Went Wrong.');
            }
        }
        else
        {
            redirect('customer.php', $customers['message']);
        }
        echo 'Something Went Wrong.';

    }else{
        redirect('customer.php', 'Something Went Wrong.');
    }
?>