<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var LeafMapX $LeafMapX */
$LeafMapX = $modx->getService('LeafMapX', 'LeafMapX', MODX_CORE_PATH . 'components/leafmapx/model/', $scriptProperties);
if (!$LeafMapX) {
    return 'Could not load LeafMapX class!';
}

$LeafMapX->initialize($ctx, $scriptProperties);

$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl.LeafMapX.item');
$outputSeparator = $modx->getOption('outputSeparator', $scriptProperties, "\n");
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, false);

$list = [];
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
return $output;
