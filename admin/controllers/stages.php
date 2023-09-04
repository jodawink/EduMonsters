<?php

Load::script('controllers/admin');

class StagesController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function main($page_id = 1) {
        $this->listing($page_id);
    }

    public function listing($page_id = 1) {

        $this->set_view('list');
        $this->set_menu('stages');

        Load::model('stage');

        $paginator = new Paginator(0, $page_id, 30, 'stages/listing/');
        $stages = Stage::find_all($paginator);

        Load::assign('stages', $stages);
        Load::assign('paginator', $paginator);
    }

    public function add() {

        $this->set_view('add');
        $this->set_menu('stages');

        if (isset($_POST) and $_POST) {

            Load::model('stage');

            $stage = new Stage();

            $stage->stage_name = $this->get_post('stage_name');
            $stage->required_questions = $this->get_post('required_questions');
            $stage->corect_questions = $this->get_post('corect_questions');


            $stage->save();

            $this->set_confirmation('New Entity Created');

            URL::redirect('stages');
        }
    }

    public function edit($id) {

        $this->set_view('add');
        $this->set_menu('stages');

        Load::model('stage');

        $stage = Stage::find_by_id($id);

        if (isset($_POST) and $_POST) {

            $stage->stage_name = $this->get_post('stage_name');
            $stage->required_questions = $this->get_post('required_questions');
            $stage->corect_questions = $this->get_post('corect_questions');

            $stage->save();

            $this->set_confirmation('Updated');

            URL::redirect('challenges/edit-stage/' . $id);
        }

        Load::assign('stage', $stage);
    }

    public function delete($id) {

        $this->no_layout();

        Load::model('stage');

        $stage = new Stage();
        $stage->id = $id;

        $stage->delete();

        URL::redirect_to_refferer();
    }

}
