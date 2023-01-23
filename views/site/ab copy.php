<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'AB Test page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script type="text/javascript">
            function selectall(l){
                var ele=document.getElementsByName('selezione[]');
                for(var i=0; i<ele.length; i++){
                    if(ele[i].type=='checkbox')
                        ele[i].checked=l;
                }
            }
        
                
                function selectDataFile(o,l)
                {
                    var fr = new FileReader();
                    
                   fr.onload = function(e){

                    var ele=document.getElementsByName('selezione[]');
                    const str =  e.target.result;
                    
                    const res = (str.match(/\d+/g) || []).map(n => parseInt(n));
                   // for checking the slection uncomment the next  command
                   // alert(res);
                    for(var i=0; i<res.length; i++){
                    if(ele[res[i]-1].type=='checkbox')
                        ele[res[i]-1].checked=l;
                    }
                   
                }
                fr.readAsText(o.files[0]);
            }
               

                function Select(l) {
                const sta = document.getElementById('start').value -1;
                const sto = document.getElementById('stop').value;
                var ele=document.getElementsByName('selezione[]');
                for(var i=sta; i<sto; i++){
                    if(ele[i].type=='checkbox')
                        ele[i].checked=l;
                }
            }
                function DeSelect() {
                    const sta = document.getElementById('start').value -1;
                const sto = document.getElementById('stop').value;
                var ele=document.getElementsByName('selezione[]');
                for(var i=sta; i<sto; i++){
                    if(ele[i].type=='checkbox')
                        ele[i].checked=false;

                }
            }



        </script>

                    <?php
                    ob_start();
                    require_once('Auth.php');
                    // Include config file
                    require_once "config.php";
                     // Attempt select query executiona


                     $sql = "SELECT \n"

                    . "  Ospiti.id, \n"

                    . "  Ospiti.nome, \n"

                    . "  Ospiti.cognome, \n"

                    . "  Tessera.dataRilascio, \n"

                    . "  Tessera.dataUltimoRinnovo, \n"

                    . "  Tessera.dataScadenza, \n"

                    . "  Tessera.QRfilename, \n"

                    . "  Tessera.TSfilename \n"

                    . "FROM \n"

                    . "  Ospiti \n"

                    . "  inner JOIN Tessera ON Ospiti.id = Tessera.id";
                     if (isset($_POST['search'])){
                         $search_term = $_POST['search_box'];
                         //need to sanitise the entry mysql_real_escape_string($search_term);
                         $sql=$sql." WHERE Ospiti.cognome like '%{$search_term}%' ";
                         $sql.="OR Ospiti.nome like '%{$search_term}%' ";
                         $sql.="OR Ospiti.id like '%{$search_term}%' ";
                         $sql.="OR Tessera.dataRilascio like '%{$search_term}%' ";
                         $sql.="OR Tessera.dataUltimoRinnovo like '%{$search_term}%' ";


                         //echo $sql."<br>";

                     }
              ?>
                     <form method="GET" action="abb">
                      Ricerca: <input type="text" name="search_box" value="" />
                      <input type="submit"  name="search"  value="ricerca tabella..">
                      <br>
                   
                     <div>
                     <label for="start">Selezione Da:</label>
                    <input type="number" id="start" name="start"
                             min="1" max="5000">
                    <label for="stop">A:</label>
                    <input type="number" id="stop" name="stop"
                             min="1" max="5000">
                    <input type="button" onclick='Select(true)' value="Seleziona"/>
                    <input type="button" onclick='Select(false)' value="Deseleziona"/>
                    </div>
                     Seleziona da lista :
                     <input type="file"  value="Select" id="a1" name="a1" accept=".txt" onchange="selectDataFile(this,true)"> 
                     De-Seleziona da lista :
                     <input type="file"   value="Deselect" id="a2" name="a2" accept=".txt" onchange="selectDataFile(this,false)">
                     <pre id="datafile"></pre>
                    <input type="button" onclick='selectall(true)' value="Seleziona Tutti"/>
                    <input type="button" onclick='selectall(false)' value="Deseleziona Tutti"/>
                    <br>
                    <br>
                     <input type="submit" name="stampa" value="Stampa Tessere Selezionate"/>
                     <input type="submit" name="genera" value="Genera Tessere Selezionate"/>
                        </body>


                                        <?php

                                        include_once("tcpdf/tessere/GenTesseraBpdf.php");
                                        //Manage the  print of the  selected tessere in a set of A4 pages.
                                        if(isset($_POST['stampa'])){//to run PHP script on submit
                                        if(!empty($_POST['selezione'])){
                                        // Loop to store and display values of individual checked checkbox.
                                        require_once('Auth.php');
                                        // Include config file
                                        require_once "config.php";
                                        // Attempt select query executiona

                                            $sqlprint = "SELECT \n"

                                            . "  Ospiti.id, \n"

                                            . "  Ospiti.nome, \n"

                                            . "  Ospiti.cognome, \n"

                                            . "  Tessera.dataScadenza \n"

                                            . "FROM \n"

                                            . "  Ospiti \n"

                                            . "  inner JOIN Tessera ON Ospiti.id = Tessera.id \n"
                                            ."WHERE ";

                                            $count = count($_POST['selezione']);
                                            foreach($_POST['selezione'] as $selected){
                                            $sqlprint = $sqlprint."Ospiti.id = ".$selected;
                                            if (--$count >0 )
                                                $sqlprint = $sqlprint." OR ";
                                            }
                                            $sqlprint = $sqlprint." LIMIT 2000;";
                                            //echo  $sqlprint;

                                        if($result = mysqli_query($link, $sqlprint)){
                                            if(mysqli_num_rows($result) > 0){
                                                $count= mysqli_num_rows($result);
                                                echo "Totale Tessere Stamapate: ";
                                                echo $count.".";
                                                echo "File PDF:";
                                                echo '<a href="tessere\TS-print.pdf"  > Clicca per Aprire  </a>';
                                                echo "<br>";
                                                // create new PDF document of A4 format and fill with 9 tessera for each page.
                                                $doc = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                                                    $doc->AddPage('L',"A4");
                                                    // Set positin for teh tessere
                                                    $xpos = array(
                                                        0,
                                                        95,
                                                        190);
                                                    $ypos = array(
                                                            0,
                                                            55,
                                                            110);

                                        while($count > 0){

                                                for($j = 0, $ysize = count($ypos); $j < $ysize && $count >0; ++$j) {

                                                    for($i = 0, $xsize = count($xpos); $i < $xsize && $count >0; ++$i) {
                                                        $row = mysqli_fetch_array($result);
                                                    --$count;
                                                    DisplayTessera($doc, $row['id'],$row['nome'],$row['cognome'],$row['dataScadenza'],$xpos[$i] ,$ypos[$j]);
                                                }
                                            }
                                            if ($count >0) $doc->AddPage('L',"A4");
                                        }
                                        $doc->Output('/Applications/MAMP/htdocs/antoniano-ops/tessere/'.'TS-'.'print'.'.pdf', 'F');
                                        mysqli_free_result($result);



                                        }
                                    }
                                }

                        }?>



