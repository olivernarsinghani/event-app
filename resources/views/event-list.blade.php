<!DOCTYPE html>
<html lang="en">
<head>
  <title>Events</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Event List</h2>
  <p><a class="btn btn-primary text-right" href="{{  route('add-event') }}">Add Event</a></p>            
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Dates</th>
        <th>Occurrence</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @php
        @endphp
      @if(!empty(count($getEventData) > 0))
        @foreach($getEventData as $eventData)
                <tr>
                    <td>{{ $eventData->event_name }}</td>
                    <td>{{ $eventData->event_start_date }} To {{ $eventData->event_end_date }}</td>
                    <td>{{ eventRepeatData($eventData->recurrence,$eventData->recurrence_reference) }}</td>
                    <td colspan="3">
                        <a class="btn btn-primary vieweventdetails" data-EventURL="{{ route('view-event',$eventData->id) }}" >View</a>
                        <a class="btn btn-primary" href="{{ route('edit-event',$eventData->id) }}">Edit</a>
                        <a class="btn btn-primary" href="{{ route('delete-event',$eventData->id) }}">Delete</a>
                    </td>
                </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6">No Recods Found</td>
        </tr>
    @endif
    </tbody>
  </table>
</div>

<div class="modal" id="event_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Event details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="view_event_details">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
    $('.vieweventdetails').on('click',function(){
        var EventURL = $(this).attr('data-EventURL');
        $.ajax({
            'url':EventURL,
             success:function(data){
                $('#view_event_details').html(data.event_data);
                $('#event_modal').modal('show');
             }
        });
    });
</script>
</body>
</html>
