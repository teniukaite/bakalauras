<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreConflictRequest;
use App\Http\Requests\UpdateConflictRequest;
use App\Mail\Conflicts\NewConflict;
use App\Mail\Conflicts\NewConflictUser;
use App\Models\Conflict;
use App\Models\ConflictHistory;
use App\Models\File;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConflictController extends Controller
{
    public function index(): View
    {
        $conflicts = Conflict::UsersConflicts()->latest()->paginate(10);

        return view('conflicts.index',compact('conflicts'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        $orders = Auth::user()->orderedOrders ?? [];

        return view('conflicts.create', compact('orders'));
    }

    public function store(StoreConflictRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $moderator = User::RandomModerator()->first();

        $data['plaintiff_id'] = Auth::user()->id;
        $data['identification'] = 'Nr. ' . Str::random(4);
        $data['moderator_id'] = $moderator->id;

        $conflict = Conflict::create($data);

        if ($files = $request->file('file')) {
            foreach ($files as $file) {
                $destinationPath = 'files/conflicts/';
                $name = $file->hashName();
                move_uploaded_file($file->getRealPath(), 'uploads/'.$destinationPath.$name);
                $fileData['file_path'] = 'uploads/'.$destinationPath.$name;
                $fileData['name'] = $name;
                $conflict->files()->create($fileData);
            }
        }


        Mail::to(Auth::user()->email)->send(new NewConflictUser());
        Mail::to($moderator->email)->send(new NewConflict());
        ConflictHistory::create([
            'details' => 'pateikė skundą',
            'user_id' => Auth::user()->id,
            'conflict_id' => $conflict->id
        ]);

        return redirect()->route('conflicts.index')
            ->with('success','Skundas pateiktas sekmingai. Apie tolimesne eiga gausite pranesima');
    }

    public function show(Conflict $conflict): View
    {
      //  $conflict = $conflict->with(['orders', 'orders.service'])->where('id', $conflict->id)->first();
        //$conflict = $conflict->with('files');
        ConflictHistory::create([
            'details' => 'peržiūrėjo skundą',
            'user_id' => Auth::user()->id,
            'conflict_id' => $conflict->id
        ]);
        return view('conflicts.show', compact('conflict'));
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
