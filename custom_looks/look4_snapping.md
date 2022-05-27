
# Look 4 Snapping
### Mostly just good for mobile size, it snaps to the next Dude like TikTok etc.


First the part in functions.php, or where ever you place your php code. 

```
add_filter("snillrik_dudes_format_look_add_option", function ($looks_array) {
    $looks_array[] = "snapping";
    //Or something like this if you have more than one look and don't want to add more filters.
    //$looks_array = array_merge($looks_array,["photoframe", "flippin", "snapping"]); 
    return $looks_array;
}, 10, 1);

//add html to the new look here (or replace old one) with the info from the look info array.
add_filter("snillrik_dudes_format_look_html_out_snapping", function ($html_out, $look_info_array) {
    extract($look_info_array);

    $html_out .= "<div class='sndude-dude-box' data-url='$permalink'>
    <div class='custom-dude-snapping'>
    <div class='custom-dude-snapping-inner' style='background-image:url($thumb)'>
      <div class='custom-dude-snapping-content'>
        <div class='custom-dude-snapping-infobox'><h3>$title</h3>$jobtitle</div>
        </div>
    </div>
  </div>
  ";

    $html_out .= "</div>";

    return wp_kses_post($html_out);
}, 10, 2);
```
And then some css, that can be placed in your css or customizer. (it might not show up in the shortcode genereator depending on if that css is read in wp-admin or not)
```

/**
* Snapping
*/

.sndude-dude-wrap-snapping {
    display: inline-block;
    height: calc(100vh - 125px);
    margin: 0 auto;
    white-space: nowrap;
    scroll-snap-type: x mandatory;
    overflow-y: scroll;
    scroll-snap-type: y mandatory;
}

.sndude-dude-wrap-snapping .sndude-dude-box {
    scroll-snap-align: center;
    height: 100%;
}

.custom-dude-snapping {
    height: 100%;
}

.custom-dude-snapping-inner {
    height: 100%;
    background-size: cover;
    background-position: center center;
}

.custom-dude-snapping-content {
    height: 100%;
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    align-items: flex-end;
    padding-bottom: 35px;
    align-content: flex-end;
}

.custom-dude-snapping-content h3 {
    color: rgb(0 0 0);
    margin-bottom: 5px;
}

.custom-dude-snapping-infobox {
    background-color: #ffffffb5;
    padding: 0px 34px 10px;
    border-radius: 35px 0 0 35px;
    text-align: right;
}

.sndude-dude-box-jobtitle-inner {
    background-color: #a504bd;
}
```
