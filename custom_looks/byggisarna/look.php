<?php
define('BYGGISARNA_LOOK_NAME', basename(dirname(__FILE__)));

add_filter("snillrik_dudes_format_look_add_option", function ($looks_array) {
    $looks_array[] = BYGGISARNA_LOOK_NAME;
    return $looks_array;
}, 10, 1);

//add html to the new look here (or replace old one) with the info from the look info array.
add_filter("snillrik_dudes_format_look_html_out_".BYGGISARNA_LOOK_NAME, function ($html_out, $look_info_array) {
    extract($look_info_array);
    $look_name = BYGGISARNA_LOOK_NAME;
    $rownum = $rownum ? $rownum : 4;
    $total_number_of_dudes = $total_number_of_dudes > $rownum ? $rownum : $total_number_of_dudes;
    $dudebox_boxes_class = $issingle ? "sndude-dude-box-single" : "sndude-dude-box$total_number_of_dudes";
    $lanet = isset($look_info_array["contact"]["lan"]) ? $look_info_array["contact"]["lan"] : "byggisarna";

    $html_out .= "<div class='sndude-dude-box $dudebox_boxes_class' data-url='$permalink' data-lan='$lanet'>
      <div class='sndude-dude-box-image'>
      <div class='sndude-dude-box-image-inner $image_transition_css' style='background-image:url($thumb)'></div></div>";
    $html_out .= "<div class='sndude-dude-box-content'>";
    if ($showname)
        $html_out .= "<h4 class='sndude-dude-box-title'><a href='$permalink'>" . $title . "</a></h4>$jobtitle";
    if ($showexcerpt)
        $html_out .= "<div class='sndude-dude-box-excerpt'>" . $excerpt . "</div>";
    if ($showcontact)
        $html_out .= "<div class='sndude-dude-box-contactbox'>$contact_str</div>";

    $html_out .= "</div></div>";


    return wp_kses_post($html_out);
}, 10, 2);

//Shortcode for addin input fields to the dudebox
add_shortcode("byggisarna_filter_dudes", function ($atts, $content = null) {
    $all_dudes = get_posts(array(
        'post_type' => 'dude',
        'posts_per_page' => -1,
        'meta_key' => 'snillrik_dudes_lan',
        'orderby' => 'meta_value',
        'order' => 'DESC'
    ));
    $options_str = "";
    $all_lan = array();
    foreach ($all_dudes as $dude) {
        $currlan = get_post_meta($dude->ID, "snillrik_dudes_lan", true);
        if(!in_array($currlan, $all_lan) && $currlan != ""){
            $all_lan[] = $currlan;
            $options_str = "<option value='$currlan'>$currlan</option>" . $options_str;
        }
    }

    $html_out = "<div class='byggisarna-filter-dudes'>
        <select id='byggisarna-filter-dudes-lan'>
            <option value=''>Alla län</option>
            $options_str
        </select></div>";
        return $html_out;
});