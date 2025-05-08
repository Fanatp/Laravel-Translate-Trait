<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use App\Models\Translate as TranslateModel;

/**
 * @method getKey()
 * @method static find($getKey)
 * @method static addGlobalScope(string $string, \Closure $param)
 * @method hasMany(string $class, string $string, string $string1)
 */
trait Translate
{
    /**
     * Automatically eager load translates relation by default.
     */
    protected static function bootHasTranslates(): void
    {
        static::addGlobalScope('withTranslates', function (Builder $builder) {
            $builder->with('translates');
        });
    }

    /**
     * Відношення до перекладів
     */
    protected function translates():hasMany
    {
        return $this->hasMany(TranslateModel::class, 'key', 'id')
            ->where('model', static::class);
    }

    /**
     * Отримати перекладене значення або fallback
     */
    public function getTranslate(string $column, string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();

        $translated = $this->translates
            ->where('column', $column)
            ->where('locale', $locale)
            ->first()->value();

        return $translated ?? $this->$column;
    }

    /**
     * Отримати всі переклади для API
     */
    public function getTranslatesForApi(string $locale = null): array
    {
        $locale = $locale ?? App::getLocale();

        $translations = $this->translates
            ->where('locale', $locale)
            ->pluck('value', 'column')
            ->toArray();


        foreach ($this->getAttributes() as $column => $value) {
            if (!array_key_exists($column, $translations) && !is_null($value)) {
                $translations[$column] = $value;
            }
        }

        return $translations;
    }

    public function setTranslate(string $field, string $locale, string $value): void
    {

        TranslateModel::updateOrCreate([
                'model'  => static::class,
                'column' => $field,
                'key'    => $this->getKey(),
                'locale' => $locale,
            ], [
                'value' => $value,
            ]);

    }

    /**
     * Зберегти переклади
     */
    public function setTranslates(string $locale, array $data): void
    {
        foreach ($data[0] as $column => $value) {
            if (!empty($value)) {
                TranslateModel::updateOrCreate([
                    'model'  => static::class,
                    'column' => $column,
                    'key'    => $this->getKey(),
                    'locale' => $locale,
                ], [
                    'value' => $value,
                ]);
            }
        }
    }

       public function delTranslate(string $column, string $locale,):void
    {
        $this->translates()
            ->where('column', $column)
            ->where('locale', $locale)
            ->delete();
    }

}
