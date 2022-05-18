<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src="/assets/js/moment.min.js"></script>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/fullcalendar.min.js"></script>
<link href='/assets/css/fullcalendar.min.css' rel='stylesheet' />
<link href='/assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script>

  var date = new Date();
  var dia = date.getDate();
  var mes = date.getMonth() + 1;
  var ano = date.getFullYear();
  var hoje = ano+"-"+mes+"-"+dia

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      defaultDate: hoje,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: hoje
        },
        {
          title: 'Long Event',
          start: '2022-05-12',
          end: '2022-05-13'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2022-05-16T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2022-05-19T16:00:00'
        },
        {
          title: 'Conference',
          start: '2022-05-01',
          end: '2022-05-01'
        },
        {
          title: 'Meeting',
          start: '2022-05-01T10:30:00',
          end: '2022-05-01T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2022-05-01T12:00:00'
        },
        {
          title: 'Meeting',
          start: hoje
        },
        {
          title: 'Happy Hour',
          start: '2021-11-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2021-11-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2021-11-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: hoje
        }
      ]
    });

  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
</head>
<body>

  <div id='calendar'></div>

</body>
</html>
