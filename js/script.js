$(document).ready(function(){
  readAllCalendarEvents();
  $("table").mouseup(function(){
      return ($(this).prevAll().text());
  });

  $("td.day").click(function(){
      $("div#modal-div").toggleClass("event_creator");
      $("form#create-event-form").toggleClass("event_form").css("display","block");
      $("div#modal-background").toggleClass("inner");

      day = ($(this).text().length == 1) ? "0".concat($(this).text()) : $(this).text();
      m_y = $(this).parents("table").prevAll().text();

      date = new Date(day+" "+m_y);
      month_num = date.getMonth()+1;
      month = (month_num < 10) ? "0".concat(month_num) : month_num;

      var curr_date = date.getFullYear()+"-"+month+"-"+day;
      $("input[type=date]").val(curr_date);
  });
});


function readAllCalendarEvents(){
  $(document).load("event/read.php", function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success")
            resp = JSON.parse(responseTxt);
            for( var record_num = 0; record_num < resp.records.length; record_num++ ){
              var date = resp.records[record_num].date.split("-");
              var current_year = $("h1.selected_year").text();
              if (current_year == date[0]){
                var event_name = resp.records[record_num].event;
                var sellectedTable = $( "body" ).find( "table tbody" ).eq( date[1] - 1);
                var selectedDay = sellectedTable.children("tr").children("td:contains("+date[2]+")");
                selectedDay.attr("title", event_name).css({"background-color":"#00328d", "color":"white"});
              }
            }
    if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
  });
}
