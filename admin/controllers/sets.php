<?php

Load::script('controllers/admin');

class SetsController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function main($page_id = 1) {
        $this->listing($page_id);
    }

    public function get($stage_id = 0) {
        $this->no_layout();
        $this->no_trackng();
        $sets = Set::getAllWithQuestions();
        $this->json_response($sets);
    }

    public function listing($page_id = 1) {

        $this->set_view('list');
        $this->set_menu('sets');

        Load::model('set');

        $paginator = new Paginator(0, $page_id, 30, 'sets/listing/');
        $sets = Set::find_all($paginator);

        Load::assign('sets', $sets);
        Load::assign('paginator', $paginator);
    }

    public function add() {

        $this->set_view('add');
        $this->set_menu('sets');

        if (isset($_POST) and $_POST) {

            Load::model('set');

            $set = new Set();

            $set->title = $this->get_post('title');
            $set->created_by = Membership::instance()->user->user_id;

            $set->save();

            $this->set_confirmation('New Entity Created');

            URL::redirect('sets');
        }
    }

    public function edit($id) {

        $this->set_view('add');
        $this->set_menu('sets');

        Load::model('set');

        $set = Set::find_by_id($id);

        if (isset($_POST) and $_POST) {

            $set->title = $this->get_post('title');
            $set->save();
            $this->set_confirmation('Updated');

            URL::redirect('sets');
        }

        Load::assign('set', $set);
    }

    public function delete($id) {

        $this->no_layout();

        Load::model('set');

        $set = new Set();
        $set->id = $id;

        $set->delete();

        URL::redirect_to_refferer();
    }

}
