<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var LeafMapX $LeafMapX */
$LeafMapX = $modx->getService('LeafMapX', 'LeafMapX', MODX_CORE_PATH . 'components/leafmapx/model/');
$modx->lexicon->load('leafmapx:default');

// handle request
$corePath = $modx->getOption('leafmapx_core_path', null, $modx->getOption('core_path') . 'components/leafmapx/');
$path = $modx->getOption('processorsPath', $LeafMapX->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);