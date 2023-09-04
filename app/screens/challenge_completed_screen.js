(function (window, app, sharedObject, undefined) {

    function ChallengeCompletedScreen() {
        this.initialize();
    }

    ChallengeCompletedScreen.prototype = new HScreen();
    ChallengeCompletedScreen.prototype.screen_initialize = ChallengeCompletedScreen.prototype.initialize;


    ChallengeCompletedScreen.prototype.initialize = function () {

        this.screen_initialize();

        this.setBackgroundColor('#1B6C97');

        ////////////////////

        this.content = new Layer();
        this.addChild(this.content);
        this.importer = new Importer(this);
        this.importer.importObjects(ContentManager.jsons.challenge_completed_screen.objects, this.content);


    };

    ChallengeCompletedScreen.prototype.onUpdate = function (dt) {

    };

    ChallengeCompletedScreen.prototype.onShow = function () {

    };

    ChallengeCompletedScreen.prototype.onHide = function () {

    };

    ChallengeCompletedScreen.prototype.onNextChallenge = function () {
        Sounds.fx('click');
        var screen = new HomeScreen();
        app.navigator.add(screen, null, null, function () {
            app.navigator.setCurrentAsRoot();
        });
    };

    window.ChallengeCompletedScreen = ChallengeCompletedScreen;

}(window, app, sharedObject));
