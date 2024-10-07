<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function toggleBookmark($id)
    {
        $user = auth()->user();

        // User modelidagi bookmarkAds metodini chaqirish
        if ($user->bookmarkAds()->where('ad_id', $id)->exists()) {

            $user->bookmarkAds()->detach($id);
            return back()->with('message', "elon o'chiildi");
        } else {
            // Agar e'lon bookmarklangan bo'lmasa, qo'shish
            $user->bookmarkAds()->attach($id);
            return back()->with('message', "elon yaratildi");
        }
    }

    public function someMethod(): void
    {
        $user = User::withCount('bookmarks')->find(auth()->id());


    }

    public function profile(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        $user = auth()->user();
        $ads = Ad::all();
        return view('ads.profile', compact('user', 'ads'));
    }

    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }

    public function getByGender($gender)
    {
        return User::where('gender', $gender)->get();
    }

    // Get users by position
    public function getByPosition($position)
    {
        return User::where('position', $position)->get();
    }

    public function getByBranch($branchId)
    {
        return User::where('branch_id', $branchId)->get();
    }

    public function getUserAds($id)
    {
        $user = User::findOrFail($id);
        return $user->ads;  // Assuming a relation 'ads' exists in the User model
    }

    public function getUserBookmarks($id)
    {
        $user = User::findOrFail($id);
        return $user->bookmarks;  // Assuming a relation 'bookmarks' exists in the User model
    }

    public function getUserActiveAds($id)
    {
        $user = User::findOrFail($id);
        return $user->ads()->where('status', 'active')->get();
    }

    public function getUserInactiveAds($id)
    {
        $user = User::findOrFail($id);
        return $user->ads()->where('status', 'inactive')->get();
    }

}
