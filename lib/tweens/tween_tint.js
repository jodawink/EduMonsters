(function (window, app , sharedObject, undefined) {

    function TweenTint(object, to, bezier, duration, callback) {
        this.initialize(object, to, bezier, duration, callback);
    }
    TweenTint.prototype = new Tween();
    TweenTint.prototype.parentInitialize = TweenTint.prototype.initialize;
    TweenTint.prototype.initialize = function (object, to, bezier, duration, callback) {

        this.parentInitialize(object, to, bezier, duration, callback);


        this.start_tint = new Color(object.tint);
        this.end_tint = new Color(to);
               
        this.timePassed = 0;
    };



    TweenTint.prototype.step = function (dt) {

        this.timePassed += dt;

        var s = this.timePassed / this.duration;

        s = (s >= 1) ? 1.0 : s;

        var bstep = this.bezier ? this.bezier.get(s) : s;
        
        if (s === 1) {
            bstep = 0.9;
        }

        var r = (this.end_tint.red - this.start_tint.red) * bstep + this.start_tint.red;
        var g = (this.end_tint.green - this.start_tint.green) * bstep + this.start_tint.green;
        var b = (this.end_tint.blue - this.start_tint.blue) * bstep + this.start_tint.blue;
        
        this.object.tint = Color.get_color_32(1, r, g, b);
     
        if (s === 1) {
            this.callback(this.object);
            this.stop();
        }

    };

    window.TweenTint = TweenTint;

}(window , app , sharedObject));