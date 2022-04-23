<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdditionalInformationRequest;
use App\Http\Requests\UpdateAdditionalInformationRequest;
use App\Mail\Conflicts\InformationAdded;
use App\Models\AdditionalInformation;
use App\Models\Conflict;
use App\Models\ConflictHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdditionalInformationController extends Controller
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
     * @param  \App\Http\Requests\StoreAdditionalInformationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdditionalInformationRequest $request, Conflict $conflict)
    {
        $data = $request->validated();

        $additionalInformation = AdditionalInformation::create([
            'conflict_id' => $conflict->id,
            'user_id' => Auth::user()->id,
            'explanation' => $data['explanation'],
            ]
        );

        if ($files = $request->file('file')) {
            foreach ($files as $file) {
                $destinationPath = 'files/conflicts/';
                $name = $file->hashName();
                move_uploaded_file($file->getRealPath(), 'uploads/'.$destinationPath.$name);
                $fileData['file_path'] = 'uploads/'.$destinationPath.$name;
                $fileData['name'] = $name;
                $additionalInformation->files()->create($fileData);
            }
        }

        ConflictHistory::create([
            'details' => 'pateikė paildomą informaciją',
            'user_id' => Auth::user()->id,
            'conflict_id' => $conflict->id
        ]);

        Mail::to($conflict->moderator->email)->send(new InformationAdded());

        return redirect()->route('conflicts.index')
            ->with('success','Informacija sekmingai pateikta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalInformation  $additionalInformation
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalInformation $additionalInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalInformation  $additionalInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(AdditionalInformation $additionalInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdditionalInformationRequest  $request
     * @param  \App\Models\AdditionalInformation  $additionalInformation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdditionalInformationRequest $request, AdditionalInformation $additionalInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalInformation  $additionalInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalInformation $additionalInformation)
    {
        //
    }
}
