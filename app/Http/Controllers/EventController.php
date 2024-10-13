<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Event::query()->get();
        return view("event.index", compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("event.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "name" => "required",
                "place" => "required",
                "event_date" => "required",
            ],
            [
                "name.required" => "エラーが発生しました",
                "place.required" => "エラーが発生しました",
                "event_date.required" => "エラーが発生しました",
            ]
        );
        Event::query()->create([
            "name" => $request->name,
            "place" => $request->place,
            "event_date" => $request->event_date,
        ]);
        $message = "イベント情報が登録されました";
        return redirect(route("event_create"))->with(["message" => $message]);
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
        $item=Event::query()->find($id);
        return view("event.edit",compact("item"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                "name" => "required",
                "place" => "required",
                "event_date" => "required",
            ],
            [
                "name.required"=>"エラーが発生しました",
                "place.required"=>"エラーが発生しました",
                "event_date.required"=>"エラーが発生しました",
            ]
        );
        $item=Event::query()->find($id);
        $item->update([
            "name"=>$request->name,
            "place"=>$request->place,
            "event_date"=>$request->event_date,
        ]);
        $message="イベント情報が更新されました";
        return redirect(route("event_edit",$item->id))->with(["message"=>$message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Event::query()->find($id);
        $item->delete();
        return redirect(route("event_index"));
    }
}
