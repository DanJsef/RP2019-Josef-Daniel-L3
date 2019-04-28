<?php

namespace Directus\Services;

use Directus\Application\Container;

class LayoutsService extends AbstractExtensionsController
{
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $basePath = $this->container->get('path_base');
        $this->paths = [
            $basePath . '/../www/directus/extensions/core/layouts',
            $basePath . '/../www/directus/extensions/custom/layouts',
        ];
    }

    public function findAll(array $params = [])
    {
        return $this->all($params);
    }
}
