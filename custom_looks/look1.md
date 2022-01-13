# Look 1
### Example for making your own Dudes looks.

Things to add in like functions.php of your theme.
```
//add your look to the Dudes generator dropdown. 
add_filter("format_look_add_option", function($looks_array){
    $looks_array[] = "circle3";
    return $looks_array;
},10,1);

//add html to the new look here (or replace old one) with the info from the look info array.
add_filter("format_look_html_out_circle3", function($html_out,$look_info_array){
    extract($look_info_array);
    $total_number_of_dudes = $total_number_of_dudes > 4 ? 4 : $total_number_of_dudes;
    $dudebox_boxes_class = $issingle ? "sndude-dude-box-single" : "sndude-dude-box$total_number_of_dudes";
    $html_out .= "<div class='sndude-dude-box $dudebox_boxes_class' data-url='$permalink'>
        <div class='sndude-dude-box-image'>
            <div class='sndude-dude-box-image-inner $image_transition_css' style='background-image:url($thumb)'></div>
            $jobtile
        </div>";
    $html_out .= "<div class='sndude-dude-box-content'>";
    if ($showname)
        $html_out .= "<div class='sndude-dude-box-title'>" . $title . "</div>";

    $html_out .= "</div></div>";

    return wp_kses_post($html_out);

},10,2);
```
You will also need some css for your new look.
```
.sndude-dude-wrap-circle3 .sndude-dude-box-jobtitle-inner {
    margin: auto;
    margin-top: -80px;
    display: flex;
    width: 100px;
    height: 100px;
    /* padding-top: 40px; */
    background: #ffffffb8;
    border-radius: 50%;
    border: 3px dotted #00000033;
    color: #540808;
    vertical-align: middle;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: space-around;
}

.sndude-dude-wrap-circle3 .sndude-dude-box-title {
    font-size: 100%;
    /* display: block; */
    text-transform: uppercase;
    font-weight: bold;
    /* text-decoration: underline; */
    padding: 20px 0;
    /* border-left: 10px solid #550080; */
    background: #f1f1f1;
    min-height: 56px;
    vertical-align: middle;
}

.sndude-dude-wrap-circle3 .sndude-dude-box4 {
    background: #f3f3f3;
    padding: 10px;
    border: 1px solid #c7c7c7;
    border-radius: 10px;
}
```
