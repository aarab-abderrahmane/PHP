

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Bungee+Spice&family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <title>Document</title>

    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height : 100vh;
            font-weight: bold;
            font-family: monospace;


            background-color: #622785;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1200 800'%3E%3Cdefs%3E%3CradialGradient id='a' cx='0' cy='800' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23390b59'/%3E%3Cstop offset='1' stop-color='%23390b59' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='b' cx='1200' cy='800' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23311443'/%3E%3Cstop offset='1' stop-color='%23311443' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='c' cx='600' cy='0' r='600' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%2308000f'/%3E%3Cstop offset='1' stop-color='%2308000f' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='d' cx='600' cy='800' r='600' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23622785'/%3E%3Cstop offset='1' stop-color='%23622785' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='e' cx='0' cy='0' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%2310001D'/%3E%3Cstop offset='1' stop-color='%2310001D' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='f' cx='1200' cy='0' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23000000'/%3E%3Cstop offset='1' stop-color='%23000000' stop-opacity='0'/%3E%3C/radialGradient%3E%3C/defs%3E%3Crect fill='url(%23a)' width='1200' height='800'/%3E%3Crect fill='url(%23b)' width='1200' height='800'/%3E%3Crect fill='url(%23c)' width='1200' height='800'/%3E%3Crect fill='url(%23d)' width='1200' height='800'/%3E%3Crect fill='url(%23e)' width='1200' height='800'/%3E%3Crect fill='url(%23f)' width='1200' height='800'/%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;

        }

        .container{
            /* max-width: 800px; */
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap:10px;
            border: 1px gray solid;
            border-radius: 15px;;
            padding: 0;
            width: auto;

            
        }

        #image{
            width: 30vw;
            height: 565px;
            object-fit: cover;
            margin: 0;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            mask: linear-gradient(to left, transparent 0%, black 100%);

        }

        form{
            width: 100%;
            margin: 20px ;
            padding: 0 5px;
        }

        input{
            background-color: rgba(0, 0, 0, 0.29) !important;
            color: gray !important;
            font-weight: bold;
            height: 40px;
            border-color:rgb(66, 66, 66) !important;
            -webkit-text-fill-color: white !important;
        }

        input:-webkit-autofill {
        background-color: #1e1e2f !important;
        -webkit-box-shadow: 0 0 0 1000px #1e1e2f inset !important;
        -webkit-text-fill-color: white !important;
            }

        button[type="submit"]{
            background-color: #009c60 !important;
            border: 1px solid #00ffa4 !important;
            border-radius: 10px !important;
        }

        button[type='submit']:hover{
            background-color:rgba(0, 156, 96, 0.5)  !important;

        }

        input:focus{
            outline: purple 3px solid !important;
        }

        h2{
            text-align: center;
            margin-bottom: 10px;
            font-family:"Akaya Kanadaka", system-ui;
            font-weight: bold;
            color: #f34b00;
        }

        @media (max-width:1000px){
            .container{
                border: none;
                flex-direction: column;
                align-items: center;

            }

            #image{
                width: 100%;
                mask: none;
                mask: linear-gradient(to top, transparent 0%, black 100%);
                border-radius: 15px;

            }

            body{
                font-size: 0.7rem;
            }


        }
        @media (min-width:1001px){
            form{
                width: 31vw;;
            }


        }
        

    </style>
</head>
<body  style="color:white;">
    

    <div class="container ">

            <img src="images/wallpaperflare.com_wallpaper (1).jpg" id="image">
            <form  method="post" >

                    <h2>Registration</h2>
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

                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-patch-plus me-3"></i>Sign UP</button>
            </form>

    </div>


</body>
</html>