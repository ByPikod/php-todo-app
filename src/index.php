<?php
session_start();
if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = [];
}
$tasks = $_SESSION["tasks"];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO APP</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body data-bs-theme="dark">
    <div class="container text-center">
        <h1 class="my-5">TODO APP</h1>
        <div class="form">
            <form action="actions.php?action=add" method="POST">
                <input autofocus type="text" name="task" placeholder="Enter your task" class="form-control">
                <button type="submit" name="submit" class="btn btn-primary mt-3 w-100">Add Task</button>
            </form>
        </div>
        <a href="actions.php?action=clear">Clear</a>
        <div class="list text-start">
            <ul id="sortable" class="p-0 m-0 list-group mt-3">
                <?php foreach ($tasks as $key => $task) : ?>
                    <label for="task-<?=$key?>">
                        <li 
                            class="todo-item fs-4 list-unstyled list-group-item mb-2"
                            ondrag="drag(event)"
                            draggable="true"
                        >
                            <input
                                style="width: 15px;height: 15px;"
                                type="checkbox" 
                                id="task-<?=$key?>"
                                <?=$task["checked"] ? "checked='on'" : ""?>
                                onchange="checkTask(<?=$key?>)">
                            <?= $task["task"] ?>
                            <a href="actions.php?action=remove&id=<?=$key?>">
                                <button class="btn btn-danger float-end">Delete</button>
                            </a>
                        </li>
                    </label>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>