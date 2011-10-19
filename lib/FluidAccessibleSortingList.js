var demo = demo || {};
(function ($, fluid) {
    
    demo.initListReorderer = function () {
        return fluid.reorderList("#demo-selector-listReorderer", {
            styles: {
                defaultStyle: "demo-listReorderer-movable-default",
                selected: "demo-listReorderer-movable-selected",
                dragging: "demo-listReorderer-movable-dragging",
                mouseDrag: "demo-listReorderer-movable-mousedrag",
                hover: "demo-listReorderer-movable-hover",
                dropMarker: "demo-listReorderer-dropMarker",
                avatar: "demo-listReorderer-avatar"
            }
        });
    };
})(jQuery, fluid);
