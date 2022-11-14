<?php
    $hostName = "localhost";
    $userName = "root";
    $password = "root";
    $dbName = "todo-app";
    $conn = new mysqli($hostName, $userName, $password, $dbName);
    $errors = "";

    if(isset($_POST['submit'])) {
        $task = $_POST['task'];
        if(empty($task)) {
            $errors = "You must fill in the task";
        } else {
            mysqli_query($conn, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location : index.php');
        }
    }
    if(isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
        header('location : index.php');
    }
    $tasks = mysqli_query($conn, "SELECT * FROM tasks");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Todo-App</title>
    </head>
    <body>
        <div class="heading">
            <h2>Todo list application with PHP and MySQL</h2>
        </div>
        <form method="POST" action="index.php">
            <?php
                if(isset($errors)) {
            ?>
                <p><?php echo $errors ?></p>
            <?php } ?>
            <input type="text" name="task" class="task_input">
            <button type="submit" class="task_btn" name="submit">Add task</button>
        </form>


        <table>
            <thead>
                <tr>
                    <th>N</th>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_array($tasks)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td class="task"><?php echo $row['task']; ?></td>
                    <td class="delete">
                        <a href="index.php?del_task=<?php echo $row['id']; ?>">X</a>
                    </td>
                    <td>
                        <?php echo $row['date_time']; ?>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
    </body>
</html>