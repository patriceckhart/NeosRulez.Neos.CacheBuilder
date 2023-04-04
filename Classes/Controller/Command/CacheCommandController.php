<?php
namespace NeosRulez\Neos\CacheBuilder\Controller\Command;

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
     * @param string|null $sitemap
     * @return void
     */
    public function buildCommand(string|null $sitemap = null): void
    {
        if($sitemap !== null) {
            $this->cacheService->buildCacheOnce($sitemap);
            $this->outputLine('Cache build complete.');
        } else {
            $result = $this->cacheService->buildCache();
            if($result) {
                $this->outputLine('Cache build complete.');
            } else {
                $this->outputLine('No sitemaps defined.');
            }
        }
    }

}
