<?php

function enviar_email($titulo, $email, $mensagem)
{
	$subject = $titulo;
	$subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= "From: Rural Deals <no-reply@ruraldeals.com.br>";
	$headers .= "\r\nReply-To: no-reply@ruraldeals.com.br";

	if (mail($email, $subject, $mensagem, $headers, "-f suporte@ruraldeals.com.br")) {
		return TRUE;
	} else {
		return FALSE;
	}
}
