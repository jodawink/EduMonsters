(function (window, app, sharedObject, undefined) {

    function LevelCompletedScreen() {
        this.initialize();
    }

    LevelCompletedScreen.prototype = new HScreen();
    LevelCompletedScreen.prototype.screen_initialize = LevelCompletedScreen.prototype.initialize;


    LevelCompletedScreen.prototype.initialize = function () {

        this.screen_initialize();

        this.setBackgroundColor('#1B6C97');

        ////////////////////

        this.content = new Layer();
        this.addChild(this.content);
        this.importer = new Importer(this);
        this.importer.importObjects(ContentManager.jsons.level_completed_screen.objects, this.content);


    };

    LevelCompletedScreen.prototype.onUpdate = function (dt) {

    };

    LevelCompletedScreen.prototype.onShow = function () {

    };

    LevelCompletedScreen.prototype.onHide = function () {

    };

    LevelCompletedScreen.prototype.onNextLevel = function (event, element) {
        Sounds.fx('click');
        var screen = new GameScreen();
        app.navigator.add(screen , null , null , function () {
            app.navigator.setCurrentAsRoot();
        });
    };


    window.LevelCompletedScreen = LevelCompletedScreen;

}(window, app, sharedObject));