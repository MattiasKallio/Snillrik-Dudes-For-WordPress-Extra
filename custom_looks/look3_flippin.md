#Look 3 Flippin
###One of those flippin things with a photo and the info on the flipside.


First the part in functions.php, or where ever you place your php code. 

```
add_filter("snillrik_dudes_format_look_add_option", function($looks_array){
    $looks_array[] = "flippin";
    return $looks_array;
},10,1);

//the html generating stuff function format_look_html_out_ named with the flippin in the end.
add_filter("snillrik_dudes_format_look_html_out_flippin", function($html_out,$look_info_array){
    extract($look_info_array);
    $rownum = $rownum ? $rownum : 4;
    $total_number_of_dudes = $total_number_of_dudes > $rownum ? $rownum : $total_number_of_dudes;
    $dudebox_boxes_class = $issingle ? "sndude-dude-box-single" : "sndude-dude-box$total_number_of_dudes";
    $html_out .= "<div class='sndude-dude-box $dudebox_boxes_class' data-url='$permalink'>
    <div class='custom-dude-flip-card'>
    <div class='custom-dude-flip-card-front' style='background-image:url($thumb)'>
      <div class=''><h3>$title</h3><h4>$jobtitle</h4></div>
    </div>
    <div class='custom-dude-flip-card-back sndude-dude-box-image'><h3>$title</h3><h4>$jobtitle</h4><div class='custom-dude-flip-card-contact'>$contact_str</div></div>
  </div>
  ";

    $html_out .= "</div>";

    return wp_kses_post($html_out);

},10,2);
```
And then some css, that can be placed in your css or customizer. (it might not show up in the shortcode genereator depending on if that css is read in wp-admin or not)
```

/* Flippin CSS */

.custom-dude-flip-card {
    position: relative;
    width: 100%;
    height: 300px;
    text-align: center;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.sndude-dude-wrap-flippin .sndude-dude-box:hover .custom-dude-flip-card {
    transform: rotateY(180deg);
}

.custom-dude-flip-card-front,
.custom-dude-flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    display: flex;
    align-content: space-between;
    align-items: center;
    justify-content: flex-end;
    flex-direction: column;
    padding: 20px;
}

.custom-dude-flip-card .sndude-dude-box-jobtitle-inner {
    background-color: #ffb713;
}

.custom-dude-flip-card-front {
    background-color: #bbb;
    color: black;
    background-size: cover;
    background-position: center center;
}

.custom-dude-flip-card-front h3 {
    text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
}

.custom-dude-flip-card-back {
    background-color: #ffb713;
    color: white;
    transform: rotateY(180deg);
    justify-content: center;
    cursor: pointer;
}

.custom-dude-flip-card .custom-dude-flip-card-back .sndude-dude-box-jobtitle-inner {
    background-color: #fff;
    color: #ffb713;
}

.custom-dude-flip-card-back h3 {
    color: black;
}

.custom-dude-flip-card-contact a {
    color: white;
}
```
