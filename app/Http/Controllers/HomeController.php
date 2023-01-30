<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

class HomeController extends Controller
{
    public function meetingCreate(Request $request)
    {
        $user = Zoom::user()->first();
        $meetingData = [
            'topic' => "meegting",
            'duration' => 11,
            'password' => 'qwertyui',
            'start_time' => New Carbon('2023-02-02 00:00:00'),
            //'timezone' => config('zoom.timezone')
            'timezone' => 'Asia/Dhaka'
        ];
        $meeting = Zoom::meeting()->make($meetingData);

        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]);
        //dd($meeting);
        dd($user->meetings()->save($meeting))  ;
    }
}
