<?php
namespace App\Http\Controllers\Admin;
use App\Image;
use App\Imagestrait;
use App\School;
use App\News;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;
class NewsController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $id=AdminHomeController::chooseSchool();
        if (!empty($keyword)) {
            $news = News::where('title', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $news = News::where('school', 'LIKE', "$id")
            ->latest()->paginate($perPage);
        }
        return view('admin.news.index', compact('news'));
    }
    public function create()
    {  
       return view('admin.news.create');
    }
       public function store(Request $request)
    {
        $request->validate(News::$VALIDATION_RULES);
        
        $id = AdminHomeController::chooseSchool();
        $news = News::create($request->all());
        $news->school=$id;
        $news->save();
        $news->storeImage($request);
         return redirect('admin/news')
         ->with('flash_message', 'news added!');
    }
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }
    public function update(Request $request, News $news)
    {
        $request->validate(News::$VALIDATION_RULES);
        
        $news_path = $news->images()->get(['path'])->first();
        if(!$news_path==null){
            $news->update($request->all());
        }else{
            $image1=null;
            $news->update($request->all());
        }
        $news->storeImage($request);
        return redirect('admin/news')
        ->with('flash_message', 'News updated!');
    }
    public function destroy(News $news)
    {
        $news->deleteImage();
        $news->delete();
        return redirect('admin/news')
        ->with('flash_message', 'News deleted!');
    }
}
