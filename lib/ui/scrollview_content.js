(function (window, app , sharedObject, undefined) {

    function ScrollviewContent(name) {
        this.initialize(name);
    }

    ScrollviewContent.prototype = new Sprite();
    ScrollviewContent.prototype.spriteInitialize = ScrollviewContent.prototype.initialize;
 
    ScrollviewContent.prototype.initialize = function (name) {
        this.spriteInitialize(name); // your image name
        this.TYPE = ScrollviewContent.TYPE;

    };

    ScrollviewContent.prototype.setSize = function (width, height) {
        this._width = width;
        this._height = height;
    };

//    ScrollviewContent.prototype.set_position = function (x, y) {
//
//        var parent = this.get_parent();
//
//        if (parent) {
//            var x_max = parent.__width - parent.content_width;
//            x = (x > 0) ? 0 : x;
//            x = (x < x_max) ? x_max : x;
//
//            var y_max = parent.__height - parent.content_height;
//            
//            y = (y > 0) ? 0 : y;
//            y = (y < y_max) ? y_max : y;
//        }
//
//        Sprite.prototype.set_position.call(this, x, y);
//    };

    ScrollviewContent.prototype.onUpdate = function (dt) {
       // Sprite.prototype.update.call(this, dt);
    };

    window.ScrollviewContent = ScrollviewContent;

}(window , app , sharedObject));