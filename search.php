<?php
$name = array();
$x = array();
$z = array();
$icon = array();
$i=-1;
if(isset($_POST['submit'])){
  $world = $_POST['world'];
  $search = $_POST['search'];
  $json_location = "http://map.majncraft.cz/tiles/_markers_/";
  
  $haystack = array();
  
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
    
    if (strpos($label,$search) !== false) {
      array_push($name,$obj->sets->$set->markers->$marker->label);
      array_push($x,$obj->sets->$set->markers->$marker->x);
      array_push($z,$obj->sets->$set->markers->$marker->z);
      array_push($icon,$obj->sets->$set->markers->$marker->icon);
      }
    }
  }
}