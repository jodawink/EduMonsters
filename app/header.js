(function (window, app, sharedObject, undefined) {

    function Header() {
        this.initialize();
    }

    Header.prototype = new HScreen();
    Header.prototype.screenInitialize = Header.prototype.initialize;

    Header.prototype.initialize = function () {
        this.screenInitialize();

        this.content = new Layer();
        this.addChild(this.content);

    };

    Header.prototype.onFxDown = function (event, sender) {
        Sounds.fx('click');
    };

    Header.prototype.onMusicDown = function (event, sender) {
        Sounds.fx('click');
    };

    Header.prototype.onFxUp = function (event, sender) {
        Sounds._isFXMuted = !Sounds._isFXMuted;
        this.setFxButtonState();
    };

    Header.prototype.onMusicUp = function (event, sender) {
        Config.is_sound_on = !Config.is_sound_on;

        if (Config.is_sound_on) {
            Sounds.audio_full.play();
        } else {
            Sounds.audio_full.pause();
        }

        this.setButtonState();
    };

    Header.prototype.setButtonState = function () {
        if (Config.is_sound_on) {
            this.button.imageNormal = 'music_on';
            this.button.imageSelected = 'music_on';
        } else {
            this.button.imageNormal = 'music_off';
            this.button.imageSelected = 'music_off';
        }
    };

    Header.prototype.setFxButtonState = function () {
        if (!Sounds._isFXMuted) {
            this.fxButton.imageNormal = 'audio_on';
            this.fxButton.imageSelected = 'audio_on';
        } else {
            this.fxButton.imageNormal = 'audio_off';
            this.fxButton.imageSelected = 'audio_off';
        }
    };

    Header.prototype.onShow = function () {
        this.button = this.findById('music-button');
        this.fxButton = this.findById('fx-button');

        this.button.onMouseDown = this.onMusicDown.bind(this);
        this.button.onMouseUp = this.onMusicUp.bind(this);

        this.fxButton.onMouseDown = this.onFxDown.bind(this);
        this.fxButton.onMouseUp = this.onFxUp.bind(this);

        this.setButtonState();
        this.setFxButtonState();
    };

    Header.prototype.onHide = function () {
        app.input.remove(this.button);
        app.input.remove(this.fxButton);
    };

    window.Header = Header; // make it available in the main scope

}(window, app, sharedObject));