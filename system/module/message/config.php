<?php
$config->message = new stdclass();
$config->message->types = 'comment,message,notice,reply';
$config->message->recPerPage = 10;

$config->message->require = new stdclass();
$config->message->require->post  = 'from, type, content';
$config->message->require->reply = 'from, type, content';
