(function (window, undefined) {

    function Dust() {
        this.initialize();
    }

    Dust.prototype = new Sprite();
    Dust.prototype.spriteInitialize = Dust.prototype.initialize;
    Dust.prototype.initialize = function () {

        var particles = ['star'];

        var name = particles[Math.randomInt(0,particles.length-1)];

        this.spriteInitialize(name); // the image name of the particle
        
        //this.blendMode = PIXI.BLEND_MODES.ADD;
//        this.tint = 0x333333;

        this.duration = 900;
        this.total_time = 0;
        this.emitter = null;

        ////////////////////////////////////////////////////////////////////////
        ///////// Set custom properties to the particle


        this.direction = new V(1,1);
        this.trust_magnitude = 0;

        this.begin_scale = 0.3;
        this.end_scale = 0.5;

        this.begin_alpha = 1;
        this.end_alpha = 0.0;
        this.anchor.set(0.5, 0.5);

        
        this.reset();
        
        this.alphaBezier = new Bezier(.67,.04,.84,.14);

    };

    Dust.prototype.reset = function () {

        // RESET YOUR PARTICLE PROPERTIES 

        this.total_time = 0;
        this.scale.set(this.begin_scale);
        this.alpha = (this.begin_alpha);
        this.direction.setAngle(Math.degreesToRadians(Math.randomInt(0,360)));
        this.trust_magnitude = Math.randomInt(100, 800) / 1000;
        this.rotation = Math.degreesToRadians(Math.randomInt(0,360));
     

    };

//    Dust.prototype.on_added_to_parent = function (parent) {
//        Sprite.prototype.on_added_to_parent.call(this, parent);
//
//        // DELETE THIS CODE IF YOU DON'T NEED DISPLACMENT FROM THE EMISSION PONIT 
//        this.alpha = 0;
//        var r1 = Math.random_int(0, 6);
//        var r2 = Math.random_int(0, 6);
//        var pos = this.get_position();
//        this.set_position(pos.x + r1 - 3, pos.y + r2 - 3);
//
//    };

    Dust.prototype.onUpdate = function (dt) {

        this.total_time += dt;
        var t = this.total_time / this.duration;

        if (t > 1.0) {
            this.emitter.recycleParticle(this);
        } else {

            ////////////////////////////////////////////////////////////////////
            ////////////// Particle Behaviour code

            var pos = new V().copy(this.position);

            this.direction.setLength(dt * this.trust_magnitude * (1-t));
            pos.add(this.direction);
            this.position.set(pos.x, pos.y);

            var f = this.begin_scale + (this.end_scale - this.begin_scale) * t;

            var a = this.begin_alpha + (this.end_alpha - this.begin_alpha) * t;

            this.scale.set(f);
            this.alpha = a; // 1 - this.alphaBezier.get(t);

        }

    };

    Dust.prototype.onEmmitted = function () {
        
    };

    window.Dust = Dust;

}(window));