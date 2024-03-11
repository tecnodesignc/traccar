<?php

namespace Modules\Traccar\Repositories\Cache;

use Modules\Traccar\Repositories\TokenRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTokenDecorator extends BaseCacheDecorator implements TokenRepository
{
    public function __construct(TokenRepository $token)
    {
        parent::__construct();
        $this->entityName = 'traccar.tokens';
        $this->repository = $token;
    }
}
