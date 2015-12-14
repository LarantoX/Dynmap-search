<?php
$name = array();
$x = array();
$z = array();
$icon = array();
$i=-1;
$closest = 0;
$world_id =0;

$labels = array();

if(isset($_POST['submit'])){
  $world = $_POST['world'];
  $search = $_POST['search'];
  $json_location = "http://map.majncraft.cz/tiles/_markers_/";
  
  $haystack = array();
  
  if(!empty($search)){
  
    switch ($world) {
      case "novus":
        $json_location .= "marker_novus.json";
        $world_id = 0;
        break;
      case "novus_nether":
        $json_location .= "marker_novus_nether.json";
        $world_id = 1;
        break;
      case "world":
        $json_location .= "marker_world.json";
        $world_id = 2;
        break;
      case "world_nether":
        $json_location .= "marker_world_nether.json";
        $world_id = 3;
        break;
      case "world_space":
        $json_location .= "marker_world_space.json";
        $world_id = 4;
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
        array_push($x,$obj->sets->$set->markers->$marker->x);
        array_push($z,$obj->sets->$set->markers->$marker->z);
        array_push($icon,$obj->sets->$set->markers->$marker->icon);
        }
      }
    }
  
    /* test zda byly nalezené nějaké výsledky, jinak najdi podobný výraz*/
    if (empty($name)) {
      // no shortest distance found, yet
      $shortest = -1;

      // loop through words to find the closest
      foreach ($labels as $word) {

      // calculate the distance between the input word,
      // and the current word
      $lev = levenshtein($search, $word);

      // check for an exact match
      if ($lev == 0) {

          // closest word is this one (exact match)
          $closest = $word;
          $shortest = 0;

          // break out of the loop; we've found an exact match
          break;
        }

      // if this distance is less than the next found shortest
      // distance, OR if a next shortest word has not yet been found
      if ($lev <= $shortest || $shortest < 0) {
        // set the closest match, and shortest distance
        $closest  = $word;
        $shortest = $lev;
        }
      }
    }
  }
}