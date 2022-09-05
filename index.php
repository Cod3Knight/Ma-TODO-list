
<?php
// EXO 1
$a = "jean";
$b = "dujardin";
echo $a . " <br> " . $b . "<br>";
echo $a. " " .$b . " <br> ";

// DECLARER UN TABLEAU - AFFICHER 0 ET 3
$num = array(10,50,80,28);
echo $num[0] . " " . $num[3] . " <br> ";

// EXERCICE 3
$tab = array(36, 'Garfield', 123.50, 'chat', 'roux');
echo $tab[1] . " " . 'est un ' . $tab[3] . " " . $tab[4] . " <br>";

// EXERCISE 4
$a = 50;
$b = 30;
echo  $a + $b . "<br>";

// EXERCISE 5
$a = 80;
$b = 17;
echo $a * $b . "<br>";

// EXERCISE 6
$a = "jean";
$b = "dujardin";
echo $b. " " .$a . " <br> ";

// EXERCISE 7
$a = mt_rand(1, 5);
// -------------------------------------TODO LIST-------------------------------
?>

<?php
 // initialise variables erreurs
 $errors = "";

 // connection bade de donnee
 $db = mysqli_connect("localhost", "root", "root", "todo");

 // insert un texte si le champ est vide
 if (isset($_POST['submit'])) {
     if (empty($_POST['tasks'])) {
         $errors = "Vous devez remplir la tâche";
     }else{
         $task = $_POST['tasks'];
         $sql = "INSERT INTO tasks (tasks) VALUES ('$task')";
         mysqli_query($db, $sql);
         header('location: index.php');
     }
 }	
 // Effacer tâche
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
	header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
		<input type="text" name="tasks" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Rajouter Tâches</button>
        <?php if (isset($errors)) { ?>
	        <p><?php echo $errors; ?></p>
        <?php } ?>

        <table>
	<thead>
		<tr>
			<th>N°</th>
			<th>Tâches</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// selectionne toutes les tâches si la page est visitée ou rafraichie
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="tasks"> <?php echo $row['tasks']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
        </table>
	</form>
</body>
</html>
