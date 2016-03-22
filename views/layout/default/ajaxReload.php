<?php

$feed_url = 'http://localhost/GestionTareas/sistema';
$content = file_get_contents($feed_url);
$x = new SimpleXmlElement($content);
$feedData = '';
//$date = date("Y-m-d H:i:s");

//output
//$feedData .=  "";
foreach($x->channel->item as $entry) {
    $feedData .= "" . $entry->title . "";
}
//$feedData .= "";
//$feedData .= "Data current as at: ".$date."";

echo $feedData;
?>

