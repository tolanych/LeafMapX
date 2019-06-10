var LeafMapX = function (config) {
    config = config || {};
    LeafMapX.superclass.constructor.call(this, config);
};
Ext.extend(LeafMapX, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('leafmapx', LeafMapX);

LeafMapX = new LeafMapX();