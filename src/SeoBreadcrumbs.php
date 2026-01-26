<?php

declare(strict_types=1);

namespace VUmanskyi\SeoBreadcrumbs;

use yii\base\Widget;

/**
 * @author Vlad Umanskyi <vladumanskyi@gmail.com>
 *
 * @version  1.0.1
 */
class SeoBreadcrumbs extends Widget
{
    /**
     * @var string
     */
    public const VERSION = '1.0.1';

    /**
     * @var Template
     */
    protected Template $template;

    /**
     * @var string|null the name of the breadcrumb container tag.
     */
    public ?string $tag = null;

    /**
     * @var array the HTML attributes for the breadcrumb container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public array $options = ['class' => 'breadcrumb'];

    /**
     * @var array
     */
    public array $links = [];

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
