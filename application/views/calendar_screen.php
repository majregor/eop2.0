<?php
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/14/15
 * Time: 3:38 PM
 */
echo $this->session->flashdata('error');
$controlStatus="";
if($this->session->userdata['role']['read_only']=='y'){
    $controlStatus = "disabled";
}
?>


<div id='calendar'></div>

<div id="dialog-form" title="New Event">
    <!--  <p class="validateTips">All form fields are required.</p> -->
    <form id="new-calendar-event-form">
        <fieldset class="calendar-fieldset">
            <ul>
                <li>
                    <label><span>Date:</span><span id="selectedDate"></span></label>
                </li>
                <li>
                    <label for="title">Name / Title</label>
                    <input type="text" name="title" id="title" value="" class="text ui-widget-content ui-corner-all">
                </li>


                <div id="lists-container">

                </div>

                <li>
                    <label for="location">Location:</label>
                    <textarea rows="3" cols="25" name="location" id="location" class="text ui-widget-content ui-corner-all"></textarea>
                </li>

                <li>
                    <label for="body">Body:</label>
                    <textarea rows="3" cols="25" name="body" id="body" class="text ui-widget-content ui-corner-all"></textarea>
                </li>

                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </ul>
        </fieldset>
    </form>
</div>



<div id="dialog-edit-form" title="Edit Event">
    <!--  <p class="validateTips">All form fields are required.</p> -->
    <form id="new-calendar-event-form">
        <fieldset class="calendar-fieldset">
            <ul>

                <li>
                    <label for="title">Name / Title</label>
                    <input type="text" <?php echo($controlStatus); ?> name="title" id="title-ed" value="" class="text ui-widget-content ui-corner-all">
                </li>

                <div id="edit-lists-container">

                </div>

                <li>
                    <label for="location">Location:</label>
                    <textarea rows="3" cols="25" <?php echo($controlStatus); ?> name="location" id="location-ed" class="text ui-widget-content ui-corner-all"></textarea>
                </li>

                <li>
                    <label for="body">Body:</label>
                    <textarea rows="3" cols="25" <?php echo($controlStatus); ?> name="body" id="body-ed" class="text ui-widget-content ui-corner-all"></textarea>
                </li>

                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </ul>
        </fieldset>
    </form>
</div>


