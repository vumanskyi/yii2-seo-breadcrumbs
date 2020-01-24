<?php

namespace umanskyi31\opengraph\test\Unit\src;

use PHPUnit\Framework\TestCase;
use VUmanskyi\SeoBreadcrumbs\SeoBreadcrumbs;
use VUmanskyi\SeoBreadcrumbs\Template;

class SeoBreadcrumbsTest extends TestCase
{
    protected $seoBreadcrumbs;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seoBreadcrumbs = new SeoBreadcrumbs();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf(Template::class, $this->seoBreadcrumbs->getTemplate());
    }

    public function testRun()
    {
        $this->assertTrue(is_string($this->seoBreadcrumbs->run()));
    }
}
