


<?php

//  connexion et fonction d'appel a la connexion 

      $servername = "localhost";
      $username = "root";
      $password = "";
      $db_name = "livre";


//creer et verifier la connexion:

 $conn = new mysqli($servername, $username, $password ,$db_name);

     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        // echo "connected successfuly";


// la classe livre

/**
 * Book
 * 
 */
class Book {
    const insertQuery = "INSERT INTO book(title, author, description, dpublication ,edition ) values(?,?,?,?,?)";
    const updateQuery = "UPDATE book set title = ?, author = ?, description = ?, dpublication = ?,edition=? , WHERE id = ? author=? edition =?";
    const selectQuery = "SELECT * FROM book";
    const selectByIdQuery = "SELECT * FROM book WHERE id=?  author=? edition =?";
    const deleteByIdQuery = "DELETE  FROM book WHERE id=?  author=? edition =?";
    const searchQuery = "SELECT *  FROM book WHERE title like ? OR description like ? OR author like ? OR edition like ? ";
    private int $id;
    private string $title;
    private string $author;
    private string $description;
    private string $dpublication;
    private string $edition;
    public $errorMsg =[];



//fonctions de remplissage de champs et de verification d'input

function setId(int $Id){
    $this->id = $id ;

}
function setTitle( string $Title){
    try{$this->title = checkField("Title", $Title);
    }catch (Exception $e) {
        $this->errorMsg["Title"] = $e->getMessage();
    }
}

    
function setAuthor (string  $Author){
    try{
        $this-> author = checkField("Author",$Author);
    }catch (Exception $e) {
        $this->errorMsg["Author"] = $e->getMessage();
    }

    }
    

 
 function setDescription(string $description){
         try {
          $this->description = checkField("Description", $description);   
         } catch (Exception $e) {
             $this->errorMsg["description"] = $e->getMessage();
         };   
  }
  function setEdition(string $edition){
    try {
     $this->edition = checkField("Edition", $edition);   
    } catch (Exception $e) {
        $this->errorMsg["Edition"] = $e->getMessage();
    };   
}

 function setDatePub(string $dpublication){
    try {
     $this->dpublication = checkField("Dpublication", $dpublication,9);   
    } catch (Exception $e) {
        $this->errorMsg["datePub"] = $e->getMessage();
    }

}



//fonctions GET

 function getId(){
    return $this->id;
 }
    
function getTitle(){
    return $this->title ;
}
function getDescription(){
    return $this->description ;
}
function getEdition(){
    return $this->edition ;
}
function getDatepublication(){
    return $this -> dpublication;
}
function getAuthor(){
    return $this->author ;
}

//handling functions:insertion
function Query() :string{
    return "INSERT INTO book(title, author, description, dpublication,edition) values(?,?,?,?,?)";
}

function getFields(): array{
    return [$this->getTitle(),$this->getAuthor(),$this->getDescription(),$this->getDatepublication(),$this->getEdition()];
    }
}
//handling functions : initialisation des données et clean up des champs de saisie 

//check hors classe
/**
 * checkField
 *
 * @param  mixed $fieldName
 * @param  mixed $fieldValue
 * @param  mixed $nbreChar
 * @return void
 */
function checkField(string $fieldName,string $fieldValue, int $nbreChar = 0){
    $value = trim($fieldValue);
    if(strlen($value) > $nbreChar){
       return $value;
    }else{

        throw new Exception( "$fieldName field is required", 406);
    }
}


function init(){
    global $title ;
   global $author ;
   global $description;
   global $dpublication;
   global $edition;
   global $book;
$title =null;
$author =null;
$description = null;
$dpublication= null;
$edition= null;
$book = new Book();
}

$success = null;
$error = null;
init();
if(isset($_POST['save'])){

$title =$_POST['title'];
$author =$_POST['author'];
$description = $_POST['description'];
$dpublication = $_POST['dpublication'];
$edition = $_POST['edition'];
$book->setTitle($title);
$book->setAuthor($author);
$book->setDescription($description);
$book->setDatePub($dpublication);  
$book->setEdition($edition);  
if (count($book->errorMsg)==0) {
    if (add($book::insertQuery,"sssss",$book->getFields())) {
        $success = "added with success"  ;
       init();
      }else{
          $error = "error of insertion"  ;
      }
}   }
    
 //handling functions:
 //Post an array to Db-ADD

function add(string $requestQuery, string $fieldTypes, array $fields):bool{
    global $conn;
    $stmt = $conn ->prepare($requestQuery);
    $stmt->bind_param($fieldTypes, ...$fields);

    if ($stmt->execute()) {
    return true;
    }
    return false;
 }

 //Update Data and Post TO DB :
 function Update(string $requestQuery, string $fieldTypes, array $fields ,int$id):bool{
    $stmt = $conn->prepare($requestQuery);
    $stmt->bind_param($fieldTypes, ...$fields);
   

    if ($stmt->execute()) {
    return true;
    }
    return false;
 }
 //Delete Data from DB
 function Delete( string $requestQuery, string $fieldTypes, array $fields , int$id):bool{
    $stmt= $conn->prepare($requestQuery);
    $stmt->bind_param($fieldTypes,...$fields);
    $array = [...$fields, $id];

    if ($stmt ->execute()){
        return true;
    }return false;
 }
//consulter la bd en entier :getall 

function getAll ( $requestQuery){
    $stmt= $conn->prepare($requestQuery);
    $stmt->bind_param($fieldTypes,...$fields);
    if ($stmt->execute()){
        
        return $stmt->get_result();
    }
    return false;
}

//consulter un element de la bd :

function getByelement(string $requestQuery, string $fieldTypes,array $fields){
    $stmt = $conn->prepare($requestQuery);
    $stmt->bind_param($fieldTypes, ...$fields);
    if ($stmt->execute()) {
        return $stmt->get_result();
    }
    return false;
}

//Rechercher un element de la bd:
function Search(string $requestQuery, string $fieldTypes,array $fields){
    $stmt = $conn->prepare($requestQuery);
    $stmt->bind_param($fieldTypes, ...$fields);
    if($stmt->execute()){
        return $stmt->get_result();
    }
return false;
}

//l'affichage des message d'erreur et de completion groupés index 





//update
//delete
//getall
//getbyelement
//Search