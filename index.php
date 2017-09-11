<?php
    ob_start();
    session_start();
    require_once 'classes/kurv.php';
    require_once 'config.php';
    
    $minKurv = new Basket();
    $produkter = new Produkter($db);

    if(isset($_POST['send'])) {
        $produkter->insert($_POST['navn'], $_POST['pris']);
    }
    if(isset($_POST['opdater'])) {
         $produkter->update($_POST['editNavn'], $_POST['editPris'], $_GET['edit']);
         header('Location: index.php?admin');
    }

    if(isset($_GET['action']) && $_GET['action'] === 'add') {
        $minKurv->PutIKurv($_GET['id'], $_POST['quantity'], $_POST['price'], $_POST['navn']);
        header('Location: index.php');
    }
    $quantity = 0;
    foreach ($minKurv->VisKurv() as $key => $value){
                    $quantity = $quantity + $value['antal'];
                }

   
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-float.css">
    <title>Document</title>
</head>
<body>
<header>
<div class="top-bar">
    <div class="top-bar-left">
        <ul class="menu">
            <li><a href="index.php">Produkter</a></li>
            <li><a href="index.php?admin">Admin</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <li><a href="index.php?kurv"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  <?= $quantity ?></a></li>
        </ul>
    </div>
</div>
</header>
<main class="row">
<?php if(isset($_GET['admin'])): require_once 'admin.php'; ?>
<?php elseif(isset($_GET['kurv'])): require_once 'kurv.php'; ?>
<?php endif; //else: ?>
<?php if((!isset($_GET['admin'])) && (!isset($_GET['kurv']))) : ?>
    <h3>Produkter.</h3>
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
        foreach($produkter->getAll() as $value){
?>              <form method="post" action="index.php?action=add&id=<?= $value->id ?>">
                    <tr>
                        <td><h3><?= $value->navn ?></h3></td>
                        <td><h3><?= $value->pris ?></h3></td>
                        <input type="hidden" value="<?= $value->navn ?>" name="navn">
                        <input type="hidden" value="<?= $value->pris ?>" name="price">
                        <td><input type="number" name="quantity" value="1" size="2" /></td>
                        <td><input type="submit" name="cart" value="Tilføj til kurven" class="button" /></td>
                    </tr>
                </form>
                    <?php
        }
    endif;
    ?>
    </tbody>
     </table>
     </main>
</body>
</html>
