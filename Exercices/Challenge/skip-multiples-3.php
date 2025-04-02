<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <?php 
    
        for($i=1 ; $i<=20;$i++){
           
            if ($i%3===0){

                continue;
            }

            if ($i%3!==0){
                echo "$i <br>";
            }

         }
    
    ?>


</body>
</html>