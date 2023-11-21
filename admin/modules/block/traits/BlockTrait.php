<?php

namespace admin\modules\block\traits;

use admin\modules\block\models\Block;

trait BlockTrait
{
    public function render($view, $params = [])
    {
        $content = parent::render($view, $params);

        return $this->renderBlock($content);
    }

    private function renderBlock($content)
    {
        if (preg_match_all('/\{([0-9a-zA-Z_\-]+?)\}/', $content, $matches)) {
            foreach ($matches[1] as $match) {
                if ($block = Block::find()->where(['name' => $match])->one()) {
                    $html = "";
                    if ($block->enabled) {
                        $html = $this->renderBlock($block->html);
                    }
                    $content = preg_replace('/\{' . $match . '\}/', $html, $content);
                }
            }
        }
        return $content;
    }
}