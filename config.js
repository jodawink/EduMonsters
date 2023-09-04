var Config = {};
////////////////////////////////////////////////////////////////////////////////
// TYPE variables that will be available everywhere and 
// they will be the same for all servers


////////////////////////////////////////////////////////////////////////////////
//-- START RELEASE DEPPENDENT VARIABLES ----------------------------------------

Config.game_uuid = '';
Config.API_URL = '';

//-- END RELEASE DEPPENDENT VARIABLES ------------------------------------------

///////////////////////////////////////////////////////////////////////////////////////

Config.game_width = 1080; // set the size of the canvas here 
Config.game_height = 1920;

Config.name = 'app'; // Its the name of the running environment

Config.MODE_FLEXIBLE_WIDTH = 0; // it will scale to the same height and adjust the width acordingly
Config.MODE_FLEXIBLE_HEIGHT = 1; // use the same width , but change the height to flll the screen
Config.MODE_STRETCH = 2; // I dont know why I would use this mode
Config.MODE_CENTERED = 3; // it will preserve the aspect ratio an fit into the screen
Config.MODE_NONE = 4; // do not do anything about it
Config.MODE_PADDING = 5; // it will leave some space on the sides
Config.MODE_FLIXIBLE = 6; // it will flex on all sides

Config.window_mode = 3; // set the scaling method
Config.window_mode_mobile = 0; // if you need special mode for mobile devices

Config.is_canvas_auto_layout = true;

Config.canvas_padding = '0 0 0 0'; // top - right - bottom - left

Config.is_sound_on = true; // switch the sound on/off
Config.debug_info = false;
Config.debug = false;
Config.should_clear_stage = false;
Config.slow_motion_factor = 1;
Config.is_game_paused = false;

Config.master_volume = 0.8;

Config.base_url = '';
Config.lang = 'en';
Config.background_color = 0x555555;

Config.ROTATION_MODE_ALLOW = 0;
Config.ROTATION_MODE_HORIZONTAL = 1;
Config.ROTATION_MODE_VERTICAL = 2;

Config.rotation_mode = Config.ROTATION_MODE_ALLOW;

//////////////// KEYBOARD

Config.keyboardFont = 'sf-pro-text-regular';

//Config.keyboardFontWeight = null; // no need
//Config.keyboardFontSize = 30;
//Config.keyboardPreviewScale = 5; // font scale
//Config.keyboardVibrate = true;
//Config.keyboardCellHeight = 80;
//Config.keyboardSpacingX = 8;
//Config.keyboardSpacingY = 16;
//Config.keyboardPreviewBubbleScale = 0.5; // preview bubble scale
//Config.keyboardDoneText = 'Done';
//Config.keyboardNextText = 'Next';
//Config.hasRaisedBed = false;

//////////////////////// TOAST 

//Config.TOAST_TEXTURE = 'rounded-15';
//Config.TOAST_FONT_NAME = 'sf-pro-display-bold';
Config.TOAST_FONT_SIZE = 80;
//Config.TOAST_PADDING = 25;
//Config.TOAST_ALPHA = 0.95;
//Config.TOAST_SUCCESS_BACK_COLOR = 0x16b86c;
//Config.TOAST_SUCCESS_TEXT_COLOR = 0xffffff;
//Config.TOAST_WARRNING_BACK_COLOR = 0xf7a736;
//Config.TOAST_WARRNING_TEXT_COLOR = 0xffffff;
//Config.TOAST_ERROR_BACK_COLOR = 0xcf1d1d;
//Config.TOAST_ERROR_TEXT_COLOR = 0xffffff;

