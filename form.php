<?php
	include "config.php";
    // atkarībā no tā, kādi dati būs pieejami, attiecīgā funcija tiks izsaukta
if (isset($_GET['id']))
{   
    $toDo->render_form();

    if (isset($_POST['submit']))
    {
        $toDo->update_todo();
    }

    if (isset($_POST['delete']))
    {
        $toDo->destroy();
    }
}
else
{   
    $toDo->render_form();

    if (isset($_POST['submit'])) 
    {
        $toDo->create();
    }
}
// ja netiek rediģēts ieraksts, tad formā 'value' lauki būs tukši
function renderForm($title = '', $description = '', $id = ''){ ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title><?php if ($id != '') { echo "Labot ierakstu"; } else { echo "Jauns ieraksts"; } ?></title>
</head>
<body>
    <div class="container bg-light align-content-center">
        <h1 class="text-center"><?php if ($id != '') { echo "Labot ierakstu"; } else { echo "Jauns ieraksts"; } ?></h1>
        <form method="post">
            <div class="form-group">
                <label for="title">Virsraksts:</label>
                <input type='text' class="form-control" id="title" name='title' value="<?php echo $title; ?>">
            </div>
            <div class="form-group">
                <label for="description">Apraksts:</label>
                <textarea rows="7" type='text' class='form-control' id="description" name='description'><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="created" value="<?php echo date("Y.m.d"); ?>">
                <br>
                <a href="index.php" class="btn btn-secondary">Atpakaļ</a>
                <button type="submit" name="submit" class="btn btn-secondary float-right">Saglabāt</button>
                <?php if ($id != '') { ?> <button type="submit" name="delete" class="btn btn-danger">Dzēst</button> <?php } ?>
        </form>
    </div>
<?php } ?>