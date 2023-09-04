<?php

define('DS', DIRECTORY_SEPARATOR);
$main_dir = getcwd() . DS . '..' . DS . 'assets';

$content = "";

function stringContains($haystack, $needle) {
    return strpos($haystack, $needle) !== false;
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

function beforeComma($string) {

    return substr($string, 0, strrpos($string, '.'));
}

function create_url($dir) {
    global $main_dir;
    $url = str_replace($main_dir, '', $dir);
    $url = str_replace(DS, "/", $url);
    return 'assets' . $url . '/';
}

function listFolderFiles($dir) {
    $ffs = scandir($dir);
    global $main_dir, $content;
    foreach ($ffs as $ff) {
        if ($ff != '.' && $ff != '..') {

            /////////////////////////
            // files to skip

            if ((startsWith($ff, 'assets') and endsWith($ff, '.js')) || $ff === "css") { // $ff === "assets.js"
                // do nothing   
            } else {

                if (endsWith($dir, DS . 'spine')) {
                    if (endsWith($ff, '.png')) {
                        $basic = beforeComma($ff);
                        $content .= "ContentManager.addSpine('" . $basic . "');\n";
                    }
                } else if (stringContains($dir, 'sounds' . DS . 'effects')) {
                    if (endsWith($ff, '.webm')) {
                        $basic = beforeComma($ff);
                        $content .= "ContentManager.addSound('" . $basic . "',['" . create_url($dir) . $basic . ".webm','" . create_url($dir) . $basic . ".mp3']);\n";
                    }
                } else if (stringContains($dir, 'sounds' . DS . 'music')) {
                    if (endsWith($ff, '.webm')) {
                        $basic = beforeComma($ff);
                        $content .= "ContentManager.addAudio('" . $basic . "',['" . create_url($dir) . $basic . ".webm','" . create_url($dir) . $basic . ".mp3']);\n";
                    }
                } else if (endsWith($dir, DS . 'fonts')) {
                    if (endsWith($ff, '.ttf')) {
                        $basic = beforeComma($ff);
                       // $content .= "ContentManager.addFont('" . $basic . "','" . create_url($dir) . $ff . "',{ xhrType: PIXI.loaders.Resource.XHR_RESPONSE_TYPE.DOCUMENT});\n";
                    } else if (endsWith($ff, '.fnt')) {
                        $basic = beforeComma($ff);
                        $content .= "ContentManager.addBitmapFont('" . $basic . "','" . create_url($dir) . $ff . "');\n";
                    }
                } else if (stringContains($dir, 'assets' . DS . 'images' . DS . "atlases")) {
                    if (endsWith($ff, '.png')) {
                        $basic = beforeComma($ff);
                        $content .= "ContentManager.addAtlas('" . $basic . "');\n";
                    }
                } else if (endsWith($dir, DS . 'localization')) {
                    if (endsWith($ff, '.txt')) {
                        $basic = beforeComma($ff);
                        $content .= "ContentManager.addFile('" . $basic . "','" . create_url($dir) . $ff . "');\n";
                    }
                } else if (endsWith($dir, DS . 'initial')) {
                    // do nothing
                } else if (stringContains($dir, 'assets' . DS . 'images')) {
                    if (endsWith($ff, '.png') or endsWith($ff,".jpg")) {
                        $basic = beforeComma($ff);
                        $basic = substr($basic, 0, strpos($basic, "@"))?: $basic;
                        $url = create_url($dir);
                        $url = str_replace('assets/images', '', $url);
                        $url = ltrim($url, '/');
                        $content .= "ContentManager.addImage('" . $basic . "','" . $url . $ff . "');\n";
                    }
                } else if (endsWith($ff, '.json') or endsWith($ff, '.txt')) {
                    // looking for json files 
                    $basic = beforeComma($ff);
                    $content .= "ContentManager.addFile('" . $basic . "','" . create_url($dir) . $ff . "');\n";
                }
            }

            ///////////////////////////////


            if (is_dir($dir . DS . $ff)) {
                $content .= "\n";
                listFolderFiles($dir . DS . $ff);
            }
        }
    }
}

listFolderFiles($main_dir);

$content = "app.loadAssets = function () {\n\n" . $content . " \n};";

file_put_contents('..' . DS . 'assets' . DS . 'assets.js', $content);

echo "<pre>";
echo $main_dir . "/assets/assets.js" . " GENEREATED";
echo "\n";
echo "\n";
echo $content;

//include_once './assets_style.php';
