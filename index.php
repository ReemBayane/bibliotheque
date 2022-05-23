<?php 
include_once "./connectionlib.php";
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
      <meta charset="UTF-8">
      <title> Gestionnaire de bibliotheque  | Rim Bayane </title>
      <link rel="stylesheet" href="./style.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body onload="typeWriter()">
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-bottom" id="navig">
           
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Search</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">update</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="listbook.php">Consult</a>
              </li>
         
              <li class="nav-item">
                <a class="nav-link" href="index.php">Add</a>
              </li>
           
            </ul>
          </nav>
      
     

   
    
            <div class= "container" id="formulaire">

             <?php 
            if (count($book->errorMsg)>0){
            echo  "<div class='alert alert-danger'> merci de remplir tout les champs      </div>";
            } 

            if(isset($success)){
              echo "<div class='alert alert-success'> completed !     </div>";
            }
                ?>  
                      <p id="quote"></p>


            
                    <form action="" method="post" target="_blank">
                    <div class="form-group">
                      <label for="booktitle" id="title">Title:</label>
                      <input type="text" class="form-control" placeholder="Enter Book Title"  name="title" id="title"  value ="<?=$title; ?>">
                    </div>
                    <div class="form-group">
                      <label for="author">Author:</label>
                      <input type="text" class="form-control" name="author"  id="author">
                    </div>
                    <div class="form-group">
                        <label for="Dpublication">Date of publishing:</label>
                        <input type="date" class="form-control"  name="dpublication" id="dpublication">
                      </div>
                      <div class="form-group">
                        <label for="bookid">Book Id :</label>
                        <input type="text" class="form-control"   id="Id">
                      </div>
                      <div class="form-group">
                        <label for="edition">Edition:</label>
                        <input type="text" class="form-control"  name="edition" id="edition">
                      </div>
                      <div class="form-group">
                        <label for="description">Description :</label>
                        <input type="text" class="form-control"   name="description" id="description">
                      </div>
                
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                </form>
                

        </div>
   
        

    


<script>
  // window.addEventListener("load",typerWriter);
var i = 0;
var txt = "“We may sit in our library and yet be in all quarters of the earth.” – John Lubbock";
var speed = 50;

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("quote").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}
</script> 

       

    </body>

    </html>