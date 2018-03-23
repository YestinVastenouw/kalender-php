<?php

	function getAllData()
	{
		$db = openDataBaseConnection();

		$query = $db->prepare("SELECT * FROM `birthdays` ORDER BY month, day, year");
		$query->execute();

		$db = null;
		return $query->fetchAll();
	}

	function getDataById($id)
	{
		$db = openDataBaseConnection();
		$query = $db->prepare(
			"SELECT * FROM `birthdays` WHERE `id` = :id"
		);

		$query->execute(array(
			"id" => $id
		));

		$db = null;
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if (strlen($result['day']) == 1)
			$result['day'] = "0". $result['day'];
		if (strlen($result['month']) == 1)
			$result['month'] = "0". $result['month'];
		return $result;
	}

	function deleteById($id)
	{
		$db = openDataBaseConnection();
		$query = $db->prepare(
			"DELETE FROM `birthdays` WHERE `id` = :id"
		);

		if (!$query->execute(array("id" => $id)))
			return false;
		return true;
	}

	function updateById($id)
	{
		// Preconditions first.
		$person = isset($_POST['person']) ? strip_tags($_POST['person']) : null;
		$tmp_date = isset($_POST['date']) ? strip_tags($_POST['date']) : null;
		$date = explode("-", $tmp_date);

		$db = openDataBaseConnection();
		$query = $db->prepare(
			"UPDATE `birthdays` 
			 SET `person` = :person, `day` = :day, `month` = :month, `year` = :year
			 WHERE `id` = :id"
		);

		if(!$query->execute(array(
			"id" => $id,
			"person" => $person,
			"day" => $date[2],
			"month" => $date[1],
			"year" => $date[0]
		))) return false;
		return true;
	}

	function createData()
	{
		// Preconditions first.
		$person = isset($_POST['person']) ? strip_tags($_POST['person']) : null;
		$tmp_date = isset($_POST['date']) ? strip_tags($_POST['date']) : null;
		$date = explode("-", $tmp_date);

		if ($person == null || $date == null)
			return false;

		// Preconditions first.
		$db = openDataBaseConnection();
		// Checking if the data we want to put in the database isn't already in the database, we don't want double values.
		$query = $db->prepare(
			"SELECT `id` FROM `birthdays` 
			 WHERE `person` = :person AND `day` = :day AND `month` = :month AND`year` = :year"
		);

		$query->execute(array(
			"person" => $person,
			"day" => $date[2],
			"month" => $date[1],
			"year" => $date[0]
		));

		if (count($query->fetchAll()) > 0)
		{
			// This means there is already a person in the database with the exact same name and date so we don't want to add them to the database.
			$db = null;
			return false;
		} 
		else
		{
			//Add the data to the data base.
			$query = $db->prepare(
				"INSERT INTO `birthdays` (person, day, month, year) VALUES (:person, :day, :month, :year)"
			);

			$db = null;
			if(!$query->execute(array(
				"person" => $person,
				"day" => $date[2],
				"month" => $date[1],
				"year" => $date[0]
			))) return false;
		}
		return true;
	}

