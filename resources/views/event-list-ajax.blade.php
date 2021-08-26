        <label>Event Name : {{ $getEventData->event_name }}</label>
       
        <table class="table">
            <thead>
              <tr>
                  <th>Date</th>
                  <th>Day</th>
              </tr>
            </thead>
            <tbody>
                @if(!empty($eventDates))
                    @foreach ($eventDates as $eventDatesRow)
                    @php
                        $eventDatesRowData = explode(', ',$eventDatesRow);
                    @endphp
                    <tr>
                        <td>{{ $eventDatesRowData[1] }}</td>
                        <td>{{ $eventDatesRowData[0] }}</td>
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
