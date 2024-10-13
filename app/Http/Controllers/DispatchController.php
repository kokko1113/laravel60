<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use App\Models\Event;
use App\Models\Worker;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=Dispatch::get();
        return view("dispatch.index",compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events=Event::get();
        $workers=Worker::get();
        return view("dispatch.create",compact("events","workers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "event_name"=>"required",
            "worker_name"=>"required",
            "memo"=>"required",
        ],
        [
            "event_name.required"=>"エラーが発生しました",
            "worker_name.required"=>"エラーが発生しました",
            "memo.required"=>"エラーが発生しました",
        ]
        );
        $event=Event::query()->where("name",$request->event_name)->first()->id;
        // $event=$events->where("id",$request->event_id)->first();
        $worker=Worker::query()->where("name",$request->worker_name)->first()->id;
        Dispatch::query()->create([
            "event_id"=>$event,
            "worker_id"=>$worker,
            "permit"=>false,
            "memo"=>$request->memo,
        ]);
        $message="派遣情報が登録されました";
        return redirect(route("dispatch_create"))->with(["message"=>$message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Dispatch::query()->find($id);
        $events=Event::get();
        $workers=Worker::get();
        $prev_event=Event::query()->where("id",$item->event_id)->first()->name;
        $prev_worker=Worker::query()->where("id",$item->worker_id)->first()->name;
        return view("dispatch.edit",compact("prev_event","prev_worker","item","events","workers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "event_name"=>"required",
            "worker_name"=>"required",
            "memo"=>"required",
        ],
        [
            "event_name.required"=>"エラーが発生しました",
            "worker_name.required"=>"エラーが発生しました",
            "memo.required"=>"エラーが発生しました",
        ]
        );
        $event=Event::query()->where("name",$request->event_name)->first()->id;
        $worker=Worker::query()->where("name",$request->worker_name)->first()->id;
        $item=Dispatch::query()->find($id);
        $item->update([
            "event_id"=>$event,
            "worker_id"=>$worker,
            "memo"=>$request->memo,
        ]);
        $message="派遣情報が更新されました";
        return redirect(route("dispatch_edit",$item->id))->with(["message"=>$message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Dispatch::query()->find($id);
        $item->delete();
        return redirect(route("dispatch_index"));
    }
}
