<?php
session_start();

require 'dbcon.php';

function validate($inputData){

    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim($validatedData);
}


//redirect
function redirect($url, $status){

    $_SESSION['status']= $status;
    header('location: '. $url);
    exit(0);
}


//alertmessage
function alertmessage(){

    if(isset($_SESSION['status'])){       
         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
         <h6>'. $_SESSION['status'].'</h6>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }
}

// insert
function insert($tableName, $data)
{
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'".implode("', '", $values)."'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Update
function update($tableName, $id, $data){

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";

    foreach($data as $column => $value){
        $updateDataString .=$column.'=' . "'$value',";
    }

    $finalUpdateData = substr(trim($updateDataString),0,-1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id' "; 
    $result = mysqli_query($conn, $query);
    return $result;
}

//get all
function getAll($tableName, $status = NULL){

    global $conn;

    $table = validate($tableName);
    $status = validate($status);

    if($status == 'status')
    {
        $query = "SELECT * FROM $table WHERE status='0'";
    }
    else
    {
        $query = "SELECT * FROM $table";
    }
    return mysqli_query($conn, $query);
}

//get id
function getById($tableName, $id)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result)
    {
        if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => 'Record Data Found'
            ];
            return $response; 

        }else{
            $response = [
                'status' => 404,
                'message' => 'No Data Found'
            ];
            return $response; 
        }
    }else{
        $response = [
            'status' => 500,
            'message' => 'Something Went Wrong'
        ];
        return $response;
    }
}

//data delete
function delete($tableName, $id){

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result =  mysqli_query($conn, $query);
    return $result;
}

function checkParamId($type ){
    if(isset($_GET[$type])){

        if($_GET[$type] != ''){

            return $_GET[$type];
        }else{
            return '<h5>No Id Found</h5>';  
        }
        
    }else{
        return '<h5>No Id Given</h5>';
    }
}

function logoutSession(){

    unset( $_SESSION['loggedIn'] );
    unset( $_SESSION['loggedInUser'] );

}

function jsonResponse($status, $status_type, $message){

    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];
    echo json_encode($response);
    return  ;
}

function getCount($tableName)
{
    global $conn;

    $table = validate($tableName);

    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run){
        
        $totalCount = mysqli_num_rows($query_run);
        return $totalCount;
    }
    else{
        return 'something went wrong...' ;
    }
}
?>