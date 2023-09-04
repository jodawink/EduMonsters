<?php

class Question extends Model {

    public static $table_name = 'questions';
    public static $id_name = 'id';
    public static $db_fields = array('id', 'content', 'answers', 'difficulty', 'set_id', 'created_by', 'created_at');
    public $id;
    public $content;
    public $answers;
    public $difficulty;
    public $set_id;
    public $created_by;
    public $created_at;

    public static function getAllBySet($set_id) {
        $query = " SELECT * FROM questions WHERE set_id = '" . Model::db()->prep($set_id) . "' ";
        return Question::find_by_sql($query);
    }

}