<script>

    $(document).ready(function() {
        var global_defaultDate = '<?php echo currentDate('Y-m-d');?>';
        var global_start, global_end;
        var dialog, editDialog, form,

            emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
            title = $( "#title" );

        var selectedEventId,
            selectedEventTitle,
            selectedEventStart,
            selectedEventEnd,
            selectedEventLocation,
            selectedEventBody;
        //tips = $( ".validateTips" );

        function checkLength( o, n, min, max ) {
            if ( o.val().length > max || o.val().length < min ) {
                o.addClass( "ui-state-error" );
                updateTips( "Length of " + n + " must be between " +
                min + " and " + max + "." );
                return false;
            } else {
                return true;
            }
        }
        function checkRegexp( o, regexp, n ) {
            if ( !( regexp.test( o.val() ) ) ) {
                o.addClass( "ui-state-error" );
                updateTips( n );
                return false;
            } else {
                return true;
            }
        }


        dialog = $( "#dialog-form" ).dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                "Save": addEvent,
                Cancel: function() {
                    $( this ).dialog( "close" );
                }

            },
            show: {
                //effect: "blind",
                //duration: 1000
            },
            hide: {
                //effect: "explode",
                //duration: 1000
            }
        });


        editDialog = $( "#dialog-edit-form" ).dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                "Save": editEvent,
                "Delete": deleteEvent,
                <?php endif; ?>
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        function deleteEvent(){

            if(confirm("Are you sure you want to delete this even permanently?")){

                var dataString = "action=delete&id=" + selectedEventId;

                $.ajax({
                    url: '<?php echo(base_url("calendar/delete")) ?>',
                    data: {
                        ajax:   1,
                        id:     selectedEventId
                    },
                    type:'POST',
                    async: false, // Prevents page from navigating to other page before ajax call completes
                    success:function(response){
                        selectedEventId = null;
                        selectedEventTitle = null;
                        selectedEventStart = null;
                        selectedEventEnd = null
                        selectedEventLocation = null;
                        selectedEventBody = null;

                        $("#title-ed").val("");
                        $("#start-ed").val("");
                        $("#end-ed").val("");
                        $("#location-ed").val("");
                        $("#body-ed").val("");

                        editDialog.dialog( "close" );
                    },
                    error:function(error){
                        alert(error);
                    }
                });

                $("#calendar").fullCalendar( 'refetchEvents' );
            }
        }
        function editEvent(){
            var valid=true;

            var editId = selectedEventId;
            var editTitle = $("#title-ed");
            var editStart = $("#start-ed");
            var editEnd = $("#end-ed");
            var editBody = $("#body-ed");
            var editLocation = $("#location-ed");


            valid = valid && checkLength( editTitle, "Event Title", 0, 255 );
            //valid = valid && checkRegexp( editTitle, /^[0-9a-z]([0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );

            if(valid){

                $.ajax({
                    url: '<?php echo(base_url("calendar/update")) ?>',
                    data: {
                        ajax:       1,
                        id:         editId,
                        start:      editStart.val(),
                        end:        editEnd.val(),
                        title:      editTitle.val(),
                        body:       editBody.val(),
                        location:   editLocation.val()

                    },
                    type:'POST',
                    async: false, // Prevents page from navigating to other page before ajax call completes
                    success:function(response){

                        selectedEventId = null;
                        selectedEventTitle = null;
                        selectedEventStart = null;
                        selectedEventEnd = null
                        selectedEventLocation = null;
                        selectedEventBody = null;

                        $("#title-ed").val("");
                        $("#start-ed").val("");
                        $("#end-ed").val("");
                        $("#location-ed").val("");
                        $("#body-ed").val("");

                        editDialog.dialog( "close" );
                    },
                    error:function(error){
                        alert(error);
                    }
                });

            }
            $("#title-ed").val("");
            $("#start-ed").val("");
            $("#end-ed").val("");
            $("#location-ed").val("");
            $("#body-ed").val("");
            editDialog.dialog("close");

            $("#calendar").fullCalendar( 'refetchEvents' );
        }

        function addEvent() {
            var valid = true;

            var titleVal = $("#title").val();
            var startTime = $( "#startTime" );
            var endTime = $( "#endTime" );
            var body = $("#body");
            var location = $("#location");

            valid = valid && checkLength( $("#title"), "Event Title", 0, 255 );

            //valid = valid && checkRegexp( $("#title"), /^[ _0-9a-z]([ 0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
            //valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
            //valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
            if ( valid ) {
                var eventData;

                $.ajax({
                    url: '<?php echo(base_url("calendar/add")) ?>',
                    data: {
                        ajax: 1,
                        start: startTime.val(),
                        end: endTime.val(),
                        title: titleVal,
                        body: body.val(),
                        location: location.val()
                    },
                    type:'POST',
                    async: false, // Prevents page from navigating to other page before ajax call completes
                    success:function(response){
                        //$calendar.weekCalendar("removeUnsavedEvents");
                        //$calendar.weekCalendar("updateEvent", calEvent);
                        //alert(response);
                        $("#title").val("");
                        startTime.val("");
                        endTime.val("");
                        location.val("");
                        body.val("");

                        dialog.dialog( "close" );
                    },
                    error:function(error){
                        alert(error);
                    }
                });


                $("#title").val("");
                startTime.val("");
                endTime.val("");
                location.val("");
                body.val("");
                dialog.dialog( "close" );

                $("#calendar").fullCalendar( 'refetchEvents' );

            }
            return valid;
        }

        function pad(num, size) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        }

        function populateStartEndLists(selectedDate){

            //var dataString="action=make_time_lists&selectedDate="+ $('#selectedDate').html();
            //alert($('#selectedDate').html());
            $.ajax({
                url: '<?php echo(base_url("calendar/makeTime")) ?>',
                data: {
                    ajax: 1,
                    selectedDate: $('#selectedDate').html()
                },
                type:'POST',
                success:function(response){
                    //alert(response);
                    $("#lists-container").html(response);
                },
                error:function(error){
                    alert(error);
                }
            });

        }

        function populateEditStartEndLists(eventStart, id){


            $.ajax({
                url: '<?php echo(base_url("calendar/listTime")) ?>',
                data: {
                    ajax    : 1,
                    event_id: id
                },
                type:'POST',
                success:function(response){
                    //alert(response);
                    $("#edit-lists-container").html(response);
                },
                error:function(error){
                    alert(error);
                }
            });
        }

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: global_defaultDate,
            timezone: "America/New_York",
            timeFormat: "h(:mm)A",
            selectable: true,
            selectHelper: true,
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
            select: function(start, end) {
                //var title = prompt('Event Title:');
                global_start = start;
                global_end = end;

                $("#selectedDate").html(start.toISOString());


                populateStartEndLists();
                dialog.dialog( "open" );
                $('#calendar').fullCalendar('unselect');
            },
            <?php endif; ?>
            editable: true,
            eventLimit: true, // allow "more" link when too many events

            events: {
                url: '<?php echo(base_url("calendar/read")) ?>',
                type: 'POST',
                async: false, // Prevents page from navigating to other page before ajax call completes
                data: {
                    ajax : 1
                },
                error: function() {
                    $('#script-warning').show();
                }
            },
            loading: function(bool) {
                $('#loading').toggle(bool);
            },

            dayClick: function(date, jsEvent, view) {


                //$( "#dialog" ).dialog( "open" );

                //alert('Clicked on: ' + date.format());

                //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                //alert('Current view: ' + view.name);

                // change the day's background color just for fun
                // $(this).css('background-color', 'red');

            },


            eventClick: function(calEvent, jsEvent, view) {

                //alert('Event: ' + JSON.stringify(calEvent));
                selectedEventId = calEvent.id;
                selectedEventTitle = calEvent.official;
                selectedEventStart = calEvent.start
                selectedEventEnd = calEvent.end;
                selectedEventLocation = calEvent.location;
                selectedEventBody = calEvent.body;

                var startDate  = new Date(selectedEventStart);
                var endDate = new Date(selectedEventEnd);


                $("#title-ed").val(selectedEventTitle);

                populateEditStartEndLists(selectedEventStart, selectedEventId);
                //$("#start-ed").append("<option selected='selected' value='" + selectedEventStart + "'>" + startDate.getHours() + ":" + startDate.getMinutes() +  "</option>");
                //$("#end-ed").append("<option selected='selected' value='" + selectedEventEnd + "'>" + endDate.getHours() + ":" + endDate.getMinutes() + "</option>");
                //$("#start-ed").val(selectedEventStart);
                //$("#end-ed").val(selectedEventEnd);

                $("#location-ed").val(selectedEventLocation);
                $("#body-ed").val(selectedEventBody);
                //alert(selectedEventBody);
                editDialog.dialog( "open" );
                //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                //alert('View: ' + view.name);

                // change the border color just for fun
                //$(this).css('border-color', 'red');


            }

        });

        form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            addEvent();
        });

        formS = editDialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            editEvent();
        });

    });


</script>
<?php
// Date Utilities
//----------------------------------------------------------------------------------------------


// Parses a string into a DateTime object, optionally forced into the given timezone.
function parseDateTime($string, $timezone=null) {
    $date = new DateTime(
        $string,
        $timezone ? $timezone : new DateTimeZone('UTC')
    // Used only when the string is ambiguous.
    // Ignored if string has a timezone offset in it.
    );
    if ($timezone) {
        // If our timezone was ignored above, force it.
        $date->setTimezone($timezone);
    }
    return $date;
}


// Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
// but in UTC.
function stripTime($datetime) {
    return new DateTime($datetime->format('Y-m-d'));
}
/**
 * Returns current date in either ISO8601 or Y-m-d formats
 * Default is ISO8601
 * @param unknown $format
 * @return string
 */
function currentDate($format='c'){
    if($format!='c'){
        if($format != 'Y-m-d'){
            return date($format);
        }
        else{
            return date('Y-m-d');
        }
    }
    else{
        return date('c');
    }
}

?>