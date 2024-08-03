# TranslateTrait

## Використання

Для використання цих методів потрібно в моделі обовязково добавити trait Translate в тіло класу.


```
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Translate;

class Article extends Model
{
    use Translate;
}
```

##  ***getTranslate($column, $locale)***

Доступна при використанні в *.blade.php файлі вигляду для отримання перекладу, якщо переклад не існує буде повернутий базовий текст.


### Пошук

Variant 1

 use for *.blade.php - $article->getTranslate('content', 'en');
```
public function getArticle($id)
{
      $article = Article::find($id);

      return $article->getTranslate('content', 'en');

    // OR return  view("name_view_from_resource_view", compact("article"));
   }
   ```

### Отримання всіх записів

Variant 1

for *.blade.php   use after foreach($articles as $article)  *$article->getTranslate('content', 'en');*
```
public function getArticles()
{
      $articles = Article::query()->get();

      return  view("name_view_from_resource_view", compact("articles"));  
   }
   ```

## ***setTranslate($column,$value, $locale)***

Може бути використана в контролері для додавання перекладу.Пілся додавання базового тексту або пошуку запису бази даних по критерію можна викликати дану функцію для додавання перекладу.

### Додавання перекладу

Variant 1
```
public function createArticle(Request $request)
{
      $article = Article::create([
        "title" => $request->input("title"),
        "content" => $request->input("content")
    ]);

      $article->setTranslate('content', 'Контент English !', 'en');

      return redirect()->route("article");
   }
   ```

Variant 2
```
public function createArticle(Request $request)
{
        $article = new Article();
        $article->title = $request->input("title");
        $article->content  = $request->input("content");
        $article->save();

        $article->setTranslate('content', 'Контент English !', 'en');

      return redirect()->route("article");
   }
   ```

