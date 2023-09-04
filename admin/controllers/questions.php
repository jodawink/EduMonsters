<?php

Load::script('controllers/admin');

class QuestionsController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function main($page_id = 1) {
        $this->listing($page_id);
    }

    public function listing($page_id = 1) {
        URL::redirect('');
    }

    public function manage($set_id = 0) {

        $this->set_view('list');
        $this->set_menu('questions');

        Load::model('question');

        $set = Set::find_by_id($set_id);
        $questions = Question::getAllBySet($set_id);

        Load::assign('questions', $questions);
        Load::assign('set', $set);
    }

    public function add($set_id = 0) {

        $this->set_view('add');
        $this->set_menu('questions');

        if (isset($_POST) and $_POST) {

            Load::model('question');

            $question = new Question();

            $question->content = $this->get_post('content');

            $a1 = $this->get_post('answer1');
            $a2 = $this->get_post('answer2');
            $a3 = $this->get_post('answer3');
            $a4 = $this->get_post('answer4');

            $answers = json_encode([$a1, $a2, $a3, $a4]);

            $question->answers = $answers;
            $question->difficulty = $this->get_post('difficulty');
            $question->set_id = $set_id;
            $question->created_by = Membership::instance()->user->user_id;

            $question->save();

            $this->set_confirmation('New Entity Created');

            URL::redirect('questions/manage/' . $set_id);
        }
    }

    public function edit($id) {

        $this->set_view('add');
        $this->set_menu('questions');

        Load::model('question');

        $question = Question::find_by_id($id);

        if (isset($_POST) and $_POST) {

            $question->content = $this->get_post('content');
            $a1 = $this->get_post('answer1');
            $a2 = $this->get_post('answer2');
            $a3 = $this->get_post('answer3');
            $a4 = $this->get_post('answer4');

            $answers = json_encode([$a1, $a2, $a3, $a4]);

            $question->answers = $answers;
            $question->difficulty = $this->get_post('difficulty');

            $question->save();

            $this->set_confirmation('Updated');

            URL::redirect('questions/manage/' . $question->set_id);
        }

        Load::assign('question', $question);
    }

    public function delete($id) {

        $this->no_layout();

        Load::model('question');

        $question = new Question();
        $question->id = $id;

        $question->delete();

        URL::redirect_to_refferer();
    }

}
