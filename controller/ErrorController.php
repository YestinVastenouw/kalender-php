<?php

function error_404()
{
	echo("404 - De gevraagde route is niet beschikbaar. Controleer je controller en action naam.");
}

function error_delete()
{
	echo("An error occured while trying to delete data from the database.");
}

function error_create()
{
	echo("The data you are trying to add to the database already occurs to exist inside the database.");
}

function error_update()
{
	echo("An error occured while updating your data to the database.");
}