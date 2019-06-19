<?php
class todo
{
	private $db;
	// kad tiek izveidots objekts, tiek izveidots savienojums ar datubāzi
	function __construct($mysqli)
	{
		$this->db = $mysqli;
	}
	// visu ierakstu izvadīšana
	public function all()
	{
		global $stmt;
		global $done;
		global $not_done;
		$stmt = $this->db->query("SELECT * FROM things_to_do ORDER BY id");
		// tiek atrasts ierakstu skaits, kur checkbox vērtība ir viens un nulle
		$stmt_for_done = $this->db->query("SELECT * FROM things_to_do WHERE checkbox = 1");
		$stmt_for_not_done = $this->db->query("SELECT * FROM things_to_do WHERE checkbox = 0");
		$done = $stmt_for_done->num_rows;
		$not_done = $stmt_for_not_done->num_rows;
	}
	// jauna ieraksta izveidošana
	public function create()
	{	
		// virsraksts ir kā obligāts lauks
		if ($_POST['title'] == '')
		{
			echo "<b style='color: red'>Lūdzu ievadiet virsrakstu!<b>";
		}
		else
		{
			// tiek sagatavots vaicājums, piesaistīti parametri un veikta darbība
			if ($stmt = $this->db->prepare("INSERT INTO things_to_do (title, description, created) VALUES(?, ?, ?)"))
			{
				$stmt->bind_param("sss", $_POST['title'], $_POST['description'], $_POST['created']);
				$stmt->execute();
				$stmt->close();
			}
			else
			{
				printf('errno: %d, error: %s', $this->db->errno, $this->db->error);
			}
			header("Location: index.php");
		}
	}
	// ieraksta izdzēšana
	public function destroy()
	{	
		if ($stmt = $this->db->prepare("DELETE FROM things_to_do WHERE id = ? LIMIT 1"))
		{
			$stmt->bind_param("i", $_GET['id']);
			$stmt->execute();
			$stmt->close();
		}
		else
			// ja rodas kļūda vaicājuma palaišanas laikā, tiek izvadīts kļūdas paziņojums
		{
			printf('errno: %d, error: %s', $this->db->errno, $this->db->error);
		}
		
		header("Location: index.php");
	}
	// ieraksta labošana/atjaunošana
	public function update_todo()
	{	
		// šis tiek veikts, lai visi dati tiktu attēloti un daļa/viss nepazustu iespējamu " dēļ
		$title = htmlentities($_POST['title'], ENT_QUOTES);
		$description = htmlentities($_POST['description'], ENT_QUOTES);

		if ($_POST['title'] == '')
		{
			echo "<b style='color: red'>Lūdzu ievadiet virsrakstu!<b>";
		}
		else
		{
			if ($stmt = $this->db->prepare("UPDATE things_to_do SET title = ?, description = ?, created = ? WHERE id = ?"))
			{
				$stmt->bind_param("sssi", $title, $description, $_POST['created'], $_GET['id']);
				$stmt->execute();
				$stmt->close();
			}
			else
			{
				printf('errno: %d, error: %s', $this->db->errno, $this->db->error);
			}
			// pēc veiksmīgas darbības tiek pāredresēts uz sākuma lapu
			header("Location: index.php");
		}
	}
	// 'checkbox' atzīmēšana tiek saglabāta datu bāzē
	public function update_checkbox()
	{	
		if ($stmt = $this->db->prepare("UPDATE things_to_do SET checkbox = ? WHERE id = ?"))
		{
			$stmt->bind_param("ii", $_POST['checkbox'], $_POST['id']);
			$stmt->execute();
			$stmt->close();
		}
		else
		{	
			printf('errno: %d, error: %s', $this->db->errno, $this->db->error);
		}
	}
	// funkcija tiek izmantota, lai aizpildītu formas laukus, ja ieraksts tiek rediģēts
	public function render_form()
	{

		if($stmt = $this->db->prepare("SELECT * FROM things_to_do WHERE id=?"))
		{
			$stmt->bind_param("i", $_GET['id']);
			$stmt->execute();

			$stmt->bind_result($id, $title, $description, $created, $checkbox);
			$stmt->fetch();
			// šī funkcija aptver formu un aizpilda laukus ar attiecīgajām vērtībām
			renderForm($title, $description, $id);
			// tiek atbrīvota atmiņa no vaicājuma izpildes
			$stmt->close();
		}
	}
}
?>