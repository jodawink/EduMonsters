(function (window, app, sharedObject, undefined) {

    function HomeScreen() {
        this.initialize();
    }

    HomeScreen.prototype = new HScreen();
    HomeScreen.prototype.screen_initialize = HomeScreen.prototype.initialize;

    HomeScreen.prototype.initialize = function () {

        this.screen_initialize();

        this.setBackgroundColor('#1B6C97');

        ////////////////////

        this.content = new Layer();
        this.addChild(this.content);
        this.importer = new Importer(this);
        this.importer.importObjects(ContentManager.jsons.home_screen.objects, this.content);

        var monsters = this.findByTag('monster');

        var alphaFilter = new PIXI.filters.AlphaFilter(0.5);
        var filters = [alphaFilter];
        this.monsters = this.findById('monsters');
        this.monsters.filters = filters;

    };


    HomeScreen.prototype.onStudentDown = function (dt) {
        Sounds.fx('click');
    };
    
    HomeScreen.prototype.onTeacherDown = function (dt) {
        Sounds.fx('click');
    };

    HomeScreen.prototype.onTeacherClicked = function (dt) {
        window.open('admin');
    };

    HomeScreen.prototype.onStudentClicked = function (dt) {

        if (!Sounds.audio_full.playing()) {
            Sounds.audio_full.loop(true).play();
        }
        var screen = new CodeScreen();
        app.navigator.add(screen);
    };

    HomeScreen.prototype.onUpdate = function (dt) {

    };

    HomeScreen.prototype.onShow = function () {

    };

    HomeScreen.prototype.onHide = function () {

    };

    window.HomeScreen = HomeScreen;

}(window, app, sharedObject));