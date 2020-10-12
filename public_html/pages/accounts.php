<?php
ob_start();
$db = json_decode(file_get_contents(__DIR__.'/../db.json'), 1);
//_c($db);

$html = '';
//_c($_POST);

$db1 = [];

$toast_html = '';
if(isset($_POST['add'])) {
    session_unset();
    // _c("add");

    if(count($_POST) != 2) {
        $toast_html = '
        <div class="toast">
            <p>Pasirinkit viena is saskaitu</p>
        </div>';

    } else {
        $_SESSION['add'] = $_POST['add'];
        foreach($_POST as $value) {
            if(is_numeric($value)) {
                $_SESSION['id'] = $value;
            }
        }
        // _c($_SESSION);
        ob_start();
        header('Location: '.URL.'/balance-add');

        die;
    }

} 
if(isset($_POST['substract'])) {
    session_unset();
    // _c("substract");

    if(count($_POST) != 2) {
        $toast_html = '
        <div class="toast">
            <p>Pasirinkit viena is saskaitu</p>
        </div>';
    } else {
        $_SESSION['substract'] = $_POST['substract'];
        foreach($_POST as $value) {
            if(is_numeric($value)) {
                $_SESSION['id'] = $value;
            }
        }
        // _c($_SESSION);
        header('Location: '.URL.'/balance-add');
        die;
    }
} 

if(isset($_POST['delete'])) {
    foreach($db as $key => $value) {
        $to_delete = false;
        
        foreach($_POST as $value2) {
            if(strlen($value2) > 0) {
                if($value['id'] == $value2 && $value['balance'] == 0) {
                     //_c($value);
                     $to_delete = true;
                }
                
            }
        }
        if(!$to_delete) {
            $db1[] = $value;
        }
    }

    //_c($db1);
    file_put_contents('db.json', json_encode($db1));
    header('Location: '.URL.'/accounts');
    die;
}

if(is_array($db)) {
    foreach ($db as $key => $value) {
        $html .= '
        <tr>
            <td>
                <label for="' . $value['id'] . '">' . $value['id'] . '</label>
                <input type="checkbox" name="id' . $value['id']. '" id="' .$value['id'] . '" value="' . $value['id'] . '">
            </td>
            <td>' . $value['name'] . '</td>
            <td>' . $value['lastname'] . '</td>
            <td>' . $value['personalnumber'] . '</td>
            <td>' . $value['iban'] . '</td>
            <td>' . $value['balance'] . ' €</td>
        </tr>';
    }
}

$html1 = '
<div>
    <form class="table-wrapper" action="" method="post">
        '.$toast_html.'
        <table class="darkTable">
            <tr>
                <th>ID</th>
                <th>Vardas</th>
                <th>Pavarde</th>
                <th>Asmens kodas</th>
                <th>IBAN</th>
                <th>Balansas</th>
            </tr>
            '.$html.'
            <tfoot>
                <tr>
                    <td colspan="2">
                        <button class="button" type="submit" name="delete">Istrinti</button>
                    </td>
                    <td colspan="2">
                        <button class="button" type="submit" name="add">Prideti</button>
                    </td>
                    <td colspan="2">
                        <button class="button" type="submit" name="substract">Atimti</button>
                    </td>
                </tr>
            </tfoot>

        </table>
    </form>
</div>
';

echo $html1;
ob_end_flush();