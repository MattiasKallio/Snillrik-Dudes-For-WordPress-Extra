<?php
//add your look to the Dudes generator dropdown. 
define('PHOTOFRAME_LOOK_NAME', basename(dirname(__FILE__)));

add_filter("snillrik_dudes_format_look_add_option", function($looks_array){
    $looks_array[] = PHOTOFRAME_LOOK_NAME;
    return $looks_array;
},10,1);

//add html to the new look here (or replace old one) with the info from the look info array.
add_filter("snillrik_dudes_format_look_html_out_".PHOTOFRAME_LOOK_NAME, function($html_out,$look_info_array){
    extract($look_info_array);
    $rownum = $rownum ? $rownum : 4;
    $total_number_of_dudes = $total_number_of_dudes > $rownum ? $rownum : $total_number_of_dudes;
    $dudebox_boxes_class = $issingle ? "sndude-dude-box-single" : "sndude-dude-box$total_number_of_dudes";
    $html_out .= "<div class='sndude-dude-box $dudebox_boxes_class' data-url='$permalink'>
    <div class='my-dude-frame'>
    <div class='my-dude-border'>
      <div class='sndude-dude-box-image my-dude-image' style='background-image:url($thumb)'>
      </div>
    </div>
  </div>
  <div class='my-dude-frame-name'><h3>$title</h3><h4>$jobtitle</h4></div>";

    $html_out .= "</div>";

    return wp_kses_post($html_out);

},10,2);
?>