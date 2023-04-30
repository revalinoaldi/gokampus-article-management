<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $search = $request->input('search');
        $author = $request->input('author');
        $categories = $request->input('categories');

        $article = Article::with(['category'])->where('is_publish', "1")->whereHas('category', function($q){
            return $q->where('deleted_at', NULL);
        });

        if($id)
        {
            $article = $article->where('slug',$id);

            if($article)
                return ResponseFormatter::success(
                    $article,
                    'Data article berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data article tidak ada',
                    404
                );
        }

        if(@$search || @$categories || @$author)
            $article->filter(request(['search', 'categories','author']));

        return ResponseFormatter::success(
            // $article->paginate($limit),
            ['data' => $article->get()],
            'Data list article berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
