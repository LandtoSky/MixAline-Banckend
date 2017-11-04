<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Image;
use App\Models\TimeLine;
use App\Models\LineEvent;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TimeLineController extends Controller
{
    /********Get All TimeLines*********/
    public function index()
    {
        $timeLines = TimeLine::paginate(10);
        return response()->json([
            'success' => true,
            'result' => $timeLines
        ], 201);
    }
    /**********Get Timelines by User Id********/
    public function read($user_id)
    {
        $timeLines = TimeLine::where('user_id', $user_id)->get();
        return response()->json([
            'success' => true,
            'result' => $timeLines
        ], 201);
    }
    /**********Get Single TimeLine***************/
    public function show($id)
    {
        $timeLine = TimeLine::find($id);

        $timeLine->events = $this->getEvents($timeLine->id);
        return response()->json([
            'success' => true,
            'result' => $timeLine
        ], 201);
    }

    /**************Get TimeLine and Event Counts by User ID***********/
    public function getCount($user_id)
    {
        $timeLineCount = TimeLine::where('user_id', $user_id)->count();
        $eventCount = Event::where('user_id', $user_id)->count();
        return response()->json([
            'success' => true,
            'result' => [
                'timeLineCount' => $timeLineCount,
                'eventCount' => $eventCount
            ]
        ]);
    }

    public function getEvents($timeLine_id)
    {
        $events = Event::join('line_event', 'line_event.event_id', '=', 'events.id')
                        ->where('line_event.timeline_id', $timeLine_id)
                        ->select('events.*')
                        ->get();

        return $events;
    }
}