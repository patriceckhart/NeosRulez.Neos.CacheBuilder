<?php
namespace NeosRulez\Neos\CacheBuilder\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use NeosRulez\Neos\CacheBuilder\Service\CacheService;

/**
 * @Flow\Scope("singleton")
 */
class CacheCommandController extends CommandController
{

    #[Flow\Inject]
    protected CacheService $cacheService;

    /**
     * Build frontend caches
     *
     * @return void
     */
    public function buildCommand(): void
    {
        $result = $this->cacheService->buildCache();
        if($result) {
            $this->outputLine('Cache build complete.');
        } else {
            $this->outputLine('No sitemaps defined.');
        }
    }

}
