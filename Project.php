<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="Project1.css">
    <title>Biological Issues Solver</title>
</head>
<body>
    <script src="Project_nadeen.js"></script>
        <!-- Navigation -->
	<div class="navbar navbar-default " role="navigation">
		<div class="container">
			<ul class="nav navbar-nav navbar-right" style="font-size:x-large;">
				<li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
				<li><a href="#Transcription">Transcription</a></li>
				<li><a href="#Complement">Complement</a></li>
                <li><a href="#Reverse_Complement">Reverse Complement</a></li>
				<li><a href="#GC_Content">GC Content</a></li>
                <li><a href="#Kmers">K-Mers Re-Occurences</a></li>
                <li style="float:right"><a href="#">Biological Issues Solver</a></li>
			</ul>
		</div>
	</div>
	<!-- Navigation -->
    <!--Home-->
    <section id="home" class="home-start">
		<div class="container">
            <h1 style="font-size:45px;"><center><b>Welcome To The Biological Issues Solver </b></center></h1>     
		</div>
	</section>
    <br>
    <fieldset id="about" >
        <legend style="color: darkblue;font-size: 25px;"><center><b>About</b></center></legend>
        <p>Our aim from this website is to solve some of biological issues any biologist could face. </p>
    </fieldset>
    <br/>
    <br/>
    <!--Home-->
    <!--Form-->
    <form id="form" method="post" action="" onsubmit="validation()">
       <fieldset>
            <h3 class="H3">Sequence</h3>
            <label style='color:navy ;font-size: 25px;'>Sequence ID : </label>
            <input type="number" name="GID" id="GID" />
            <br>
            <label style='color:navy ;font-size: 25px;'>Gene Name :</label>	
            <input type="text" name="GName" id="GName" /><br>
            <label style='color:navy ;font-size: 25px;'>Please input the sequence you want to process on it: </label>
            <br/>
            <textarea name="GSeq" id="sequence" placeholder="Please input the sequence" wrap="off" cols="100" rows="10"></textarea>
            <br/>
            <br/>
            <label style='color:darkblue ;font-size: 25px;'><b>Choose your sequence type :</b></label>
            <label class="b">DNA
            <input type="radio" checked="checked"  name="seq_type" value="DNA">
            <span class="checkmark"></span>
          </label>
          <label class="b">RNA
            <input type="radio"   name="seq_type" value="RNA">
            <span class="checkmark"></span>
          </label>
            <label style='color:navy ;font-size: 25px;' >number of K-mers : </label>
            <input type="number" name="num_K" id="num_K" />
            <br>
            <br>
            <label style='color:navy ;font-size: 25px;'>Please check processes you want to apply:</label>
            <br/>
            <ul class="ks-cboxtags">
                <li><input type="checkbox" id="Transcription" name="Transcription" value="Transcription"><label
                        for="Transcription" >Transcription</label></li>
                <li><input type="checkbox" id="Complement" name="Complement" value="Complement"><label
                        for="Complement">Complement</label></li>
                <li><input type="checkbox" id="Reverse_Complement" name="Reverse_Complement" value="Reverse_Complement"><label
                        for="Reverse_Complement">Reverse Complement</label></li>
                <li><input type="checkbox" id="GC_Content" name="GC_Content" value="GC_content"><label
                        for="GC_Content">GC content</label></li>
                <li><input type="checkbox" id="Kmers" name="Kmers" value="K-mers"><label
                        for="Kmers">Re-Occurences of k-mers</label></li>
            </ul>
        </fieldset>
        <br/>
        <br/>
      <fieldset>
        <legend style='color:darkblue ;font-size: 25px;'><b>Manipulate your Database :</b></legend>
        <label class="b">Insert 
            <input type="radio" name= "db" id= "db"   value="insert">
            <span class="checkmark"></span>
          </label>
          <label class="b">Update
            <input type="radio"  name= "db" id= "db" value="update">

            <span class="checkmark"></span>
          </label>
          <label class="b">Select
            <input type="radio" name="db" id= "db" value="select">
            <span class="checkmark"></span>
          </label>
          <label class="b">Delete
            <input type="radio" name= "db"  id= "db" value="delete">
            <span class="checkmark"></span>
          </label>
          <label class="b">Select All
            <input type="radio" name= "db"  id= "db" value="SelectAll">
            <span class="checkmark"></span>
          </label>
   </fieldset>
  <h2> Update sequence (ID):</h2> <input type="number" name="upSeq" id="upSeq" /><br>
   <input type="submit" name="submit"  id="submit" value="Submit"> 
       
    </form>
