/* 
 * 
 * Author : Aung Naing Oo 
 * 
 * */
$(function(){

  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  var events = [];

  $.getJSON('php/results.json')
      .done(function (data) {
      events = data;
    });

  $('.submit').click(function(evt){
    evt.preventDefault();
    events.forEach(function(arrayItem)
    {
      arrayItem.start = moment(arrayItem.start).add(0, 'day').format();
    });
    var events_json = JSON.stringify(events);
    //console.log(events);
    $.ajax({
      type: 'POST',
      url: 'php/save.php',
      dataType:'json',
      data:{e:events_json},
      success: function(data){
        alert(data['msg']);
      }

    }).done(function(data){
        //alert(data['msg']); 
    });

    //alert("Button clicked");
  });

  $('#calendar').fullCalendar({
    events:'php/myfeed.php',editable:true,

    //List of custom buttons that I want to add
    customButton: {

      prevYear: {
        text: 'custom!',
        click: function() {
          fullCalendar( 'prevYear' ) 
        }
      },

      nextYear: {
        text: 'custom!',
        click: function() {
          fullCalendar( 'nextYear' ) 
        }
      }
    },

    eventClick: function(calEvent, jsEvent, view) {
    /**
     * calEvent is the event object, so you can access it's properties
     */
      bootbox.confirm("Delete " + calEvent.title + " ?", function(result) {
          if (result){
            $('#calendar').fullCalendar('removeEvents', calEvent.id);
             events.splice(_.indexOf(events, _.findWhere(events, { id : calEvent.id })), 1);
             //alert(events);
          }
      }); 
    },

    dayClick: function(date, jsEvent, view) {
        //Tricky Work -- BackUP var e = {title:'', start:moment(date).add(0, 'day').format(), id:String(Date.now())};
        var e = {title:'', start:moment(date).add(0, 'day').format(), id:String(Date.now())};
        //alert('Clicked on: ' + date);
        //e.title = prompt('Enter Prayer');
        bootbox.prompt("Enter Task : ",function(result) {
        if(result){
            e.title = result;
            if (e.title){
              //e.id += e.title;
              //e.start = moment(date).add(0, 'day').format();
              events.push(e);
              $('#calendar').fullCalendar('renderEvent', e);
              $('#calendar').fullCalendar('updateEvent', events);
              //$(this).css('background-color', 'rgba(73,177,177,0.59)');
            }
            e={};
          }
        });
    },

    header: {
      left: 'prevYear,prev,today,next,nextYear',
      center: 'title',
      right: 0 
    },
    editable: false

  });

});
