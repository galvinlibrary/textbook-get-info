<?php

function get_record_info($record, $type){
  $recordArr=array(
    "title"=>"245", 
    "author"=>"245", 
    "edition"=>"250"
  );

  foreach($record->datafield as $item){
    $rc = array_search($item[@tag],$recordArr);
    if ($rc){
      echo "<p>here " . $item[@tag] , " $rc</p>";
      break;
    }

  }      
      

}

$wskey=getenv('OCLC_DEV_KEY');
$url="http://www.worldcat.org/webservices/catalog/content/isbn/978-0-02-391341-9?wskey=" . $wskey;

if (($response_xml_data = file_get_contents($url))===false){
    echo "Error fetching XML\n";
} 
else {
   libxml_use_internal_errors(true);
   $dataObj = simplexml_load_string($response_xml_data);
   if (!$dataObj) {
       echo "Error loading XML\n";
       foreach(libxml_get_errors() as $error) {
           echo "\t", $error->message;
       }
   } else {
      print_r($dataObj);
      $title=get_record_info($dataObj, "title");
      echo "<p>$title</p>";
   }
}
 
?>