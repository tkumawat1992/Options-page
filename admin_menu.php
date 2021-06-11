<?php
$themename = "Theme option";

$shortname = "wpc";

/* Get Categories



  ------------------------------ */



$categories = get_categories('hide_empty=1&orderby=name');



$wp_cats = array();



foreach ($categories as $category_list) {



    $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}



/* array_unshift($wp_cats, "Choose a category"); */

/* Get Page Link



  ------------------------------ */

$pages = get_pages('hide_empty=0&orderby=name');

$wp_pag = array();

foreach ($pages as $pagg) {

    $wp_pag[$pagg->ID] = $pagg->post_title;
}



//array_unshift($wp_pag, "Choose page");











/* =Option Panel



  ------------------------------------------------------------------------------------------------------------------------------ */



$options = array(
    array("name" => $themename . " Options",
        "type" => "title"),
    /* = Theme style ---------------------------------------------------------------------------------------------------------------------------- */
	
	  array("name" => "Address",
        "type" => "section"),
    array("type" => "open"),   

	 array("name" => "Phone number",
        "desc" => "This phone number will be used in website",
        "id" => $shortname . "_pnumber",
        "type" => "text",
        "std" => ""),	
    array("name" => "Email",
        "desc" => "This Email will be used in website",
        "id" => $shortname . "_email",
        "type" => "text",
        "std" => ""),
   array("name" => "Address",
        "desc" => "This address will be used in website",
        "id" => $shortname . "_address",
        "type" => "textarea2",
        "std" => ""),
		
		
		 array("type" => "close"),

    array("name" => "Social media links",
        "type" => "section"),
    array("type" => "open"),   

	 array("name" => "Facebook URL",
        "desc" => "This URL will be used in Social medialink as facebook",
        "id" => $shortname . "_fburl",
        "type" => "text",
        "std" => ""),	
    array("name" => "Twitter URL",
        "desc" => "This URL will be used in Social media link as Twitter",
        "id" => $shortname . "_twitter",
        "type" => "text",
        "std" => ""),				array("name" => "Instagram URL",        "desc" => "This URL will be used in Social media link as Linkdin",        "id" => $shortname."_instagram",        "type" => "text",        "std" => ""),
		
		array("name" => "Youtube URL",

        "desc" => "This URL will be used in Social media link as Instagram",

        "id" => $shortname."_youtube",

        "type" => "text",

        "std" => ""),
		
		    array("type" => "close"),
		
	
    );
	
	
	
		
		
  /*   array("type" => "close"),
    
    ); */
    



	







//Footer Settings--------------------------------------------------------------
    
function mytheme_add_admin() {
//print_r($_REQUEST);
    global $themename, $shortname, $options; 
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'mythemeoption') {
            if ('save' == isset($_REQUEST['action'])) {
           //     print_r($options);
                foreach ($options as $value) { //echo "<pre>"; print_r($value);
                if(isset($value['id'])){
                    update_option($value['id'], $_REQUEST[$value['id']]);
                }
                }
                foreach ($options as $value) {
                    if(isset($value['id'])){
                        if (isset($_REQUEST[$value['id']])) {
                            update_option(isset($value['id']), $_REQUEST[$value['id']]);
                        } else {
                            delete_option($value['id']);
                        }
                    }
                }

                header("Location: themes.php?page=mythemeoption&saved=true");

                //die;
            } else if ('reset' == isset($_REQUEST['action'])) {
                foreach ($options as $value) {
                    delete_option($value['id']);
                }
                header("Location: themes.php?page=mythemeoption&reset=true");
                die;
            }
        }
    }


//add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
    add_theme_page($themename, $themename, 'administrator', 'mythemeoption', 'mytheme_admin');
}

function mytheme_add_init() {







    $file_dir = get_bloginfo('template_directory');



    wp_enqueue_style("functions", $file_dir . "/optionpage/functions.css", false, "1.0", "all");



    wp_enqueue_style("functions", $file_dir . "/optionpage/admin-style.css", false, "1.0", "all");



    wp_enqueue_script("am_script", $file_dir . "/optionpage/am_script.js", false, "1.0");

    wp_enqueue_script("upload_box", $file_dir . "/optionpage/upload_box.js", false, "1.0");

    wp_enqueue_script('media-upload');

    wp_enqueue_script('thickbox');

 //   wp_register_script('my-upload', get_bloginfo('stylesheet_directory') . '/js/uploader.js', array('jquery', 'media-upload', 'thickbox'));

    wp_enqueue_script('my-upload');

    wp_enqueue_style('thickbox');
}