<?php

//Manage the  generation of the  selected tessere and place in the tessere folder 
if(isset($_POST['genera'])){//to run PHP script on submit
if(!empty($_POST['selezione'])){
// Loop to store and display values of individual checked checkbox.
require_once('Auth.php');
// Include config file
require_once "config.php";
include_once("tcpdf/tessere/GenTessera.php");
// Attempt select query executiona

    $sqlprint = "SELECT \n"

    . "  Ospiti.id, \n"

    . "  Ospiti.nome, \n"

    . "  Ospiti.cognome, \n"

    . "  Tessera.dataScadenza \n"

    . "FROM \n"

    . "  Ospiti \n"

    . "  inner JOIN Tessera ON Ospiti.id = Tessera.id \n"
    ."WHERE ";

    $count = count($_POST['selezione']);
    foreach($_POST['selezione'] as $selected){
    $sqlprint = $sqlprint."Ospiti.id = ".$selected;
    if (--$count >0 )
        $sqlprint = $sqlprint." OR ";
    }
    //echo  $sqlprint;

if($result = mysqli_query($link, $sqlprint)){
    if(mysqli_num_rows($result) > 0){
        $count= mysqli_num_rows($result);
        echo "Totale Tessere Generate: ";
        echo $count.".";
        echo "<br>";
        //Generate the required tessera

while($count > 0){

            --$count;
            $row = mysqli_fetch_array($result);
            $id = $row['id'];
            $fid = $id;
            if ($id <10)
                    {   
                     $fid="000".$id;
                        }   
                    else if ($id <= 99)
                             {
                         $fid= "00".$id;
                        }           
                   else if ($id <= 999) $fid= "0".$id;

            CreateTessera($row['id'],$fid,$row['nome'],$row['cognome'],$row['dataScadenza']);
        
            }
        
    }
} 
   mysqli_free_result($result);
}
}
?>




                                    <?php
                                        // Attempt select query executiona

                                        if($result = mysqli_query($link, $sql)){
                                            if(mysqli_num_rows($result) > 0){
                                                $count= mysqli_num_rows($result);
                                                echo "<br>"."Totale Tessere Ospiti: ";
                                                echo ($count+1)."<br>";
                                                echo '<table class="table table-bordered table-striped">';
                                                    echo "<thead>";
                                                        echo "<tr>";
                                                            echo "<th>Seleziona</th>";
                                                            echo "<th>#</th>";
                                                            echo "<th>Nome</th>";
                                                            echo "<th>Cognome</th>";
                                                            echo "<th>Data Rilascio</th>";
                                                            echo "<th>Data Ultimo Rinnovo</th>";
                                                            echo "<th>Data Scadenza</th>";
                                                        echo "</tr>";
                                                        echo "<tr>";
                                                            echo "<th></th>";
                                                            echo "<th></th>";
                                                            echo "<th></th>";
                                                            echo "<th></th>";
                                                            echo "<th></th>";
                                                            echo "<th></th>";
                                                            echo "<th></th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                    echo "<tbody>";
                                                    while($row = mysqli_fetch_array($result)){
                                                        echo "<tr>";
                                                        echo "<td>" .'<input type="checkbox" name="selezione[]" value="'.$row['id'].'">'.' <br>'. "</td>";;
                                                            echo "<td>" . $row['id'] . "</td>";
                                                            echo "<td>" . $row['nome'] . "</td>";
                                                            echo "<td>" . $row['cognome'] . "</td>";
                                                            echo "<td>" . $row['dataRilascio'] . "</td>";
                                                            echo "<td>" . $row['dataUltimoRinnovo'] . "</td>";
                                                            echo "<td>" . $row['dataScadenza'] . "</td>";
                                                    }


                                                    echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                            } else{
                                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                            }
                                        } else{
                                            echo "Oops! Something went wrong. Please try again later.";
                                        }

                                        // Close connection
                                        mysqli_close($link);
                                        ?>
                                        <form\>
                                    </div>
                                </div>
                            </div>
                        </div>
</body>
</html>
