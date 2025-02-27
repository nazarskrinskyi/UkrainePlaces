<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review = Review::create($validated + ['user_id' => auth()->id()]);

        return response()->json(['message' => 'Review added successfully', 'review' => $review], 201);
    }

    public function editForm($id): View
    {
        $review = Review::findOrFail($id);
        return view('review.edit', compact('review'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::findOrFail($id);
        $review->update($request->all());

        return redirect()->back()->with('success', 'Review updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        Review::destroy($id);
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
