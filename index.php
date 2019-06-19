<?php
include('config.php');
// tiek paņemti dati no 'post' pierasījuma un atjaunots ieraksts(ielikts 'ķeksis')
if (isset($_POST['id']) && isset($_POST['checkbox']))
{
	$toDo->update_checkbox();
}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
	<script src="script.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Darāmo lietu saraksts</title>
</head>
<body>
	<div class="container bg-light align-content-center" id="content">
		<h1 class="text-center">Darāmo lietu saraksts</h1>
		<?php
		$toDo->all();
		if ($not_done == 0) { echo "<h4 class='text-center'>Šobrīd nav neviena ieplānota darba</h4>"; }
		if ($stmt->num_rows > 0)
			{ 
				 while ($row = $stmt->fetch_object())
				{ 	
					// tiek attēloti tikai ieraksti ar checkbox vērtību 0(neizpildīti)
					if ($row->checkbox == 0)
					{ ?>
					<div class="card">
						<div class="card-body" id="not_done">
							<p class="float-right"><?php echo $row->created ?></p>
							<h4 class="card-title"><?php echo $row->title ?></h4>
							<p class="card-text"><?php echo $row->description ?></p>
							<h6>Izdarīts?</h6><input type="checkbox" class="check" id="<?php echo $row->id ?>" value="<?php if($row->checkbox == 0) { echo 0; } else { echo 1; } ?>" name="checkbox" <?php if($row->checkbox == 1) {echo "checked=checked";} ?>>
							<a href="form.php?id=<?php echo $row->id ?>" class="btn btn-secondary btn-sm float-right">Labot</a>
						</div>	
					</div>
				<?php } 
				}
			} ?>
		<a href="form.php" class="btn btn-secondary">Pievienot jaunu</a>
		<?php if ($done > 0) { echo "<h3 class='text-center'>Jau paveiktās lietas</h3>"; }
		$toDo->all();
		if ($stmt->num_rows > 0)
			{ 
				 while ($row = $stmt->fetch_object())
				{ 	
					// tiek attēloti izpildīto darbu dati
					if ($row->checkbox == 1){ ?>
					<div class="card">
						<div class="card-body" id="done">
							<p class="float-right"><?php echo $row->created ?></p>
							<h4 class="card-title"><?php echo $row->title ?></h4>
							<p class="card-text"><?php echo $row->description ?></p>
							<h6>Izdarīts?</h6><input type="checkbox" class="check" id="<?php echo $row->id ?>" value="<?php if($row->checkbox == 0) { echo 0; } else { echo 1; } ?>" name="checkbox" <?php if($row->checkbox == 1) {echo "checked=checked";} ?>>
							<a href="form.php?id=<?php echo $row->id ?>" class="btn btn-secondary btn-sm float-right">Labot</a>
						</div>	
					</div>
				<?php } 
				}
			} ?>
	</div>
</body>
</html>