<?php

class ChallengeStage extends Model {

    public static $table_name = 'challenge_stages';
    public static $id_name = 'id';
    public static $db_fields = array('id', 'challenge_id', 'stage_id');
    public $id;
    public $challenge_id;
    public $stage_id;

    public static function delete_stage($challenge_id, $stage_id) {
        $query = " DELETE FROM challenge_stages WHERE challenge_id = '" . Model::db()->prep($challenge_id) . "' AND stage_id = '" . Model::db()->prep($stage_id) . "' LIMIT 1";
        Model::db()->query($query);
    }

}
