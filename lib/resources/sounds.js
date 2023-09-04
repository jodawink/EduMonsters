(function (window, undefined) {

    function Sounds() {
        throw 'cant initialize sounds';
    }

    Sounds._isFXMuted = false;
    Sounds.fx = function (key, volume = 1) {
        if (!Sounds._isFXMuted) {
            return Sounds[key].volume(volume).play();
        }
    };

    window.Sounds = Sounds;

}(window, app, sharedObject));