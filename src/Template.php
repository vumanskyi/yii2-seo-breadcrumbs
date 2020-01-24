<?php

declare(strict_types=1);

namespace VUmanskyi\SeoBreadcrumbs;

use yii\helpers\Html;

/**
 * @author Vlad Umanskyi <vladumanskyi@gmail.com>
 *
 * @version  1.0.0
 */
class Template
{
    /**
     * @var string
     */
    const REPLACE_CONTENT = '{link}';

    /**
     * @var string
     */
    protected $tag = 'ul';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * There are default options for SEO.
     *
     * @var array
     */
    protected $defaultOptions = [
        'itemscope' => '',
        'itemtype'  => 'http://schema.org/BreadcrumbList',
    ];

    /**
     * @var string
     */
    protected $template = "<li itemprop=\"itemListElement\" itemscope=\"\" itemtype=\"http://schema.org/ListItem\">{link}</li>\n";

    /**
     * @var string
     */
    protected $activeTemplate = '<li class="active">{link}</li>';

    /**
     * @param array  $params
     * @param string $tag
     * @param array  $options
     */
    public function __construct(array $params = [], string $tag = 'ul', array $options = [])
    {
        $this->params = $params;

        $this->tag = $tag;

        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        if (!$this->getParams()) {
            return '';
        }

        $params = $this->getParams();

        $links = [];
        $itempropPosition = 1;

        foreach ($params as $param) {
            if (!empty($param['template'])) {
                $links[] = strtr($param['template'], [self::REPLACE_CONTENT => $param['label']]);
            } elseif (empty($param['url'])) {
                $span = '<span>'.$param['label'].' </span>';
                $links[] = strtr($this->activeTemplate, [self::REPLACE_CONTENT => $span]);
            } else {
                $span = '<span itemprop="name">'.$param['label'].' </span>';
                $content = Html::a($span, $param['url'], ['itemprop' => 'item']).PHP_EOL.'<meta itemprop="position" content="'.$itempropPosition.'">';
                $links[] = strtr($this->template, [self::REPLACE_CONTENT => $content]);
            }

            $itempropPosition++;
        }

        $options = array_merge($this->options, $this->defaultOptions);

        return Html::tag($this->tag, implode('', $links), $options);
    }
}
