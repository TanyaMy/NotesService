
<html>
    <head>
        <meta http-equiv="Refresh" content="0; URL=calendar.php">
    </head>
    <body>
    </body>
</html>
<?php
@session_start();
$id = $_POST['noteToedit'];
    if(isset($_POST['title'])) $title = $_POST['title']; 
    if(isset($_POST['text'])) $text = $_POST['text']; 
    if(isset($_POST['datetime'])) $datetime = $_POST['datetime']; 
$con = new MongoClient();
$collection = $con -> notes -> data;
$oldnote = $collection->findOne(array('_id' => new MongoId($id)));
$newnote = array('login' => $_SESSION["session_login"], 'label' => true, 'title' => $title, 'text' => $text, 'datetime' => $datetime);
$option = array("upsert" => true);
$collection ->  update($oldnote, $newnote, $option);
$con -> close();
?>
