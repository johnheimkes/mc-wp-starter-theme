<?php
/**
 * ACF Module: Image
 *
 * @global $data
 */

use JBH\App\Fields\ACF;
use JBH\App\Media;
use JBH\App\Fields\Util;

$image = ACF::getField('image', $data);

if (! $image) {
    return;
}
?>

<div class="module image">
    <div class="container">
        <div class="module__image">
            <?php echo Util::getImageHTML(Media::getAttachmentByID($image)); ?>
        </div>
    </div>
</div>
