<?php

namespace Directus\Services;

use Directus\Application\Container;

class PagesService extends AbstractExtensionsController
{
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $basePath = $this->container->get('path_base');
        $this->paths = [
            $basePath . '/../www/directus/extensions/core/pages',
            $basePath . '/../www/directus/extensions/custom/pages',
        ];
    }

    public function findAll(array $params = [])
    {
        return $this->all($params);
    }
}
