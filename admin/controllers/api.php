<?php

Load::script('controllers/admin');

class ApiController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->no_layout();
        $this->no_trackng();
    }

    public function main() {
        $this->json_response('Edu Monsters API');
    }
    
    public function challenge() {
        $code = $this->get_post('code');
        $tree_data = Challenge::get_tree(null, strtoupper($code));
        $tree = Challenge::build_tree($tree_data);
        $this->json_response(count($tree) ? $tree : null);
    }

}
