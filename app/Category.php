<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories'; //name table with work this model
    //protected $primaryKey = 'id'; //вказує яке поле є первинним ключем. Це не потрібно вказувати, якщо первинний ключ в таблиці має найменування 'id'

    //public $incrementing = false; //вказує, що немає автоінкрементування для первинного ключа
    //public $timestamps = false; //вказує, що при створенні чи редагуванні запису через модель не буде автоматично прописувати дату створення чи редагування запису в поля created_at and updated_at

    protected $fillable = [
        'name',
        'slug',
        'description',
    ]; // список полів, які є доступними для масового присвоєння через модель,
    protected $guarded = [

    ];// список полів, які НЕ є доступними для масового присвоєння через модель,

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public static function getListId()
    {
        $categories = self::pluck('name', 'id')->toArray();

        return $categories;
    }

    public static function getListSlug()
    {
        $categories = self::pluck('name', 'slug')->toArray();

        return $categories;
    }
}
