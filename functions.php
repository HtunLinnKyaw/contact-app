<?php


// web security start
function old($inputName){
    if(isset($_POST[$inputName])){
        return $_POST[$inputName];
    }else{
        return "";
    }
}

function textFilter($text){
    $text = trim($text);
    $text = htmlentities($text,ENT_QUOTES);
    $text = stripslashes($text);

    return $text;
}

function setError($inputName,$message){
    $_SESSION['error'][$inputName] = $message;
}

function clearError(){
    $_SESSION['error'] = [];
}

function getError($inputName){
    if(isset($_SESSION['error'][$inputName])){
        return $_SESSION['error'][$inputName];
    }else{
        return "";
    }
}

function register(){



    $errorStatus = 0;
    $upload = "";
    $contact_name = "";
    $phone_number = "";
    if(empty($_POST['contact_name'])){
        setError("contact_name","Name is required");
        $errorStatus = 1;
    }else{
        if(strlen($_POST['contact_name']) < 5 ){
            setError("contact_name","Name is too short");
            $errorStatus = 1;
        }else{
            if(strlen($_POST['contact_name']) > 20){
                setError("contact_name","Name is too long");
                $errorStatus = 1;
            }else{
                if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['contact_name'])) {
                    setError("contact_name","Only letters and white space allowed");
                    $errorStatus = 1;
                }else{
                    $name = $_POST['contact_name'];
                }
            }
        }
    }



    if(empty($_POST['phone_number'])){
        setError("phone_number","phone is required");
        $errorStatus = 1;
    }else{
        $regex = '/^(?:1(?:[. -])?)?(?:\((?=\d{3}\)))?([2-9]\d{2})(?:(?<=\(\d{3})\))? ?(?:(?<=\d{3})[.-])?([2-9]\d{2})[. -]?(\d{4})(?: (?i:ext)\.? ?(\d{1,5}))?$/';
        if (!preg_match($regex,$_POST['phone_number'])) {
            setError("phone_number","Phone format incorrect");
            $errorStatus = 1;
        }else{
            $phone = $_POST['phone_number'];
        }
    }



    $supportFileType = ['image/jpeg','image/png','image/jpg'];

    if(isset($_FILES['upload']['name'])) {
        $tempFile = $_FILES['upload']['tmp_name'];
        $fileName = $_FILES['upload']['name'];
        if (in_array($_FILES['upload']['type'], $supportFileType)) {
            $saveFolder = "upload/";
//            if (move_uploaded_file($tempFile, $saveFolder . uniqid() . "_" . $fileName)) {
//                header("location:index.php");
//            }
        } else {
            setError("upload", "File is incorrect");
            $errorStatus = 1;
        }
    }else{
        setError("upload", "File is required");
        $errorStatus = 1;
    }



    if(!$errorStatus){
        //print_r($_POST);
        //print_r($_FILES);
    }
}



// web security end

// common start

function linkto($l){
    echo "<script>location.href='$l'</script>";
}

function runQuery($sql){
    $con = con();
    if(mysqli_query($con,$sql)){
        return true;
    }else{
        die("Query Fail : ".mysqli_error($con));
    }
}

function fetchAll($sql){
    $query = mysqli_query(con(),$sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)){
        array_push($rows,$row);
    }
    return $rows;
}

function fetch($sql){
    $query = mysqli_query(con(),$sql);
    $row = mysqli_fetch_assoc($query);
    return $row;
}

function showTime($timestamp,$format = "d-m-y"){
    return date($format,strtotime($timestamp));
}

// common end

function insertToDb(){
    $image = $_FILES['upload'];
    $contact = $_POST['contact_name'];
    $phone_number = $_POST['phone_number'];

    $imageFileName = $image['name'];
    $imageFileError = $image['error'];
    $imageFileTmp = $image['tmp_name'];

    $filename_separate = explode('.',$imageFileName);
    $fileExtension = strtolower(end($filename_separate));

    $ext = array('jpeg','jpg','png');
    if(in_array($fileExtension,$ext)){
        $upload_image="upload/". $imageFileName;
        move_uploaded_file($imageFileTmp,$upload_image);

        $sql = "insert into `users` (image,name,phone) values ('$upload_image','$contact','$phone_number')";
        $result = mysqli_query(con(),$sql);
        if($result){
            echo "<div class='col-7 mx-auto'>
                <p class='alert alert-success d-flex justify-content-center align-items-center w-80 h-3'>Contact Successfully Created</p>
            </div>";
        }else{
            die(mysqli_error(con()));
        }
    }
}


function users(){
    $sql = "SELECT * FROM users";
    return fetchAll($sql);
}

function user($id){
    $sql = "SELECT * FROM users WHERE id = $id";
    return fetch($sql);
}

function DeleteUser($id){
    $sql = "DELETE FROM users WHERE id=$id";
    return runQuery($sql);
}

function UpdateUser()
{
    $image = $_FILES['upload'];
    $contact = $_POST['contact_name'];
    $phone_number = $_POST['phone_number'];
    $id = $_POST['id'];

    $imageFileName = $image['name'];
    $imageFileError = $image['error'];
    $imageFileTmp = $image['tmp_name'];

    $filename_separate = explode('.', $imageFileName);
    $fileExtension = strtolower(end($filename_separate));

    $ext = array('jpeg', 'jpg', 'png');
    if (in_array($fileExtension, $ext)) {
        $upload_image = "upload/" . $imageFileName;
        move_uploaded_file($imageFileTmp, $upload_image);

        $sql = "UPDATE users SET image='$upload_image',name='$contact',phone='$phone_number' WHERE id=$id ";
        //die($sql);
        $result = runQuery($sql);
        if($result){
            echo "
                <p class='alert alert-success d-flex justify-content-center align-items-center w-75 h-3'>Contact Successfully Updated</p>
               ";
        }else{
            echo "fail .".mysqli_error();
        }
    }


}