var challenge = JSON.parse('{"2":{"id":2,"name":"quick test 2","code":"QNUX","stages":{"1":{"id":1,"name":"stage 1","required_questions":5,"corect_questions":3,"sets":{"1":{"id":1,"name":"Addition set","questions":[{"id":1,"content":"what is 2 + 2","answers":"[\\"4\\",\\"3\\",\\"2\\",\\"1\\"]","difficulty":1},{"id":2,"content":"what is 2 + 5","answers":"[\\"7\\",\\"6\\",\\"8\\",\\"5\\"]","difficulty":1},{"id":13,"content":"what is 3 + 3 ?","answers":"[\\"6\\",\\"5\\",\\"4\\",\\"7\\"]","difficulty":1},{"id":14,"content":"what is 5 + 3 ?","answers":"[\\"8\\",\\"5\\",\\"4\\",\\"7\\"]","difficulty":1},{"id":26,"content":"what is 4 + 2 ?","answers":"[\\"6\\",\\"7\\",\\"3\\",\\"5\\"]","difficulty":1},{"id":27,"content":"what is 4 + 3 ?","answers":"[\\"7\\",\\"6\\",\\"3\\",\\"5\\"]","difficulty":1},{"id":28,"content":"what is 4 + 1 ?","answers":"[\\"5\\",\\"6\\",\\"3\\",\\"4\\"]","difficulty":1},{"id":29,"content":"what is 5 + 4 ?","answers":"[\\"9\\",\\"6\\",\\"3\\",\\"4\\"]","difficulty":1}]},"3":{"id":3,"name":"multiplication","questions":[{"id":3,"content":"what is 3 x 4","answers":"[\\"12\\",\\"10\\",\\"11\\",\\"14\\"]","difficulty":1},{"id":15,"content":"what is 2 x 2 ?","answers":"[\\"4\\",\\"5\\",\\"3\\",\\"7\\"]","difficulty":1},{"id":16,"content":"what is 3 x 2 ?","answers":"[\\"6\\",\\"5\\",\\"3\\",\\"7\\"]","difficulty":1},{"id":17,"content":"what is 4 x 3 ?","answers":"[\\"12\\",\\"16\\",\\"4\\",\\"43\\"]","difficulty":1},{"id":30,"content":"what is 3 x 5 ?","answers":"[\\"15\\",\\"6\\",\\"5\\",\\"4\\"]","difficulty":1},{"id":31,"content":"what is 5 x 3 ?","answers":"[\\"15\\",\\"6\\",\\"5\\",\\"4\\"]","difficulty":1},{"id":32,"content":"what is 7 x 2 ?","answers":"[\\"14\\",\\"7\\",\\"5\\",\\"4\\"]","difficulty":1}]}}},"2":{"id":2,"name":"STAGE 2","required_questions":5,"corect_questions":4,"sets":{"2":{"id":2,"name":"substruction set","questions":[{"id":4,"content":"what is 3-2","answers":"[\\"1\\",\\"2\\",\\"3\\",\\"4\\"]","difficulty":1},{"id":19,"content":"what is 7 - 5 ?","answers":"[\\"2\\",\\"5\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":11,"content":"What is 10 - 5 ?","answers":"[\\"5\\",\\"3\\",\\"4\\",\\"6\\"]","difficulty":3},{"id":18,"content":"what is 6 - 2 ?","answers":"[\\"4\\",\\"5\\",\\"3\\",\\"2\\"]","difficulty":1},{"id":20,"content":"what is 10 - 5 ?","answers":"[\\"5\\",\\"4\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":21,"content":"what is 11 - 7 ?","answers":"[\\"4\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":22,"content":"what is 10  - 9 ?","answers":"[\\"1\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":23,"content":"what is 10  - 8 ?","answers":"[\\"2\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":24,"content":"what is 9  - 4 ?","answers":"[\\"5\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":25,"content":"what is 9  - 5 ?","answers":"[\\"4\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1}]}}},"90":{"id":90,"name":"Stage 3","required_questions":5,"corect_questions":4,"sets":{"1":{"id":1,"name":"Addition set","questions":[{"id":1,"content":"what is 2 + 2","answers":"[\\"4\\",\\"3\\",\\"2\\",\\"1\\"]","difficulty":1},{"id":2,"content":"what is 2 + 5","answers":"[\\"7\\",\\"6\\",\\"8\\",\\"5\\"]","difficulty":1},{"id":13,"content":"what is 3 + 3 ?","answers":"[\\"6\\",\\"5\\",\\"4\\",\\"7\\"]","difficulty":1},{"id":14,"content":"what is 5 + 3 ?","answers":"[\\"8\\",\\"5\\",\\"4\\",\\"7\\"]","difficulty":1},{"id":26,"content":"what is 4 + 2 ?","answers":"[\\"6\\",\\"7\\",\\"3\\",\\"5\\"]","difficulty":1},{"id":27,"content":"what is 4 + 3 ?","answers":"[\\"7\\",\\"6\\",\\"3\\",\\"5\\"]","difficulty":1},{"id":28,"content":"what is 4 + 1 ?","answers":"[\\"5\\",\\"6\\",\\"3\\",\\"4\\"]","difficulty":1},{"id":29,"content":"what is 5 + 4 ?","answers":"[\\"9\\",\\"6\\",\\"3\\",\\"4\\"]","difficulty":1}]},"2":{"id":2,"name":"substruction set","questions":[{"id":4,"content":"what is 3-2","answers":"[\\"1\\",\\"2\\",\\"3\\",\\"4\\"]","difficulty":1},{"id":19,"content":"what is 7 - 5 ?","answers":"[\\"2\\",\\"5\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":11,"content":"What is 10 - 5 ?","answers":"[\\"5\\",\\"3\\",\\"4\\",\\"6\\"]","difficulty":3},{"id":18,"content":"what is 6 - 2 ?","answers":"[\\"4\\",\\"5\\",\\"3\\",\\"2\\"]","difficulty":1},{"id":20,"content":"what is 10 - 5 ?","answers":"[\\"5\\",\\"4\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":21,"content":"what is 11 - 7 ?","answers":"[\\"4\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":22,"content":"what is 10  - 9 ?","answers":"[\\"1\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":23,"content":"what is 10  - 8 ?","answers":"[\\"2\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":24,"content":"what is 9  - 4 ?","answers":"[\\"5\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1},{"id":25,"content":"what is 9  - 5 ?","answers":"[\\"4\\",\\"9\\",\\"3\\",\\"6\\"]","difficulty":1}]}}}}}}');

Config.initialScreen = 'HomeScreen'; // name of the screen HomeScreen CodeScreen GameScreen FailScreen LevelCompletedScreen ChallengeCompletedScreen
Config.initialScreenArgs = [challenge , 0 ]; // list of arguments to pass to the screen

