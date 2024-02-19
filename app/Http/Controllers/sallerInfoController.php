<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sallerinfo;
use Illuminate\Support\Facades\Auth;

class sallerInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sallerInfo = sallerinfo::where('saller_id', Auth::guard('sallers')->id())->first();
        return view('saller.sallerInfo.sallerinfo', compact('sallerInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'nid.*' => 'nullable|image|max:2048', // validate each uploaded file
        ]);

        $sellerInfo = new sallerinfo();
        $sellerInfo->phone = $validatedData['phone'];
        $sellerInfo->address = $validatedData['address'];
        $sellerInfo->saller_id = Auth::guard('sallers')->id();

        // Handle multiple image uploads
        // Handle multiple image uploads
        if ($request->hasFile('nid')) {
            $nidPaths = [];
            foreach ($request->file('nid') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $path = 'uploads/sallerInfo/nids';
                $file->move($path, $filename);
                $nidPaths[] = $path . '/' . $filename;
            }
            $sellerInfo->nid = json_encode($nidPaths); // store file paths as JSON array
        }

        $sellerInfo->save();

        return redirect()->back()->with('success', 'Seller info stored successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'nid.*' => 'nullable|image|max:2048', // validate each uploaded file
        ]);

        // Find the seller info associated with the authenticated seller
        $sellerInfo = SallerInfo::where('saller_id', Auth::guard('sallers')->id())->first();

        if (!$sellerInfo) {
            return redirect()->back()->with('error', 'Seller info not found.');
        }

        $sellerInfo->phone = $validatedData['phone'];
        $sellerInfo->address = $validatedData['address'];

        // Handle multiple image uploads for NID
        if ($request->hasFile('nid')) {
            $nidPaths = [];
            foreach ($request->file('nid') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $path = 'uploads/sallerInfo/nids';
                $file->move($path, $filename);
                $nidPaths[] = $path . '/' . $filename;
            }
            // Merge existing NID images with new ones
            $existingNID = json_decode($sellerInfo->nid, true) ?: [];
            $sellerInfo->nid = json_encode(array_merge($existingNID, $nidPaths)); // store file paths as JSON array
        }

        $sellerInfo->save();

        return redirect()->back()->with('success', 'Seller info updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
