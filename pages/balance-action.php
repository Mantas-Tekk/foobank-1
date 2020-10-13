<?php

require FUNCTION_DIR . '/functions/iban.php';

$db = json_decode(file_get_contents(__DIR__.'/../db.json'), 1);

$user = '';
$button_value = '';
$button_name = '';
$toast_html= '';

if (isset($_SESSION['add'])) {
    foreach ($db as $value) {
        if ($value['id'] == $_SESSION['id']) {
            $user = $value;
        }
    }
    $button_value = 'b_a';
    $button_name = 'Prideti';
}
if (isset($_SESSION['substract'])) {

    foreach ($db as $value) {
        if ($value['id'] == $_SESSION['id']) {
            $user = $value;
        }
    }
    $button_value = 'b_s';
    $button_name = 'Atimti';
}

// var_dump($_SESSION);
// _c($user);
$db1 = [];

if (isset($_POST['b_a'])) {
    $money = $_POST['money'];
    //_c($_POST['money']); 
    if(validSum($money)) {
        if ($money > 0) {
            $user['balance'] += $money;
            $user['balance'] = number_format($user['balance'],2,".","");
    
            foreach ($db as $value) {
                $is_in_list = false;
                if ($value['id'] == $_SESSION['id']) {
                    $is_in_list = true;
                }
                if (!$is_in_list) {
                    $db1[] = $value;
                } else {
                    $db1[] = $user;
                }
            }
            file_put_contents('db.json', json_encode($db1));
            header('Location: '.INSTALL_DIR.'balance-action');
        }
    } else {
        $toast_html = '
        <div class="toast1">
            <p>Lievas formatas</p>
        </div>';
    }
}

if (isset($_POST['b_s'])) {
    $money = $_POST['money'];
    // _c($_POST['money']); 
    // _c($money);
    if(validSum($money)) {
        // _c($money);

        if ($money >= 0 && $money <= $user['balance']) {
            // _c($money);
            if ($money <= $user['balance']) {
                $user['balance'] -= $money;
                $user['balance'] = number_format($user['balance'],2,".","");
            }
    
            foreach ($db as $value) {
                $is_in_list = false;
                if ($value['id'] == $_SESSION['id']) {
                    $is_in_list = true;
                }
    
                if (!$is_in_list) {
                    $db1[] = $value;
                } else {
                    $db1[] = $user;
                }
            }

            file_put_contents('db.json', json_encode($db1));
            header('Location: '.INSTALL_DIR.'balance-action');

        } else {
            $toast_html = '
            <div class="toast1">
                <p>Nera tiek pinigu saskaitoje</p>
            </div>';
        }
    } else {
        $toast_html = '
        <div class="toast1">
            <p>Lievas formatas</p>
        </div>';
    }
}

?>
<div class="container">
    <?= $toast_html?>
   <div class="container2">
        <form action="" method="post">
            <div class="row">
                <div class="col-25">
                    <label for="fname">Vardas</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="firstname" placeholder="<?= $user['name'] ?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="lname">Pavarde</label>
                </div>
                <div class="col-75">
                    <input type="text" id="lname" name="lastname" placeholder="<?= $user['lastname'] ?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="lname">Balansas</label>
                </div>
                <div class="col-75">
                    <input type="text" id="lname" name="lastname" placeholder="<?= $user['balance'] ?> €" disabled>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-25">
                    <label for="money"><?= $button_name ?> pinigu</label>
                </div>
                <div class="col-50">
                    <input type="text" name="money" id="money" placeholder="0.00 €">
                </div>
                <div class="col-25-b">

                    <button type="submit" name="<?= $button_value ?>"><?= $button_name ?></button>
                </div>
            </div>
        </form>
    </div>
</div>