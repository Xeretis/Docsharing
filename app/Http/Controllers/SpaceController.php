<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterSpaceRequest;
use App\Http\Requests\StoreSpaceRequest;
use App\Http\Requests\UpdateSpaceRequest;
use App\Models\Space;
use Debugbar;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SpaceController extends Controller
{
    public function index()
    {
        return view('spaces.index', [
            'ownedSpaces' => auth()->user()->ownedSpaces()->orderBy('created_at')->get(),
            'joinedSpaces' => auth()->user()->joinedSpaces()->orderBy('created_at')->get(),
        ]);
    }

    public function view(Space $space)
    {
        $this->authorize('view', $space);

        return view('spaces.view', [
            'space' => $space,
        ]);
    }

    public function store(StoreSpaceRequest $request)
    {
        Space::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => auth()->user()->id,
        ]);

        return redirect()->route('spaces.index');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Space::class);

        return view('spaces.create');
    }

    public function join()
    {
        return view('spaces.join');
    }

    public function enter(EnterSpaceRequest $request)
    {
        $space = Space::where('hash', $request->code)->first();

        //Moved this out of EnterSpaceRequest to have one less db query
        if ($space === null) {
            throw ValidationException::withMessages(['code' => __('validation.exists', ['attribute' => 'code'])]);
        }

        if ($space->owner_id === auth()->user()->id) {
            throw ValidationException::withMessages(['code' => 'You are the owner of that space']);
        }

        if (auth()->user()->joinedSpaces->contains($space)) {
            throw ValidationException::withMessages(['code' => 'You are already in that space']);
        }

        if (!$space->joinable_with_hash) {
            throw ValidationException::withMessages(['code' => 'You are not authorized to join that space']);
        }

        $space->users()->attach(auth()->user()->id);

        return redirect()->route('spaces.index');
    }

    public function joinInvite(Request $request, Space $space)
    {
        if (!$space->joinable_with_hash && !$request->hasValidSignature()) {
            abort(401);
        }

        return view('spaces.join-invite', ['space' => $space]);
    }

    public function enterInvite(Request $request, Space $space)
    {
        if (!$request->hasValidSignature()) {
            throw ValidationException::withMessages(['space' => 'You are not authorized to join that space']);
        }

        if ($space->owner_id === auth()->user()->id) {
            throw ValidationException::withMessages(['space' => 'You are the owner of that space']);
        }

        if (auth()->user()->joinedSpaces->contains($space)) {
            throw ValidationException::withMessages(['space' => 'You are already in that space']);
        }

        $space->users()->attach(auth()->user()->id);

        return redirect()->route('spaces.index');
    }

    public function edit(Space $space)
    {
        $this->authorize('update', $space);

        return view('spaces.edit', ['space' => $space]);
    }

    public function update(UpdateSpaceRequest $request, Space $space)
    {
        $joinable_with_hash = false;
        if (array_key_exists('joinable_with_hash', $request->input())) {
            $joinable_with_hash = true;
        }

        Debugbar::info($joinable_with_hash);
        $space->whereId($space->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'joinable_with_hash' => $joinable_with_hash
        ]);

        return redirect()->route('spaces.index');
    }

    public function delete(Space $space)
    {
        $this->authorize('delete', $space);

        $space->delete();

        return redirect()->route('spaces.index');
    }
}
