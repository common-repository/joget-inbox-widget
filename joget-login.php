<?php
    /**
     * Login page that authenticates against posted credentials and returns a
     * JSON body that signifies if an authentication is/is not successful. Note
     * that this module is written only to verify credentials and not to perform
     * an actual login (ie, authentication filters are not meant to be fired).
     *
     * Sample response body:
     * {
     *    "user_login" : ["myloginname"],
     *    "login_success" : ["0"|"1"],
     *    "error_msg" : ("error")
     * }
     *
     * This page also queries and returns a user object is the password parameter
     * is not present. Sample response body for a user object:
     *
     * {
     *    "id" : [""|"user id"],
     *    "username" : ["username"],
     *    "displayname" : ["displayname"],
     *    "nicename" : ["nicename"],
     *    "email" : ["email"],
     *    "url" : ["url"]
     * }
     *
     * @author Michael Yap
     */
    require(dirname(__FILE__).'/../../../wp-load.php');
    if($_POST['password']=='')
    {
        //No password found. Retrieving user object
        $json = array('id'=>'', 'username'=>'', 'displayname'=>'', 'nicename'=>'', 'email'=>'', 'url'=>'');
        $list = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->users WHERE user_login=%s", $_POST['username']));
        if(!is_null($list))
        {
            $json['id']=$list->ID;
            $json['username']=$list->user_login;
            $json['displayname']=$list->display_name;
            $json['nicename']=$list->user_nicename;
            $json['email']=$list->user_email;
            $json['url']=$list->user_url;
        }
    }
    else
    {
        //Attempting to authenticate user
        $json = array('user_login'=>$_POST['username'], 'login_success'=>'', 'error_msg'=>'');
        //Have to be careful what we're calling here. We want to verify credentials, not log the user in
        $user = wp_authenticate_username_password($user, $_POST['username'], $_POST['password']);
        if (is_wp_error($user))
        {
            $json['login_success'] = '0';
            $json['error_msg'] = $user->get_error_message();
        }
        else
            $json['login_success'] = '1';

    }
    echo json_encode($json);
?>