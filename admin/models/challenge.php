<?php

class Challenge extends Model {

    public static $table_name = 'challenges';
    public static $id_name = 'id';
    public static $db_fields = array('id', 'name', 'code', 'created_by', 'created_at');
    public $id;
    public $name;
    public $code;
    public $created_by;
    public $created_at;

    public static function find_stages($challenge_id) {
        $query = "SELECT * FROM challenges as c ";
        $query .= " JOIN challenge_stages AS cs ON c.id = cs.challenge_id ";
        $query .= " JOIN stages AS s ON cs.stage_id = s.id ";
        $query .= " WHERE c.id = '" . Model::db()->prep($challenge_id) . "' ";

        $result = Model::db()->query($query);
        $r = [];
        while ($row = Model::db()->fetch_array($result)) {
            $r[] = $row;
        }

        return $r;
    }

    public static function get_tree($challenge_id, $code = null) {
        $query = " SELECT c.* ";
        $query .= " , s.id AS stage_id , s.stage_name , s.required_questions , s.corect_questions ";
        $query .= " , st.id AS set_id , st.title AS set_name ";
        $query .= " , q.id AS question_id , q.content , q.answers , q.difficulty ";
        $query .= " FROM challenges as c ";
        $query .= " JOIN challenge_stages AS cs ON c.id = cs.challenge_id ";
        $query .= " JOIN stages AS s ON cs.stage_id = s.id ";
        $query .= " LEFT JOIN stage_sets AS ss ON s.id = ss.stage_id  ";
        $query .= " LEFT JOIN sets AS st ON ss.set_id = st.id  ";
        $query .= " LEFT JOIN questions AS q ON st.id = q.set_id ";

        if ($code) {
            $query .= " WHERE c.code = '" . Model::db()->prep($code) . "' ";
        } else {
            $query .= " WHERE c.id = '" . Model::db()->prep($challenge_id) . "' ";
        }

        return Model::find_by_row($query);
    }

    public static function build_tree($tree_data) {
        $tree = [];

        foreach ($tree_data as $data) {
            // check for challange

            if (!isset($tree[$data['id']])) {
                $tree[$data['id']] = new stdClass();
                $tree[$data['id']]->id = $data['id'];
                $tree[$data['id']]->name = $data['name'];
                $tree[$data['id']]->code = $data['code'];
                $tree[$data['id']]->stages = [];
            }

            $challange = &$tree[$data['id']];

            // check for stage

            if (!isset($challange->stages[$data['stage_id']])) {
                $challange->stages[$data['stage_id']] = new stdClass();
                $challange->stages[$data['stage_id']]->id = $data['stage_id'];
                $challange->stages[$data['stage_id']]->name = $data['stage_name'];
                $challange->stages[$data['stage_id']]->required_questions = $data['required_questions'];
                $challange->stages[$data['stage_id']]->corect_questions = $data['corect_questions'];
                $challange->stages[$data['stage_id']]->sets = [];
            }

            $sets = &$challange->stages[$data['stage_id']]->sets;



            if ($data['set_id']) {
                if (!isset($sets[$data['set_id']])) {
                    $set = new stdClass();
                    $set->id = $data['set_id'];
                    $set->name = $data['set_name'];
                    $set->questions = [];

                    $sets[$data['set_id']] = $set;
                }

                if ($data['question_id']) {
                    $questions = &$sets[$data['set_id']]->questions;

                    $question = new stdClass();
                    $question->id = $data['question_id'];
                    $question->content = $data['content'];
                    $question->answers = $data['answers'];
                    $question->difficulty = $data['difficulty'];

                    $questions [] = $question;
                }
            }
        }
        return $tree;
    }

}
