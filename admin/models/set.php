<?php

class Set extends Model {

    public static $table_name = 'sets';
    public static $id_name = 'id';
    public static $db_fields = array('id', 'title', 'created_by', 'created_at');
    public $id;
    public $title;
    public $created_by;
    public $created_at;

    public static function if_exists($stage_id, $set_id) {
        $query = " SELECT id FROM stage_sets WHERE stage_id = '" . Model::db()->prep($stage_id) . "' AND set_id = '" . Model::db()->prep($set_id) . "' LIMIT 1";
        $result = Model::find_by_row($query);
        return count($result) > 0;
    }

    public static function addSet($stage_id, $set_id) {
        $query = " INSERT stage_sets (id,stage_id ,set_id) VALUES (null, '" . Model::db()->prep($stage_id) . "' , '" . Model::db()->prep($set_id) . "')";
        Model::db()->query($query);
    }

    public static function deleteStageSets($stage_id, $set_id) {
        $query = " DELETE FROM stage_sets WHERE stage_id = '" . Model::db()->prep($stage_id) . "' AND set_id = '" . Model::db()->prep($set_id) . "' LIMIT 1 ";
        Model::db()->query($query);
    }

    public static function getAllWithQuestions() {
        $sets = Set::find_all();
        foreach ($sets as $set) {
            $set->questions = Question::getAllBySet($set->id);
        }
        return $sets;
    }

    public static function get_sets_by_stage($stage_id) {
        
    }

}
