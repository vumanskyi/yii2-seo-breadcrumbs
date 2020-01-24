# Yii2.x Seo Breadcrumbs 

[![StyleCI](https://github.styleci.io/repos/235655547/shield?branch=master)](https://github.styleci.io/repos/235655547)

Created a widget for Yii2. This is SeoBreadcrumbs widget which can help your website to set the correct scheme for breadcrumbs

### Installation

```
composer require vumanskyi/seo-breadcrumbs
```


### How to use

In view file :
```php
<?php
    $this->params['breadcrumbs'][] = [
        'label' => 'Home',
        'url' => '/'
    ];

    $this->params['breadcrumbs'][] = [
        'label' => 'Second',
        'url' => '/second'
    ];
    $this->params['breadcrumbs'][] = [
        'label' => 'Last',
    ];

    echo \VUmanskyi\SeoBreadcrumbs\SeoBreadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
    ]);
```

