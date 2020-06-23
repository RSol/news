<?php

namespace app\models;

use app\helpers\ArrayHelper;
use app\sys\cache\MemcacheCache;
use app\sys\db\Model;
use app\sys\db\QueryLOSParams;
use Faker\Factory;
use PDO;

class News extends Model
{
    public $id;
    public $category_id;
    public $title;
    public $description;
    public $image;
    public $created_at;

    public static function tableName(): string
    {
        return 'news';
    }

    public static function getCategories()
    {
        return [
            1 => 'Laravel',
            2 => 'Yii2',
            3 => 'Phalcon',
            4 => 'WordPres',
            5 => 'NodeJs',
        ];
    }

    /**
     * @param $id
     * @param string $default
     * @return mixed|null
     */
    public static function getCategoryLabel($id, $default = '')
    {
        return ArrayHelper::getValue($id, static::getCategories(), $default);
    }

    public function createTable()
    {
        $tableName = static::tableName();
        $sql = "CREATE TABLE IF NOT EXISTS {$tableName} (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $this->getConnection()->exec($sql);
    }

    public function findAll(QueryLOSParams $params = null)
    {
        $sql = $this->getSql($params ?: (new QueryLOSParams()));

        $query = $this->getConnection()->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $params
     * @return string
     */
    private function getSql(QueryLOSParams $params)
    {
        $tableName = static::tableName();
        $index = '';
        foreach ($params->sort->getSort() as $field => $dir) {
            $parts = [
                'index',
                $field
            ];
            if ($dir) {
                $parts[] = 'desc';
            }
            $index = implode('_', $parts);
            $index = " USE INDEX ({$index}) ";
        }
        return "SELECT id, category_id, title, description, image, created_at FROM {$tableName}{$index}" . $params;
    }

    public function findOne(int $id)
    {
        $tableName = static::tableName();
        $sql = "SELECT id, category_id, title, description, image, created_at FROM {$tableName} WHERE id = :id";
        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(':id', $id);

        $model = new self();
        $query->setFetchMode(PDO::FETCH_INTO, $model);
        $query->execute();
        $query->fetch(PDO::FETCH_INTO);
        return $model;
    }

    public function add()
    {
        $tableName = static::tableName();
        $sql = "INSERT INTO {$tableName} (category_id, title, description, image) VALUES (:category_id, :title, :description, :image)";
        $query = $this->getConnection()->prepare($sql);
        foreach (['category_id', 'title', 'description', 'image'] as $column) {
            $query->bindParam(":{$column}", $this->$column);
        }
        if ($query->execute()) {
            MemcacheCache::getInstanse()->flush();
            return $this->getConnection()->lastInsertId();
        }
        return false;
    }

    public function save(int $id)
    {
        // TODO: Implement save() method.
    }

    public function addFake()
    {
        $faker = Factory::create();
        $imageCategory = $faker->randomElement([
            'abstract',
            'animals',
            'business',
            'cats',
            'city',
            'food',
            'nightlife',
            'fashion',
            'people',
            'nature',
            'sports',
            'technics',
            'transport',
        ]);

        $model = (new self());
        $model->title = $faker->name();
        $model->description = $faker->text();
        $model->image = $faker->imageUrl(200, 200, $imageCategory);
        $model->category_id = $faker->randomElement(array_keys(self::getCategories()));
        return $model->add();
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'category' => static::getCategoryLabel($this->category_id),
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'created_at' => $this->created_at,
        ];
    }
}
