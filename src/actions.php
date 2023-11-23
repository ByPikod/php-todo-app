<?php

session_start();
header("Content-Type: application/json");

if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = [];
}

// Add task

if (!isset($_GET["action"])) {
    http_response_code(400);
    header("Location: index.php");
    die("bad request");
}

function isAction(string $action): bool
{
    return isset($_GET["action"]) && $_GET["action"] === $action;
}

function getPostOrRedirect(string $post): string
{
    if (!isset($_POST[$post])) {
        http_response_code(400);
        die("bad request");
    }

    return $_POST[$post];
}

function getGetOrRedirect(string $get): string
{
    if (!isset($_GET[$get])) {
        http_response_code(400);
        die("bad request");
    }

    return $_GET[$get];
}

if (isAction("clear")) {
    $_SESSION["tasks"] = [];
    header("Location: index.php");
    die();
}

if (isAction("add")) {
    $task = getPostOrRedirect("task");
    if (empty($task)) {
        http_response_code(400);
        header("Location: index.php");
        die("bad request");
    }
    $_SESSION["tasks"][] = [
        "task" => $task,
        "checked" => false,
    ];
    header("Location: index.php");
    die();
}

if (isAction("check")) {
    $tasks = $_SESSION["tasks"];
    $id = getPostOrRedirect("id");
    $id = intval($id);
    $_SESSION["tasks"][$id]["checked"] = !$_SESSION["tasks"][$id]["checked"];
    die("OK");
}

if (isAction("remove")) {
    $id = getGetOrRedirect("id");
    $id = intval($id);
    unset($_SESSION["tasks"][$id]);
    header("Location: index.php");
    die();
}
