<form action="<?= URL ?>kalender/updateSave/<?= $data['id'] ?>" method="POST">
	<input type="text" name="person" value="<?= $data['person'] ?>">
	<input type="date" name="date" value="<?= $data['year'] ?>-<?= $data['month']?>-<?= $data['day'] ?>">
	<button type="submit">Update</button>
</form>