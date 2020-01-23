<?php
declare(strict_types=1);

namespace VUmanskyi\SeoBreadcrumbs;

use yii\helpers\Html;

/**
 * @author Vlad Umanskyi <vladumanskyi@gmail.com>
 * @version  1.0.0
 */
class Template
{
    /**
     * @var string
     */
    protected $tag = 'ul';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Use default params
     *
     * @var boolean
     */
    protected $default = true;

     /**
     * @var string
     */
    protected $template = "<li>{link}</li>\n";

    /**
     * @var string
     */
    protected  $activeTemplate = '<li class="active">{link}</li>\n';

    /**
     * @param array $params
     * @param string $tag
     * @param boolean $default
     */
    public function __construct(array $params = [], string $tag = 'ul', bool $default = true)
    {
        $this->params = $params;

        $this->tag = $tag;

        $this->default = $default;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    public function render()
    {
        if (!$this->getParams()) {
            return '';
        }

        $params = $this->getParams();

        $links = [];
        foreach ($params as $param) {
            if (!empty($param['template'])) {
                $links[] = strtr($param['template'], ['{link}' => $param['label']]);
            } else {
                $links[] = '<li>' . Html::a($param['label'], $param['url']) . '</li>';
            }
        }

        return Html::tag($this->tag, implode('', $links));
    }
}