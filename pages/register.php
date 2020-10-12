<?php

require FUNCTION_DIR . '/functions/iban.php';
defined('FRONT_1') || die;

$error = '';

function setError($msg) {
    global $error;
    $error = $msg;
    
}

if(isset($_POST['register'])) {
    $is_person_valid = validation($_POST);

    if($is_person_valid) {

        $db = json_decode(file_get_contents('http://localhost/project_01/uzd-bank/bank-1/db.json'), 1);
        
        $_POST['iban'] = GenerateIban();
    
        $id = is_array($db) && $db != null ? $db[count($db)-1]['id'] +1 : 1;
        $user = [
         'name'=> $_POST['name'],
         'lastname'=> $_POST['lastname'],
         'personalnumber'=> $_POST['personalnumber'],
         'iban'=> $_POST['iban'],
         'balance'=> '0.00',
         'id' => $id];
         $db[] = $user;
        
        file_put_contents('db.json', json_encode($db));
        header('Location: '.INSTALL_DIR.'accounts');
    }
}

//VALIDATION
function validation($a) {
    $v1 = uniquePersonalNumber($a['personalnumber']);
    if(!$v1) {
        $error = 'Asmens kodas jau egzistuoja <br>';
        setError($error);
        return false;
    }
    $v2 = validatePersonNumber(''.$a['personalnumber']);
    if(!$v2) {
        $error = 'Neteisingas asmens kodas <br>';
        setError($error);
        return false;
    }
    $v3 = inputStringValidation($a['name']);
    if(!$v3) {
        $error = 'Neteisingas vardas <br>';
        setError($error);
        return false;
    }
    $v4 = inputStringValidation($a['lastname']);
    if(!$v4) {
        $error = 'Neteisinga pavarde <br>';
        setError($error);
        return false;
    }

    return true;
}


$html = '
<div class="register">
    <div style="'.(strlen($error) > 0? '' : 'display:none;') .'" class="reg-toast">
        <p>'.$error.'</p>
    </div>

    <form action="" method="post">
        <h2>Registracijos forma</h2>

        <label for="name">Vardas</label>
        <input type="text" name="name" required>

        <label for="lastname">Pavarde</label>
        <input type="text" name="lastname" required>
        
        <label for="personalcode">Asmens kodas</label>
        <input type="text" name="personalnumber" required>

        <button type="submit" name="register">Registruotis</button>
    </form>
</div>';

echo $html;

