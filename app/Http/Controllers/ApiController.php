<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use App\Models\Event;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function events(Request $request){
        $worker_id = $request->worker_id;
        $date = $request->date;
        $place = $request->place;
        $title = $request->title;
        $dispatches = Dispatch::query()->where("worker_id", $worker_id)->get();
        $events = [];
        $results = [];
        foreach ($dispatches as $dispatch) {
            $event_id = $dispatch->event_id;
            $events[] = Event::query()->find($event_id);
        }
        foreach ($events as $event) {
            $query = Event::query();
            if (isset($date)) {
                $query->where("event_date", $date);
            }
            if (isset($place)) {
                $query->where("place", $place);
            }
            if (isset($title)) {
                $query->where("name", "like", "%" . $title . "%");
            }
            $aaa = $query->find($event->id);
            if ($aaa != null) {
                $results[] = $aaa;
            }
        }
        if(empty($results)){
            return response()->json(["error"=>"エラーが発生しました"],404);
        }
        return response()->json($results);
    }
    public function post(Request $request){
        $event_id=$request->event_id;
        $worker_id=$request->worker_id;
        $dispatch=Dispatch::query()->where("event_id",$event_id)->where("worker_id",$worker_id)->first();
        if(empty($dispatch)){
            return response()->json(["error"=>"エラーが発生しました"],404);
        }
        $dispatch->update([
            "permit"=>true,
        ]);
        return response()->json(["message"=>"更新されました"],204);
    }
}
