(function (window, app, sharedObject, undefined) {

    function CodeScreen() {
        this.initialize();
    }

    CodeScreen.prototype = new HScreen();
    CodeScreen.prototype.screen_initialize = CodeScreen.prototype.initialize;


    CodeScreen.prototype.initialize = function () {

        this.screen_initialize();

        this.setBackgroundColor('#1B6C97');

        ////////////////////

        this.content = new Layer();
        this.addChild(this.content);
        this.importer = new Importer(this);
        this.importer.importObjects(ContentManager.jsons.code_screen.objects, this.content);
        var input = this.findById('code-input');
        input.cursor.tint = 0x000000;
        input.setText('qnux');

    };

    CodeScreen.prototype.onEnterDown = function () {
        Sounds.fx('click');
    };

    CodeScreen.prototype.onEnter = function () {
        this.checkCode();
    };

    CodeScreen.prototype.checkCode = function () {
        var input = this.findById('code-input');
        var data = {code: input.getText()};
        ajaxPost('admin/api/challenge', data, function (response) {
            if (response) {
                sharedObject.setChallenge(response);
                sharedObject.progress = 0;
                var screen = new GameScreen();
                app.navigator.add(screen);
            } else {
                Toast.warrning('Challenge not found');
            }

        });


    };

    CodeScreen.prototype.onUpdate = function (dt) {

    };

    CodeScreen.prototype.onShow = function () {

    };

    CodeScreen.prototype.onHide = function () {

    };

    CodeScreen.prototype.onKeyboardDone = function () {
        this.checkCode();
    };


    window.CodeScreen = CodeScreen;

}(window, app, sharedObject));