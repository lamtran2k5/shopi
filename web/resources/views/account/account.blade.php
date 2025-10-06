<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        if(session()->has('user_id')){
            echo "User ID: " . session('user_id') . "<br>";
            echo "Username: " . session('username') . "<br>";
        }else{
            echo "Chưa đăng nhập.";
        }  
    ?>
    
</body>
</html>