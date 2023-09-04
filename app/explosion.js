(function (window, undefined) {

    function Explosion() {
        this.initialize();
    }

    Explosion.prototype = new Sprite();
    Explosion.prototype.spriteInitialize = Explosion.prototype.initialize;
    Explosion.prototype.initialize = function () {

        this.spriteInitialize(null);


        this.layer = new Sprite('white_circle');
        this.layer.centered();
        this.addChild(this.layer);

        this.centered();


        this.maskLayer = new Sprite('mask_hole');

        this.maskLayer.centered();

        this.mask = this.maskLayer;
        this.addChild(this.maskLayer);

        this.scaling = 1.5;
        this.duration = 200;
        this.displace = 20;

        this.begin = 0.5 * this.scaling;
        this.end = 1 * this.scaling;

        this.pos3D = {x: 0, y: 0, z: 0};


        this.layer.visible = false;


    };

    Explosion.prototype.start = function (delay, callback) {

        delay = delay || 0;


        this.maskLayer.position.set(Math.randomInt(-this.displace, this.displace), Math.randomInt(-this.displace, this.displace));

        new Stepper(function (progress) {
            this.layer.visible = true;
            this.layer.scale.set((this.begin + (this.end - this.begin) * progress) * this.scaling);
        }, this.duration, null, null, function () {}, this).delay(delay).run();

        new Stepper(function (progress) {
            this.maskLayer.scale.set((0.5 + 1.5 * progress) * this.scaling);
        }, this.duration + 200, null, null, function () {
            this.removeFromParent();
            if (callback) {
                callback(this);
            }
        }, this).delay(delay).run();

    };

    Explosion.prototype.onUpdate = function (dt) {
        // you could also use postUpdate method
    };

    Explosion.prototype.setData = function (data, extract, importer) {
        // invoked when the object is created while importing to stage
        // extract(key, data) - used get the data set using custom properties in the editor
        // this.setTexture(data.imageName);
    };

    Explosion.prototype.onImport = function (data) {
        // invoked once the object is placed at the scene
    };

    window.Explosion = Explosion;

}(window));