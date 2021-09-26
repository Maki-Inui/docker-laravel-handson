<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReview;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function __construct() 
    {      
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('review_post_user_check')->only(['edit', 'update', 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return view
     */
    public function create($id)
    {
        $shop = Shop::find($id);
        return view('review.post', compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreReview $request
     * @param  int  $shop_id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReview $request, $shop_id)
    {
        return DB::transaction(function () use ($request, $shop_id)
        {
            $review = new Review();
            $review->recommend_score = $request->recommend_score;
            $review->food_score = $request->food_score;
            $review->title = $request->title;
            $review->comment = $request->comment;
            $review->shop_id = $shop_id;
            $review->user_id = Auth::id();
            $review->save();

            $files = $request->file('image');
            if ($request->hasFile('image')) 
            {
                foreach($files as $file) 
                {
                    $photo = new Photo();
                    $file_name = time() . $file->getClientOriginalName();
                    $target_path = public_path('image/review/');
                    $file->move($target_path, $file_name);
                    $photo->path = $file_name;
                    $photo->review_id = $review->id;
                    $photo->save();
                }
            }
            return redirect()->route('shops.show', ['shop' => $shop_id])->with('success', 'レビューを投稿しました！');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function show($shop_id, $id)
    {
        $review = Review::find($id);

        if ($review === null)
        {
            return redirect()->route('shops.index')->with('failure', '指定されたIDのショップレビューは存在しません');
        }

        return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function edit($shop_id, $id)
    {
        $review = Review::find($id);
        return view('review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreReview $request
     * @param  int  $shop_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReview $request, $shop_id, $id)
    {
        $review = Review::find($id);
        $update = [
            'title' => $request->title,
            'comment' => $request->comment,
            'recommend_score' => $request->recommend_score,
            'food_score' => $request->food_score,
        ];
        $review->update($update);
        return redirect()->route('shops.show', ['shop' => $shop_id])->with('success', '編集完了');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $shop_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($shop_id, $id)
    {
        $review = Review::find($id);
        if($photos = $review->photos) 
        {
            foreach($photos as $photo)
            {
                $path = public_path('image/review/' . $photo->path);
                \File::delete($path);
            }
        }
        $review->delete();
        return redirect()->route('shops.show', ['shop' => $shop_id])->with('success', 'レビューを削除しました');
    }
}
