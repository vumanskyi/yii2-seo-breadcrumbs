<?php
declare(strict_types=1);

namespace VUmanskyi\SeoBreadcrumbs;

/**
 * @author Vlad Umanskyi <vladumanskyi@gmail.com>
 * @version  1.0.0
 */
class SeoBreadcrumbs
{
    /**
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * @var Items
     */
    protected $items;

    /**
     * @var Template
     */
    protected $template;

    public function __construct()
    {
        $this->items = new Items();

        $this->template = new Template();
    }

    /**
     * @return Items
     */
    public function getItems(): Items
    {
        return $this->items;
    }

    /**
     * @return Template
     */
    public function getTemplate(): Template
    {
        return $this->template;
    }

    public function render()
    {
        //TODO - in process
    }
}