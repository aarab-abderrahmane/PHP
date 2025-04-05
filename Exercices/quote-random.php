<?php

    $url ='https://dummyjson.com/quotes/random';
    $response = file_get_contents($url);


    if($response !== false){

        $data =  json_decode($response,true);

        $quote = $data['quote'];

        $author =$data['author'];



    }else{
        $quote="Error lors du chargement de la citation.";
        $author="....";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        body{
            background-color: black;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

        }

        .container{
            width: 80vw;
        }

        .logo{
            position: absolute;
            bottom:0;
            font-family: monospace;

        }

    </style>

</head>
<body >

        <div class="container">

            
            <figure class="max-w-screen-md mx-auto text-center">
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                    <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                </svg>
                <blockquote>
                    <p class="text-2xl italic font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($quote)?></p>
                </blockquote>
                <figcaption class="flex items-center justify-center mt-6 space-x-3 rtl:space-x-reverse">
                    <img class="w-6 h-6 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png" alt="profile picture">
                    <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-500 dark:divide-gray-700">
                        <cite class="pe-3 font-medium text-gray-900 dark:text-white"><?=htmlspecialchars($author)?></cite>
                        <cite class="ps-3 text-sm text-gray-500 dark:text-gray-400"><?=htmlspecialchars(date('l'))?></cite>
                    </div>
                </figcaption>
            </figure>


        </div>

        <div class="logo">
            <h1 style="margin-bottom: 10px;letter-spacing:3px">@aarab-abdulrahman</h1>
        </div>
    
</body>
</html>



