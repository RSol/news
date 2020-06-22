<?php

namespace app\controllers;

use app\helpers\Paginator;
use app\models\News;
use app\sys\cache\MemcacheCache;
use app\sys\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $total = (new News())->getTotalCount();
        $paginator = new Paginator($total);
        $params = $paginator->getPageParams();

        $news = MemcacheCache::getOrSet((new News())->getCacheKeyForList($params), static function () use ($params) {
            $data = (new News())->findAll($params);
            return array_map(static function ($el) {
                $el['category'] = News::getCategoryLabel($el['category_id']);
                return $el;
            }, $data);
        });

        return $this->json([
            'meta' => $paginator->getMeta(),
            'newsList' => $news,
        ]);
    }

    public function view()
    {
        return $this->json((new News())->findOne((int)$this->params[0])->toArray());
    }

    public function create()
    {
        if ($id = (new News())->addFake()) {
            echo "Add one record with ID#{$id}";
        }
        echo "No one record added";
    }

    public function flush()
    {
        MemcacheCache::getInstanse()->flush();
    }
}
