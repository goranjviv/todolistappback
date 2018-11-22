<?php

namespace App\Http\Controllers;


use App\Todo;
use Illuminate\Http\Request;
use Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        return Todo::where("user_id", $userId)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Todo::create(array_merge(
            request()->only('done', 'text', 'title', 'priority'),
            ['user_id' => Auth::user()->id]
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        if ($todo->user_id == Auth::user()->id) {
            return $todo;
        }
        return response()->json(['status' => 'Not Found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id == Auth::user()->id) {
            $todo->update($request->only('done', 'text', 'title', 'priority'));
            return response()->json($todo, 200);
        }
        return response()->json(['status' => 'Not Found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if ($todo->user_id == Auth::user()->id) {
            $todo->delete();
            return response()->json(null, 204);
        }
        return response()->json(['status' => 'Not Found'], 404);
    }
}
