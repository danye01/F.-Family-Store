<?php

    require '../config/function.php';


    $paramResultId = checkParamId('id');
    if(is_numeric( $paramResultId)){

        $categoryId = validate($paramResultId);

        $category = getById('categories', $categoryId);

        if($category['status'] == 200)
        {
            $respose = delete('categories', $categoryId);
            if($respose)
            {
                redirect('categories.php', 'Category Deleted Successfully.');
            }
            else
            {
                redirect('categories.php', 'Something Went Wrong.');
            }
        }
        else
        {
            redirect('categories.php', $category['message']);
        }
        echo 'Something Went Wrong.';

    }else{
        redirect('categories.php', 'Something Went Wrong.');
    }
?>