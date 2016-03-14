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

  $.getJSON('user_json/'+session_user+'.json')
      .done(function (data) {
      if (!data)
        events = [];  
      else
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
      url: 'save.php',
      dataType:'json',
      data:{e:events_json},
      success: function(data){
        alert(data['msg']);
      }

    }).done(function(data){
        //alert(data['msg']); 
    });

    
  });

  $('#calendar').fullCalendar({
    events:'myfeed.php',editable:true,

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
             
             $.ajax({
                type: 'POST',
                url: 'delete.php',
                dataType:'json',
                data:{e:calEvent.id},
                success: function(data){
                  alert(data['msg']);
              }

              }).done(function(data){
                  //alert(data['msg']); 
              });



          }
      }); 
    },

    dayClick: function(date, jsEvent, view) {
        //Tricky Work -- BackUP var e = {title:'', start:moment(date).add(0, 'day').format(), id:String(Date.now())};
        var e = {title:'', 
          start:moment(date).add(0, 'day').format(), 
          id:String(new Date().getDate()+'_'+new Date().getDay()+'_'+new Date().getFullYear()+'_'+new Date().toLocaleTimeString())+'_'+session_user, 
          description: '',
          dateTimeOfCreation : String(new Date().getDate()+'_'+new Date().getDay()+'_'+new Date().getFullYear()+'_'+new Date().toLocaleTimeString()),
          dateTimeOfReminder : '',
          reminder_status : ''
        };
   
        bootbox.dialog({
                title: "Task Details",
                message: 
                      '<div class="row">  ' +
                        '<div class="col-md-12"> ' +
                          '<form class="form-horizontal"> ' +
                          
                          '<div class="form-group"> ' +
                            '<label class="col-md-4 control-label" for="title_of_task">Task Title</label> ' +
                              '<div class="col-md-4"> ' +
                                '<input type="text" value="" name ="title_of_task" id="title_of_task" autofocus/><br>' +                                 
                              '</div> ' +
                          '</div> ' +

                          '<div class="form-group"> ' +
                            '<label class="col-md-4 control-label" for="remind_time">Time for Reminder</label> ' +
                              
                              // '<div class="col-md-2"> ' +
                              //   '<input type="text" value="" id="datetimepicker"/><br><br>' +
                              // '</div> ' +

                              '<div class="col-md-2"> ' +
                                '<input type="text" value="" id="remind_time" id="remind_time" placeholder="2:15PM"/><br><br>' +                                                                  
                              '</div> ' +
                          '</div> ' +

                          '<div class="form-group"> ' +
                            '<label class="col-md-4 control-label" for="description_of_task">Task Description</label> ' +
                              '<div class="col-md-2"> ' +
                                '<textarea id="description_of_task" name="description_of_task" rows="4" cols="30">'+
                                  'BLA LBA LAB '+
                                '</textarea>'+
                              '</div> ' +
                          '</div> ' +


                        '<div class="form-group"> ' +
                          '<label class="col-md-4 control-label" for="enable_reminder">Enable Reminder for this task</label>' +
                          '<div class="col-md-4">' +
                            '<div class="checkbox">'+ 
                               '<input type="checkbox" name="enable_reminder" id="enable_reminder" value="1" checked="checked">' +
                            '</div>'+
                          '</div> ' +
                        '</div>' +

                    
                    '</form> </div>  </div>',

                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function () {

                            var title_of_task = $("#title_of_task").val();
                            var remind_time = $("#remind_time").val();
                            var description_of_task = $("#description_of_task").val();
                            var enable_reminder_status = $("input[name='enable_reminder']:checked").val()?1:0;
                            
                            //For testing only.  
                            console.log(title_of_task);
                            console.log(remind_time);
                            console.log(description_of_task);
                            console.log(enable_reminder_status);

                            e.title = title_of_task;
                            e.description = description_of_task;
                            e.reminder_status = enable_reminder_status;
                            e.dateTimeOfReminder=moment(date).add(0, 'day').format('DD_MM_YYYY')+'_'+remind_time;

                            console.log(e);
                            
                            if (e.title){
                              events.push(e);
                              $('#calendar').fullCalendar('renderEvent', e);
                              $('#calendar').fullCalendar('updateEvent', events);

                            }
                            e={};
                        
                        }
                    }
                }
            }
        );

        //$( "#datetimepicker" ).datepicker();
         


        // bootbox.prompt("Enter Task : ",function(result) {
        // if(result){
        //     e.title = result;
        //     if (e.title){
        //       //e.id += e.title;
        //       //e.start = moment(date).add(0, 'day').format();
              
        //       events.push(e);
        //       $('#calendar').fullCalendar('renderEvent', e);
        //       $('#calendar').fullCalendar('updateEvent', events);
        
        //     }
        //     e={};
        //   }
        // });

       
    },

    header: {
      left: 'prevYear,prev,today,next,nextYear',
      center: 'title',
      right: 0 
    },
    editable: false

  });

});