<?php
/**
 * File ArticleController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers\Api
 */
class ArticleController extends BaseController
{
    const ITEM_PER_PAGE = 100;

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $articleQuery = Article::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $articleQuery->where('judul', 'LIKE', '%' . $keyword . '%');
        }

        return MasterResource::collection($articleQuery->paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRules(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                // upload file
                $file = $request->file('file');

                $maxFileSizeKB = 10240; // For example, 10MB
            
                // Validate file size
                $validator = Validator::make(
                    ['file' => $file],
                    ['file' => "required|file|max:$maxFileSizeKB"]
                );

                $uniq = Str::random(5);
                $nama_file = $uniq . '-' . $file->getClientOriginalName();
                $file->move('uploads/article/', $nama_file);

                $params = $request->all();
                $slug = Str::slug($params['judul']);
                $article = Article::create([
                    'slug' => $slug,
                    'judul' => $params['judul'],
                    'description' => $params['description'],
                    'content' => $params['content'],
                    'kategori' => $params['kategori'],
                    'image' => $nama_file,
                ]);

                DB::commit();
                return response()->json(['message' => "Sukses Upload article"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $articleQuery = Article::where('id',$id)->first();
       
        return $articleQuery;
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function slug($slug)
    {
       
        $articleQuery = Article::where('slug', $slug)->first();
       
        return $articleQuery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article    $article
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $file = $request->file('file');

            $maxFileSizeKB = 10240; // For example, 10MB
        
            // Validate file size
            $validator = Validator::make(
                ['file' => $file],
                ['file' => "required|file|max:$maxFileSizeKB"]
            );

            $slug = Str::slug($request->get('judul'));

            $article = Article::find($request->get('id'));
            $article->slug = $slug;
            $article->judul = $request->get('judul');
            $article->description = $request->get('description');
            $article->content = $request->get('content');
            $article->kategori = $request->get('kategori');

            //find data by id
            if ($file) {
                $filename  = public_path('uploads/article/').$article->image;
                if(File::exists($filename)) {

                    $uniq = Str::random(5);
                    $nama_file = $uniq . '-' . $file->getClientOriginalName();
                    $file->move('uploads/article/', $nama_file);

                    //update filename to database
                    $article->image = $nama_file;
                    //Found existing file then delete
                    File::delete($filename);  // or unlink($filename);
                }
            }
            $article->save();
            return new MasterResource($article);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Company $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $article = Article::find($id);
            $filename  = public_path('uploads/article/').$article->image;
            // hapus file yang sudah tidak digunakan
            if(File::exists($filename)) {
                File::delete($filename);  // or unlink($filename);
            }

            Article::where('id',$id)->delete();

            return response()->json(['message' => "Success Delete article"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    private function getValidationRules($isNew = true)
    {
        return [
            'judul' => 'required',
            'description' => 'required',
            'content' => 'required',
            'kategori' => 'required',
        ];
    }
}
