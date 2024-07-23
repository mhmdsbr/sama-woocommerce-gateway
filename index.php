<?php
/*
Plugin Name: افزونه پرداخت سما
Version: 5.5.1
Description:  افزونه درگاه پرداخت سما برای فروشگاه ساز ووکامرس
Plugin URI: https://docs.sama.ir/
Author: mohammad mahdi hodayan
Author URI: https://docs.sama.ir/
*/
include_once ("class-wc-gateway-sama.php");
remove_filter('the_content', 'wpautop');
add_action('wp_footer', 'custom_checkout_button_script');
function custom_checkout_button_script()
{
    $sama_plugin_url = plugin_dir_url(__FILE__);

    ?>
    <style>
        .disabled_by_sama_plugin * {
            cursor: no-drop;
        }

        #sama_payment_type_f_field {
            display: none !important;
        }

        .disabled_by_sama_plugin {
            background: #5552;
        }

        #sama_payment_type_f {
            display: none !important;
        }

        @media only screen and (min-width : 720px) {
            .payment_select_button_remove {
                width: 14% !important;
            }
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("form.woocommerce-checkout").prepend(' <div class="sama_bg_box"><div class="sama_main"><div class="sama_main_content"><div class="sama_header_box"><div class="logo_sama"><img src="<?php echo $sama_plugin_url; ?>images/logo_col.png" alt=""></div><div class="sama_head_title">آسودگی خاطر در خرید، امکان پرداخت در آینده!</div></div><div class="sama_boxs_holder"><div class="sama_option" id="zemanat_payment"><div class="payment_descriptions"><div class="payment_title"><div class="payment_icon"><img src="<?php echo $sama_plugin_url; ?>images/payment_checked.svg" alt=""></div><div class="payment_title_txt">پرداخت با ضمانت سما</div><div class="payment_select_btn_side"><div class="payment_select_button disable_all_and_enable_sama"id="disable_all_and_enable_sama">انتخاب پرداخت نقدی</div><div class="payment_select_button_remove w_en_all" style="display:none;"><img src="<?php echo $sama_plugin_url; ?>images/remove_icon.svg" alt=""></div></div></div><div class="payment_info_items"><div class="info_item_sama"><div class="sama_icon_item"><img src="<?php echo $sama_plugin_url; ?>images/check.svg" alt=""></div><div class="info_item_sama_text">امکان بازگشت کالا تا ۱۵ روز پس از خرید</div></div><div class="info_item_sama"><div class="sama_icon_item"><img src="<?php echo $sama_plugin_url; ?>images/check.svg" alt=""></div><div class="info_item_sama_text">بازپرداخت آنی وجه درصورت مغایرت کالا با سفارش</div></div><div class="info_item_sama"><div class="sama_icon_item"><img src="<?php echo $sama_plugin_url; ?>images/check.svg" alt=""></div><div class="info_item_sama_text">بازپرداخت آنی وجه درصورت انصراف از خرید</div></div><div class="info_item_sama"><div class="sama_icon_item"><img src="<?php echo $sama_plugin_url; ?>images/check.svg" alt=""></div><div class="info_item_sama_text">بازپرداخت آنی وجه درصورت عدم‌ارسال کالا توسط فروشگاه</div></div></div></div></div><div class="sama_option" id="etebari_payment"> <div class="payment_descriptions"><div class="payment_title"><div class="payment_icon"><img src="<?php echo $sama_plugin_url; ?>images/payment_date.svg" alt=""></div><div class="payment_title_txt">پرداخت اعتباری سما</div><div class="payment_select_btn_side"><div class="payment_select_button disable_all_and_enable_sama pardakht_etebari">انتخاب پرداخت اعتباری</div><div class="payment_select_button_remove w_en_all" style="display:none;"><img src="<?php echo $sama_plugin_url; ?>images/remove_icon.svg" alt=""></div></div></div><div class="payment_info_items"><div class="info_item_sama"><div class="sama_icon_item"><img src="<?php echo $sama_plugin_url; ?>images/check.svg" alt=""></div><div class="info_item_sama_text">مزایای پرداخت با ضمانت سما</div></div><div class="info_item_sama"><div class="sama_icon_item"><img src="<?php echo $sama_plugin_url; ?>images/check.svg" alt=""></div><div class="info_item_sama_text">استفاده سریع و آسان از اعتبار</div></div><div class="info_item_sama"><div class="sama_icon_item"><img src="<?php echo $sama_plugin_url; ?>images/check.svg" alt=""></div><div class="info_item_sama_text">بدون نیاز به چک، سفته یا ضامن</div></div><div class="info_item_sama"><div class="sama_icon_item"><img src="<?php echo $sama_plugin_url; ?>images/check.svg" alt=""></div><div class="info_item_sama_text">امکان تسویه اقساط در ۴ تا ۱۲ ماه</div></div></div></div></div></div></div></div></div>');
        });

        setTimeout(() => {
            jQuery('p:empty').remove();
        }, 500);
        jQuery('p:empty').remove();
        jQuery(document).ready(function ($) {
            setTimeout(() => {
                jQuery('p:empty').remove();
            }, 500);
            jQuery('p:empty').remove();
            $('.disable_all_and_enable_sama').click(function (e) {
                e.preventDefault();

                $('input[name="payment_method"]').prop('disabled', true);
                // Uncheck other payment methods
                $('input[name="payment_method"]').prop('checked', false);

                $('#payment_method_WC_Samaplugin').prop('checked', true);
                $('#payment_method_WC_Samaplugin').prop('disabled', false);
                $('#payment_method_WC_Samaplugin').click();
                $("#payment_method_WC_Samaplugin").parent().fadeIn();

                // cuctom style for disabled payments : 
                $("ul.wc_payment_methods > li:not(.payment_method_WC_Samaplugin)").addClass("disabled_by_sama_plugin");

                if ($(this).hasClass("pardakht_etebari")) {
                    $("#sama_payment_type_f").val("pardakht_etebari");
                } else {
                    $("#sama_payment_type_f").val("pardakht_zemanati");
                }
            });
            $("#sama_payment_type_f").val("pardakht_Default");
            $('.w_en_all').click(function (e) {
                e.preventDefault();

                $('input[name="payment_method"]').prop('disabled', false);
                // Uncheck other payment methods
                $('input[name="payment_method"]').prop('checked', false);
                $('.wc_payment_method:nth-child(1) input').prop('checked', true);

                // 
                // $("#payment_method_WC_Samaplugin").parent().fadeOut();


                // cuctom style for enable payments : 
                $("ul.wc_payment_methods > li:not(.payment_method_WC_Samaplugin)").removeClass("disabled_by_sama_plugin");
            });
        });
        jQuery(document).ready(function ($) {


            $(".payment_select_button").click(function (e) {
                e.preventDefault();
                // disable other option if selected
                $("body").find(".selected_option_sama").removeClass("selected_option_sama");
                $("body").find(".payment_select_button_remove").hide();
                $("body").find(".payment_select_button").show();

                $(this).hide();
                $(this).parent().find(".payment_select_button_remove").show();
                $(this).parent().parent().parent().parent().addClass("selected_option_sama");
            });
            $(".payment_select_button_remove").click(function (e) {
                e.preventDefault();
                $(this).hide();
                $(this).parent().find(".payment_select_button").show();
                $(this).parent().parent().parent().parent().removeClass("selected_option_sama");
                $("#sama_payment_type_f").val("pardakht_Default");
            });
        });
    </script>
    <link rel="stylesheet" href="<?php echo $sama_plugin_url; ?>css/style.css">
    <style>
        .disabled_payments {
            filter: brightness(0.8);
            background: #fff;
            cursor: no-drop;
        }

        .sama_bg_box {
            width: 100%;
            margin: auto;
            margin-top: 2rem;
        }

        @media only screen and (max-width: 700px) {
            width: 90%;
            margin: auto;
            margin-top: 1rem;
        }
    </style>
    <?php
}



function ps_log( $message ) {
    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        if ( is_array( $message ) || is_object( $message ) ) {
            error_log( print_r( $message, true ) );
        } else {
            error_log( $message );
        }
    }
}
