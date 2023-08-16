<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    public function getEvents( Request $request ) {
        $user_id = $request->header( 'id' );

        $data = Event::where( 'user_id', '=', $user_id )->get();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request ) {
        $user_id = $request->header( 'id' );
        $request['user_id'] = $user_id;
        try {
            $event = Event::create( $request->all());
            return response()->json( [
                'status'  => 'success',
                'data'=> $event,
                'message' => 'Event Added Successfully',
            ], 200 );
        } catch ( Exception $e ) {
            return $e;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show( Event $event ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Event $event ) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( UpdateEventRequest $request, Event $event ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Event $event ) {
        //
    }
}
