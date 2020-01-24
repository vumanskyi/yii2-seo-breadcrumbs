<?php

declare(strict_types=1);

namespace VUmanskyi\SeoBreadcrumbs;

use yii\base\Widget;

/**
 * @author Vlad Umanskyi <vladumanskyi@gmail.com>
 *
 * @version  1.0.0
 */
class SeoBreadcrumbs extends Widget
{
    /**
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * @var Template
     */
    protected $template;

    /**
     * @var string the name of the breadcrumb container tag.
     */
    public $tag;

    /**
     * @var array the HTML attributes for the breadcrumb container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'breadcrumb'];

    /**
     * @var array
     */
    public $links = [];

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->template = new Template($this->links, $this->tag ?? 'ul', $this->options);
    }

    /**
     * @return Template
     */
    public function getTemplate(): Template
    {
        return $this->template;
    }

    /**
     * Render.
     */
    public function run()
    {
        return $this->getTemplate()->render();
    }
}
