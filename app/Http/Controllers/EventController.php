<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use DateTime;
use DatePeriod;
use DateInterval;


class EventController extends Controller
{
    // list event data
    public function eventList()
    {
        $getEventData = Event::all();
        return view('event-list',compact('getEventData'));
    }

    // add event 
    public function addEvent(Request $request)
    {
        if($request->method()=='POST'){
            $this->validate($request,[
                'event_name'=>'required',
                'event_start_date'=>'required',
                'event_end_date'=>'required',
                'repeat'=>'required'
             ]);
          $repeatData = '';
          if(!empty($request->event_id)){
              $eventData =  Event::find($request->event_id);
          }else{
              $eventData = new Event;
          }
           $eventData->event_name = $request->event_name;
           $eventData->event_start_date = date('Y-m-d',strtotime($request->event_start_date));
           $eventData->event_end_date =date('Y-m-d',strtotime($request->event_end_date));
           if($request->first && $request->second){
               $repeatData = $request->first." ".$request->second;
               $recurrenceReference = 1;
           }else{
                $repeatData = $request->third." ".$request->fourth." ".$request->fifth;
                $recurrenceReference = 2;
           }
           $eventData->recurrence = $repeatData;
           $eventData->recurrence_reference = $recurrenceReference;
           if($eventData->save()){
               return redirect()->route('event-list');
           }
           
        }
        $getEventData='';
        return view('event-add',compact('getEventData'));
    }
     // list event data
     public function getEventDetails($id)
     {
         $getEventData = Event::where('id',$id)->first();
         return view('event-add',compact('getEventData'));
     }

      // delete event data
      public function deleteEvent($id)
      {
          $getEventData = Event::where('id',$id)->delete();
          return redirect()->route('event-list');
      }

       // view event data
       public function viewEvent($id)
       {
           $getEventData = Event::find($id);
            //get date periods
            $start = new DateTime($getEventData->event_start_date);
            $end   = new DateTime($getEventData->event_end_date);

            if($getEventData->recurrence_reference==1){
                $getRecurrenceData = explode(" ",$getEventData->recurrence);
                    $step  = $getRecurrenceData[0];
                    $unit  = $getRecurrenceData[1];
            }else{
                $getRecurrenceData = explode(" ",$getEventData->recurrence);
                $step  = $getRecurrenceData[2];
                $unit  = 'M';
                $start->modify($getRecurrenceData[1]);
            }

            $interval = new DateInterval("P{$step}{$unit}");
            $period   = new DatePeriod($start, $interval, $end);
            $eventDates = array();
            foreach ($period as $date) {
                $eventDates[] =  $date->format('D, Y-m-d');
            }
            $returnHTML = view('event-list-ajax',compact('eventDates','getEventData'))->render();
            return response()->json(array('event_data'=>$returnHTML));
       }
}
