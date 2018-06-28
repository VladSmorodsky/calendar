$(document).ready(function(){
  readAllCalendarEvents();
  alert(Number("01"));
  $("table").mouseup(function(){
      return ($(this).prevAll().text());
  });

  $("td.day").click(function(){
      $("div#modal-div").toggleClass("event_creator");
      $("form#create-event-form").toggleClass("event_form").css("display","block");
      $("div#modal-background").toggleClass("inner");
      $("div.div-create-event").css("display","flex");

      day = ($(this).text().length == 1) ? "0".concat($(this).text()) : $(this).text();
      m_y = $(this).parents("table").prevAll().text();

      date = new Date(day+" "+m_y);
      month_num = date.getMonth()+1;
      month = (month_num < 10) ? "0".concat(month_num) : month_num;

      var curr_date = date.getFullYear()+"-"+month+"-"+day;
      $("input[type=date]").val(curr_date);
  });

  $("div#modal-background").click(function(){
    $("div#modal-div").toggleClass("event_creator");
    $("form#create-event-form").toggleClass("event_form").css("display","block");
    $("div#modal-background").toggleClass("inner");
    $("div.div-create-event").toggle();
    clearEventCreationInputs();
  });

  $("form#create-event-form").on('submit', function(e){
    e.preventDefault();

    $.ajax({
      type: 'post',
      url: 'event/create.php',
      data: $("form#create-event-form").serialize(),
      success: function(){
        alert("Event was created");
        readAllCalendarEvents();
        $("div#modal-div").toggleClass("event_creator");
        $("form#create-event-form").toggleClass("event_form").css("display","block");
        $("div#modal-background").toggleClass("inner");
        $("div.div-create-event").toggle();
        clearEventCreationInputs();
      }
    });
});
});


function clearEventCreationInputs(){
  $("form#create-event-form :input").val("");
  $("textarea").text("");
}

function readAllCalendarEvents(){
  $(document).load("event/read.php", function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success")
            resp = JSON.parse(responseTxt);
            for( var record_num = 0; record_num < resp.records.length; record_num++ ){
              var date = resp.records[record_num].date.split("-");
              var current_year = $("h1.selected_year").text();

              var year = date[0];
              var month = date[1];
              var day = Number(date[2]);

              if (current_year == year){
                var event_name = resp.records[record_num].event;
                var sellectedTable = $( "body" ).find( "table tbody" ).eq( month - 1);
                var selectedDay = sellectedTable.children("tr").children("td:contains("+day+")");

                if (selectedDay.length < 2) {
                  selectedDay.attr("title", event_name).css({"background-color":"#00328d", "color":"white"});
                }
                else {
                  for (var i = 0; i < selectedDay.length; i++) {
                    if (selectedDay.eq(i).text() == day) {
                      selectedDay.eq(i).attr("title", event_name).css({"background-color":"#00328d", "color":"white"});
                    }
                  }
                }
              }
            }
    if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
  });
}
