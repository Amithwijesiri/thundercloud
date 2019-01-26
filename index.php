
<!DOCTYPE html>  
<html>
  <head>
    <title>ThunderCloud Web Automation Tool</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
      
      setTimeout(fade_out, 2000);

      function fade_out() {
        $("#messageError").fadeOut().empty();
      }
    </script>
  </head>
  <body>

    <div class="container" style="margin: 0px;width: 100%;">
  	<div>
  		<h5 class="header"><strong>ThunderCloud</strong> <span class="label label-default">0.0.1 - Beta</span></h5>
  	</div>
  	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img alt="ThunderCloud" src="images/logo.png" width="100%" height="">
      </a>
     </div>
     <h6 class="headerQuate">Ultimate Experience Of The Test-Automation</h6>
  </div>
</nav>
<?php  
  session_start();
  
  if (isset($_POST["distroy"])) {
  session_unset(); 
  session_destroy(); 
  header("Location: index.php"); /* Redirect browser */
  
  }
  $dataFolder="/src/main/java/com/test/data";
  $pageFolder="/src/main/java/com/test/pages/";
  $objectFolder="/src/main/java/com/test/pageObjects";
  
  if(isset($_POST["location"]))  
  { 
  
   $_POST["locationName"] = str_replace('\\', '/', $_POST["locationName"]);
   $_SESSION["location"] = $_POST["locationName"];
   
  }
  if (!isset($_SESSION["location"])) 
  {
  	?>
<div class="row">
  <div class="col-md-4">.col-md-4</div>
  <div class="col-md-4">

  	<form method="post">
              <input type="text" name="locationName" class="form-control input-sm">
              <button type="submit" id="location" name="location" class="btn btn-primary btn-xs">Project Location</button> 
              </form>
  </div>
  <div class="col-md-4">.col-md-4</div>
</div>
  	<?php
  }


  if (isset($_SESSION["location"])) {


      if (isset($_POST["name"])) {
          $_POST["name"]=str_replace('"', "'", $_POST["name"]);
      }
      if (isset($_POST["xpath"])) {
          $_POST["xpath"]=str_replace('"', "'", $_POST["xpath"]);
      }
      if (isset($_POST["abxpath"])) {
          $_POST["abxpath"]=str_replace('"', "'", $_POST["abxpath"]);
      }
      if (isset($_POST["type"])) {
          $_POST["type"]=str_replace('"', "'", $_POST["type"]);
      }



     $paramFile=$_SESSION["location"].$dataFolder;
     $paramPage=$_SESSION["location"].$pageFolder;
     $objectLocation=$_SESSION["location"].$objectFolder;
  
  //Creating the file
  
  if(isset($_POST["createnew"]))  
  {
     $paramFile=$_SESSION["location"].$dataFolder;
  
     $filename=$_POST['txtcreatenew'].".json";
     $filenameData=$_POST['txtcreatenew']."Data.json";
     
     $myfile = fopen($paramFile."/".$filename, "w") or die("Unable to open file!");
     $myfile = fopen($paramFile."/".$filenameData, "w") or die("Unable to open file!");
  
  }
  
  
  
  $message = '';  
  $error = '';  
  if(isset($_POST["submit"]))  
  {  
       if(empty($_POST["name"]))  
       {  
            $error = "<label class='text-danger'>Enter Name</label>";  
       }  
       else if(empty($_POST["xpath"]))  
       {  
            $error = "<label class='text-danger'>Enter XPath</label>";  
       }  
       else if(empty($_POST["abxpath"]))  
       {  
            $error = "<label class='text-danger'>Enter Absolute Xpath</label>";  
       } 
       else if(empty($_POST["type"]))  
       {  
            $error = "<label class='text-danger'>Enter Designation</label>";  
       }  
       else  
       {  
         //Delete from the JSON
           //Insert the JSON
               $true_value = false;
               $json = file_get_contents($paramFile."/".$_GET['filename']);
                  $paramFile."/".$_GET['filename'];
                  //Decode JSON
                  $json_data = json_decode($json,true);
                  if ($json_data!=null) {
                  //Print data
                  //print_r($json_data);
                  $i=1;
                  foreach ($json_data as $key2 => $value2) 
                    {

                        if ($_POST['name']==$json_data[$key2]['name']) {
                         
                            $true_value=true;
                            $message = "<div class='alert alert-danger' role='alert' style='text-align:center;' id='messageError'><strong>".$_POST["name"]."</strong> - Element Already Exist</div>";
                            break;
                        }
                    }
                  }

            if ($true_value!=true) {
              
            
          
            if(file_exists($paramFile."/".$_GET['filename']))  
            {  
                 $current_data = file_get_contents($paramFile."/".$_GET['filename']);  
                 $array_data = json_decode($current_data, true);  
                 $extra = array(  
                      'name'               =>     $_POST['name'],  
                      'xpath'          =>     $_POST["xpath"],  
                      'abxpath'          =>     $_POST["abxpath"],
                      'type'     =>     $_POST["type"]  
                 );  
                 $array_data[] = $extra;  
                 $final_data = json_encode($array_data);  
                 if(file_put_contents($paramFile."/".$_GET['filename'], $final_data))  
                 {  
                       $page=str_replace('.json', '', $_GET['filename']);
                       writeMsg($page,$paramPage,$paramFile);
                      $message = "<div class='alert alert-success' role='alert' style='text-align:center;' id='messageError'>".$_POST["name"]." - Element Added Successfully</div>";  
                 }  
            }  
            else  
            {  
                 $error = 'JSON File not exits';  
            }  

            }   
       }  
  }  
  
  
  if(isset($_POST["submitDelete"]))  
  {
     //get all your data on file
           $data = file_get_contents($paramFile."/".$_GET['filename']);
  
           // decode json to associative array
           $json_arr = json_decode($data, true);
  
           // get array index to delete
           $arr_index = array();
           foreach ($json_arr as $key => $value) {
               if ($key == $_POST['key']) {
                   $arr_index[] = $key;
               }
           }
  
           // delete data
           foreach ($arr_index as $i) {
               unset($json_arr[$i]);
           }
           
           // rebase array
           $json_arr = array_values($json_arr);
  
           // encode array to json and save to file
           file_put_contents($paramFile."/".$_GET['filename'], json_encode($json_arr));
           $page=str_replace('.json', '', $_GET['filename']);
           writeMsg($page,$paramPage,$paramFile);
            $message = "<div class='alert alert-danger' role='alert' style='text-align:center;' id='messageError'>Element Deleted Successfully</div>";  
  
  }
  
  
  if(isset($_POST["submitEdit"]))  
  { 
     $jsonString = file_get_contents($paramFile."/".$_GET['filename']);
     $data = json_decode($jsonString, true);
  
     $key= $_POST['key'];
     $data[$key]['name'] = $_POST['name'];
     $data[$key]['xpath'] = $_POST['xpath'];
     $data[$key]['abxpath'] = $_POST['abxpath'];
     $data[$key]['type'] = $_POST['type'];
                   
     $newJsonString = json_encode($data);
     file_put_contents($paramFile."/".$_GET['filename'], $newJsonString);
     $editMessage="Success";
     $page=str_replace('.json', '', $_GET['filename']);
     writeMsg($page,$paramPage,$paramFile);
     $message = "<div class='alert alert-warning' role='alert' style='text-align:center;' id='messageError'>".$_POST["name"]." - Element Modified Successfully</div>";  
  }

  if(isset($_POST["pageDelete"]))  
  { 
        $file_pointer = $_SESSION["location"].$dataFolder."/".$_POST["page"];
         $file_pointerData = $_SESSION["location"].$dataFolder."/".str_replace('.json', 'Data.json', $_POST["page"]);
        if (!unlink($file_pointerData))
        {
           echo "weradi";
        }
        else
        {
           
        }

        if (!unlink($file_pointer))
        {
           echo "weradi";
        }
        else
        {
           
        }
     
     $message = "<div class='alert alert-danger' role='alert' style='text-align:center;' id='messageError'>Page Deleted Successfully</div>";  
  }
  
  
  
  ?>  

    <container>

      <div class="row">
        <div class="col-md-2">
          <!-- Project location section-->
          <?php
            if ($_SESSION["location"]==null) {
              echo '
              <form method="post">
              <input type="text" name="locationName" class="form-control input-sm">
              <button type="submit" id="location" name="location" class="btn btn-primary btn-xs">Project Location</button> 
              </form>';
            }
            
            else
            {
              $_SESSION["location"]."/pom.xml";
              
              $xml=simplexml_load_file($_SESSION["location"]."/pom.xml") or die("Error: Cannot create object");
               echo "Project Name - <span class='label label-warning'>".$xml->artifactId."</span>";
                
            }
            ?>
            
          <!-- Project location section-->
          <!-- Navigation Bar -->
          <hr>  
        
          <!-- File List-->
          <div class="list-group">
            <?php
              $dir = $paramFile=$_SESSION["location"].$dataFolder;
              $a = scandir($dir);
              for ($i=2; $i <sizeof($a); $i++) { 
                 
                echo '<a href="index.php?filename='.$a[$i].'" class="list-group-item"> <form method="post" action="index.php">
            <input type="text" style="display:none;" name="page" value="'.$a[$i].'">
            <button type="submit" name="pageDelete" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </form>'.$a[$i].'</a>';
                 $i++;
              }
              
              
              ?>
          </div>

          
          <!-- File List-->
            <button type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-target="#demo">Create New Page</button>
          <form method="post" style="margin-top: 10px;">
            <div id="demo" class="collapse">
              <input type="text" name="txtcreatenew" class="form-control input-sm" required>
              <button type="submit" id="createnew" name="createnew" class="btn btn-primary btn-xs" style="margin-top: 10px;">Save</button>
            </div>
          </form>
          
        </div>
        <div class="col-md-9" >
        	


          <?php
            if (isset($_GET['filename'])) {

            	?>
            	<ul class="nav nav-tabs">
        		 <?php 
            		$dataURL=null;
            		$status=null;
            		$status2=null;
                     if (isset($_GET['filename'])) {
                     	
                     	 $dataURL= str_replace('.json', '', $_GET['filename']);
                     	 $dataURL= $dataURL."Data.json";

                     	 if (\strpos($_GET['filename'], 'Data.json') == true) {
                     	 	$status="active";
                     	 }
                     	 else
                     	 {
                     	 	$status2="active";
                        
                     	 }
                     }
                    

                     ?>
			  <li class="<?php echo $status2 ?>"><a href="index.php?filename=<?php echo str_replace('Data', '', $dataURL); ?>">Test Parameters</a></li>
			  <li class="<?php echo $status ?>"><a href="index.php?filename=<?php echo $dataURL; ?>">Test Data</a></li>
			</ul>
      <br>
      <?php  
              if(isset($message))  
                {  
                  echo $message;  
                }  
              ?>  
      <div class="row" id="headerTable">
        <?php
        if (\strpos($_GET['filename'], 'Data.json') != true) {
          ?>
          <div class="col-md-3" id="headerTableRow">Element Name</div>
        <div class="col-md-3" id="headerTableRow">Locator (Relative)</div>
        <div class="col-md-3" id="headerTableRow">Locator (Absolute)</div>
        <div class="col-md-1" id="headerTableRow">Type</div>
        <div class="col-md-2" id="headerTableRow">Action</div>
          <?php
        }
        else
        {
          ?>
          <div class="col-md-3" id="headerTableRow">Element Name</div>
        <div class="col-md-6" id="headerTableRow">Data Details</div>
        
        <div class="col-md-1" id="headerTableRow">Type</div>
        <div class="col-md-2" id="headerTableRow">Action</div>
          <?php
        }

        ?>
        
      
      </div>
      <br>
			<?php
               $json = file_get_contents($paramFile."/".$_GET['filename']);
                  $paramFile."/".$_GET['filename'];
                  //Decode JSON
                  $json_data = json_decode($json,true);
                  if ($json_data!=null) {
                  //Print data
                  //print_r($json_data);
                  $i=1;
                  foreach ($json_data as $key1 => $value1) {

                    ?>
                    
          <form method="post" action="index.php?filename=<?php echo $_GET['filename'] ?>">
            <div class="row">
              <?php if (\strpos($_GET['filename'], 'Data.json') != true){ ?>
                <div class="col-md-3"><input class="txtAdd" type="text" name="name" value="<?php echo $json_data[$key1]['name']; ?>"/></div>
              <div class="col-md-3"><input class="txtAdd" type="text" name="xpath" value="<?php echo $json_data[$key1]['xpath']; ?>"/></div>
               <div class="col-md-3"><input class="txtAdd" type="text" name="abxpath" value="<?php echo $json_data[$key1]['abxpath']; ?>"/></div>
              <div class="col-md-1"><input class="txtAdd" type="text" name="type" value="<?php echo $json_data[$key1]['type']; ?>"/></div>
              <input class="txtname" type="text" name="key" style="display: none" value="<?php echo $key1; ?>"/>
              <div class="col-md-2" style="text-align: right;"><input type="submit" name="submitEdit" value="Edit Save" class="btn btn-default btn-xs" />
                <input type="submit" name="submitDelete" value="Delete" class="btn btn-default btn-xs" />
              </div>
              <?php }
              else
              {?>
              <div class="col-md-3"><input class="txtAdd" type="text" name="name" value="<?php echo $json_data[$key1]['name']; ?>"/></div>
              <div class="col-md-6"><input class="txtAdd" type="text" name="xpath" value="<?php echo $json_data[$key1]['xpath']; ?>"/></div>
              <div class="col-md-1" style="display: none"><input class="txtAdd" type="text" name="abxpath" value="nullData"/></div>
              <div class="col-md-1"><input class="txtAdd" type="text" name="type" value="<?php echo $json_data[$key1]['type']; ?>"/></div>
              <input class="txtname" type="text" name="key" style="display: none" value="<?php echo $key1; ?>"/>
              <div class="col-md-2" style="text-align: right;"><input type="submit" name="submitEdit" value="Edit Save" class="btn btn-default btn-xs" />
                <input type="submit" name="submitDelete" value="Delete" class="btn btn-default btn-xs" />
              </div>
              <?php } ?>

              
            </div>
            
          </form>

          <?php
          $i++;
            }  
            
            }
            }
          
            ?>
          <?php if (isset($_GET['filename'])) { ?>
            <hr>
            <?php if (\strpos($_GET['filename'], 'Data.json') != true) { ?>

                        <form method="post" action="index.php?filename=<?php echo $_GET['filename']; ?>">
            <?php   
              if(isset($error))  
                {  
                  echo $error;  
                }  
              ?>  
            <div class="row">
              <div class="col-md-3">
                <input type="text" name="name" class="txtname" />
              </div>
              <div class="col-md-3">
                <input type="text" name="xpath" class="txtname" />
              </div>
              <div class="col-md-3">
                <input type="text" name="abxpath" class="txtname" />
              </div>
              <div class="col-md-2">
                <input type="text" name="type" class="txtname" />
              </div>
              <div class="col-md-1">
                <input type="submit" name="submit" value="Add New" class="btn btn-info" />
              </div>
            </div>
           
          </form>

            <?php } else { ?>


          <form method="post" action="index.php?filename=<?php echo $_GET['filename']; ?>">
            <?php   
              if(isset($error))  
                {  
                  echo $error;  
                }  
              ?>  
            <div class="row">
              <div class="col-md-3">
                <input type="text" name="name" class="txtname" />
              </div>
              <div class="col-md-6">
                <input type="text" name="xpath" class="txtname" />
              </div>
              <div class="col-md-3" style="display: none">
                <input type="text" name="abxpath" class="txtname" value="nullData" />
              </div>
              <div class="col-md-2">
                <input type="text" name="type" class="txtname" />
              </div>
              <div class="col-md-1">
                <input type="submit" name="submit" value="Add New" class="btn btn-info" />
              </div>
            </div>
           
          </form>
          <?php }} ?>
        </div>
        <div class="col-md-1">
         
         <form method="post">
            <button type="submit" id="distroy" name="distroy" style="float: left;width: 100%;" class="btn btn-default btn-xs">Log Out</button>
          </form>
        </div>
      </div>
    </container>
    <?php
      }
      
      function writeMsg($pagenameParam,$projectLocation,$dataLocation) {
          
        $pagename=$pagenameParam.".json";
        if (\strpos($pagename, 'Dat') == true) {
          $pagename=str_replace('Data', '', $pagename);
        }
      
      
        $dataPageName=$pagenameParam."Data.json";
        if (\strpos($dataPageName, 'DataData') == true) {
          $dataPageName=str_replace('DataData', 'Data', $dataPageName);
        }
        $pageNameClass=str_replace('Data', '', $pagenameParam).".java";
        $projectLocation=$projectLocation;
        
        // JSON string
        $someJSON = file_get_contents($dataLocation."/".$pagename);
        $dataLocation."/".$pagename;
        // Convert JSON string to Array
        $someArray = json_decode($someJSON, true);
        $someArray = $someArray;
      
        $fullTxtParam=null;
        foreach ($someArray as $key => $value) {
          
          $name=str_replace(' ', '', $value['name']);
          $fullTxtParam=$fullTxtParam. "protected ".$value["type"]."[]".str_replace(' ', '', $value["name"])."= readPathNames(\"$name\",fileNameParameters);"."\n";
      
        }
      
        //Reading Data file
        $someJSON = file_get_contents($dataLocation."/".$dataPageName);
        $dataLocation."/".$dataPageName;
        // Convert JSON string to Array
        $someArray = json_decode($someJSON, true);
        $someArray = $someArray;
        $fullTxtData=null;
        if ($someArray!=null) {
          
        foreach ($someArray as $key => $value) {
          
          $name=str_replace(' ', '', $value['name']);
          $fullTxtData = $fullTxtData. "protected ".$value["type"]." ".str_replace(' ', '', $value["name"])."Data= readData(\"$name\",fileNameData);"."\n";
        } 
        }
        
      
       
      
        //Creating java file inside the page folder
      
      $myfile = fopen($projectLocation.$pageNameClass, "w") or die("Unable to open file!");
      $txt = "package com.test.pages;
      
      import com.test.utlities.TestBase;
      
      /**
       * @author awijesiri
       *
       */
      public class ".str_replace('.java', '', $pageNameClass)." extends TestBase
      
      {
      
        String fileNameParameters=\"$pagename\";
        String fileNameData=\"$dataPageName\";
        //Reading Xpaths
        ".$fullTxtParam."
        
        //Reading Data
        ".$fullTxtData."
        
      }
      ";
        fwrite($myfile, $txt);
        fclose($myfile);
      

      
       // call the function
 
      }
      
      
      
      ?>

        <div class="footer">
          <h5 style="color: black;">All Rights Reserved &copy; 2019 | By <a href="https://www.linkedin.com/in/amithwijesiri/" style="color: black;"> Amith Wijesiri </a> </h5 >
        </div>
      </div>
  </body>
</html>

