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
    </head>
    <body>
        <h1>Vyhledávání v dynmapě</h1>
        <form method="post" class="search-box">
            <div class="mdl-selectfield">
            <label for="world">Svět</label>
            <select name="world" name="world">
                <option value="novus">Novus | Overworld</option>
                <option value="novus_nether">Novus | Nether</option>
                <option value="world">Eternia | Overworld</option>
                <option value="world_nether">Eternia | Nether Reloaded</option>
                <option value="world_space">Vesmír | Space</option>
            </select>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="search" name="search">
              <label class="mdl-textfield__label" for="search" required>Hledat...</label>
            </div>
            <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="submit" value="Vyhledat v mapě">
        </form>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead  class="mdl-data-table__cell--non-numeric">
                <tr>
                    <th>Název</th>
                    <th>Souřadnice X</th>
                    <th>Souřadnice Z</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($name as $n): $i++;?>
                <tr onclick="document.location = '<?= "http://map.majncraft.cz/?worldname=$world&mapname=surface&zoom=8&x=$x[$i]&y=64&z=$z[$i]"?>';">
                    <td><?=$name[$i]?></td>
                    <td><?=$x[$i]?></td>
                    <td><?=$z[$i]?></td>
                </tr>
                <?php endforeach;?>
             </tbody>
        </table>
    </body>
</html>
