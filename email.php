<?php

require_once '../PHPMailer/class.phpmailer.php';
require_once '../PHPMailer/class.smtp.php';


/* Instanciando a Classe de Email */
$email  = new PHPMailer();

/* Configurando o Email. */
$email->SMTPSecure   = "ssl";
$email->IsSMTP();
$email->SMTPAuth     = true;

$email->Host         = "smtpout.secureserver.net";
$email->Port         = 465;



$email->Username     = "email@example.com";
$email->Password     = "";
$email->IsHTML(true);


/* Configuracoes de quem Esta Mandando o Email. */
$email->SetFrom($_POST['txtEmail'], $_POST['txtName']);
$email->AddReplyTo($_POST['txtEmail'], $_POST['txtName']);
$email->From         = "email@example.com";
$email->FromName     = $_POST['txtName'];
$email->AddAddress('email@example.com');
$email->Subject      = 'Contact Us Email';
$email->Body         =  'Name : '           .$_POST['txtName'].             '<br/>'.
                        'Email : '          .$_POST['txtEmail'].            '<br/>'.
                        'Especialidade : '  .$_POST['txtEspecialidade'] .   '<br/>'.
                        'Phone : '          .$_POST['txtTelefone'].         '<br/>'.

                        'Message : '        .$_POST['txtComentario'];

/* Verificar se o Email foi Enviado com Sucesso */
if($email->Send()):
    $Mensagem = 'Email Enviado com Sucesso';
else:
    $Mensagem = 'Erro ao Enviar o Email '.$email->ErrorInfo;
endif;

/* Mostrar o Resultado. */
echo $Mensagem;
?>