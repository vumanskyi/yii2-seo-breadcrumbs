<?php
declare(strict_types=1);

namespace VUmanskyi\SeoBreadcrumbs\Interfaces;
/**
 * @author Vlad Umanskyi <vladumanskyi@gmail.com>
 * @version  1.0.0
 */
interface TemplateInterface
{
    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @return string
     */
    public function getTag(): string;
}