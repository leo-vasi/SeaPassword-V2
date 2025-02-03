<?php
require_once __DIR__ . '/../controller/StorageController.php';

if (isset($_GET['id'])) {
    $storageId = (int) $_GET['id'];
    $storageController = new StorageController();

    if ($storageController->deleteStorage($storageId)) {
        header("Location: test.php?message=Storage deleted successfully.");
        exit();
    } else {
        header("Location: test.php?message=Error deleting storage.");
        exit();
    }
} else {
    header("Location: test.php?message=Invalid request.");
    exit();
}
?>
