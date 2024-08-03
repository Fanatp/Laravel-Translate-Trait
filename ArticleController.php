<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
 public function index(){

    $articles = Article::with('author')->get();

    return view('articles', compact('articles'));
 }

 public function articleid(Article $article){

   return $article->getKey();
 }

   public function testTranslate()
   {
      $article = Article::find(1);

      // $res = $article->setTranslate('content', 'Контент English !', 'en');
      // $res = $article->getTranslate('content', 'en');

      return $article->getTranslate('content', 'ru');
   }

   public function allTranslate()
   {
      $res = DB::table('translate')->get();
        echo "<pre>";
      print_r($res);
      echo "</pre>";
   }
}
