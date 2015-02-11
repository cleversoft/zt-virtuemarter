<?php // no direct access
defined('_JEXEC') or die('Restricted access');

// add javascript for price and cart, need even for quantity buttons, so we need it almost anywhere
vmJsApi::jPrice();
$url_file = JURI::root(true);
$product_number = 0;
$productss = array();
for ($i = 0; $i < strlen($url_file); $i++) {
    if ($url_file[$i] == '/') {
        $product_number = $i;
    }
}
$url_file = substr($url_file, $product_number);
$num = $products_per_row;
if (isset($_POST['product'])) {
    $num = intval($_POST['product']) + $products_per_row;
    if ($num > count($products)) {
        $num = count($products);
    }
    for ($i = 0; $i < $num; $i++) {
        $productss[$i] = $products[$i];
    }
    require('subtmpl/load_ajax.php');
    die;
}
if ($num > count($products)) {
    $num = count($products);
}
for ($i = 0; $i < $num; $i++) {
    $productss[$i] = $products[$i];
}
?>
<div id="products_require">
    <?php
    require('subtmpl/load_ajax.php');
    ?>
</div>
<input type="hidden" class="base_url" value="<?php JURI::root(); ?>"/>
<input type="hidden" class="num_plus" value="<?php echo $products_per_row;?>"/>
<div class="more-product">
    <a class="more_product readmore" style="cursor:pointer">More Products...</a>
</div>
<!--ajax-->
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.more_product').click(function () {
            var base_url = jQuery('.base_url').val();
            var num = jQuery('.num_plus').val();
            num = parseFloat(num);
            jQuery.ajax({
                url: base_url,
                type: 'POST',
                cache: false,
                data: 'product=' + num,
                success: function (string) {

                    //----------------$$$-------------------------

                    //----------------end $$$---------------------
                    var num = parseFloat(jQuery('.num_plus').val());
                    num = num + 4;
                    if (string) {
                        jQuery('#products_require').html('');
                        jQuery('#products_require').append(string);
                        jQuery('.num_plus').val(num);
                    }

                    var show_quicktext = "Quick View";

                    jQuery(".zt-product-content").each(function (indx, element) {
                        var my_product_id = jQuery(this).find(".quick_ids").val();
                        if (my_product_id) {
                            jQuery(this).append("<div class=\'quick_btn\' onClick =\'quick_btn(" + my_product_id + ")\'><i class=\'fa fa-search\'></i><span>" + show_quicktext + "</span></div>");
                        }
                        jQuery(this).find(".quick_id").remove();
                    });

                    Virtuemart.product(jQuery("form.product"));
                },
                error: function () {
                    alert("Can not get more product!");
                }
            });
        });
    });
</script>