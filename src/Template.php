<?php
declare(strict_types=1);

namespace VUmanskyi\SeoBreadcrumbs;

use VUmanskyi\SeoBreadcrumbs\Interfaces\TemplateInterface;

/**
 * @author Vlad Umanskyi <vladumanskyi@gmail.com>
 * @version  1.0.0
 */
class Template implements TemplateInterface
{
    /**
     * The HTML attributes for the breadcrumb container tag.
     * @var array
     */
    protected $options = ['class' => 'breadcrumb'];

    /**
     * @var string
     */
    protected $tag = 'ul';

    /**
     * @var string render inactive item template
     */
    protected $itemTemplate = "<li itemscope=\"\" itemtype=\"//data-vocabulary.org/Breadcrumb\">{link}</li>\n";

    /**
     * @var string active item template
     */
    protected $activeItemTemplate = "<li class=\"active\">{link}</li>\n";

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return TemplateInterface
     */
    public function options(array $options): TemplateInterface
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return TemplateInterface
     */
    public function tag(string $tag): TemplateInterface
    {
        $this->tag = $tag;

        return $this;
    }

}