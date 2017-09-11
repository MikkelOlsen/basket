    <h3>Kurv</h3>
    <?php
        if(isset($_GET['add'])){
            $minKurv->RetVare($_GET['add'], 1);
            header('Location: index.php?kurv');
        }

        if(isset($_GET['minus'])){
            $minKurv->MinusVare($_GET['minus'], 1);
            header('Location: index.php?kurv');
        }

        if(isset($_GET['remove'])){
            $minKurv->SletVare($_GET['remove'], 1);
            header('Location: index.php?kurv');
        }

        if(isset($_POST['checkout'])){
            echo '<div class="callout success">Din ordre er modtaget.</div>';
            $minKurv->Afslut();
            $produkter->OrdreListe($_POST['fullname'], $_POST['adresse'], $_POST['pris']);
        }
        
        ?>

            <table class="unstriped">
                <thead>
                    <tr>
                        <th>Navn</th>
                        <th>Pris</th>
                        <th>Antal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>    

        <?php
        $pris = 0;
        $moms = 0;

        foreach ($minKurv->VisKurv() as $key => $value){

            $pris = $pris + ($value['antal'] * $value['pris']);
            $moms = $pris * 0.25;

            echo '<tr>';
            echo '<td>' . $value['navn'] . '</td>';
            echo '<td>' . $value['pris'] . '</td>';
            echo '<td>
            <a href="index.php?kurv&minus='.$key.'"><i class="fa fa-minus-square" aria-hidden="true"></i></a>
            ' . $value['antal'] . '  
            <a href="index.php?kurv&add='.$key.'"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
            </td>';
            echo '<td><a class="alert button" href="index.php?kurv&remove='.$key.'">Fjern vare</a></td>';
            echo '</tr>';
            
        }
        
    ?>
    </tbody>
    </table>
    </br>
    <h5>Sub total: <?php echo $pris ?>.-</h5>
    <h5>heraf moms: <?php echo $moms ?>.-</h5>
    <form method="post" action="">
        Navn:<br>
        <input type="text" name="fullname"><br>
        Adresse:<br>
        <input type="text" name="adresse"><br>
        <input type="hidden" name="pris" value="<?= $pris ?>">
        <button class="button" type="submit" name="checkout">Køb</button>
    </form>