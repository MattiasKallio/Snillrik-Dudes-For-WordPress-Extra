<?php
define('HELAKROPPEN_LOOK_NAME', basename(dirname(__FILE__)));

add_filter("snillrik_dudes_format_look_add_option", function ($looks_array) {
    $looks_array[] = HELAKROPPEN_LOOK_NAME;
    return $looks_array;
}, 10, 1);

//add html to the new look here (or replace old one) with the info from the look info array.
add_filter("snillrik_dudes_format_look_html_out_" . HELAKROPPEN_LOOK_NAME, function ($html_out, $look_info_array) {
    extract($look_info_array);
    //error_log("HELAKROPPEN_LOOK_NAME: ". print_r($look_info_array,true));
    $look_name = HELAKROPPEN_LOOK_NAME;
    $categories = $look_info_array['categories'];
    $cat_list = array();
    if ($categories) {
        foreach ($categories as $cat) {
            $cat_list[] = $cat->name;
        }
    }
    $categories_data = $cat_list;
    $rownum = $rownum ? $rownum : 4;
    $total_number_of_dudes = $total_number_of_dudes > $rownum ? $rownum : $total_number_of_dudes;
    $dudebox_boxes_class = $issingle ? "sndude-dude-box-single" : "sndude-dude-box$total_number_of_dudes";
    $names_from_title = explode(" ", $title);
    $firstname = $names_from_title[0];
    $lastname = isset($names_from_title[1]) ? $names_from_title[1] : "";
    $read_more_text = sprintf("Läs mer om %s", $firstname);
    $first_letter_fname = strtoupper(substr($firstname, 0, 1));
    $first_letter_lname = strtoupper(substr($lastname, 0, 1));

    $html_out .= "<div class='sndude-dude-box $dudebox_boxes_class ' data-url='$permalink' data-categories='" . json_encode($categories_data) . "' data-firstname='$firstname' data-lastname='$lastname' data-firstletter='$first_letter_fname' data-lastletter='$first_letter_lname'>
      <div class='sndude-dude-box-image'>
      <div class='sndude-dude-box-image-inner $image_transition_css' style='background-image:url($thumb)'></div></div>";
    $html_out .= "<div class='sndude-dude-box-content'><div class='sndude-dude-box-content-upper'>";
    if ($showname)
        $html_out .= "<h4 class='sndude-dude-box-title'><a href='$permalink'>" . $title . "</a></h4>$jobtitle";
    if ($showexcerpt)
        $html_out .= "<div class='sndude-dude-box-excerpt'>" . $excerpt . "</div>";
    if ($showcontact)
        $html_out .= "<div class='sndude-dude-box-contactbox'>$contact_str</div>";

    $html_out .= "</div><div class='sndude-dude-box-readmore'><a href='$permalink'>" . $read_more_text . "</a></div>";
    $html_out .= "</div></div>";


    return wp_kses_post($html_out);
}, 10, 2);


//Shortcode for addin input fields to the dudebox
add_shortcode("helakroppen_filter_dudes", function ($atts, $content = null) {
    
    $all_dudes_types = get_terms(array(
        'taxonomy' => 'dude-type',
        'hide_empty' => true,
    ));

    $all_types = array(); //ie areas
    $options_str = "";
    foreach ($all_dudes_types as $type) 
    {
        $currlan = $type->name;
        if (!in_array($currlan, $all_types) && $currlan != "") 
        {
            $all_types[] = $currlan;
            $options_str = "<option value='$currlan'>$currlan</option>" . $options_str;
        }
    }

    //alphabet array with åäö
    $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'Å', 'Ä', 'Ö');

    $html_out = "<div class='helakroppen-filter-dudes' data-selectedletter='' data-selectedarea=''>
        <div><select class='helakroppen-filter-dudes-area'>
            <option value=''>Alla områden</option>
            $options_str
        </select></div>";
    $html_out .= "<div><div class='helakroppen-filter-dudes-alphabet'>
    <div class='helakroppen-filter-dudes-letter' data-letter=''>Alla</div>";
    foreach ($alphabet as $letter) {
        $html_out .= "<div class='helakroppen-filter-dudes-letter' data-letter='$letter'>$letter</div>";
    }
    $html_out .= "</div></div></div>";
        return $html_out;
});