function mytheme_admin() {







    global $themename, $shortname, $options;



    $i = 0;







    if (isset($_REQUEST['saved']))
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings saved.</strong></p></div>';



    if (isset($_REQUEST['reset']))
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings reset.</strong></p></div>';
    ?>



    <div class="wrap am_wrap">



        <h2><?php echo $themename; ?> Options Panel</h2>



        <div class="am_opts">



            <form method="post">



    <?php
    foreach ($options as $value) {



        switch ($value['type']) {







            case "open":
                ?>







                <?php
                break;



            case "close":
                ?>







                    </div>



                </div>



                <br/>







                <?php
                break;



            case "title":
                ?>







                <p>Please, use the menu below to setting up your theme.</p>







                <?php
                break;



            case 'text':
                ?>







                <div class="am_input am_text">



                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>



                    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (get_option($value['id']) != "") {
                    echo stripslashes(get_option($value['id']));
                } else {
                    echo $value['std'];
                } ?>" />



                    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>



                </div>



                <?php
                break;



            case 'text2':
                ?>







                <div class="am_input am_text">

                    <style type="text/css">

                        .icolor{position:absolute;}

                        .icolor_flat,.icolor_ft{position:relative;}

                        .icolor td{width: 15px;height: 15px;border: solid 1px #000000;	cursor:pointer;}

                        .icolor table{background-color: #FFFFFF;border: solid 1px #ccc;}

                        .icolor .icolor_tbx{width:170px;border-top:1px solid #999;border-left:1px solid #ccc;border-right:1px solid #ccc;border-bottom:1px solid #ccc;}

                        .icolor_ok img{border:none;}



                        .icolorC,h2{width:500px;margin:80px auto;}

                        #icolor4 .icolor_tbx{width:154px;padding-right:16px;}

                        #icolor4 .icolor_ok{position:absolute;left:154px;top:50%;margin-top:-8px;}

                    </style>



                    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/optionpage/js/jquery.icolor.js"></script> 

                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>



                    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if (get_option($value['id']) != "") {
                    echo stripslashes(get_option($value['id']));
                } else {
                    echo $value['std'];
                } ?>"/>







                    <script type="text/javascript">

                        //<![CDATA[



                        var $ = jQuery.noConflict();



                        $("#<?php echo $value['id']; ?>").icolor({
                            onSelect: function (c) {
                                this.$tb.css("background-color", c);
                                this.$t.val(c);
                            }

                        });





                        //]]>

                    </script>



                </div>





                <?php
                break;



            case 'textarea':
                ?>







                <div class="am_input am_textarea">



                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>



                    <div class="texted"><textarea id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if (get_option($value['id']) != "") {
                    echo stripslashes(get_option($value['id']));
                } else {
                    echo $value['std'];
                } ?></textarea>



                        <div class="clear" style="margin:0;padding:0; clear:both;"></div>



                    </div>



                    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>







                    <script>



                        //<![CDATA[



                        bkLib.onDomLoaded(function () {
                            new nicEditor().panelInstance('<?php echo $value['id']; ?>');
                        });







                //]]>



                    </script>











                <?php //print_r($value);?>







                </div>





                <?php
                break;

            case 'textarea2':
                ?>



                <div class="am_input am_textarea">

                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

                    <div class="texted"><textarea  name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if (get_option($value['id']) != "") {
                    echo stripslashes(get_option($value['id']));
                } else {
                    echo $value['std'];
                } ?></textarea>

                        <div class="clear" style="margin:0;padding:0; clear:both;"></div>

                    </div>

                    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>





                <?php //print_r($value); ?>



                </div> 



                <?php
                break;



            case 'select':
                ?>







                <div class="am_input am_select">



                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>



                    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">







                <?php foreach ($value['options'] as $key => $option) { ?>



                            <option <?php if (get_option($value['id']) == $key) {
                        echo 'selected="selected"';
                    } ?> value="<?php echo $key; ?>"><?php echo $option; ?></option><?php } ?>



                    </select>



                    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>



                </div>



                <?php break;

            case 'upload':
                ?>

                <div class="rm_input rm_upload">

            <?php
            default:
                ?>



                    <p class="awdMetaImage" style="padding-left:15px; max-width:720px;"><img  src="<?php if (get_option($value['id']) != "") {
                    echo stripslashes(get_option($value['id']));
                } else {
                    echo $value['std'];
                } ?>"  /> <p>

                        <label style="padding-left:15px;" for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

                        <input type="text" class="upload-url <?php $field_class ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['name']; ?>" value="<?php if (get_option($value['id']) != "") {
                    echo stripslashes(get_option($value['id']));
                } else {
                    echo $value['std'];
                } ?>" />

                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload"  />



                </div>



                <?php
                break;





            case "checkbox":
                ?>







                <div class="am_input am_checkbox">



                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>



                <?php if (get_option($value['id'])) {
                    $checked = "checked=\"checked\"";
                } else {
                    $checked = "";
                } ?>



                    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />



                    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>



                </div>







                <?php
                break;



            case "section":



                $i++;
                ?>

                <div class="am_section">

                    <div class="am_title">

                        <h3><img src="<?php bloginfo('template_directory') ?>/optionpage/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3>

                        <!--<span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save Changes" /></span>-->

                        <div class="clearfix"></div></div>

                    <div class="am_options">

                <?php
                break;
        }
    }
    ?>
    <p class="submit save">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        <input type="hidden" name="action" value="save" />
    </p>

</form>







            <form method="post" class="submit">







                <input name="reset" type="submit" value="Reset All Settings" />



                <input type="hidden" name="action" value="reset" />







            </form>



        </div> 
		<style>.awdMetaImage img { width:75%; }</style>

    <?php
}

add_action('admin_init', 'mytheme_add_init');



add_action('admin_menu', 'mytheme_add_admin');
?>