</body>
<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "bioserverdb";

$conn=new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error)
{
    die("Connection error: " . $conn->connect_error);
}
else
{
    echo $dbname . "DB Connected successfully<br>";
   
            

  $action = $_POST["db"];
  echo $action;
  if(isset($_POST["submit"]) && $action == 'insert' )
  {
      echo "submited and insert";
  DB_insert($conn);
  }
  
  if(isset($_POST["submit"]) &&$action == 'delete' )
  {
    echo "submited and delete";
  
    DB_delete($conn);
  }

  if(isset($_POST["submit"]) && $action == 'update')
  {
    echo "submited and update";
  
    DB_update($conn);

    }

    if(isset($_POST["submit"]) && $action == 'select')
    {
      echo "submited and select";
    
      DB_select($conn);
  
      }
      if(isset($_POST["submit"]) && $action == 'SelectAll')
      {
        echo "submited and select";
      
        DB_selectAll($conn);
    
        }
    $conn->close();
}
function DB_selectAll($conn)
{
     $sql="SELECT * FROM gene";
     $result=$conn->query($sql);

     if($result->num_rows > 0 )
     {
         echo "<h3> SQL Select Results: </h3><br>";
         echo "<table><tr><th>Gene ID</th><th>Gene Name</th><th>Gene Sequence</th></tr> ";
         while($row=$result->fetch_assoc())
         {
             echo "<tr><td>".$row["geneID"]."</td><td>".$row["geneName"]."</td><td>".$row["geneSeq"]."</td></tr>";
         }
         echo "</table>";
     }
     else
     {
         echo "0 results in gene table";
     }
}

function DB_select($conn)
{
    $GID=$_POST["GID"];
    $sql_Functions="SELECT * FROM bio_functions WHERE geneID='$GID'";
    $fun_result=$conn->query($sql_Functions);
    
    //$joinSQL="SELECT geneIDFROM geneLEFT JOIN bioFunctions ON geneID = geneID";
    
    //Seq with id
    $Subsql="SELECT * FROM gene WHERE geneID='$GID'";
    $Subresult=$conn->query($Subsql);
    $sequence=$Subresult->fetch_assoc();
    $RS=$sequence["geneSeq"];
    
        echo "<fieldset>
        <legend style=\"color: darkblue;font-size: 25px;\" ><center><b>Results</b></center></legend>";


        $row=$fun_result->fetch_assoc();

        $trans=$row["Transcription"];
        $comp=$row["ComplementSeq"];
        $gc_content=$row["GC_content"];
        $kmer=$row["Kmers"];
        $rev_comp=$row["RevComp"];
            echo "<section class=\"Sequence\">
            <div class=\"container-fluid\">
                <div class=\"row\">
                    <h3 class=\"H3\" id = \"trans\" >Sequence</h3>

                    <h1 >  $RS  </h1>
                </div>
            </div>
        </section>
        <br>
            <section class=\"Transcription\">
            <div class=\"container-fluid\">
                <div class=\"row\">
                    <h3 class=\"H3\" id = \"trans\" >Transcription</h3>
                    <h1 >$trans</h1>
                    
                    
                        
                </div>
            </div>
        </section>
        <br>
        <section class=\"Complement\">
            <div class=\"container-fluid\">
                <div class=\"row\">
                    <h3 class=\"H3\">Complement</h3>
                    <h1 >$comp</h1>
                    
                        
                </div>
            </div>
        </section>
        <br>
        <section class=\"Reverse_Complement\">
            <div class=\"container-fluid\">
                <div class=\"row\">
                    <h3 class=\"H3\">Reverse Complement</h3>
                    <h1 >$rev_comp</h1>
                    
                        
                </div>
            </div>
        </section>
        <br>
        <section class=\"GC_Content\">
            <div class=\"container-fluid\">
                <div class=\"row\">
                    <h3 class=\"H3\">GC content</h3>
                    <h1 >$gc_content</h1>
                    
                        
                </div>
            </div>
        </section>
        <br>
        <section class=\"Kmers\">
            <div class=\"container-fluid\">
                <div class=\"row\">
                    <h3 class=\"H3\">K-mers Re-Occurences</h3>
                    <h1 >$kmer</h1>
                    
                        
                </div>
            </div>
        </section>
        <br>";
        
        echo "</fieldset>";

}
function GC_content($seq){
 $G=0;
 $C=0;


for ($i = 0; $i < strlen($seq); $i++){
    if($seq[$i] == 'G' ||$seq[$i] == 'g'){
        $G+=1;
    }
    if($seq[$i] == 'C' ||$seq[$i] == 'c'){
        $C+=1;
    }

}
 $GC = (($G*$C)/strlen($seq));

return $GC;

}

