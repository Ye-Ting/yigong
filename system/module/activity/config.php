<?php
$config->activity->require = new stdclass();
$config->activity->require->create   = 'categories, title, content';
$config->activity->require->page     = 'title, content';
$config->activity->require->link     = 'categories, title, link';
$config->activity->require->pageLink = 'title, link';
$config->activity->require->edit     = 'categories, title, content';

$config->activity->editor = new stdclass();
$config->activity->editor->create = array('id' => 'content', 'tools' => 'full');
$config->activity->editor->edit   = array('id' => 'content', 'tools' => 'full');

/* Set the recPerPage of activity. */
$config->activity->recPerPage = 5;
