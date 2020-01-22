<?php
declare(strict_types=1);

namespace VUmanskyi\SeoBreadcrumbs;

/**
 * @author Vlad Umanskyi <vladumanskyi@gmail.com>
 * @version  1.0.0
 */
class Items
{
    /**
     * @var array
     */
    protected $list = [];

    /**
     * @var Route
     */
    protected $route;

    /**
     * @var array
     */
    protected $breadcrumbs = [];

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @return mixed
     */
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    /**
     * @codeCoverageIgnore
     * @return Route
     */
    public function getRoute()
    {
        return \Request::route();
    }

    /**
     * @param $name
     * @param $route
     * @param $title
     * @param $parent
     */
    public function push($name, $route, $title, $parent)
    {
        $this->list[] =  [
            'name'   => $name,
            'title'  => $title,
            'url'    => $route,
            'last'   => false,
            'first'   => false,
            'parent' => $parent,
        ];
    }

    public function generate()
    {
        $data = $this->findByRouteName($this->getRoute()->getName());

        if (!empty($data)) {
            $data['last'] = true;
            $this->breadcrumbs[] = $data;
        }

        $this->buildRelationWithParent($data['parent']);
        return array_reverse($this->breadcrumbs);
    }

    /**
     * @codeCoverageIgnore
     * @param string|null $parentName
     */
    protected function buildRelationWithParent(string $parentName = null)
    {
        if (!empty($parentName)) {
            $data = $this->findByRouteName($parentName);
            if (!empty($data)) {
                //Check if this is the first element
                $data['first'] = empty($data['parent']);
                $this->breadcrumbs[] = $data;
            }
            if (!empty($data['parent'])) {
                $this->buildRelationWithParent($data['parent']);
            }
        }
    }

    /**
     * @param string $name
     * @return null|array
     */
    public function findByRouteName(string $name): ?array
    {
        $key = array_search($name, array_column($this->list, 'name'));

        return $key === false ? null : $this->list[$key];
    }

    /**
     * @param null $name
     * @return bool
     */
    public function exists($name = null): bool
    {
        if (is_null($name)) {
            try {
                //get current route name
                $routeData = $this->getRoute();

                if (empty($routeData)) {
                    return false;
                }

                $route[] = $routeData->getName();
                $route[] = array_values($routeData->parameters());
                list($name) = $route;
            } catch (\Exception $e) {
                return false;
            }
        }

        return  $this->findByRouteName($name) !== null;
    }
}