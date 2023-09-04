(function (window, app , sharedObject, undefined) {

    function LoadingScreen() {
        this.initialize();
    }

    LoadingScreen.prototype = new HScreen();
    LoadingScreen.prototype.screenInitialize = LoadingScreen.prototype.initialize;
    
    LoadingScreen.prototype.initialize = function () {
        this.screenInitialize();

        this.background = new Sprite('white');
        this.background.stretch(app.width,app.height);
        this.background.visible = true;
        this.background.tint = 0x40cde3;
        this.addChild(this.background);

        this.logo = new Sprite('logo');//Put logo image here
        this.logo.scale.set(0.8);
        this.logo.centered();
        
        this.addChild(this.logo);

        this.isAnimating = true;

        _loadingBar = new LoadingBar({
            background: 'white',
            backgroundIsSliced: true,
            backgroundWidth: 600,
            backgroundHeight: 80,
            backgroundPadding: '1 1 1 1',
            backgroundTint: 0x0b6775,

            foreground: 'white',
            foregroundIsSliced: true,
            foregroundWidth: 600,
            foregroundHeight: 80,
            foregroundPadding: '1 1 1 1',
            foregroundTint: 0xbaf6ff,

            offsetX: 0,
            offsetY: 0,

            isAnimated: false,
            animationSpeed: 300,
            showPercent: true
        });
        this.addChild(_loadingBar);

        this.lastLoadedCount = 0;

        this.setPositions();

    };

    LoadingScreen.prototype.setPositions = function () {

        var mid_x = app.width / 2;
        var height = app.height;

        this.logo.position.set(mid_x ,  height * 0.45);
        _loadingBar.position.set(mid_x , height * 0.75); // 300 is half the loading bar width

        this.background.position.set(-10,-10);
        this.background.width = app.width * 1.2;
        this.background.height = app.height * 1.2;
        
    };

    LoadingScreen.prototype.onUpdate = function (dt) {

        var to_load = ContentManager.countToLoad;
        var loaded = ContentManager.countLoaded;
        
        var loading = loaded / to_load;
        loading = (loading <= 0) ? 0.01 : loading;
        loading = (to_load === 0) ? 1 : loading;

        if (loaded && this.lastLoadedCount != loaded) {          
            this.lastLoadedCount = loaded;
            _loadingBar.setPercent(loading , true);
        }

    };

    LoadingScreen.prototype.onResize = function () {
        this.setPositions();
    };

    window.LoadingScreen = LoadingScreen;

}(window , app , sharedObject));