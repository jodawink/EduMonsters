<?php

Load::script('controllers/admin');

class ChallengesController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function main($page_id = 1) {
        $this->listing($page_id);
    }

    public function listing($page_id = 1) {

        $this->set_view('list');
        $this->set_menu('challenges');

        Load::model('challenge');

        $paginator = new Paginator(0, $page_id, 30, 'challenges/listing/');
        $challenges = Challenge::find_all($paginator);

        Load::assign('challenges', $challenges);
        Load::assign('paginator', $paginator);
    }

    public function add() {

        $this->set_view('add');
        $this->set_menu('challenges');

        if (isset($_POST) and $_POST) {

            Load::model('challenge');

            $challenge = new Challenge();

            $challenge->name = $this->get_post('name');
            $challenge->code = $this->getRandomCode(4);
            $challenge->created_by = Membership::instance()->user->user_id;


            $challenge->save();

            $this->set_confirmation('New Entity Created');

            URL::redirect('challenges/edit-stage/' . $challenge->id);
        }
    }

    public function edit($id) {

        $this->set_view('add');
        $this->set_menu('challenges');

        Load::model('challenge');

        $challenge = Challenge::find_by_id($id);

        if (isset($_POST) and $_POST) {

            $challenge->name = $this->get_post('name');
            $challenge->save();

            $this->set_confirmation('Updated');

            URL::redirect('challenges');
        }

        Load::assign('challenge', $challenge);
    }

    public function edit_stage($id) {

        Head::instance()->load_js('../treeview/bootstrap-treeview.min');
        Head::instance()->load_css('../treeview/bootstrap-treeview.min');

        $this->set_view('edit_stage');
        $this->set_menu('challenges');

        Load::model('challenge');

        $challenge = Challenge::find_by_id($id);

        if (isset($_POST) and $_POST) {
            // crate a stage here 
            $stage = new Stage();
            $stage->stage_name = $this->get_post('name');
            $stage->required_questions = $this->get_post('required_questions');
            $stage->corect_questions = $this->get_post('corect_questions');
            $stage->save();

            $cs = new ChallengeStage();
            $cs->challenge_id = $challenge->id;
            $cs->stage_id = $stage->id;
            $cs->save();

            URL::redirect_to_refferer();
        }

        $tree_data = Challenge::get_tree($id);
        $tree = Challenge::build_tree($tree_data);
        Load::assign('tree', json_encode($tree));

        $stages = Challenge::find_stages($id);

        Load::assign('stages', $stages);
        Load::assign('challenge', $challenge);
    }

    public function edit_stage_data() {
        $this->no_layout();
        $this->no_trackng();
        $stage_id = $this->get_post('stage_id');
        $name = $this->get_post('name');
        $required_questions = $this->get_post('required_questions');
        $corect_questions = $this->get_post('corect_questions');

        /* @var $stage Stage */
        $stage = Stage::find_by_id($stage_id);
        $stage->stage_name = $name;
        $stage->required_questions = $required_questions;
        $stage->corect_questions = $corect_questions;
        $stage->save();

        $this->json_response($stage);
    }

    public function add_sets() {
        $this->no_layout();
        $this->no_trackng();
        $stage_id = $this->get_post('stageId');
        $set_ids = $this->get_post('ids');
        $added = [];
        foreach ($set_ids as $set_id) {
            if (!Set::if_exists($stage_id, $set_id)) {
                Set::addSet($stage_id, $set_id);
                $added[] = $set_id;
            }
        }

        $this->json_response($added);
    }

    public function edit_set() {
        $this->no_layout();
        $this->no_trackng();
        $set_id = $this->get_post('set_id');
        $name = $this->get_post('name');

        $set = Set::find_by_id($set_id);
        $set->title = $name;
        $set->save();

        $this->json_response($set);
    }

    public function delete_sets() {
        $this->no_layout();
        $this->no_trackng();
        $stage_id = $this->get_post('stage_id');
        $set_id = $this->get_post('set_id');

        Set::deleteStageSets($stage_id, $set_id);

        $this->json_response(['msg' => 'success']);
    }

    public function add_question() {
        $this->no_layout();
        $this->no_trackng();

        $set_id = $this->get_post('set_id');
        $question_id = $this->get_post('question_id');
        $content = $this->get_post('content');
        $difficulty = $this->get_post('difficulty');
        $answers = $this->get_post('answers');

        $question = $question_id ? Question::find_by_id($question_id) : new Question();
        $question->content = $content;
        $question->difficulty = $difficulty;

        if (!$question_id) {
            $question->created_by = Membership::instance()->user->user_id;
        }

        $question->answers = json_encode($answers);

        if ($set_id) {
            $question->set_id = $set_id;
        }

        $question->save();

        $this->json_response($question);
    }

    public function delete_question() {
        $this->no_layout();
        $this->no_trackng();

        $question_id = $this->get_post('question_id');

        $question = Question::find_by_id($question_id);
        $question->delete();

        $this->json_response($question);
    }

    public function delete_stage() {

        $stage_id = $this->get_post('stage_id');
        $challenge_id = $this->get_post('challenge_id');
        $this->no_layout();
        $this->no_trackng();
        $stage = Stage::find_by_id($stage_id);
        $stage->delete();

        ChallengeStage::delete_stage($challenge_id, $stage_id);

        $this->json_response($stage);
    }

    public function delete($id) {

        $this->no_layout();

        Load::model('challenge');

        $challenge = new Challenge();
        $challenge->id = $id;

        $challenge->delete();

        URL::redirect_to_refferer();
    }

    private function getRandomCode($n) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

}
