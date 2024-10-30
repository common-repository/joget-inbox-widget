<?php
/*
    Plugin Name: Joget Workflow Inbox
    Plugin URI: http://www.joget.org/
    Description: The Joget Workflow Inbox widget for outstanding tasks and available applications
    Author: Michael Yap
    Version: 1.0
    Author URI: http://michaelyap.wordpress.com
*/
add_action('widgets_init', array('Jiw', 'register'));
register_activation_hook( __FILE__, array('Jiw', 'activate'));
register_deactivation_hook( __FILE__, array('Jiw', 'deactivate'));
//add_filter('authenticate', array('Jiw', 'login'), 10, 3);
/**
 * Joget Inbox Widget (JIW) class
 */
class Jiw
{
    /**
     * Activating user settings
     */
    function activate()
    {
        $data = array('joget_url'=>'', 'title'=>'', 'process_list'=>'1');
        if (! get_option('Jiw'))
            add_option('Jiw' , $data);
        else
            update_option('Jiw' , $data);
    }
    /**
     * Deactivating user settings
     */
    function deactivate()
    {
        delete_option('Jiw');
    }
    /**
     * User settings
     */
    function settings()
    {
        $data = get_option('Jiw');
        ?>
        <input type="hidden" value="1" name="jiw_submit">
        <p><label>Title <input type="text" name="jiw_title" value="<?php echo $data['title'] ?>" size="18"></label></p>
        <p><label>Joget URL <input type="text" name="jiw_jogetUrl" value="<?php echo $data['joget_url'] ?>" size="15"></label></p>        
        <p><label><input type="checkbox" name="jiw_processList" value="1" <?php if($data['process_list']=='1') echo 'CHECKED'; ?>> Display available applications</label></p>
        <?php
        if(isset($_POST['jiw_submit']))
        {
            $data['title'] = $_POST['jiw_title'];
            $data['joget_url'] = $_POST['jiw_jogetUrl'];            
            if(isset($_POST['jiw_processList']))
                $data['process_list'] = '1';
            else
                $data['process_list'] = '0';
            update_option('Jiw', $data);
        }
    }
    /**
     * Render main widget body
     * @param <type> $args
     */
    function widget($args)
    {
        $data = get_option('Jiw');
        echo $args['before_widget'];
        echo $args['before_title'];
        echo $data['title'];
        echo $args['after_title'];        
        $pluginUrl = get_option('siteurl') . '/wp-content/plugins/joget-inbox/';
        $jogetUrl = $data['joget_url'];
        if(substr($jogetUrl, 0, 7) != 'http://')
            $jogetUrl = 'http://' . $jogetUrl;
        if(substr($jogetUrl, -1) == '/')
            $jogetUrl = substr($jogetUrl, 0, strlen($jogetUrl)-1);
        ?>
<link rel="stylesheet" type="text/css" href="<?php echo $pluginUrl ?>jiw.css">
<script type="text/javascript" src="<?php echo $jogetUrl ?>/js/jquery/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="<?php echo $jogetUrl ?>/js/json/util.js"></script>
<div id="jogetInboxDiv"><center><img src="<?php echo $pluginUrl ?>portlet_loading.gif" alt="Loading Joget Inbox"/></center></div>
<div id="jogetProcessListDivHeader"></div>
<div id="jogetProcessListDiv"></div>
<script>
$(document).ready(function()
{
    //Initial callback checking if user is logged in
    var clb_currentuser =
    {
        success: function(data)
        {
            <?php if($data['process_list']=='1') { ?>
            if(data.username!="roleAnonymous")
            {
                document.getElementById("jogetProcessListDiv").innerHTML = "<center><img src='<?php echo $pluginUrl ?>portlet_loading.gif' alt='Loading Joget List'/></center>";
                document.getElementById("jogetProcessListDivHeader").innerHTML = "<p><p><strong>Available Applications</strong></p>";
                $.getScript('<?php echo $jogetUrl ?>/web/js/workflow/processList.js?divId=jogetProcessListDiv', null);
            }
            else
            {
                document.getElementById("jogetProcessListDiv").innerHTML = "<center></center>";
                document.getElementById("jogetProcessListDivHeader").innerHTML = "";
            }
            <?php } ?>
        }
    };
    $.getScript('<?php echo $jogetUrl ?>/web/js/workflow/inbox.js?loginCallback=clb_login&id=1&divId=jogetInboxDiv', null);
    AssignmentManager.getCurrentUsername('<?php echo $jogetUrl ?>', clb_currentuser);
})
//Rendering process list when logged in
var clb_login =
{
    success: function()
    {
        <?php if($data['process_list']=='1') { ?>
        //Cosmetics. Adding headers
        document.getElementById("jogetProcessListDiv").innerHTML = "<center><img src='<?php echo $pluginUrl ?>portlet_loading.gif' alt='Loading Joget List'/></center>";
        document.getElementById("jogetProcessListDivHeader").innerHTML = "<p><p><strong>Available Applications</strong></p>";        
        $.getScript('<?php echo $jogetUrl ?>/web/js/workflow/processList.js?divId=jogetProcessListDiv', null);
        <?php } ?>
    }
};
</script>
        <?php
        echo $args['after_widget'];
    }
    /**
     * Initialization call to register widget
     */
    function register()
    {
        register_sidebar_widget('Joget Workflow Inbox', array('Jiw', 'widget'));
        register_widget_control('Joget Workflow Inbox', array('Jiw', 'settings'));
    }    
}
?>