<html>
    <head>
        <meta charset="UTF-8">
        <title>Calendar&Notes</title>
        
    </head>
    
    <body bgcolor = "#FFFFE0">
       
            <h1>Март 2016</h1>
    <table border ="1">              
                
        <?php 
        @session_start(); 
        echo "Hello, ".$_SESSION["session_login"]."!<p></p>";
        $i = -7;
        $days = array(
            -7 => "Пн",
            -6 => "Вт",
            -5 => "Ср",
            -4 => "Чт",
            -3 => "Пт",
            -2 => "Сб",
            -1 => "Вс",
        );
        while ( $i < 32){
            while ( $i < 0)
            {
                 echo "<td>".$days[$i]."</td>";
                 $i++;
            }
                        if ( $i %7 == 0)
                        {
                            echo "<tr>".PHP_EOL;
                        }
                        if ( $i == 0)
                            echo "<td>"."</td>".PHP_EOL;
                        else
                        echo "<td>".$i."</td>".PHP_EOL;
                        $i++;
                        if ( $i %7 == 0)
                        {
                            echo "</tr>".PHP_EOL;
                        }
            }
        ?>
        <table/>
              <a href="newNote.html">Добавить заметки</a>
       <p></p>
       <a href="form.html">Log out</a>
          
        
    <?php
    session_start();
    if(isset($_POST['title'])) $title = $_POST['title']; 
    if(isset($_POST['text'])) $text = $_POST['text']; 
    if(isset($_POST['datetime'])) $datetime = $_POST['datetime']; 

    $con = new MongoClient();
    $collection= $con-> notes-> data;
    if ($text != null && $text != "") {       
    $data = array('login' => $_SESSION["session_login"], 'label' => true, 'title' => $title, 'text' => $text, 'datetime' => $datetime);
    $collection -> insert($data);  
    }
    $con -> close();
  ?>
        

            <h2>Your notes</h2>
         <?php
         session_start();
         $con = new MongoClient();
         $collection= $con-> notes-> data;
         $filter=array("label"=>true, "login" =>$_SESSION["session_login"]);
         $list = $collection->find($filter);
         $i = 1;
            while($document = $list->getNext())
            {
                echo "Note № ".$i."<br/>";
                echo "Title:" . $document["title"]."<br/>";
                echo "Text:" . $document["text"]."<br/>";
                echo "Date:" . $document["datetime"] . "<p/>"."<br/>";
                $i++;
            }

          $con->close();
         ?>
            
            
        
        
    </body>
</html>
