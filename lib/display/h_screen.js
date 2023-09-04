(function (window, app, sharedObject, undefined) {

    function HScreen() {
        this.initialize();
    }

    HScreen.prototype = Object.create(PIXI.Container.prototype);
    HScreen.prototype.constructor = HScreen;

    HScreen.prototype.initialize = function () {

        PIXI.Container.call(this);
        this.enableSensor();
        this._touchables = [];
        this._viewComponents = [];
        this.isPaused = false;

        if (typeof app !== null) {
            this.setSensorSize(app.width, app.height);

            this._background = new Sprite();
            this._background.texture = PIXI.Texture.WHITE;
            this._background.zIndex = -1;
            this._background.visible = false;
            this._background.stretch(app.width, app.height);
            this.addChild(this._background);
        }

        this.constraints = new Constraints(this);

    };

    HScreen.prototype.setBackgroundColor = function (color) {
        if (color) {
            this._background.tint = convertColor(color);
            this._background.visible = true;
        } else {
            this._background.visible = false;
        }
    };

    HScreen.prototype.activateTouchables = function () {
        app.input.add(this._touchables);
    };

    HScreen.prototype.deactivateTouchables = function () {
        app.input.remove(this._touchables);
    };

    /**
     * The object is instantly added to the app.input , and it is 
     * registered in the _touchables Array , it is then manages on 
     * the methods onShow/onHide
     * @param {Object} touchable 
     */
    HScreen.prototype.addTouchable = function (touchable) {
        app.input.add(touchable);
        this._touchables.push(touchable);
    };

    HScreen.prototype.removeTouchable = function (touchable) {
        app.input.remove(touchable);

        var ind = this._touchables.indexOf(touchable);
        if (ind !== -1) {
            this._touchables.splice(ind, 1);
        }

    };
    HScreen.prototype._onShow = function () {
        this.onShow();

        for (var i = 0; i < this._viewComponents.length; i++) {
            var viewComponent = this._viewComponents[i];
            if (viewComponent.onShow) {
                viewComponent.onShow();
            }
        }
    };

    HScreen.prototype._onHide = function () {
        this.onHide();

        for (var i = 0; i < this._viewComponents.length; i++) {
            var viewComponent = this._viewComponents[i];
            if (viewComponent.onHide) {
                viewComponent.onHide();
            }
        }
    };

    HScreen.prototype.onShow = function () {
        // triggered after the animation ends
    };

    HScreen.prototype.onHide = function () {
        // triggered before the animation starts
    };

    HScreen.prototype.onBeforeShow = function () {
        // triggered before the animation starts
    };

    HScreen.prototype.onAfterHide = function () {
        // triggered after the animation ends
    };

    HScreen.prototype.onAnimationEnd = function () {
        //TODO remove this one
    };

    HScreen.prototype.onUpdate = function (dt) {

    };

    HScreen.prototype.postUpdate = function (dt) {

    };

    HScreen.prototype.updateChildren = function (dt, children) {

        Math.insertionSort(children, function (a, b) {
            return a.zIndex > b.zIndex;
        });

        var i = children.length;

        while (i-- > 0) {
            var child = children[i];

            if (!child.visible) {
                continue;
            }

            child.onUpdate(dt);
            if (child) {
                this.updateChildren(dt, child.children);
            }
            child.postUpdate(dt);
        }

    };

    HScreen.prototype.onVisibilityChange = function (isVisible) {

    };

    HScreen.prototype._onResize = function (width, height) {
        this.setSensorSize(width, height);
        this.constraints.applyValues();

        if (this.onResize) {
            this.onResize(width, height);
        }

    };

    HScreen.prototype.onDestroy = function () {
        // triggered when the screen is no more used
    };

    HScreen.prototype.goBack = function () {
        app.navigator.goBack();
    };

    HScreen.prototype.goTo = function (screenName) {
        if (!window[screenName]) {
            console.warn("Screen name does not exist: " + screenName);
        } else {
            var screen = new window[screenName]();
            app.navigator.add(screen);
        }

    };


    window.HScreen = HScreen;

}(window, app, sharedObject));