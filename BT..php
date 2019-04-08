<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    Name: <input type="text" name="txt1">
    E-Mail <input type="text" name="txt2">
    Phone <input type ="text" name = "txt3">
    <input type="submit" name = "txt4">
</form>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST["txt1"];
    $email = $_POST["txt2"];
    $phone = $_POST["txt3"];
}
if(empty($name)||empty($email)||empty($phone)){
    echo "Empty Field";
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "Email Validation is wrong! Try again xxx@xxx.xxx";
}else {
    if(file_exists('users.json')){
        $current_data = file_get_contents('user.json');
        $array_data = json_decode($current_data, true);
        $extra = array('name'=>$name,"email"=>$email,"phone"=>$phone);
        array_push($array_data,$extra);
        $final_data = json_encode($array_data);
        file_put_contents('users.json', $final_data);
        echo "Sucess Added";
    }else{
        echo "Json  file not exis";
    }

}
function registerUser($name, $email, $phone)
{
    $array = [];
    array_push($array, "$name", "$email", "$phone");
    return $array;
}

?>
</body>
</html>