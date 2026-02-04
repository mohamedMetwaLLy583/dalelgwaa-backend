<?php

namespace App\Http\Controllers\Review;

use App\Enums\Review\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function web_index()
    {
        $reviews = Review::where('status', Status::Active->value)->limit(6)->get();
        return ReviewResource::collection($reviews);
    }

    public function index()
    {
        return ReviewResource::collection(Review::paginate(20));
    }

    public function store(ReviewRequest $request)
    {
        $validatedData = $request->validated();

        Review::create($validatedData);

        return response()->json([
            'message' => __('response.created'),
        ]);
    }

    public function toggleStatus(Review $review)
    {
        $message = $review->toggleStatus();

        return response()->json([
            'message' => $message,
        ]);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json([
            'message' => __('response.deleted'),
        ]);
    }

}
