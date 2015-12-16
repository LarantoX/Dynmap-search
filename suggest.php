<?php
$search = $_GET['q'];
$world = $_GET['w'];

$name = array();
$icon = array();
$labels = array();
$i=0;

$json_location = "http://map.majncraft.cz/tiles/_markers_/";
  
$haystack = array();
 
if(!empty($search)){
  
  switch ($world) {
    case "novus":
      $json_location .= "marker_novus.json";
      break;
    case "novus_nether":
      $json_location .= "marker_novus_nether.json";
      break;
    case "world":
      $json_location .= "marker_world.json";
      break;
    case "world_nether":
      $json_location .= "marker_world_nether.json";
      break;
    case "world_space":
      $json_location .= "marker_world_space.json";
      break;
    default:
      $json_location .= "marker_novus.json";
      break;
  }
  $jsondata = file_get_contents($json_location);
  $obj = json_decode($jsondata);
  $sets = array_keys((array)$obj->sets);

  foreach ($sets as $set) {
    $markers = array_keys((array)$obj->sets->$set->markers);
      
    foreach ($markers as $marker){
    $label = mb_strtolower($obj->sets->$set->markers->$marker->label);
    
    array_push($labels, $label);
    
    if (strpos($label,$search) !== false) {
      array_push($name,$obj->sets->$set->markers->$marker->label);
      array_push($icon,$obj->sets->$set->markers->$marker->icon);
      }
    }
  }
}
  
echo "<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp'>\r\n";
echo "<tbody>\r\n";
foreach($name as $n){
  echo "<tr onclick=\"transfer('$n')\">\r\n";
  echo "<td class='table-left'><img src='http://map.majncraft.cz/tiles/_markers_/$icon[$i].png' alt='$icon[$i]'></td>\r\n";
  echo "<td>$n</td>";
  echo "</tr>\r\n";
  $i++;
}
echo "<tbody>\r\n";
echo "</table>\r\n";
