(function (window, app, sharedObject, undefined) {

    function FailScreen() {
        this.initialize();
    }

    FailScreen.prototype = new HScreen();
    FailScreen.prototype.screen_initialize = FailScreen.prototype.initialize;

    FailScreen.prototype.initialize = function () {

        this.screen_initialize();

        this.setBackgroundColor('#1B6C97');

        ////////////////////

        this.content = new Layer();
        this.addChild(this.content);
        this.importer = new Importer(this);
        this.importer.importObjects(ContentManager.jsons.fail_screen.objects, this.content);

    };

    FailScreen.prototype.onTryAgain = function (dt) {
        Sounds.fx('click');
        sharedObject.progress = 0;
        var screen = new GameScreen();
        app.navigator.add(screen, null, null, function () {
            app.navigator.setCurrentAsRoot();
        });
    };

    FailScreen.prototype.onTryOther = function (dt) {
        Sounds.fx('click');
        sharedObject.progress = 0;
        var screen = new CodeScreen();
        app.navigator.add(screen, null, null, function () {
            app.navigator.setCurrentAsRoot();
        });
    };

    FailScreen.prototype.onUpdate = function (dt) {

    };

    FailScreen.prototype.onShow = function () {

    };

    FailScreen.prototype.onHide = function () {

    };

    window.FailScreen = FailScreen;

}(window, app, sharedObject));