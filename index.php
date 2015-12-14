<?php include 'search.php'?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Lukáš Rak pro Majncraft.cz">
        <title>Hledat na mapě</title>
        <link rel="stylesheet" href="material-design.css" type="text/css"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <script src="material.min.js"></script>
        <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16"> 
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-71315969-1', 'auto');
        ga('send', 'pageview');

        </script>
    </head>
    <body>
        <h1>Vyhledávání v dynmapě</h1>
        <?php
          if(!empty($closest)){
            echo "<div class='information'>\r\n";
            echo "Pro <b>$search</b> nic nenalezeno. Nehledali jste <b>$closest</b>?\r\n";
            echo "</div>";
          }
        ?>
        <form method="post" class="search-box">
            <div class="mdl-selectfield">
            <label for="world">Svět</label>
            <select name="world" name="world">
                <option value="novus" <?php if($world=="novus") echo 'selected'?>>Novus | Overworld</option>
                <option value="novus_nether" <?php if($world=="novus_nether") echo 'selected'?>>Novus | Nether</option>
                <option value="world" <?php if($world=="world") echo 'selected'?>>Eternia | Overworld</option>
                <option value="world_nether" <?php if($world_id=="world_nether") echo 'selected'?>>Eternia | Nether Reloaded</option>
                <option value="world_space" <?php if($world_id=="world_space") echo 'selected'?>>Vesmír | Space</option>
            </select>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="search" name="search" value="<?php if(!empty($closest))echo $closest?>">
              <label class="mdl-textfield__label" for="search">Hledat...</label>
            </div>
            <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="submit" value="Vyhledat v mapě">
        </form>
        <?php if(!empty($name)){ ?>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead  class="mdl-data-table__cell--non-numeric">
                <tr>
                    <th></th>
                    <th>Název</th>
                    <th>Souřadnice X</th>
                    <th>Souřadnice Z</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($name as $n): $i++;?>
                <tr onclick="document.location = '<?= "http://map.majncraft.cz/?worldname=$world&mapname=surface&zoom=8&x=$x[$i]&y=64&z=$z[$i]"?>';">
                    <td><img src="http://map.majncraft.cz/tiles/_markers_/<?=$icon[$i]?>.png" alt="<?=$icon[$i]?>"></td>
                    <td><?=$name[$i]?></td>
                    <td><?=$x[$i]?></td>
                    <td><?=$z[$i]?></td>
                </tr>
                <?php endforeach;?>
             </tbody>
        </table>
        <?php } ?>
    </body>
</html>
<!--<endora>-->