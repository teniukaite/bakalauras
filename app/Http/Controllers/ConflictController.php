<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreConflictRequest;
use App\Http\Requests\UpdateConflictRequest;
use App\Models\Conflict;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConflictController extends Controller
{
    public function index(): View
    {
        $conflicts = Conflict::latest()->paginate(5);

        return view('conflicts.index',compact('conflicts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        $users = User::all();
        return view('conflicts.create', compact('users'));
    }

    public function store(StoreConflictRequest $request)
    {
        $data = $request->validated();

        if ($file = $request->file('file')) {
            $destinationPath = 'files/conflicts/';
            $name = $file->hashName();
//            Storage::put($destinationPath, $file);
            Storage::disk('local')->put($destinationPath.$name, $file);
            $data['file'] = $name;
        }

        $data['plaintiff_id'] = Auth::user()->id;
        $data['identification'] = 'Nr. ' . Str::random(4);

        Conflict::create($data);

        return redirect()->route('conflicts.index')
            ->with('success','Skundas pateiktas sekmingai. Apie tolimesne eiga gausite pranesima');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conflict  $conflict
     * @return \Illuminate\Http\Response
     */
    public function show(Conflict $conflict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conflict  $conflict
     * @return \Illuminate\Http\Response
     */
    public function edit(Conflict $conflict)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConflictRequest  $request
     * @param  \App\Models\Conflict  $conflict
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConflictRequest $request, Conflict $conflict)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conflict  $conflict
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conflict $conflict)
    {
        //
    }
}
