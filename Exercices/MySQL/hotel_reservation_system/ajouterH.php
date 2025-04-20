<?php  
        

        include "database_connection.php";

        $query = "SELECT * FROM typehotel";
        $resultat = mysqli_query($connection,$query);
        $message = "";
        $errors=[];

        
        if($_SERVER['REQUEST_METHOD']=="POST"){
                $title = trim($_POST['titre']);
                $adress = trim($_POST['adress']);
                $prix = $_POST['prix'];
                $type_hotel = $_POST['type_hotel'];
                $number_places = $_POST['number_places'];
                

                if (isset($_POST['titre']) && empty($title)){
                        $errors[]='-invalide title';
                }

                if(isset($_POST['adress']) && empty($adress)){array_push($errors,"-invalide adress");}

                if(isset($_POST["prix"]) && (float)$prix <= 0.00){$errors[]='-prix must be bigger than 0';}
                
                if(isset($_POST['number_places']) && (int)$number_places <=0 ){$errors[]="-the number of places must be bigger tha 0";}


                if (empty($errors)){
                        $insert_to_sql = "INSERT INTO hotel (titre,adresse,prix_par_unit,nombre_de_places,id_type) 
                        VALUE ('$title','$adress','$prix','$number_places','$type_hotel')";
        
                        if(mysqli_query($connection,$insert_to_sql)){
                                $message="information added successfully";
                        }else{
                                $message="Error".$insert_to_sql."<br>".mysqli_error($connection);
                        }

                }


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
                *{
                        font-family: monospace;
                        font-size:0.9rem;
                        
                }

                html{
                        background-color: #171a1b;
                }
                body{
                        margin: 0;
                        display: flex;
                        flex-direction: column;
                        align-items:center
                }

                .container{
                        width: 100%;
                        margin-top: 30px;
                        display: flex;
                        justify-content: center;
                }
                form{
                        display: flex;
                        flex-direction: column;
                        gap:10px
                }

                label{
                        color: white;
                }
                input,select{
                        width: 70vw;
                        height: 6vh;
                        border-radius: 5px;
                        border : 1px solid gray;
                        outline:none;
                        padding: 5px;
                        color: aquamarine;
                        background-color: #121212;
                }

                header{ 
                        background-color: orange;
                        width: 100%;
                        height: 6vh;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                }

                header a{
                        padding: 0 10Px;
                        color: black;
                        font-weight: bold;
                        text-decoration: underline;
                }

                button[type='submit']{
                        background-color: #ff7bdb;
                        outline: none;
                        color:black;
                        font-weight: bold;
                        border-radius: 6px;
                        border: 2px solid black;
                        width: 20%;
                        height:40px;
                        cursor: pointer;
                        transition : transform 0.7s ease;
                }

                button[type='submit']:hover{
                        box-shadow: 3px 3px 0px  #ffc700;
                        transform: translateY(-5px); 
                        transform-style: preserve-3d;
                }

                

                input:focus{
                        outline:2px solid #83005a;
                }

                .alerts{
                        display: flex;
                        justify-content: center;
                        margin-top: 20px;
                }

                #success-alert{
                        background-color: #00462a !important;
                        color: #00ffb3 !important;
                        border-color: #00ffb3;
                }


        </style>
</head>

<body>
        <header>
                <a href="listerH.php">View all reservation</a>
        </header>

        <?php

                if(!empty($message) && empty($errors)){
                        
                                echo '  <div class="alerts">
                                        <div
                                        id="success-alert"
                                        class="relative w-full max-w-160 flex flex-wrap items-center justify-center py-3 px-4 rounded-lg text-base font-medium transition-all duration-500 border border-green-500 text-green-700 bg-green-100"
                                        >
                                        <!-- Close button -->
                                        <button
                                        id="close-success-btn"
                                        type="button"
                                        aria-label="close-success"
                                        class="absolute right-4 p-1 rounded-md transition-opacity text-green-500 border border-green-500 opacity-40 hover:opacity-100"
                                        >
                                        <svg
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        height="16"
                                        width="16"
                                        class="h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                        </svg>
                                        </button>

                                        <!-- Content -->
                                        <p class="flex flex-row items-center justify-center gap-x-2 w-full">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-7 w-7 text-green-300"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span class="mr-9">'.$message.'</span>
                                        </p>
                                        </div>
                                        </div>


                                ';

                        
                }elseif(!empty($errors)){

                        echo '  <div class="alerts">
                                <div
                                id="danger-alert"
                                class="relative w-full max-w-140 flex flex-wrap items-center justify-center py-3 px-4 rounded-lg text-base font-medium transition-all duration-500 border border-red-500 text-red-700 bg-red-100"
                                >
                                <!-- Close button -->
                                <button
                                id="close-danger-btn"
                                type="button"
                                aria-label="close-success"
                                class="absolute right-4 p-1 rounded-md transition-opacity text-red-500 border border-red-500 opacity-40 hover:opacity-100"
                                >
                                <svg
                                stroke="currentColor"
                                fill="none"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                height="16"
                                width="16"
                                class="h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                >
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                                </svg>
                                </button>

                                <!-- Content -->
                                <p class="flex flex-row items-center justify-center gap-x-2 w-full">
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-7 w-7 text-red-700"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                                >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                <span class="mr-8">';
                                foreach($errors as $error){ echo $error,'<br>';}
                                echo '</span>
                                </p>
                                </div>
                                </div>


                                ';

                }
        
        ?>

        <div class="container">

                <form method="post" action="ajouterH.php">
                        <label for="title">Title</label>
                        <input id="titre" type="text" name="titre" value="<?= isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : '' ?>" >
                        <label for="adress">adress</label>
                        <input id="adress" name="adress" type="text" value="<?= isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : '' ?>">
                        <label for="prix">prix par unit</label>
                        <input type="text" name="prix" step="0.05"  placeholder="100" value="<?php echo isset($_POST['prix']) ? htmlspecialchars($_POST['prix']): '' ?>">
                        <label for="type_hotel">number of starts</label>
                        <select id="type_hotel" name="type_hotel">
                                <?php   
                                        while ($row=mysqli_fetch_assoc($resultat)){
                                                $selected = (isset($_POST['type_hotel']) && $row['id_type']===$_POST['type_hotel'] )? 'selected' : '';
                                                echo"<option value='$row[id_type]' $selected >".str_repeat('⭐',(int)$row['nombre_etoile'])."</option>";
                                        } 

                                ?>

                        </select>

                        <label id="number_places">number of places</label>
                        <input type="number"  name="number_places" placeholder="4" value="<?php echo isset($_POST['number_places']) ? htmlspecialchars($_POST['number_places']) : '' ?>">
                        <div>
                                <button type="submit">Sumbit</button>            
                        </div>
                </form>

        </div>


        <script>

                window.onload = function () {
                const closeBtn = document.getElementById('close-success-btn');
                const alertBox = document.getElementById('success-alert');

                const closeBtndanger = document.getElementById('close-danger-btn');
                const alertBoxdanger = document.getElementById('danger-alert');

                if(closeBtn && alertBox){
                        closeBtn.addEventListener('click', function () {
                        alertBox.style.display = 'none';
                });
                }
             

                if(closeBtndanger && alertBoxdanger){
                closeBtndanger.addEventListener('click', function () {
                        alertBoxdanger.style.display = 'none';
                });
                
                };

                }

        </script>

</body>
</html>


<?php
        mysqli_close( $connection );
?>