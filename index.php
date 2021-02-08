<?php

require __DIR__ . "/vendor/autoload.php";
use App\model\Database;
use App\model\TaskRepository;


define("DATABASE_FILE", "./data.db");
$tasks = [];

if (!file_exists(DATABASE_FILE)) {
    Database::initialize(__DIR__."/data.db");
    $taskRepository = new TaskRepository();
    $taskRepository->initialize();
}
$database = Database::getInstance();
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>My Todo List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.min.css"/>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "uncheck":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $database->exec(<<<SQL
UPDATE $table set checked=0 WHERE id=$id;
SQL
                );
            }
            header("Location: /");
            break;
        case "check":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $database->exec(<<<SQL
UPDATE $table set checked=1 WHERE id=$id;
SQL
                );
            }
            header("Location: /");
            break;
        case "delete":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $database->exec(<<<SQL
DELETE FROM $table WHERE id=$id;
SQL
                );
            }
            header("Location: /");
            break;
        case "add":
            if (isset($_GET["name"])) {
                $name = $_GET["name"];
                $name = addslashes($name);
                $database->exec(<<<SQL
                INSERT INTO $table (name) values('$name')
SQL
                );
            }
            header("Location: /");
            break;
        default:
            echo "An error has occured";
            die();
    }
}


$query = $database->query(<<<SQL
    SELECT * FROM $table ORDER BY checked DESC;
SQL
);
if (!$query)
    die("Impossible to execute query.");

while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
    $tasks[] = $row;
}

include('template.php');
?>