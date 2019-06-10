<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/LeafMapX/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/leafmapx')) {
            $cache->deleteTree(
                $dev . 'assets/components/leafmapx/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/leafmapx/', $dev . 'assets/components/leafmapx');
        }
        if (!is_link($dev . 'core/components/leafmapx')) {
            $cache->deleteTree(
                $dev . 'core/components/leafmapx/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/leafmapx/', $dev . 'core/components/leafmapx');
        }
    }
}

return true;