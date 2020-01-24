<?php
namespace umanskyi31\opengraph\test\Unit\src;

use PHPUnit\Framework\TestCase;
use VUmanskyi\SeoBreadcrumbs\Template;

class TemplateTest extends TestCase
{
    public function testConstruct()
    {
        $params = ['link' => 'test'];
        $template = new Template($params);

        $this->assertEquals($params, $template->getParams());
    }

    /**
     * @dataProvider dataRenderProvider
     * @param $params
     * @param $tag
     * @param $options
     * @param $expected
     */
    public function testRender($params, $tag, $options, $expected)
    {
        $template = new Template($params, $tag, $options);

        $this->assertEquals($expected, $template->render());
    }

    /**
     * @return array
     */
    public function dataRenderProvider(): array
    {
        $result = '<ul itemscope="" itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="/" itemprop="item"><span itemprop="name">Home </span></a>
<meta itemprop="position" content="1"></li>
<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="/second" itemprop="item"><span itemprop="name">Second </span></a>
<meta itemprop="position" content="2"></li>
<li class="active"><span>Last </span></li></ul>';

        $resultOl = '<ol itemscope="" itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="/" itemprop="item"><span itemprop="name">Home </span></a>
<meta itemprop="position" content="1"></li>
<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="/second" itemprop="item"><span itemprop="name">Second </span></a>
<meta itemprop="position" content="2"></li>
<li class="active"><span>Last </span></li></ol>';

        $resultOption= '<ol class="new" itemscope="" itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="/" itemprop="item"><span itemprop="name">Home </span></a>
<meta itemprop="position" content="1"></li>
<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="/second" itemprop="item"><span itemprop="name">Second </span></a>
<meta itemprop="position" content="2"></li>
</ol>';

        $resultTag = '<div class="new" itemscope="" itemtype="http://schema.org/BreadcrumbList"><span>Home</span></div>';
        return [
            [
                [
                    [
                        'label' => 'Home',
                        'url' => '/'
                    ],
                    [
                        'label' => 'Second',
                        'url' => '/second'
                    ],
                    [
                        'label' => 'Last',
                    ]
                ],
                'ul',
                [],
                $result
            ],
            [
                [
                    [
                        'label' => 'Home',
                        'url' => '/'
                    ],
                    [
                        'label' => 'Second',
                        'url' => '/second'
                    ],
                    [
                        'label' => 'Last',
                    ]
                ],
                'ol',
                [],
                $resultOl
            ],
            [
                [
                    [
                        'label' => 'Home',
                        'url' => '/'
                    ],
                    [
                        'label' => 'Second',
                        'url' => '/second'
                    ]
                ],
                'ol',
                ['class' => 'new'],
                $resultOption
            ],
            [
                [
                    [
                        'template' => '<span>{link}</span>',
                        'label' => 'Home',
                        'url' => '/'
                    ]
                ],
                'div',
                ['class' => 'new'],
                $resultTag
            ]
        ];
    }
}