function Transcription($seq){
    $G=0;
    $C=0;
   
   
   for ($i = 0; $i < strlen($seq); $i++){
       if($seq[$i] == 'T'){
     $seq[$i]='U';    
    }
    if($seq[$i] == 't'){
        $seq[$i]='u';    
       }
       
       if($seq[$i] == 'U'){
        $seq[$i]='T';    
       }
       if($seq[$i] == 'u'){
           $seq[$i]='t';    
          }
          
   
   }
   return $seq;
   
   }

   function Rev_Complement($seq){
   $Rseq= strrev($seq);
   $Rseq_comp = Complement($Rseq);
   return $Rseq;
   }

   function Complement($seq){
    
   
   for ($i = 0; $i < strlen($seq); $i++){
       if($seq[$i] == 'T' ){
     $seq[$i]='A';    
    }
    if($seq[$i] == 't'){
        $seq[$i]='a';    
       }
       
       if($seq[$i] == 'U' ){
        $seq[$i]='A';    
       }
       if($seq[$i] == 'u'){
           $seq[$i]='a';    
          }
          
       if($seq[$i] == 'A' ){
        $seq[$i]='T';    
       }
       if($seq[$i] == 'a'){
           $seq[$i]='t';    
          }
       
          
          if($seq[$i] == 'C' ){
            $seq[$i]='G';    
           }
           if($seq[$i] == 'c'){
               $seq[$i]='g';    
              }
       
              
              if($seq[$i] == 'G' ){
                $seq[$i]='C';    
               }
               if($seq[$i] == 'g'){
                   $seq[$i]='c';    
                  }
                  
   
   }
   return $seq;
   
   }


   function k_mers_count($seq,$k){

    $map=[];
    
    for($i=0;$i<=(strlen($seq) - $k) ;$i++){
        
        $subSeq = substr($seq , $i ,$k);
        $map[$subSeq]=0;
    }
    
    for($i=0;$i<=(strlen($seq) - $k) ;$i++){
         $subSeq = substr($seq , $i ,$k);
        $map[$subSeq]+=1;
    }


$mx=-1;
$mx_kmer="";

foreach ($map as $key => $value) {
    
    if($mx <$value){
        $mx = $value;
        $mx_kmer = $key;
    }

}

   return $mx_kmer;
   
   }

function DB_insert($conn)
{
    echo "Insert Query from Input form!<br>";
    if(isset($_POST["submit"]))
    {
        $GID = $_POST['GID'];
        $GName = $_POST['GName'];
        $GSeq = $_POST['GSeq'];
        $number_k = $_POST['num_K'];
        
        if(!(empty($GID) && empty($GName) && empty($GSeq)))
        {
            $Type = $_POST['seq_type'];
            $sql="INSERT INTO gene(geneID, geneName, geneSeq,GeneType) VALUES('$GID' , '$GName' , '$GSeq','$Type')";
            $transcipt="";
            $seq_rev_comp="";
            $Seq_complement="";
            $kmers="";
            $GC="";
            if(!empty($_POST["Transcription"])){

                echo $_POST["Transcription"];
                $transcipt = Transcription($GSeq);
                   }
            if(!empty($_POST["Reverse_Complement"])){
                
                    echo $_POST["Reverse_Complement"];
                    $seq_rev_comp = Rev_Complement($GSeq);

                    } 
            if(!empty($_POST["Complement"])){
                
                        echo $_POST["Complement"];
                        $Seq_complement = Complement($GSeq);
                        }   
                
            if(!empty($_POST["Kmers"])){
                
                            echo $_POST["Kmers"];
                            
            $kmers = k_mers_count($GSeq,$number_k );
                            }   
                
            if(!empty($_POST["GC_Content"])){
                
                                echo $_POST["GC_Content"];
                   
                                $GC = GC_content($GSeq);
                                     }
            
        $sql_Functions="INSERT INTO bio_functions(geneID,GC_content,Transcription, ComplementSeq ,Kmers,RevComp) VALUES('$GID' ,'$GC','$transcipt' ,'$Seq_complement' ,'$kmers',' $seq_rev_comp')";
           
            

         // echo $GID, " -  ",$GName," -  ",$GSeq," -  ",$number_k," -  ",$kmers," -  ",$transcipt;
            

            if($conn->query($sql) === TRUE && $conn->query($sql_Functions) === TRUE)
            {
                echo "New record from input form created successfully<br>";
            }
            else
            {
                echo "Error in insert: ";
            }

            
        }
    }
}

