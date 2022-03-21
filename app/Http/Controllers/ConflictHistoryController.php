<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConflictHistoryRequest;
use App\Http\Requests\UpdateConflictHistoryRequest;
use App\Models\Conflict;
use App\Models\ConflictHistory;

class ConflictHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConflictHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConflictHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConflictHistory  $conflictHistory
     * @return \Illuminate\Http\Response
     */
    public function show(Conflict $conflict)
    {
        $history = $conflict->history()->latest()->paginate(10);

        return view('history.show', compact('history'))->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConflictHistory  $conflictHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ConflictHistory $conflictHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConflictHistoryRequest  $request
     * @param  \App\Models\ConflictHistory  $conflictHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConflictHistoryRequest $request, ConflictHistory $conflictHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConflictHistory  $conflictHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConflictHistory $conflictHistory)
    {
        //
    }
}
