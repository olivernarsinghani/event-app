<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add event</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<style>
  label.error {
    color: red;
}
</style>
</head>
<body>
  @if (count($errors) > 0)
  <div class = "alert alert-danger">
     <ul>
        @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
     </ul>
  </div>
@endif
<div class="container">
  <h2>Add Event</h2>
  <form method="post" action="{{ route('save-event') }}" name="eventform">
    @csrf
    <input type="hidden" value="{{ !empty($getEventData) ? $getEventData->id : '' }}" name="event_id">
    <div class="form-group">
      <label for="event_name">Event Name:</label>
      <input type="text" value="{{ !empty($getEventData) ? $getEventData->event_name : '' }}" class="form-control" id="event_name" placeholder="Enter name" name="event_name">
    </div>

    <div class="form-group">
        <label for="event_start_date">Event start Date:</label>
        <input type="text" value="{{ !empty($getEventData) ? $getEventData->event_start_date : '' }}" class="form-control" id="event_start_date" placeholder="Enter start date" name="event_start_date">
    </div>

    <div class="form-group">
    <label for="event_end_date">Event end Date:</label>
    <input type="text"  value="{{ !empty($getEventData) ? $getEventData->event_end_date : '' }}" class="form-control" id="event_end_date" placeholder="Enter end date" name="event_end_date">
    </div>

    <div class="form-group">
        <label for="event_end_date">Recurrence:</label>
        <div class="radio">
            @php 
                $dropdownData = eventRepeatData();
                $recurrence_reference = (!empty($getEventData) ? $getEventData->recurrence_reference : ''); 
                $recurrence = (!empty($getEventData) ? $getEventData->recurrence : '');
                $getRecurrenceArray = explode(' ',$recurrence);
            @endphp
            <label><input type="radio" name="repeat" id="repeat">Repeat</label>
            <select name="first">
                <option value="">Select Option</option>
                 @foreach ($dropdownData[0] as $key1=>$firstData)
                 <option value="{{ $key1 }}" @if($recurrence_reference==1 && $getRecurrenceArray[0]==$key1) selected @endif>{{ $firstData }}</option>
                 @endforeach
            </select>
            <select name="second">
                <option value="">Select Option</option>
                @foreach ($dropdownData[1] as $key2=>$secondData)
                 <option value="{{ $key2 }}" @if($recurrence_reference==1 && $getRecurrenceArray[1]==$key2) selected @endif>{{ $secondData }}</option>
                 @endforeach
            </select>
        </div>
          <div class="radio">
            <label><input type="radio" name="repeat" id="repeat_specific">Repeat on the</label>
            <select name="third">
                <option value="">Select Option</option>
                @foreach ($dropdownData[2] as $key3=>$thirdData)
                 <option value="{{ $key3 }}" @if($recurrence_reference==2 && $getRecurrenceArray[0]==$key3) selected @endif>{{ $thirdData }}</option>
                 @endforeach
            </select>
            <select name="fourth">
                <option value="">Select Option</option>
                @foreach ($dropdownData[3] as $key4=>$fourthData)
                 <option value="{{ $key4 }}" @if($recurrence_reference==2 && $getRecurrenceArray[1]==$key4) selected @endif>{{ $fourthData }}</option>
                 @endforeach
            </select>
            <select name="fifth">
                <option value="">Select Option</option>
                @foreach ($dropdownData[4] as $key5=>$fifthData)
                <option value="{{ $key5 }}" @if($recurrence_reference==2 && $getRecurrenceArray[2]==$key5) selected @endif>{{ $fifthData }}</option>
                @endforeach
            </select>
          </div>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<script>
    $(function () {
        $("#event_start_date").datepicker({ 
                autoclose: true, 
                todayHighlight: true
        }).datepicker('update', new Date());

        $("#event_end_date").datepicker({ 
                autoclose: true, 
                todayHighlight: true
        }).datepicker('update', new Date());
    }); 

    $(function() {
  $("form[name='eventform']").validate({
    rules: {
      event_name: "required",
      event_start_date: "required",
      event_end_date:"required",
      repeat:"required",
      
    },
    messages:
        {
          repeat:
          {
            required:"Please select a Recurrence<br/>"
          }
        },
        errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.container') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         },
    submitHandler: function(form) {
      form.submit();
    }
  });
});


</script>

</body>
</html>
