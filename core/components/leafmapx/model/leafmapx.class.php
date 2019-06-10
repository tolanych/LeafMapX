<?php

class LeafMapX
{
    /** @var modX $modx */
    public $modx;


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
        if (empty($this->initialized[$ctx])) {
            $config_js = array(
                'ctx' => $ctx,
                'jsUrl' => $this->config['jsUrl'] . 'web/',
                'cssUrl' => $this->config['cssUrl'] . 'web/',
                'actionUrl' => $this->config['actionUrl'],
                'startPoint' => $this->config['startPoint'],
                'layers' => $this->config['layers'],
            );
            $this->modx->regClientStartupScript('<script type="text/javascript">LeafMapConfig=' . json_encode($config_js) . ';</script>',
                true);
            $this->modx->regClientScript($this->config['jsUrl'] . 'web/leafmapx.js');
            $this->modx->regClientCSS($this->config['jsUrl'] . 'web/leafmapx.css');

            $this->initialized[$ctx] = true;
        }
    }
}