<?php

class LeafMapX
{
    /** @var modX $modx */
    public $modx;
    public $initialized = array();
    public $maps = array();

    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;
        $corePath = MODX_CORE_PATH . 'components/leafmapx/';
        $assetsUrl = MODX_ASSETS_URL . 'components/leafmapx/';

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
        ], $config);

        //$this->modx->addPackage('leafmapx', $this->config['modelPath']);
        $this->modx->lexicon->load('leafmapx:default');
    }

    public function initialize($ctx = 'web', $scriptProperties = array())
    {
        $this->config = array_merge($this->config, $scriptProperties);
        $this->config['ctx'] = $ctx;

        if (empty($this->config['target'])) {
            $this->config['target'] = 'map';
        }
        if (empty($this->initialized[$ctx])) {
            $config_js = array(
                'ctx' => $ctx,
                'jsUrl' => $this->config['jsUrl'] . 'web/',
                'cssUrl' => $this->config['cssUrl'] . 'web/',
                'actionUrl' => $this->config['actionUrl'],
                'maps' => []
            );
            $this->modx->regClientStartupScript('<script type="text/javascript">if (typeof LeafMapConfig == "undefined") { LeafMapConfig = ' . json_encode($config_js) . '; }</script>',
                true);
            $this->modx->regClientScript($this->config['jsUrl'] . 'web/leafmapx.js');
            $this->modx->regClientCSS($this->config['cssUrl'] . 'web/leafmapx.css');

            $this->initialized[$ctx] = true;
        }

        // for multiply map instances on page
        if (empty($this->maps[$this->config['target']])) {
            $config_js = array(
                'target' => $this->config['target'],
                'startPoint' => $this->config['startPoint'] ?? '0.0, 0.0',
                'startZoom' => $this->config['startZoom'] ? $this->config['startZoom'] : '15',
                'tiles' => $this->config['tiles'] ?? 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                'layers' => $this->config['layers'] ? $this->config['layers'] : [],
            );
            $target = 'LeafMapConfig.maps["'.$this->config['target'].'"]';

            $this->modx->regClientStartupScript('<script type="text/javascript">if (typeof ' . $target . ' == "undefined") { ' . $target . '=' . json_encode($config_js) . '; }</script>',
                true);

            $this->maps[$this->config['target']] = true;
        }
    }
}
