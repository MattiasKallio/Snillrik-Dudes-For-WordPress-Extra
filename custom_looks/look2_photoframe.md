# Look 2 Photoframe
### Sort of a photo frame look for the Dudes.

Classic photoframe with only the name of the Dude.

First the part in functions.php, or where ever you place your php code. 

```
add_filter("snillrik_dudes_format_look_add_option", function($looks_array){
    $looks_array[] = "photoframe";
    return $looks_array;
},10,1);

//add html to the new look here (or replace old one) with the info from the look info array.
add_filter("snillrik_dudes_format_look_html_out_photoframe", function($html_out,$look_info_array){
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
  <div class='my-dude-frame-name'>$title</div>";

    $html_out .= "</div>";

    return wp_kses_post($html_out);

},10,2);
```
And then some css, that can be placed in your css or customizer. (it might not show up in the shortcode genereator depending on if that css is read in wp-admin or not)
```
/*foto frame*/

.sndude-dude-wrap-photoframe .sndude-dude-box {
    padding: 15px;
    margin: -5px;
    text-align: center;
}

.my-dude-frame {
    position: relative;
    width: calc(100% - 10px);
    padding-bottom: calc(100% - 10px);
    background: white;
    box-shadow: 1px 1px 10px #00000073;
    border: 5px solid white;
    height: 200px;
}

.my-dude-border {
    position: absolute;
    background: #ffffff;
    box-shadow: 1px 1px 7px #0000006e inset;
    width: 100%;
    height: 100%;
}

.my-dude-image {
    background-size: cover;
    background-position: center center;
    width: calc(100% - 40px);
    height: calc(100% - 40px);
    margin: 20px;
    box-shadow: 0px 0px 7px #00000042 inset;
}

.my-dude-image img {
    width: 100%;
}

.my-dude-frame-name {
    position: relative;
    display: inline-block;
    bottom: 30px;
    z-index: 99999999;
    background: white;
    padding: 5px 18px;
    max-width: 80%;
    border: 2px solid #c7c7c7;
    box-shadow: 1px 1px 5px #00000040;
    text-transform: uppercase;
    font-weight: bold;
}
```
