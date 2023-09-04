(function (window, app, sharedObject, undefined) {

    function Monster(name) {
        this.initialize(name);
    }

    Monster.prototype = new Sprite();
    Monster.prototype.spriteInitialize = Monster.prototype.initialize;
    Monster.prototype.initialize = function (name) {

        this.spriteInitialize(name);

        this.totalHealth = 0;
        this.health = 0;
        this.isDead = false;

        this.emitter = new Emitter(null, this.parent, Dust, 1 / 20);
    };

    Monster.prototype.setHealth = function (health) {
        this.totalHealth = health;
        this.health = health;

        var baseWidth = 200;

        var width = baseWidth * health;
        var height = 80;

        this.healthBar = new LoadingBar({
            background: 'white',
            backgroundIsSliced: true,
            backgroundWidth: width,
            backgroundHeight: height,
            backgroundPadding: '1 1 1 1',
            backgroundTint: 0x0b6775,

            foreground: 'white',
            foregroundIsSliced: true,
            foregroundWidth: width,
            foregroundHeight: height,
            foregroundPadding: '1 1 1 1',
            foregroundTint: 0xf4971e,

            offsetX: 0,
            offsetY: 0,

            isAnimated: true,
            animationSpeed: 6000,
            showPercent: false
        });

        this.healthBar.setPercent(1, false);
        this.healthBar.y = -this.texture.height / 2;
        this.addChild(this.healthBar);
    };

    Monster.prototype.takeDamage = function (damage) {
        this.health -= damage || 1;
        this.healthBar.setPercent(this.health / this.totalHealth, true);

        if (this.health <= 0) {
            var dis = 200;
            for (var i = 0; i < 8; i++) {
                var explosion = new Explosion();
                explosion.position = this.position;
                explosion.position.x += Math.randomInt(-dis, dis);
                explosion.position.y += Math.randomInt(-dis, dis);
                explosion.scaling = Math.randomFloat(1, 1.5);

                this.parent.addChild(explosion);
                explosion.start(i * 200 + Math.randomInt(-100, 100));
                this.isDead = true;
            }
            this.tint = 0xe0392d;
        } else {
            new TweenBlink(this, 0.5, null, 300).repeat(3).run();
        }

        this.emitter.emissionPoint = new PIXI.Point(100, 100);
        this.emitter.emissionPoint = this.position;
        this.emitter.layer = this.parent;

        this.emitter.start();
        this.emitter.step(300);
        this.emitter.stop();

    };

    Monster.prototype.onUpdate = function (dt) {

    };

    Monster.prototype.onImport = function () {
        // invoked once the object is placed at the scene
    };

    window.Monster = Monster;

}(window, app, sharedObject));