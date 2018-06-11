<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="post" action="index.php">
    <select name="year" id="">
        <option></option>
        <?php
        for ($i = 1970; $i <2040; $i++ ){
            echo '<option name="'  . $i  . '">'.  $i  .'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Select year">
</form>

<?php
include_once("objects/Calendar.php");
$year = 0;

if (empty($_POST['year'])){
    $year = 2018;
}
else {
    $year = $_POST['year'];
}

echo '<h1 class="selected_year">' .   $year   .  '</h1>';
echo '<div class="year">';
for ($i = 1; $i <=12; $i++){
    $calendar = new Calendar($year, $i);
    $calendar->show();
}

echo '</div>';
?>

</body>
</html>