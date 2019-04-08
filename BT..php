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
<h1>Registration Form</h1>
<form action="" method="post">
    Name: <input type="text" name="txt1" placeholder="Enter Name">
    E-mail: <input type="text" name="email" placeholder="Enter Email">
    Phone: <input type="text" name="phone" placeholder="Enter Phone">
    <input type="submit" value="Register">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['txt1'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    // Check input fields
    if (empty($name) || empty($email) || empty($phone))
        echo "Empty Field";
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        echo "Email Validation is wrong! Try again xxx@xxx.xxx";
    else {
        if (file_exists('users.json')) {
            $current_data = file_get_contents('users.json');
            //print_r($current_data);
            $array_data = json_decode($current_data, true);
            //print_r($array_data);
            $extra = array(
                'txt1' => $name,
                'email' => $email,
                'phone' => $phone
            );
            //print_r($extra);
            array_push($array_data, $extra);
            //print_r($array_data);
            $final_data = json_encode($array_data);
            file_put_contents('users.json', $final_data);
            //print_r($final_data);
            echo "Success Added";
        } else
            echo 'JSON File not exits';
    }
}
?>
</body>
</html>