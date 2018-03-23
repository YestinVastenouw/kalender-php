<?php

require ROOT. "model/KalenderModel.php";

function index()
{
	render("kalender/index", array(
		"allData" => getAllData()
	));
}

function create()
{
	render("kalender/create");
}

function createSave()
{
	if(createData())
		header("Location: ". URL. "kalender/index");
	else
	{
		require(ROOT . 'controller/ErrorController.php');
		call_user_func('error_create');
	}
}

function update($id = null)
{
	if ($id === null)
		render("kalender/index", array(
			"allData" => getAllData()
		));

	render("kalender/update", array(
		"data" => getDataById($id)
	));
}

function updateSave($id = null)
{
	if ($id === null)
		render("kalender/index", array(
			"allData" => getAllData()
		));

	if (updateById($id))
		header("Location: ". URL. "kalender/index");
	else
	{
		require(ROOT . 'controller/ErrorController.php');
		call_user_func('error_update');	
	}
}

function delete($id = null)
{
	if ($id === null)
		render("kalender/index", array(
			"allData" => getAllData()
		));

	if (deleteById($id)) 
		header("Location: ". URL. "kalender/index");
	else 
	{
		require(ROOT . 'controller/ErrorController.php');
		call_user_func('error_delete');
	}
}