<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
</head>
<body>
    <h2>To-Do List</h2>

    <!-- Add Task Form -->
    <form method="POST">
        <input type="text" name="task" placeholder="Enter task" required>
        <button type="submit" name="add">Add Task</button>
    </form>

    <?php
    $file = "tasks.txt";

    // Handle Task Addition
    if (isset($_POST['add'])) {
        $task = trim($_POST['task']);
        if (!empty($task)) {
            file_put_contents($file, $task . PHP_EOL, FILE_APPEND);
        }
    }

    // Handle Task Deletion
    if (isset($_GET['delete'])) {
        $tasks = file($file, FILE_IGNORE_NEW_LINES);
        unset($tasks[$_GET['delete']]);
        file_put_contents($file, implode(PHP_EOL, $tasks) . PHP_EOL);
    }

    // Display Tasks
    if (file_exists($file)) {
        $tasks = file($file, FILE_IGNORE_NEW_LINES);
        if (count($tasks) > 0) {
            echo "<ul>";
            foreach ($tasks as $index => $task) {
                echo "<li>$task <a href='?delete=$index'>❌</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No tasks yet.</p>";
        }
    }
    ?>
</body>
</html>
