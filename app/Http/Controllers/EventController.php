<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Image;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller;

class EventController extends Controller
{
    /**********Get Events by User Id***********/
    public function read($user_id)
    {
        $events = Event::where('user_id', $user_id)->paginate(10);
        return response()->json([
            'success' => true,
            'result' => $events
        ], 201);
    }
}