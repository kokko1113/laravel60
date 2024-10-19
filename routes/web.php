<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("admin")->group(function () {
    Route::get("/login", [LoginController::class, "login"])->name("login");
    Route::post("/check", [LoginController::class, "check"])->name("check");
});

Route::prefix("admin")->middleware("auth")->group(function () {
    Route::get("/logout", [LoginController::class, "logout"])->name("logout");

    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");

    Route::get("/event", [EventController::class, "index"])->name("event_index");
    Route::get("/event/create", [EventController::class, "create"])->name("event_create");
    Route::post("/event/store", [EventController::class, "store"])->name("event_store");
    Route::get("/event/edit/{id}", [EventController::class, "edit"])->name("event_edit");
    Route::patch("/event/{id}", [EventController::class, "update"])->name("event_update");
    Route::delete("/event/{id}", [EventController::class, "destroy"])->name("event_destroy");

    Route::get("/worker", [WorkerController::class, "index"])->name("worker_index");
    Route::get("/worker/create", [WorkerController::class, "create"])->name("worker_create");
    Route::post("/worker/store", [WorkerController::class, "store"])->name("worker_store");
    Route::delete("/worker/{id}", [WorkerController::class, "destroy"])->name("worker_destroy");

    Route::get("/dispatch", [DispatchController::class, "index"])->name("dispatch_index");
    Route::get("/dispatch/create", [DispatchController::class, "create"])->name("dispatch_create");
    Route::post("/dispatch/store", [DispatchController::class, "store"])->name("dispatch_store");
    Route::get("/dispatch/edit/{id}", [DispatchController::class, "edit"])->name("dispatch_edit");
    Route::patch("/dispatch/{id}", [DispatchController::class, "update"])->name("dispatch_update");
    Route::delete("/dispatch/{id}", [DispatchController::class, "destroy"])->name("dispatch_destroy");
});
