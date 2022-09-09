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
    $html_out .= "<div class='sndude-dude-box $dudebox_boxes_class' data-url='$permalink'>
      <div class='sndude-dude-box-image'>
      <div class='sndude-dude-box-image-inner $image_transition_css' style='background-image:url($thumb)'></div></div>";
    $html_out .= "<div class='sndude-dude-box-content'>";
    if ($showname)
        $html_out .= "<h4 class='sndude-dude-box-title'>" . $title . "</h4>$jobtitle";
    if ($showexcerpt)
        $html_out .= "<div class='sndude-dude-box-excerpt'>" . $excerpt . "</div>";
    if ($showcontact)
        $html_out .= "<p>$contact_str</p>";

    $html_out .= "</div></div>";


    return wp_kses_post($html_out);
}, 10, 2);
