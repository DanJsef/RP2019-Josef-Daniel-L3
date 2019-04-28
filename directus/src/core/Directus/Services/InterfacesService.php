<?php

namespace Directus\Services;

use Directus\Application\Container;

class InterfacesService extends AbstractExtensionsController
{
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $basePath = $this->container->get('path_base');

        $this->paths = [
            $basePath . '/../www/directus/extensions/core/interfaces',
            $basePath . '/../www/directus/extensions/custom/interfaces',
        ];
    }

    public function findAll(array $params = [])
    {
        return $this->all($params);
    }
}
