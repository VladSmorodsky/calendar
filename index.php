<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
    <link rel="stylesheet" href="css/style.css">
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
include_once("objects/calendar.php");

$year = 0;

//include_once("objects/calendar_rus.php")
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

<!-- MODAL FORM (will be created) -->
<div class="" id="modal-div">
  <div class="" id="modal-background">
  </div>
  <div class="div-create-event">
    <div class="form-wrapper">
      <div class="form-header">
        <h2 id="event-creation">Event creation</h2>
      </div>
      <div class="form-body">
        <div class="input-el">
          <form class="" id="create-event-form" action="" method="post">
            <input type="date" name="date" value="">
            <input type="text" name="event" value="" placeholder="Enter your event name">
            <textarea name="name" rows="" cols="" placeholder="Enter event`s description"></textarea>
          </form>
        </div>
      </div>
      <div class="form-footer">
        <!--input type="submit" name="" value="Add" -->
        <button id="event-creation-submit" type="submit" name="button">Create event</button>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>
