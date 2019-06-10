<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var LeafMapX $LeafMapX */
$LeafMapX = $modx->getService('LeafMapX', 'LeafMapX', MODX_CORE_PATH . 'components/leafmapx/model/', $scriptProperties);
if (!$LeafMapX) {
    return 'Could not load LeafMapX class!';
}

$LeafMapX->initialize($ctx, $scriptProperties);

// Do your snippet code here. This demo grabs 5 items from our custom table.
$tpl = $modx->getOption('tpl', $scriptProperties, 'Item');
$sortby = $modx->getOption('sortby', $scriptProperties, 'name');
$sortdir = $modx->getOption('sortbir', $scriptProperties, 'ASC');
$limit = $modx->getOption('limit', $scriptProperties, 5);
$outputSeparator = $modx->getOption('outputSeparator', $scriptProperties, "\n");
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, false);

// Iterate through items
$list = [];
/** @var LeafMapXItem $item */
foreach ($items as $item) {
    $list[] = $modx->getChunk($tpl, $item->toArray());
}

// Output
$output = implode($outputSeparator, $list);
if (!empty($toPlaceholder)) {
    // If using a placeholder, output nothing and set output to specified placeholder
    $modx->setPlaceholder($toPlaceholder, $output);

    return '';
}
// By default just return output
return $output;
