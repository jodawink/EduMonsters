<?php

// add your hooks for the system events in here
// - user_created
// - user_logged
// - user_logout


Hooks::add_action('user_created', function($user){
    
    Load::helper('time_helper');
    
    Load::model('attendee');
    $attendee = new Attendee();
    $attendee->user_id = $user->user_id;
    $attendee->name = $user->full_name;
    $attendee->type = 'employee';
    $attendee->email = $user->email;
    $attendee->dob = TimeHelper::DateTimeAdjusted();
    $attendee->save();
    
});
//
//Hooks::add_action('user_logged', function($user){
//
//});
//
//Hooks::add_action('user_logout', function($user){
//    
//});
