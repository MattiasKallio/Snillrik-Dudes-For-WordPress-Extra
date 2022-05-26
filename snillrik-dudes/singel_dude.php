<?php

/**
 * Template for single dude.
 * @param array $dude_metas with all metas called snillrik_dude
 * @param string $the_content that is the content.
 * @param string $info_meta_information 
 * @parem string $contact_str (that can be filterd with "snillrik_dudes_contact_info")
 */

?>

<div class='snillrik-dude-main badass-superedit-of-dudepage'>
    <div class='snillrik-dude-left'>
        <h1><?php the_title() ?></h1>
        <?php echo "{$the_content}" ?>
        <div class="badass-superedit-of-contact"><?php echo "{$contact_str}" ?></div>
        <div class="badass-superedit-information"><?php echo "{$info_meta_information}" ?></div>
    </div>
    <div class='snillrik-dude-right'>
        <div class='snillrik-dude-imagecontainer'>
            <?php echo "{$thumb}" ?>
        </div>
    </div>
</div>