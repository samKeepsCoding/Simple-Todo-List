<?php
    $errors = "";

    // Connect to database
    $database = mysqli_connect("localhost", "root", "", "php_todo");

    // insert a quote if submit button is clicked
    if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $errors = "Please Enter A Task !";
        } else {
            $task = $_POST['task'];
            $sql = "INSERT INTO tasks (task) VALUES ('$task')";
            mysqli_query($database, $sql);
            header('location: index.php');
        }
    }

    // Gets all Tasks
    $query = 'SELECT * FROM `Tasks`';
    $tasks = mysqli_query($database, $query);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Todo App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="heading">
        <h2 style="font-style: 'Hervetica';">ToDo List Application</h2>
    </div>
    <form method='post' action='index.php' class='input_form'>
        <?php  if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>

        <input type="text" name='task' class="task_input">
        <button type="submit" name="submit" id="add_btn" class="add_btn">
            Add Task
        </button>
    </form>

    <table>
        <thead>
            <tr>
                <th>N</th>
                <th>Tasks</th>
                <th style="width: 60px;">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            // select all tasks if page is visited or refreshed
            $tasks = mysqli_query($database, "SELECT * FROM tasks");

            $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                   <tr>
                    <td> <?php echo $i; ?> </td>
                    <td class="task"> <?php echo $row['task']; ?> </td>
                    <td class="delete"> 
                        <a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
                    </td>
                </tr>
            <?php $i++; } ?>	
        </tbody>
    </table>
</body>
</html>