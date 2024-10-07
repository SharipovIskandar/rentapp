<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {

        $branches = Branch::all();

        return view('components.branch', ['branches' => $branches]);

    }

    public function branch()
    {
        $ads = Ad::all();
        return view('components.branchS', ['ads' => $ads]);
    }

    public function show($id)
    {
        return Branch::findOrFail($id);
    }

    public function store(Request $request)
    {
        $branch = Branch::create($request->all());
        return response()->json($branch, 201);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($request->all());
        return response()->json($branch, 200);
    }

    public function destroy($id)
    {
        Branch::destroy($id);
        return response()->json(null, 204);
    }

    public function getBranchAds($id)
    {
        $branch = Branch::findOrFail($id);
        return $branch->ads;
    }

    public function getBranchUsers($id)
    {
        $branch = Branch::findOrFail($id);
        return $branch->users;
    }

    public function countBranchAds($id)
    {
        $branch = Branch::findOrFail($id);
        return $branch->ads()->count();
    }

    public function countBranchUsers($id)
    {
        $branch = Branch::findOrFail($id);
        return $branch->users()->count();
    }

    public function getBranchActiveAds($id)
    {
        $branch = Branch::findOrFail($id);
        return $branch->ads()->where('status', 'active')->get();
    }

    public function getBranchInactiveAds($id)
    {
        $branch = Branch::findOrFail($id);
        return $branch->ads()->where('status', 'inactive')->get();
    }
}
