<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Document</title>

    <style>
        body{
            display: flex;
            jsustify-content: center;
            align-items: center;
            height : 100vh;
            font-weight: bold;
            font-family: monospace;


            background-color: #000000;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='250' height='30' viewBox='0 0 1000 120'%3E%3Cg fill='none' stroke='%23222' stroke-width='10' %3E%3Cpath d='M-500 75c0 0 125-30 250-30S0 75 0 75s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 45c0 0 125-30 250-30S0 45 0 45s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 105c0 0 125-30 250-30S0 105 0 105s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 15c0 0 125-30 250-30S0 15 0 15s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500-15c0 0 125-30 250-30S0-15 0-15s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 135c0 0 125-30 250-30S0 135 0 135s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3C/g%3E%3C/svg%3E");
        }

        .container{
            max-width: 800px;
        }

        input{
            background-color:transparent !important;
            color: gray !important;
            font-weight: bold;
            height: 40px;
            border-color: gray;
        }
        
       
    </style>
</head>
<body  style="background-color:#0e0f0f !important;color:white;">
    

    <div class="container">
            <form  method="post" >


                    <label for="fname" class="from-label">first name :</label>
                    <input type="text" name="fname" id="fname" class="form-control">

                    <label for="lname" class="form-label mt-3">last name :</label>
                    <input type="text" name="lname" id="lname" class="form-control">

                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="email" name="email" id="email" class="form-control">

                    <label for="password" class="form-label mt-3">password</label>
                    <input type="password" name="password" id="password" class="form-control">


                    <label for="conpassword" class="form-label mt-3">Confirm password</label>
                    <input type="password" name="conpassword" id="conpassword" class="form-control">

                    <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>

    </div>


</body>
</html>