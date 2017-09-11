<div class="small-6 columns">
<h3>Nyt produkt</h3>
    <form action="" method="post">
        <label for="navn">Varens navn:</label><br>
        <input type="text" id="navn" name="navn"><br>
        <label for="pris">Varens pris:</label><br>
        <input type="number" name="pris" id="pris"><br>
        <button name="send" class="button" type="submit">Send</button>
    </form>
</div>
<?php if(isset($_GET['del'])): $produkter->deleteOne($_GET['del']); header('Location: index.php?admin');?>

<?php elseif(isset($_GET['edit'])): ?>
<?php $data = $produkter->getOne($_GET['edit']); ?>
<div class="small-6 columns">
<h3>Rediger - <?= $data->navn ?></h3>
    <form action="" method="post">
        <label for="editNavn">Varens navn:</label><br>
        <input type="text" id="editNavn" name="editNavn" value ="<?= $data->navn ?>"><br>
        <label for="editPris">Varens pris:</label><br>
        <input type="number" name="editPris" id="editPris" value="<?= $data->pris ?>"><br>
        <button name="opdater" class="success button" type="submit">Opdater</button>
    </form>
</div>
<?php endif; //else: ?>

    <table class="unstriped">
        <thead>
                    <tr>
                        <th>Navn</th>
                        <th>Pris</th>
                        <th></th>
                        <th></th>
                    </tr>
        </thead>
        <tbody>
    <?php
        
        foreach($produkter->getAll() as $value){
?>
                    <tr>
                        <td><h3><?= $value->navn ?></h3></td>
                        <td><h3><?= $value->pris ?></h3></td>
                        <td><a href="index.php?admin&del=<?= $value->id ?>" onclick="return confirm('Are you sure you want to Remove?');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        <td><a href="index.php?admin&edit=<?= $value->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php
        }
    //endif;
    ?>
    </tbody>
     </table>
