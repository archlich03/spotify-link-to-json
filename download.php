<?php
    require 'functions.php';

    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["download_type"])) {
            $format = $_POST["download_type"];
            $data = readJSON($settings['dataFileName']);
    
            if ($format === 'CSV') {
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="data.csv"');
                $csvData = convertDataToCSV($data);
                echo $csvData;
                exit;
            } elseif ($format === 'JSON') {
                header('Content-Type: application/json');
                header('Content-Disposition: attachment; filename="data.json"');
                echo json_encode($data, JSON_PRETTY_PRINT);
                exit;
            } elseif ($format === 'TXT') {
                header('Content-Type: text/plain');
                header('Content-Disposition: attachment; filename="data.txt"');
                $textData = convertDataToText($data);
                echo $textData;
                exit;
            } else {
                die ("<h1>File format not supported.</h1>");
            }
        } else {
            $error = "File format not selected.";
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download data</title>
    <link rel="stylesheet" href="style.css?<?=date('U')?>">
    <meta name="description" content="Download page for existing data.">
    <meta name="keywords" content="spotify, converter, link">
    <meta name="author" content="We, The People">
    <meta name="date" content="2023-09-20">
    <meta name="expiry-date" content="2077-09-20">
    <meta name="robots" content="index, follow">
</head>
<body>
    <?php
        require 'template/header.html';
        require 'template/sidebar.html';
    ?>
    <div id='content'>
        <div id="output"></div>
        <h1>Download data</h1>
        <div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="radio" id="csv" name="download_type" value="CSV">
                <label for="csv">CSV file (.csv)</label><br>
                <input type="radio" id="json" name="download_type" value="JSON">
                <label for="json">JSON file (.json)</label><br>
                <input type="radio" id="txt" name="download_type" value="TXT">
                <label for="txt">Text file (.txt)</label><br><br>
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <input class="back" type="button" value="Back" onclick="location.href='index.php'">
                <input type="submit" name="submit" value="Download"><br><br>
                <span class="error"><?php echo $error;?></span>
            </form>
        </div>
    <?php
        require 'template/footer.php';
    ?>
    </div>
</body>

</html>
