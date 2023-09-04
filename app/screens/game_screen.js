(function (window, app, sharedObject, undefined) {

    function GameScreen(challenge, progress) {
        this.initialize(challenge, progress);
    }

    GameScreen.prototype = new HScreen();
    GameScreen.prototype.screenInitialize = GameScreen.prototype.initialize;

    GameScreen.prototype.initialize = function (challenge, progress) {

        this.screenInitialize();
        this.setBackgroundColor('#1B6C97');

        if (challenge) {
            sharedObject.setChallenge(challenge);
            sharedObject.progress = progress;
        }
        
        this.level = sharedObject.challenge.stages[sharedObject.progress];

        ////////////////////

        this.content = new Layer();
        this.addChild(this.content);
        this.importer = new Importer(this);
        this.importer.importObjects(ContentManager.jsons.game_screen.objects, this.content);

        this.monster = this.findById('monster');
        this.questionLabel = this.findById('question-label');
        this.progressLabel = this.findById('progress');
        this.titleLabel = this.findById('title');
        this.healthLabel = this.findById('health-label');

        this.levelClearedLabel = this.findById('level-cleared');
        this.levelClearedLabel.alpha = 0;

        this.answer1 = this.findById('answer-1');
        this.answer2 = this.findById('answer-2');
        this.answer3 = this.findById('answer-3');
        this.answer4 = this.findById('answer-4');

        this.answerLabels = [
            this.answer1,
            this.answer2,
            this.answer3,
            this.answer4
        ];

        this.orderedAnswerLabels = [
            this.answer1,
            this.answer2,
            this.answer3,
            this.answer4
        ];

        this.answer1.label.txt = "";
        this.answer2.label.txt = "";
        this.answer3.label.txt = "";
        this.answer4.label.txt = "";

        this.monsterLayer = this.monster.parent;
        this.monsterPosition = new PIXI.Point().copyFrom(this.monster.position);
        this.monster.removeFromParent();
        this.monster = null;
        
        this.titleLabel.txt = this.level.name;

        this.currentQuestion = 0;
        this.correctAnswers = 0;
        this.wrongAnswers = 0;
        this.totalQuestions = this.level.required;
        this.requiredToPass = this.level.corect;

        this.totalMonsters = 0;

        this.monsters = [];
        this.generateMonsters();
        this.loadNextQuestion();

        this.loadMonster();

        this.updateProgress();

        var width = 500;
        var height = 80;

        this.healthBar = new LoadingBar({
            background: 'white',
            backgroundIsSliced: true,
            backgroundWidth: width,
            backgroundHeight: height,
            backgroundPadding: '1 1 1 1',
            backgroundTint: 0x0b6775,

            foreground: 'white',
            foregroundIsSliced: true,
            foregroundWidth: width,
            foregroundHeight: height,
            foregroundPadding: '1 1 1 1',
            foregroundTint: 0x68cedc,

            offsetX: 0,
            offsetY: 0,

            isAnimated: true,
            animationSpeed: 6000,
            showPercent: false
        });

        this.healthBar.setPercent(1, false);
        this.healthLabel.position.set(-app.width / 2 + 20, app.height - 110);
        this.healthBar.position.set(this.healthLabel.x + this.healthLabel.width + 20 + width / 2, app.height - 110);
        this.healthLabel.parent.addChild(this.healthBar);

        this.hit = new Sprite('hit');
        this.hit.stretch(app.width, app.height);
        this.hit.visible = false;
        this.addChild(this.hit);

    };

    GameScreen.prototype.loadMonster = function () {
        if (this.monster) {
            this.removeMonster(() => {
                timeout(() => {
                    this.addMonster();
                }, 200);
            });
        } else {
            this.addMonster();
        }
    };

    GameScreen.prototype.updateProgress = function () {
        this.progressLabel.text = 'Monster '+(this.totalMonsters - this.monsters.length) + '/' + this.totalMonsters;
    };

    GameScreen.prototype.removeMonster = function (callback) {
        var bezier = new Bezier(.64, .26, .93, .66);
        new TweenAlpha(this.monster, 0, bezier, 600).run();
        new TweenMoveTo(this.monster, new PIXI.Point(this.monster.x, this.monster.y - 100), bezier, 200, () => {
            new TweenMoveTo(this.monster, new PIXI.Point(this.monster.x, this.monster.y + 600), bezier, 400, callback).run();
        }).run();
    };

    GameScreen.prototype.addMonster = function () {
        this.monster = this.monsters.pop();
        this.monster.anchor.set(0.5, 0.5);
        this.monster.scale.set(0.4);
        this.monster.position.set(this.monsterPosition.x, this.monsterPosition.y);
        this.monsterLayer.addChild(this.monster);

        this.monster.alpha = 0;
        new TweenAlpha(this.monster, 1, null, 200).run();

        Actions.stopByTag('monster');
        new TweenFloat(this.monster, 10, null, 1200).run('monster');

        this.updateProgress();
    };

    GameScreen.prototype.generateMonsters = function () {
        // available monsters are from health 1 , to health 8

        var from = 1;
        var to = 8;

        if (sharedObject.progress === 0) {
            to = 3;
        } else if (sharedObject.progress === 1) {
            to = 5;
        } else if (sharedObject.progress === 2) {
            to = 7;
        }

        var remaningPoints = this.requiredToPass;
        var allPoints = [];

        while (remaningPoints > 0) {
            var points = Math.randomInt(from, to);
            if (remaningPoints - points >= 0) {
                remaningPoints -= points;
                allPoints.push(points);
            }
        }

        Math.bubbleSort(allPoints, function (a, b) {
            return a < b;
        });

        // try to sum them up if there are too many monsters

        for (var i = 0; i < allPoints.length; i++) {
            var p = allPoints[i];
            var monster = new Monster('monster-' + p);
            monster.setHealth(p);
            this.monsters.push(monster);
        }

        this.totalMonsters = this.monsters.length;
    };

    GameScreen.prototype.loadNextQuestion = function () {
        let question = this.level.questions[this.currentQuestion++];

        for (var i = 0; i < this.orderedAnswerLabels.length; i++) {
            var answer = this.orderedAnswerLabels[i];
            new TweenAlpha(answer, 1, null, 300).delay(i * 200).run();
        }

        new TweenAlpha(this.questionLabel, 1, null, 200).run();

        if (question) {
            this.questionLabel.text = question.content;
            var answers = JSON.parse(question.answers);
            shuffleArray(this.answerLabels);

            for (var i = 0; i < this.answerLabels.length; i++) {
                var answerLabel = this.answerLabels[i];
                answerLabel.label.text = answers[i];
                answerLabel.tag = i;
            }

            this.disableButtons(false);

            return true;
        }

        return false;
    };

    GameScreen.prototype.onAnswerDown = function (event, sender) {
        Sounds.fx('click');
    };

    GameScreen.prototype.onAnswer = function (event, sender) {
        this.disableButtons(true);

        if (sender.tag === 0) {
            this.onCorrectAnswer();
        } else {
            this.onWrongAnswer();
        }
    };

    GameScreen.prototype.onCorrectAnswer = function () {
        this.correctAnswers++;
        new TweenShake(this, 5, 1 / 2, null, 100).run();
        this.monster.takeDamage();

        timeout(() => {
            for (var i = 0; i < this.orderedAnswerLabels.length; i++) {
                var answer = this.orderedAnswerLabels[i];
                new TweenAlpha(answer, 0, null, 200).delay(i * 100).run();
            }
            new TweenAlpha(this.questionLabel, 0, null, 200).run();
        }, 600);

        var timer = 1000;

        Sounds.fx('positive-4');

        if (this.monster.isDead) {
            Actions.stopByTag('monster');

            if (this.monsters.length === 0) {
                //no more monsters
                timeout(() => {
                    this.onLevelFinished();
                }, 2000);

                timeout(() => {
                    Sounds.fx('monster_death_1');
                }, timer);

                return;
            }
        }

        timeout(() => {
            if (this.monster.isDead) {
                Sounds.fx('monster_death_1');
                this.loadMonster();
            }

            if (this.loadNextQuestion()) {

            } else {

                this.onLevelFinished();
            }
        }, timer);

    };

    GameScreen.prototype.onWrongAnswer = function () {

        // check if it failed 
        this.takeDamage();

        var availableHealth = this.totalQuestions - this.requiredToPass;

        var hasFailed = this.wrongAnswers >= availableHealth;

        var jumpBezier = new Bezier(.31, .8, .66, .99);
        var fallBezier = new Bezier(.76, .22, .95, .66);

        if (hasFailed) {

            if (!Sounds._isFXMuted) {
                Sounds.audio_full.pause();
                Sounds['fail'].volume(0.4).once('end', function () {
                    if (Config.is_sound_on) {
                        Sounds.audio_full.fade(0, 1, 200).play();
                    }
                }).play();
            }

            for (var i = 0; i < this.orderedAnswerLabels.length; i++) {
                var answer = this.orderedAnswerLabels[i];
                let x = Math.randomInt(-100, 100);
                new TweenMoveTo(answer, {x: answer.x + x, y: answer.y - Math.randomInt(100, 150)}, jumpBezier, 200, function (object) {
                    new TweenMoveTo(object, {x: answer.x + x, y: answer.y + 800}, fallBezier, 600).run();
                }).delay(i * 100).run();

                new TweenRotateBy(answer, Math.degreesToRadians(Math.randomInt(-30, 30)), null, 1200).run();
            }
            new TweenAlpha(this.questionLabel, 0, null, 200).run();

            this.onGameOver();
        } else {

            Sounds.fx('negative');
            timeout(() => {
                for (var i = 0; i < this.orderedAnswerLabels.length; i++) {
                    var answer = this.orderedAnswerLabels[i];
                    new TweenAlpha(answer, 0, null, 200).delay(i * 100).run();
                }
                new TweenAlpha(this.questionLabel, 0, null, 200).run();
            }, 600);

            timeout(() => {
                if (this.loadNextQuestion()) {

                } else {
                    this.onLevelFinished();
                }
            }, 1000);
        }

    };

    GameScreen.prototype.isLevelWin = function () {
        return this.correctAnswers >= this.requiredToPass;
    };

    GameScreen.prototype.onLevelFinished = function () {
        Sounds.fx('cheering');
        this.onLevelCompleted();
    };

    GameScreen.prototype.onLevelCompleted = function () {

        // DO animation here
        this.removeMonster();

        this.levelClearedLabel.alpha = 1;
        new TweenBlink(this.levelClearedLabel, 0, null, 100).repeat(6).run();

        timeout(() => {
            var hasNextLevel = sharedObject.challenge.stages[sharedObject.progress + 1];
            if (hasNextLevel) {
                sharedObject.progress++;
                var screen = new LevelCompletedScreen();
                app.navigator.add(screen);
            } else {
                var screen = new ChallengeCompletedScreen();
                app.navigator.add(screen);
            }
        }, 1600);
    };

    GameScreen.prototype.onGameOver = function (dt) {
//        Toast.error("You failed to complete this level");
        timeout(() => {
            var screen = new FailScreen();
            app.navigator.add(screen);
        }, 1600);
    };

    GameScreen.prototype.onUpdate = function (dt) {

    };

    GameScreen.prototype.onShow = function () {

    };

    GameScreen.prototype.onHide = function () {
        Actions.stopByTag('monster');
    };

    GameScreen.prototype.disableButtons = function (disable) {
        for (var i = 0; i < this.answerLabels.length; i++) {
            var a = this.answerLabels[i];
            a.isTouchable = !disable;
        }
    };

    GameScreen.prototype.takeDamage = function () {
        this.hit.visible = true;
        this.hit.alpha = 0.8;
        new TweenAlpha(this.hit, 0, new Bezier(.82, .2, .92, .62), 600, () => {
            this.hit.visible = false;
        }).run();

        this.wrongAnswers++;
        var availableHealth = this.totalQuestions - this.requiredToPass;

        var layer = this.findByName('default');
        new TweenShake(layer, 10, 1 / 2, null, 200).run();

        var percent = 1 - (this.wrongAnswers / availableHealth);
        this.healthBar.setPercent(percent, true);
    };

    window.GameScreen = GameScreen; // make it available in the main scope

}(window, app, sharedObject));