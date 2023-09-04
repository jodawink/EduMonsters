<?php

class Stage extends Model {

    public static $table_name = 'stages';
    public static $id_name = 'id';
    public static $db_fields = array('id', 'stage_name', 'required_questions', 'corect_questions' , 'created_at');
    public $id;
    public $stage_name;
    public $required_questions;
    public $corect_questions;
    public $created_at;

}
