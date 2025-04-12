<?php
    $errors=[];
    if ($_SERVER['REQUEST_METHOD']==='POST'){

        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $email = isset($_POST['email']) ?  $_POST['email'] : '';
        $matricule=isset($_POST['matricule']) ? $_POST['matricule'] : '';
        $URL =isset($_POST['URL'])  ? $_POST['URL'] : '';
        $imageName = isset($_FILES['image']) ? $_FILES['image']['name'] : '';
        $pdf = isset($_FILES['pdf']) ? $_FILES['pdf']['name'] : "";

        $errors=[];

        if((empty($nom) || $nom==="") && (empty($email) || $email==="") && (empty($URL) || $URL==="") && (empty($imageName) || $imageName==="") && (empty($pdf) || $pdf=== "")){
            $errors[]="all fields are required.";
        }else{
            
            if(empty($nom)){
                array_push($errors,"name is required");
            }
            if(empty($email)){
                $errors[]="email is required.";
            }else{
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $errors[]="Invalid email format.";
                }
            }
            if(empty($URL)){
                $errors[]="URL is required";
            }else{
                if(!filter_var($URL,FILTER_VALIDATE_URL)){
                    $errors[]= "Invalid URL format.";
                };
            }


            #image check

            if(empty($imageName)){
                array_push($errors,'Image is required.');
            }else{

                $uploadDir = "uploads/";
                if(!is_dir($uploadDir)){
                    mkdir($uploadDir,0755,true);

                }
                $imagePath = $uploadDir. basename($imageName);
                $imageFileTYpe=strtoupper(pathinfo($imagePath,PATHINFO_EXTENSION));


                $allowedTypes=['JPG','PNG','JPEG','GIF','SVG'];

                if(!in_array($imageFileTYpe,$allowedTypes)){
                    $errors[]='only JPG,JPEG,PNG,SVG,GIF files are allowed';
                }

                if($_FILES['image']['size'] >5*1024*1024){     //convert to bits
                    $errors[]='File size must  be less than 5MB';
                }

                if(empty($errors)){
                    if(!move_uploaded_file($_FILES['image']['tmp_name'],$imagePath) || $_FILES['pdf']['error']!==0){
                        $errors[]='Failed to upload image.';
                    }
                }
            }


            #pdf check
            
            if(empty($pdf)){
                $errors[]='Pdf is required';
            }else{

                $allowedTypes_pdf=['application/pdf'];

                $fileTmpPath = $_FILES['pdf']['tmp_name'];
                $filename = $_FILES['pdf']['name'];
                $fileSize = $_FILES['pdf']['size'];
                $fileType = $_FILES['pdf']['type'];

                if (!in_array($fileType,$allowedTypes_pdf)){
                    $errors[]='Only PDF files are allowed';
                    exit;
                }

                if($fileSize > 5*1014*1024){
                    $errors[]='File size should be less than 5MB.';
                    exit;
                }

                if (!is_dir($uploadDir)){
                    mkdir($uploadDir,0755,true);
                }

                $pdfPath = $uploadDir . basename($filename);

                if(!move_uploaded_file($fileTmpPath,$pdfPath)){
                    $errors[]= 'Failed to upload pdf';
                }

            }

            
        };

    }; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>

    <style>
        form{
            display: flex;
            flex-direction: column;
            gap:10px;
        }

        .container{
            width: 70vw;
        }

        body{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
    </style>
</head>
<body>
    <h2>Add New User : </h2>
    <div class="container">
        <?php
        if($_SERVER['REQUEST_METHOD']==="POST"){
            if(empty($errors)){


                $data = isset($_COOKIE['users']) ? json_decode($_COOKIE['users'],true) : [];
                $data[]=['nom'=>$nom,'email'=>$email,'matricule'=>$matricule,'URL'=>$URL,'image'=>$imagePath,'pdf'=>$pdfPath];
                setcookie('users',json_encode($data),time()+(24*60*60));
                header('Location:home.php');


                echo'<h1 style="color:green">Add Successfully!</h1>';
                exit;
            }else{
                echo '<div class="alert">';
                foreach($errors as $error){
                        echo '<p><b>'.$error.'</b></p>';
                }   
                echo '</div>';

            }
        }      
        ?>
        <!-- <form method="post" enctype="multipart/form-data">
                <label for="name">Nom</label>
                <input id="name" type="text" name="nom"></input>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <label for="matricule">Nombre de matricule</label>
                <input type="number" name="matricule" min="1000" max="5000" value="1000">
                <label for="URL">Linkedin URL</label>
                <input type="URL" name="URL" id="URL">
                <label  for="image">image</label>
                <input type="file" id="image" name="image">
                <label for="file">pdf</label>
                <input type="file" name="pdf" id="file" accept=".pdf">
                <button type="submit">Add</button>
        </form> -->


        <form>
            <div class="space-y-12">


                <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                    <label for="first-name" class="block text-sm/6 font-medium text-gray-900">First name</label>
                    <div class="mt-2">
                        <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                    </div>

                    <div class="sm:col-span-3">
                    <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Last name</label>
                    <div class="mt-2">
                        <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                    </div>

                    <div class="sm:col-span-full">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                    </div>

                    <div class="sm:col-span-3">
                    <label for="country" class="block text-sm/6 font-medium text-gray-900">Country</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="country" name="country" autocomplete="country-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option>United States</option>
                        <option>Morocco</option>
                        <option>Mexico</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    </div>

                    <div class="col-span-3">
                    <label for="street-address" class="block text-sm/6 font-medium text-gray-900">Street address</label>
                    <div class="mt-2">
                        <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                    </div>

                </div>

                
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="col-span-2">
                    <label for="photo" class="block text-sm/6 font-medium text-gray-900">Photo</label>
                    <div class="mt-2 flex items-center gap-x-3">
                        <svg id="svgIcon" class="size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                        <img id="imagePreview" src="" alt="Preview" class="size-12 rounded-full object-cover" style="display: none;" />

                        <button onclick="openFileDialog()" type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50">Change</button>
                    </div>
                    <input type="file" id="fileInput" name="image" style="display:none"  onchange="validateImage(this)">
                    </div>


                    <div class="sm:col-span-4">
                    <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6">workcation.com/</div>
                        <input type="text" name="username" id="username" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="janesmith">
                        </div>
                    </div>
                    </div>

        


                    <div class="col-span-full">
                    <label for="about" class="block text-sm/6 font-medium text-gray-900">About</label>
                    <div class="mt-2">
                        <textarea name="about" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                    </div>
                    <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about yourself.</p>
                    </div>

                    <div class="col-span-full ">
                    <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Your (CV)</label>
                    <div id="uploadPDF" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                        <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4  flex text-sm/6 text-gray-600 ">
                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input  id="file-upload" onchange="change_color(this)" name="pdf" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs/5 text-gray-600">PDF to 5MB</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>

    </div>
    

    <script>

        function openFileDialog(){
            document.getElementById('fileInput').click();
        }

        function validateImage(input){
            const file = input.files[0];

            if(!file) return ; 
            const allowedTYpes = ['image/jpeg',"image/png","image/gif"];
            const maxsize = 5*1024*1024;

            if(!allowedTYpes.includes(file.type)){
                alert("Only JPG , PNG , or GIF images are allowed.");
                input.value="";
                return;
            
            }

            if(file.size > maxsize){
                alert('The image size must be less than 5MB.');
                input.value="";
                return;
            }


            const reader = new FileReader();
            reader.onload = function(e){
                const preview = document.getElementById('imagePreview');
                preview.src=e.target.result;
                preview.style.display = "block";


                document.getElementById('svgIcon').style.display="none";
            };
            reader.readAsDataURL(file)



        }


        function change_color(input){
                const file = input.files[0];
                const section = document.getElementById('uploadPDF');
                if(!file) return;

                if(!['application/pdf'].includes(file.type) || file.size > 5*1024*1024){
                    section.style.borderColor='red';
                    return
                }else{
                    section.style.borderColor='gray';
                    return
                }



        }



    </script>
</body>
</html>