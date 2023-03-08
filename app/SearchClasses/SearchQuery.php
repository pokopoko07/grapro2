<?php

namespace App\SearchClasses;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class SearchQuery
{
    private $word;
    private $facility;
    private $area;
    private $dogs;
    private $age;

    public function __construct($word, $facility, $area, $dogs, $age)
    {
        $this->word = $word;
        $this->facility = $facility;
        $this->area = $area;
        $this->dogs = $dogs;
        $this->age = $age;
    }

    public function searchTerms(Builder $query)
    {
        $query->where(function ($query) {
            // 単語検索
            for ($i = 0; $i < count($this->word); $i++) {
                $query->where(function ($query) use ($i) {
                    $query->where('title', 'LIKE', '%' . $this->word[$i] . '%')
                          ->orWhere('body', 'LIKE', '%' . $this->word[$i] . '%');
                });
            }
        });

        $query->where(function ($query) {
            // 選ばれた施設区分の数だけ繰り返して、施設区分にtrueが入っている
            // データを抽出する
            if(empty($this->facility)==false){
                $first=0;
                for($i=0;$i<count($this->facility);$i++){
                    switch ($this->facility[$i]){
                        case "park":
                            if($first==0){
                                $query->where('park', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('park', '=', true);
                            }
                            break;
                        case "indoor_fac":
                            if($first==0){
                                $query->where('indoor_fac', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('indoor_fac', '=', true);
                            }
                            break;
                        case "shopping":
                            if($first==0){
                                $query->where('shopping', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('shopping', '=', true);
                                }
                            break;
                        case "shopping":
                            if($first==0){
                                $query->where('shopping', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('shopping', '=', true);
                            }
                            break;
                        case "gourmet":
                            if($first==0){
                                $query->where('gourmet', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('gourmet', '=', true);
                            }
                            break;
                        case "others":
                            if($first==0){
                                $query->where('others', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('others', '=', true);
                            }
                            break;
                    }
                }
            }
        });

        $query->where(function ($query) {
            // 選択された地域で検索をします
            if(empty($this->area)==false){
                $first=0;
                for($i=0;$i<count($this->area);$i++){
                    if($first==0){
                        $query->where('area_id', '=', $this->area[$i]);
                        $first=1;
                    }else{
                        $query->orWhere('area_id', '=', $this->area[$i]);
                    }
                }
            }
        });

        $query->where(function ($query) {
            // 犬ＯＫかで検索
            if($this->dogs<100){
                $query->where('dogs', '=', $this->dogs);
            }
        });

        $query->where(function ($query) {
            // 年代で検索
            // お勧め度が3以上のデータを検索
            $first=0;
            if(empty($this->age)==false){
                for($i=0;$i<count($this->age);$i++){
                    if($first==0){
                        $query->where($this->age[$i], '>', 3);
                        $first=1;
                    }else{
                        $query->orWhere($this->age[$i], '>', 3);
                    }
                }
            }
        });

        return $query;
    }
}