function DB_delete($conn)
{

        $del = $_POST["GID"];
        if(!(empty($del)))
        {
            $sql="DELETE FROM gene WHERE geneID=$del";
            $bio_Func="DELETE FROM bio_functions WHERE geneID=$del";
        }
        if($conn->query($sql) === TRUE&& $conn->query($bio_Func) === TRUE)
        {
            echo "Data deleted successfully";
        }
        else
        {
            echo"Error while deleting" . $conn->error;
        }
}

function DB_update($conn)
{
    
        $update = $_POST["upSeq"];
        $gID = $_POST['GID'];
        $gName = $_POST['GName'];
        $gSeq = $_POST['GSeq'];
        $number_k = $_POST['num_K'];
        if(!(empty($update)))
        {
        
            $transcipt="";
            $seq_rev_comp="";
            $Seq_complement="";
            $kmers="";
            $GC="";
            if(!empty($_POST["Transcription"])){

                echo $_POST["Transcription"];
                $transcipt = Transcription($gSeq);
                   }
                   if(!empty($_POST["Reverse_Complement"])){
                
                    echo $_POST["Reverse_Complement"];
                    $seq_rev_comp = Rev_Complement($gSeq);

                    } 
                    if(!empty($_POST["Complement"])){
                
                        echo $_POST["Complement"];
                        $Seq_complement = Complement($gSeq);
                        }   
                
                        if(!empty($_POST["Kmers"])){
                
                            echo $_POST["Kmers"];
                            
            $kmers = k_mers_count($gSeq,$number_k );
                            }   
                
                            if(!empty($_POST["GC_Content"])){
                
                                echo $_POST["GC_Content"];
                   
                                $GC = GC_content($gSeq);
                                     }
            $Type = $_POST['seq_type'];
           
        //update id
        if((!(empty($gID))) && empty($gName) && empty($gSeq))
        {
            $sql="UPDATE gene SET geneID=$gID WHERE geneID=$update";
        }
        //update name
        if((!(empty($gName))) && empty($gID) && empty($gSeq))
        {
            $sql="UPDATE gene SET geneName='$gName' WHERE geneID=$update";
        }
        //update seq
        if((!(empty($gSeq))) && empty($gID) && empty($gName))
        {
            $sql="UPDATE gene SET geneSeq='$gSeq' WHERE geneID=$update";
        }
        //update id && name
        if((!(empty($gID))) && (!(empty($gName))) && empty($gSeq))
        {
            $sql="UPDATE gene SET geneID=$gID, geneName='$gName' WHERE geneID=$update";
        }
        //update id && seq
        if((!(empty($gID))) && empty($gName) && (!(empty($gSeq))))
        {
            $sql="UPDATE gene SET geneID=$gID, geneSeq='$gSeq' WHERE geneID=$update";
        }
        //update name && seq
        if((!(empty($gName))) && empty($gID) && (!(empty($gSeq))))
        {
            $sql="UPDATE gene SET geneName='$gName', geneSeq='$gSeq' WHERE geneID=$update";
        }
        //update all
        if(!(empty($gSeq)) && (empty($gID)) && (empty($gSeq)))
        {
            $sql="UPDATE gene SET geneID=$gID, geneName='$gName', geneSeq='$gSeq' WHERE geneID=$update";
        }    

            //$sql="UPDATE gene SET geneID=$gID, geneName='$gName', geneSeq='$gSeq',GeneType = '$Type' WHERE geneID=$update";
            $sql_Functions="UPDATE bio_functions SET geneID='$gID',GC_content = '$GC', Transcription = '$transcipt', ComplementSeq='$Seq_complement' ,Kmers='$kmers',RevComp='$seq_rev_comp' WHERE geneID=$update";
           
            if($conn->query($sql) === TRUE  && $conn->query($sql_Functions) === TRUE)
            {
            echo "Data updated successfully";
            }
            else
            {
            echo"Error while updating" . $conn->error;
            }
        }
}
?>       
</html>