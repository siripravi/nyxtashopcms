<?php

namespace app\modules\page\helpers;

use Yii;

class CategoryHelper
{
    private static $list = [];

    private static $parents = [];

    private static $childs = [];

    private static $tree = [];

    public static function generateList($enabled)
    {
        $temp = Yii::$app->db->createCommand("SELECT `nxt_page_lang`.`name`, `nxt_page`.`id` FROM `nxt_page`
                LEFT JOIN `nxt_page_lang` ON `nxt_page`.`id`=`nxt_page_lang`.`page_id`
                WHERE `nxt_page_lang`.`lang_id`='en' AND `nxt_page`.`enabled` = ".$enabled." AND `nxt_page`.`type` = 1")
             ->queryAll();

        foreach ($temp as $t) {
            static::$list[$t['id']] = $t['name'];
        }
       // print_r(static::$list);die;
    }

    public static function generateRelation()
    {
        $temp = (new \yii\db\Query())->from('nxt_page_parent')->all();

        foreach ($temp as $t) {
            static::$parents[$t['parent_id']][] = $t['page_id'];
            static::$childs[$t['page_id']][] = $t['parent_id'];
        }
    }

    public static function getTree($enabled)
    {
        $main = [];

        static::$tree = [];

        static::generateRelation();

        static::generateList($enabled);

        foreach (static::$list as $key => $page) {
            if (empty(static::$childs[$key])) {
                $main[] = $key;
            }
        }

        foreach ($main as $m) {
            static::$tree[$m] = static::$list[$m];
            if (!empty(static::$parents[$m])) {
                foreach (static::$parents[$m] as $key2) {
                    if (!empty(static::$list[$key2])) {
                        static::$tree[$key2] = '- ' . static::$list[$key2];
                    }
                    if (!empty(static::$parents[$key2])) {
                        foreach (static::$parents[$key2] as $key3) {
                            if (!empty(static::$list[$key3])) {
                                static::$tree[$key3] = '- - ' . static::$list[$key3];
                            }
                        }
                    }
                }
            }
        }

        return static::$tree;
    }
}