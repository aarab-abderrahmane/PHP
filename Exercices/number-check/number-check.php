<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form  method='POST' >
        <input type="text" name="number">
        <button type="submit">Send</button>
    </form>

    <h1>
        <?php 

            if ($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['number'])  && $_POST['number'] !== ''){
                $number = htmlspecialchars($_POST['number']);


                if (is_numeric(($number))){

                    if ($number<0){
                        echo 'the number ('.$number.') is negative.';
                    
                    }elseif ($number>0){
                        echo 'the number ('.$number.') is positive.';
                        
                    }else{
                        echo 'the number ('.$number.') is zero';
    
                    }
                }else {
                    echo 'please entre a valid number.';
                }
         

            }

        ?>
    </h1>

</body>
</html>