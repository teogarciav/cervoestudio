<?php

// configure
$from = 'Cervo Estudio <info@cervoestudio.com>';
$sendTo = 'info@cervoestudio.com';
$subject = 'Solicitud de plan personalizado - Cervo Estudio';
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message'); // array variable name => Text to appear in email
$okMessage = 'Se ha enviado tu solicitud de plan personalizado.';
$errorMessage = 'No se pudo enviar tu solicitud de plan personalizado, por favor, intente en unos minutos.';

// let's do the sending

try
{
    $emailText = "Solicitud de presupuesto personalizado de parte de:\n=============================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    mail($sendTo, $subject, $emailText, "From: " . $from);

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if ($responseArray['type'] == 'success') {
    // success redirect

    header('Location: http://www.cervoestudio.com/success');
}
else {
    echo $responseArray['message'];
}