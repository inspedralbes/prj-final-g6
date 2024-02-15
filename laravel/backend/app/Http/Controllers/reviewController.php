<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reviewModel;
class reviewController extends Controller
{
    //
    public function createReview(Request $request){
        $review = new reviewModel;
        $review->usuario_id = $request->usuario_id;
        $review->disco_id = $request->disco_id;
        $review->titulo = $request->titulo;
        $review->content = $request->content;
        $review->puntuacion = $request->puntuacion;
        $review->save();
        return response()->json($review);
    }
    public function getReviews(){
        $reviews = reviewModel::all();

        return response()->json($reviews);

    
    }
    public function getReview($id){
        $review = reviewModel::find($id);
        return response()->json($review);
    }
    public function update(Request $request, $id){
        $review = reviewModel::find($id);
        $review->user_id = $request->user_id;
        $review->disco_id = $request->disco_id;
        $review->titulo = $request->titulo;
        $review->content = $request->content;
        $review->puntuacion = $request->puntuacion;
        $review->save();
        return response()->json($review);
    }
    public function delete($id){
        $review = reviewModel::find($id);
        $review->delete();
        return response()->json($review);
    }

    public function getReviewsByUser($id){
        $reviews = reviewModel::where('user_id', $id)->get();
        return response()->json($reviews);
    }

    public function getReviewsByDiscoteca($id){
        $reviews = reviewModel::where('disco_id', $id)->get();
        return response()->json($reviews);
    }

    public function getReviewsByPuntuacion($puntuacion){
        $reviews = reviewModel::where('puntuacion', $puntuacion)->get();
        return response()->json($reviews);
    }

   


}
