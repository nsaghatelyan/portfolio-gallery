<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Returns a Portfolio images, other data, and options
 *
 * @param $id
 *
 * @return a Portfolio All data
 */
function portfolio_gallery_showPublishedportfolios_1($id)
{
    global $wpdb;

    $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_itportfolio_images where portfolio_id = '%d' order by ordering ASC", $id);

    $images = $wpdb->get_results($query);
    /***<title display>***/
    $title = array();
    $number = 0;
    foreach ($images as $key => $row) {
        $imagesuploader = explode(";", $row->image_url);
        array_pop($imagesuploader);
        $count = count($imagesuploader);
        for ($i = 0; $i < $count; $i++) {
            $pathinfo = pathinfo($imagesuploader[$i]);
            $filename = $pathinfo["filename"];
            $filename = strtolower($filename);
            $query = $wpdb->prepare("SELECT post_title FROM " . $wpdb->prefix . "posts where post_name = '%s'", $filename);
            $post_result = $wpdb->get_var($query);
            $concat = $post_result . "_-_-_" . $imagesuploader[$i];
            if (in_array($concat, $title)) {
                continue;
            }
            $title[$number] = $concat;
            $number++;
        }
    }
    /***</title display>***/

    $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_itportfolio_portfolios where id = '%d' order by id ASC", $id);

    $portfolio = $wpdb->get_results($query);

    $query = "SELECT * FROM " . $wpdb->prefix . "huge_itportfolio_params";


    $rowspar = $wpdb->get_results($query);

    $paramssld = array();
    foreach ($rowspar as $rowpar) {
        $key = $rowpar->name;
        $value = $rowpar->value;
        $paramssld[$key] = $value;
    }

    return front_end_portfolio($images, $paramssld, $portfolio, $title);

}

if (!function_exists('huge_it_title_img_display')) {
    function huge_it_title_img_display($image_name, $title)
    {
        for ($i = 0; $i < count($title); $i++) {
            $title_explode = explode("_-_-_", $title[$i]);
            if ($title_explode[1] == $image_name) {
                echo $title_explode[0];
            } else {
                echo "";
            }
        }
    }
}

/**
 * Get all general options parameters in a single array
 *
 * @todo: use wp_options instead
 *
 * @return array Array of all general options
 */
function portfolio_gallery_get_general_options()
{
    $paramssld['port_natural_size_toggle'] = "crop";
    $paramssld['port_natural_size_contentpopup'] = "resize";
    $paramssld['ht_view0_border_width'] = "1";
    $paramssld["ht_view0_togglebutton_style"] = "dark";
    $paramssld["ht_view0_show_separator_lines"] = "on";
    $paramssld["ht_view0_linkbutton_text"] = "View More";
    $paramssld["ht_view0_show_linkbutton"] = "on";
    $paramssld["ht_view0_linkbutton_background_hover_color"] = "df2e1b";
    $paramssld["ht_view0_linkbutton_background_color"] = "e74c3c";
    $paramssld["ht_view0_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view0_linkbutton_color"] = "ffffff";
    $paramssld["ht_view0_linkbutton_font_size"] = "14";
    $paramssld["ht_view0_description_color"] = "5b5b5b";
    $paramssld["ht_view0_description_font_size"] = "14";
    $paramssld["ht_view0_show_description"] = "on";
    $paramssld["ht_view0_thumbs_width"] = "75";
    $paramssld["ht_view0_thumbs_position"] = "before";
    $paramssld["ht_view0_show_thumbs"] = "on";
    $paramssld["ht_view0_title_font_size"] = "15";
    $paramssld["ht_view0_title_font_color"] = "555555";
    $paramssld["ht_view0_element_border_width"] = "1";
    $paramssld["ht_view0_element_border_color"] = "D0D0D0";
    $paramssld["ht_view0_element_background_color"] = "f7f7f7";
    $paramssld["ht_view0_block_width"] = "275";
    $paramssld["ht_view0_block_height"] = "160";
    $paramssld["ht_view1_show_separator_lines"] = "on";
    $paramssld["ht_view1_linkbutton_text"] = "View More";
    $paramssld["ht_view1_show_linkbutton"] = "on";
    $paramssld["ht_view1_linkbutton_background_hover_color"] = "df2e1b";
    $paramssld["ht_view1_linkbutton_background_color"] = "e74c3c";
    $paramssld["ht_view1_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view1_linkbutton_color"] = "ffffff";
    $paramssld["ht_view1_linkbutton_font_size"] = "14";
    $paramssld["ht_view1_description_color"] = "5b5b5b";
    $paramssld["ht_view1_description_font_size"] = "14";
    $paramssld["ht_view1_show_description"] = "on";
    $paramssld["ht_view1_thumbs_width"] = "75";
    $paramssld["ht_view1_thumbs_position"] = "before";
    $paramssld["ht_view1_show_thumbs"] = "on";
    $paramssld["ht_view1_title_font_size"] = "15";
    $paramssld["ht_view1_title_font_color"] = "555555";
    $paramssld["ht_view1_element_border_width"] = "1";
    $paramssld["ht_view1_element_border_color"] = "D0D0D0";
    $paramssld["ht_view1_element_background_color"] = "f7f7f7";
    $paramssld["ht_view1_block_width"] = "275";
    $paramssld["ht_view2_element_linkbutton_text"] = "View More";
    $paramssld["ht_view2_element_show_linkbutton"] = "on";
    $paramssld["ht_view2_element_linkbutton_color"] = "ffffff";
    $paramssld["ht_view2_element_linkbutton_font_size"] = "14";
    $paramssld["ht_view2_element_linkbutton_background_color"] = "2ea2cd";
    $paramssld["ht_view2_show_popup_linkbutton"] = "on";
    $paramssld["ht_view2_popup_linkbutton_text"] = "View More";
    $paramssld["ht_view2_popup_linkbutton_background_hover_color"] = "0074a2";
    $paramssld["ht_view2_popup_linkbutton_background_color"] = "2ea2cd";
    $paramssld["ht_view2_popup_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view2_popup_linkbutton_color"] = "ffffff";
    $paramssld["ht_view2_popup_linkbutton_font_size"] = "14";
    $paramssld["ht_view2_description_color"] = "222222";
    $paramssld["ht_view2_description_font_size"] = "14";
    $paramssld["ht_view2_show_description"] = "on";
    $paramssld["ht_view2_thumbs_width"] = "75";
    $paramssld["ht_view2_thumbs_height"] = "75";
    $paramssld["ht_view2_thumbs_position"] = "before";
    $paramssld["ht_view2_show_thumbs"] = "on";
    $paramssld["ht_view2_popup_background_color"] = "FFFFFF";
    $paramssld["ht_view2_popup_overlay_color"] = "000000";
    $paramssld["ht_view2_popup_overlay_transparency_color"] = "70";
    $paramssld["ht_view2_popup_closebutton_style"] = "dark";
    $paramssld["ht_view2_show_separator_lines"] = "on";
    $paramssld["ht_view2_show_popup_title"] = "on";
    $paramssld["ht_view2_element_title_font_size"] = "18";
    $paramssld["ht_view2_element_title_font_color"] = "222222";
    $paramssld["ht_view2_popup_title_font_size"] = "18";
    $paramssld["ht_view2_popup_title_font_color"] = "222222";
    $paramssld["ht_view2_element_overlay_color"] = "FFFFFF";
    $paramssld["ht_view2_element_overlay_transparency"] = "70";
    $paramssld["ht_view2_zoombutton_style"] = "light";
    $paramssld["ht_view2_element_border_width"] = "1";
    $paramssld["ht_view2_element_border_color"] = "dedede";
    $paramssld["ht_view2_element_background_color"] = "f9f9f9";
    $paramssld["ht_view2_element_width"] = "275";
    $paramssld["ht_view2_element_height"] = "160";
    $paramssld["ht_view3_show_separator_lines"] = "on";
    $paramssld["ht_view3_linkbutton_text"] = "View More";
    $paramssld["ht_view3_show_linkbutton"] = "on";
    $paramssld["ht_view3_linkbutton_background_hover_color"] = "0074a2";
    $paramssld["ht_view3_linkbutton_background_color"] = "2ea2cd";
    $paramssld["ht_view3_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view3_linkbutton_color"] = "ffffff";
    $paramssld["ht_view3_linkbutton_font_size"] = "14";
    $paramssld["ht_view3_description_color"] = "555555";
    $paramssld["ht_view3_description_font_size"] = "14";
    $paramssld["ht_view3_show_description"] = "on";
    $paramssld["ht_view3_thumbs_width"] = "75";
    $paramssld["ht_view3_thumbs_height"] = "75";
    $paramssld["ht_view3_show_thumbs"] = "on";
    $paramssld["ht_view3_title_font_size"] = "18";
    $paramssld["ht_view3_title_font_color"] = "0074a2";
    $paramssld["ht_view3_mainimage_width"] = "240";
    $paramssld["ht_view3_element_border_width"] = "1";
    $paramssld["ht_view3_element_border_color"] = "dedede";
    $paramssld["ht_view3_element_background_color"] = "f9f9f9";
    $paramssld["ht_view4_togglebutton_style"] = "dark";
    $paramssld["ht_view4_show_separator_lines"] = "on";
    $paramssld["ht_view4_linkbutton_text"] = "View More";
    $paramssld["ht_view4_show_linkbutton"] = "on";
    $paramssld["ht_view4_linkbutton_background_hover_color"] = "df2e1b";
    $paramssld["ht_view4_linkbutton_background_color"] = "e74c3c";
    $paramssld["ht_view4_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view4_linkbutton_color"] = "ffffff";
    $paramssld["ht_view4_linkbutton_font_size"] = "14";
    $paramssld["ht_view4_description_color"] = "555555";
    $paramssld["ht_view4_description_font_size"] = "14";
    $paramssld["ht_view4_show_description"] = "on";
    $paramssld["ht_view4_title_font_size"] = "18";
    $paramssld["ht_view4_title_font_color"] = "E74C3C";
    $paramssld["ht_view4_element_border_width"] = "1";
    $paramssld["ht_view4_element_border_color"] = "dedede";
    $paramssld["ht_view4_element_background_color"] = "f9f9f9";
    $paramssld["ht_view4_block_width"] = "275";
    $paramssld["ht_view5_icons_style"] = "dark";
    $paramssld["ht_view5_show_separator_lines"] = "on";
    $paramssld["ht_view5_linkbutton_text"] = "View More";
    $paramssld["ht_view5_show_linkbutton"] = "on";
    $paramssld["ht_view5_linkbutton_background_hover_color"] = "0074a2";
    $paramssld["ht_view5_linkbutton_background_color"] = "2ea2cd";
    $paramssld["ht_view5_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view5_linkbutton_color"] = "ffffff";
    $paramssld["ht_view5_linkbutton_font_size"] = "14";
    $paramssld["ht_view5_description_color"] = "555555";
    $paramssld["ht_view5_description_font_size"] = "14";
    $paramssld["ht_view5_show_description"] = "on";
    $paramssld["ht_view5_thumbs_width"] = "75";
    $paramssld["ht_view5_thumbs_height"] = "75";
    $paramssld["ht_view5_show_thumbs"] = "on";
    $paramssld["ht_view5_title_font_size"] = "16";
    $paramssld["ht_view5_title_font_color"] = "0074a2";
    $paramssld["ht_view5_main_image_width"] = "275";
    $paramssld["ht_view5_slider_tabs_font_color"] = "d9d99";
    $paramssld["ht_view5_slider_tabs_background_color"] = "555555";
    $paramssld["ht_view5_slider_background_color"] = "f9f9f9";
    $paramssld["ht_view6_title_font_size"] = "16";
    $paramssld["ht_view6_title_font_color"] = "0074A2";
    $paramssld["ht_view6_title_font_hover_color"] = "2EA2CD";
    $paramssld["ht_view6_title_background_color"] = "000000";
    $paramssld["ht_view6_title_background_transparency"] = "80";
    $paramssld["ht_view6_border_radius"] = "3";
    $paramssld["ht_view6_border_width"] = "0";
    $paramssld["ht_view6_border_color"] = "eeeeee";
    $paramssld["ht_view6_width"] = "275";
    $paramssld["light_box_size"] = "17";
    $paramssld["light_box_width"] = "500";
    $paramssld["light_box_transition"] = "elastic";
    $paramssld["light_box_speed"] = "800";
    $paramssld["light_box_href"] = "False";
    $paramssld["light_box_title"] = "false";
    $paramssld["light_box_scalephotos"] = "true";
    $paramssld["light_box_rel"] = "false";
    $paramssld["light_box_scrolling"] = "false";
    $paramssld["light_box_opacity"] = "20";
    $paramssld["light_box_open"] = "false";
    $paramssld["light_box_overlayclose"] = "true";
    $paramssld["light_box_esckey"] = "false";
    $paramssld["light_box_arrowkey"] = "false";
    $paramssld["light_box_loop"] = "true";
    $paramssld["light_box_data"] = "false";
    $paramssld["light_box_classname"] = "false";
    $paramssld["light_box_fadeout"] = "300";
    $paramssld["light_box_closebutton"] = "true";
    $paramssld["light_box_current"] = "image";
    $paramssld["light_box_previous"] = "previous";
    $paramssld["light_box_next"] = "next";
    $paramssld["light_box_close"] = "close";
    $paramssld["light_box_iframe"] = "false";
    $paramssld["light_box_inline"] = "false";
    $paramssld["light_box_html"] = "false";
    $paramssld["light_box_photo"] = "false";
    $paramssld["light_box_height"] = "500";
    $paramssld["light_box_innerwidth"] = "false";
    $paramssld["light_box_innerheight"] = "false";
    $paramssld["light_box_initialwidth"] = "300";
    $paramssld["light_box_initialheight"] = "100";
    $paramssld["light_box_maxwidth"] = "768";
    $paramssld["light_box_maxheight"] = "500";
    $paramssld["light_box_slideshow"] = "false";
    $paramssld["light_box_slideshowspeed"] = "2500";
    $paramssld["light_box_slideshowauto"] = "true";
    $paramssld["light_box_slideshowstart"] = "start slideshow";
    $paramssld["light_box_slideshowstop"] = "stop slideshow";
    $paramssld["light_box_fixed"] = "true";
    $paramssld["light_box_top"] = "false";
    $paramssld["light_box_bottom"] = "false";
    $paramssld["light_box_left"] = "false";
    $paramssld["light_box_right"] = "false";
    $paramssld["light_box_reposition"] = "false";
    $paramssld["light_box_retinaimage"] = "true";
    $paramssld["light_box_retinaurl"] = "false";
    $paramssld["light_box_retinasuffix"] = "@2x.$1";
    $paramssld["light_box_returnfocus"] = "true";
    $paramssld["light_box_trapfocus"] = "true";
    $paramssld["light_box_fastiframe"] = "true";
    $paramssld["light_box_preloading"] = "true";
    $paramssld["slider_title_position"] = "5";
    $paramssld["light_box_style"] = "1";
    $paramssld["light_box_size_fix"] = "false";
    $paramssld["ht_view0_show_sorting"] = "on";
    $paramssld["ht_view0_sortbutton_font_size"] = "14";
    $paramssld["ht_view0_sortbutton_font_color"] = "555555";
    $paramssld["ht_view0_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view0_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view0_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view0_sortbutton_border_radius"] = "0";
    $paramssld["ht_view0_sortbutton_border_padding"] = "3";
    $paramssld["ht_view0_sorting_float"] = "top";
    $paramssld["ht_view0_show_filtering"] = "on";
    $paramssld["ht_view0_filterbutton_font_size"] = "14";
    $paramssld["ht_view0_filterbutton_font_color"] = "555555";
    $paramssld["ht_view0_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view0_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view0_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view0_filterbutton_border_radius"] = "0";
    $paramssld["ht_view0_filterbutton_border_padding"] = "3";
    $paramssld["ht_view0_filtering_float"] = "left";
    $paramssld["ht_view1_show_sorting"] = "on";
    $paramssld["ht_view1_sortbutton_font_size"] = "14";
    $paramssld["ht_view1_sortbutton_font_color"] = "555555";
    $paramssld["ht_view1_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view1_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view1_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view1_sortbutton_border_radius"] = "0";
    $paramssld["ht_view1_sortbutton_border_padding"] = "3";
    $paramssld["ht_view1_sorting_float"] = "top";
    $paramssld["ht_view1_show_filtering"] = "on";
    $paramssld["ht_view1_filterbutton_font_size"] = "14";
    $paramssld["ht_view1_filterbutton_font_color"] = "555555";
    $paramssld["ht_view1_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view1_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view1_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view1_filterbutton_border_radius"] = "0";
    $paramssld["ht_view1_filterbutton_border_padding"] = "3";
    $paramssld["ht_view1_filtering_float"] = "left";
    $paramssld["ht_view2_show_sorting"] = "on";
    $paramssld["ht_view2_sortbutton_font_size"] = "14";
    $paramssld["ht_view2_sortbutton_font_color"] = "555555";
    $paramssld["ht_view2_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view2_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view2_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view2_sortbutton_border_radius"] = "0";
    $paramssld["ht_view2_sortbutton_border_padding"] = "3";
    $paramssld["ht_view2_sorting_float"] = "top";
    $paramssld["ht_view2_show_filtering"] = "on";
    $paramssld["ht_view2_filterbutton_font_size"] = "14";
    $paramssld["ht_view2_filterbutton_font_color"] = "555555";
    $paramssld["ht_view2_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view2_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view2_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view2_filterbutton_border_radius"] = "0";
    $paramssld["ht_view2_filterbutton_border_padding"] = "3";
    $paramssld["ht_view2_filtering_float"] = "left";
    $paramssld["ht_view3_show_sorting"] = "on";
    $paramssld["ht_view3_sortbutton_font_size"] = "14";
    $paramssld["ht_view3_sortbutton_font_color"] = "555555";
    $paramssld["ht_view3_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view3_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view3_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view3_sortbutton_border_radius"] = "0";
    $paramssld["ht_view3_sortbutton_border_padding"] = "3";
    $paramssld["ht_view3_sorting_float"] = "top";
    $paramssld["ht_view3_show_filtering"] = "on";
    $paramssld["ht_view3_filterbutton_font_size"] = "14";
    $paramssld["ht_view3_filterbutton_font_color"] = "555555";
    $paramssld["ht_view3_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view3_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view3_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view3_filterbutton_border_radius"] = "0";
    $paramssld["ht_view3_filterbutton_border_padding"] = "3";
    $paramssld["ht_view3_filtering_float"] = "left";
    $paramssld["ht_view4_show_sorting"] = "on";
    $paramssld["ht_view4_sortbutton_font_size"] = "14";
    $paramssld["ht_view4_sortbutton_font_color"] = "555555";
    $paramssld["ht_view4_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view4_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view4_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view4_sortbutton_border_radius"] = "0";
    $paramssld["ht_view4_sortbutton_border_padding"] = "3";
    $paramssld["ht_view4_sorting_float"] = "top";
    $paramssld["ht_view4_show_filtering"] = "on";
    $paramssld["ht_view4_filterbutton_font_size"] = "14";
    $paramssld["ht_view4_filterbutton_font_color"] = "555555";
    $paramssld["ht_view4_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view4_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view4_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view4_filterbutton_border_radius"] = "0";
    $paramssld["ht_view4_filterbutton_border_padding"] = "3";
    $paramssld["ht_view4_filtering_float"] = "left";
    $paramssld["ht_view6_show_sorting"] = "on";
    $paramssld["ht_view6_sortbutton_font_size"] = "14";
    $paramssld["ht_view6_sortbutton_font_color"] = "555555";
    $paramssld["ht_view6_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view6_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view6_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view6_sortbutton_border_radius"] = "0";
    $paramssld["ht_view6_sortbutton_border_padding"] = "3";
    $paramssld["ht_view6_sorting_float"] = "top";
    $paramssld["ht_view6_show_filtering"] = "on";
    $paramssld["ht_view6_filterbutton_font_size"] = "14";
    $paramssld["ht_view6_filterbutton_font_color"] = "555555";
    $paramssld["ht_view6_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view6_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view6_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view6_filterbutton_border_radius"] = "0";
    $paramssld["ht_view6_filterbutton_border_padding"] = "3";
    $paramssld["ht_view6_filtering_float"] = "left";
    $paramssld["ht_view0_sorting_name_by_default"] = "Default";
    $paramssld["ht_view0_sorting_name_by_id"] = "Date";
    $paramssld["ht_view0_sorting_name_by_name"] = "Title";
    $paramssld["ht_view0_sorting_name_by_random"] = "Random";
    $paramssld["ht_view0_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view0_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view1_sorting_name_by_default"] = "Default";
    $paramssld["ht_view1_sorting_name_by_id"] = "Date";
    $paramssld["ht_view1_sorting_name_by_name"] = "Title";
    $paramssld["ht_view1_sorting_name_by_random"] = "Random";
    $paramssld["ht_view1_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view1_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view2_popup_full_width"] = "on";
    $paramssld["ht_view2_sorting_name_by_default"] = "Default";
    $paramssld["ht_view2_sorting_name_by_id"] = "Date";
    $paramssld["ht_view2_sorting_name_by_name"] = "Title";
    $paramssld["ht_view2_sorting_name_by_random"] = "Random";
    $paramssld["ht_view2_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view2_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view3_sorting_name_by_default"] = "Default";
    $paramssld["ht_view3_sorting_name_by_id"] = "Date";
    $paramssld["ht_view3_sorting_name_by_name"] = "Title";
    $paramssld["ht_view3_sorting_name_by_random"] = "Random";
    $paramssld["ht_view3_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view3_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view4_sorting_name_by_default"] = "Default";
    $paramssld["ht_view4_sorting_name_by_id"] = "Date";
    $paramssld["ht_view4_sorting_name_by_name"] = "Title";
    $paramssld["ht_view4_sorting_name_by_random"] = "Random";
    $paramssld["ht_view4_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view4_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view5_sorting_name_by_default"] = "Default";
    $paramssld["ht_view5_sorting_name_by_id"] = "Date";
    $paramssld["ht_view5_sorting_name_by_name"] = "Title";
    $paramssld["ht_view5_sorting_name_by_random"] = "Random";
    $paramssld["ht_view5_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view5_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view6_sorting_name_by_default"] = "Default";
    $paramssld["ht_view6_sorting_name_by_id"] = "Date";
    $paramssld["ht_view6_sorting_name_by_name"] = "Title";
    $paramssld["ht_view6_sorting_name_by_random"] = "Random";
    $paramssld["ht_view6_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view6_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view0_togglebutton_style"] = "dark";
    $paramssld["ht_view0_show_separator_lines"] = "on";
    $paramssld["ht_view0_linkbutton_text"] = "View More";
    $paramssld["ht_view0_show_linkbutton"] = "on";
    $paramssld["ht_view0_linkbutton_background_hover_color"] = "df2e1b";
    $paramssld["ht_view0_linkbutton_background_color"] = "e74c3c";
    $paramssld["ht_view0_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view0_linkbutton_color"] = "ffffff";
    $paramssld["ht_view0_linkbutton_font_size"] = "14";
    $paramssld["ht_view0_description_color"] = "5b5b5b";
    $paramssld["ht_view0_description_font_size"] = "14";
    $paramssld["ht_view0_show_description"] = "on";
    $paramssld["ht_view0_thumbs_width"] = "75";
    $paramssld["ht_view0_thumbs_position"] = "before";
    $paramssld["ht_view0_show_thumbs"] = "on";
    $paramssld["ht_view0_title_font_size"] = "15";
    $paramssld["ht_view0_title_font_color"] = "555555";
    $paramssld["ht_view0_element_border_width"] = "1";
    $paramssld["ht_view0_element_border_color"] = "D0D0D0";
    $paramssld["ht_view0_element_background_color"] = "f7f7f7";
    $paramssld["ht_view0_block_width"] = "275";
    $paramssld["ht_view0_block_height"] = "160";
    $paramssld["ht_view1_show_separator_lines"] = "on";
    $paramssld["ht_view1_linkbutton_text"] = "View More";
    $paramssld["ht_view1_show_linkbutton"] = "on";
    $paramssld["ht_view1_linkbutton_background_hover_color"] = "df2e1b";
    $paramssld["ht_view1_linkbutton_background_color"] = "e74c3c";
    $paramssld["ht_view1_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view1_linkbutton_color"] = "ffffff";
    $paramssld["ht_view1_linkbutton_font_size"] = "14";
    $paramssld["ht_view1_description_color"] = "5b5b5b";
    $paramssld["ht_view1_description_font_size"] = "14";
    $paramssld["ht_view1_show_description"] = "on";
    $paramssld["ht_view1_thumbs_width"] = "75";
    $paramssld["ht_view1_thumbs_position"] = "before";
    $paramssld["ht_view1_show_thumbs"] = "on";
    $paramssld["ht_view1_title_font_size"] = "15";
    $paramssld["ht_view1_title_font_color"] = "555555";
    $paramssld["ht_view1_element_border_width"] = "1";
    $paramssld["ht_view1_element_border_color"] = "D0D0D0";
    $paramssld["ht_view1_element_background_color"] = "f7f7f7";
    $paramssld["ht_view1_block_width"] = "275";
    $paramssld["ht_view2_element_linkbutton_text"] = "View More";
    $paramssld["ht_view2_element_show_linkbutton"] = "on";
    $paramssld["ht_view2_element_linkbutton_color"] = "ffffff";
    $paramssld["ht_view2_element_linkbutton_font_size"] = "14";
    $paramssld["ht_view2_element_linkbutton_background_color"] = "2ea2cd";
    $paramssld["ht_view2_show_popup_linkbutton"] = "on";
    $paramssld["ht_view2_popup_linkbutton_text"] = "View More";
    $paramssld["ht_view2_popup_linkbutton_background_hover_color"] = "0074a2";
    $paramssld["ht_view2_popup_linkbutton_background_color"] = "2ea2cd";
    $paramssld["ht_view2_popup_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view2_popup_linkbutton_color"] = "ffffff";
    $paramssld["ht_view2_popup_linkbutton_font_size"] = "14";
    $paramssld["ht_view2_description_color"] = "222222";
    $paramssld["ht_view2_description_font_size"] = "14";
    $paramssld["ht_view2_show_description"] = "on";
    $paramssld["ht_view2_thumbs_width"] = "75";
    $paramssld["ht_view2_thumbs_height"] = "75";
    $paramssld["ht_view2_thumbs_position"] = "before";
    $paramssld["ht_view2_show_thumbs"] = "on";
    $paramssld["ht_view2_popup_background_color"] = "FFFFFF";
    $paramssld["ht_view2_popup_overlay_color"] = "000000";
    $paramssld["ht_view2_popup_overlay_transparency_color"] = "70";
    $paramssld["ht_view2_popup_closebutton_style"] = "dark";
    $paramssld["ht_view2_show_separator_lines"] = "on";
    $paramssld["ht_view2_show_popup_title"] = "on";
    $paramssld["ht_view2_element_title_font_size"] = "18";
    $paramssld["ht_view2_element_title_font_color"] = "222222";
    $paramssld["ht_view2_popup_title_font_size"] = "18";
    $paramssld["ht_view2_popup_title_font_color"] = "222222";
    $paramssld["ht_view2_element_overlay_color"] = "FFFFFF";
    $paramssld["ht_view2_element_overlay_transparency"] = "70";
    $paramssld["ht_view2_zoombutton_style"] = "light";
    $paramssld["ht_view2_element_border_width"] = "1";
    $paramssld["ht_view2_element_border_color"] = "dedede";
    $paramssld["ht_view2_element_background_color"] = "f9f9f9";
    $paramssld["ht_view2_element_width"] = "275";
    $paramssld["ht_view2_element_height"] = "160";
    $paramssld["ht_view3_show_separator_lines"] = "on";
    $paramssld["ht_view3_linkbutton_text"] = "View More";
    $paramssld["ht_view3_show_linkbutton"] = "on";
    $paramssld["ht_view3_linkbutton_background_hover_color"] = "0074a2";
    $paramssld["ht_view3_linkbutton_background_color"] = "2ea2cd";
    $paramssld["ht_view3_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view3_linkbutton_color"] = "ffffff";
    $paramssld["ht_view3_linkbutton_font_size"] = "14";
    $paramssld["ht_view3_description_color"] = "555555";
    $paramssld["ht_view3_description_font_size"] = "14";
    $paramssld["ht_view3_show_description"] = "on";
    $paramssld["ht_view3_thumbs_width"] = "75";
    $paramssld["ht_view3_thumbs_height"] = "75";
    $paramssld["ht_view3_show_thumbs"] = "on";
    $paramssld["ht_view3_title_font_size"] = "18";
    $paramssld["ht_view3_title_font_color"] = "0074a2";
    $paramssld["ht_view3_mainimage_width"] = "240";
    $paramssld["ht_view3_element_border_width"] = "1";
    $paramssld["ht_view3_element_border_color"] = "dedede";
    $paramssld["ht_view3_element_background_color"] = "f9f9f9";
    $paramssld["ht_view4_togglebutton_style"] = "dark";
    $paramssld["ht_view4_show_separator_lines"] = "on";
    $paramssld["ht_view4_linkbutton_text"] = "View More";
    $paramssld["ht_view4_show_linkbutton"] = "on";
    $paramssld["ht_view4_linkbutton_background_hover_color"] = "df2e1b";
    $paramssld["ht_view4_linkbutton_background_color"] = "e74c3c";
    $paramssld["ht_view4_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view4_linkbutton_color"] = "ffffff";
    $paramssld["ht_view4_linkbutton_font_size"] = "14";
    $paramssld["ht_view4_description_color"] = "555555";
    $paramssld["ht_view4_description_font_size"] = "14";
    $paramssld["ht_view4_show_description"] = "on";
    $paramssld["ht_view4_title_font_size"] = "18";
    $paramssld["ht_view4_title_font_color"] = "E74C3C";
    $paramssld["ht_view4_element_border_width"] = "1";
    $paramssld["ht_view4_element_border_color"] = "dedede";
    $paramssld["ht_view4_element_background_color"] = "f9f9f9";
    $paramssld["ht_view4_block_width"] = "275";
    $paramssld["ht_view5_icons_style"] = "dark";
    $paramssld["ht_view5_show_separator_lines"] = "on";
    $paramssld["ht_view5_linkbutton_text"] = "View More";
    $paramssld["ht_view5_show_linkbutton"] = "on";
    $paramssld["ht_view5_linkbutton_background_hover_color"] = "0074a2";
    $paramssld["ht_view5_linkbutton_background_color"] = "2ea2cd";
    $paramssld["ht_view5_linkbutton_font_hover_color"] = "ffffff";
    $paramssld["ht_view5_linkbutton_color"] = "ffffff";
    $paramssld["ht_view5_linkbutton_font_size"] = "14";
    $paramssld["ht_view5_description_color"] = "555555";
    $paramssld["ht_view5_description_font_size"] = "14";
    $paramssld["ht_view5_show_description"] = "on";
    $paramssld["ht_view5_thumbs_width"] = "75";
    $paramssld["ht_view5_thumbs_height"] = "75";
    $paramssld["ht_view5_show_thumbs"] = "on";
    $paramssld["ht_view5_title_font_size"] = "16";
    $paramssld["ht_view5_title_font_color"] = "0074a2";
    $paramssld["ht_view5_main_image_width"] = "275";
    $paramssld["ht_view5_slider_tabs_font_color"] = "d9d99";
    $paramssld["ht_view5_slider_tabs_background_color"] = "555555";
    $paramssld["ht_view5_slider_background_color"] = "f9f9f9";
    $paramssld["ht_view6_title_font_size"] = "16";
    $paramssld["ht_view6_title_font_color"] = "0074A2";
    $paramssld["ht_view6_title_font_hover_color"] = "2EA2CD";
    $paramssld["ht_view6_title_background_color"] = "000000";
    $paramssld["ht_view6_title_background_transparency"] = "80";
    $paramssld["ht_view6_border_radius"] = "3";
    $paramssld["ht_view6_border_width"] = "0";
    $paramssld["ht_view6_border_color"] = "eeeeee";
    $paramssld["ht_view6_width"] = "275";
    $paramssld["light_box_size"] = "17";
    $paramssld["light_box_width"] = "500";
    $paramssld["light_box_transition"] = "elastic";
    $paramssld["light_box_speed"] = "800";
    $paramssld["light_box_href"] = "False";
    $paramssld["light_box_title"] = "false";
    $paramssld["light_box_scalephotos"] = "true";
    $paramssld["light_box_rel"] = "false";
    $paramssld["light_box_scrolling"] = "false";
    $paramssld["light_box_opacity"] = "20";
    $paramssld["light_box_open"] = "false";
    $paramssld["light_box_overlayclose"] = "true";
    $paramssld["light_box_esckey"] = "false";
    $paramssld["light_box_arrowkey"] = "false";
    $paramssld["light_box_loop"] = "true";
    $paramssld["light_box_data"] = "false";
    $paramssld["light_box_classname"] = "false";
    $paramssld["light_box_fadeout"] = "300";
    $paramssld["light_box_closebutton"] = "true";
    $paramssld["light_box_current"] = "image";
    $paramssld["light_box_previous"] = "previous";
    $paramssld["light_box_next"] = "next";
    $paramssld["light_box_close"] = "close";
    $paramssld["light_box_iframe"] = "false";
    $paramssld["light_box_inline"] = "false";
    $paramssld["light_box_html"] = "false";
    $paramssld["light_box_photo"] = "false";
    $paramssld["light_box_height"] = "500";
    $paramssld["light_box_innerwidth"] = "false";
    $paramssld["light_box_innerheight"] = "false";
    $paramssld["light_box_initialwidth"] = "300";
    $paramssld["light_box_initialheight"] = "100";
    $paramssld["light_box_maxwidth"] = "768";
    $paramssld["light_box_maxheight"] = "500";
    $paramssld["light_box_slideshow"] = "false";
    $paramssld["light_box_slideshowspeed"] = "2500";
    $paramssld["light_box_slideshowauto"] = "true";
    $paramssld["light_box_slideshowstart"] = "start slideshow";
    $paramssld["light_box_slideshowstop"] = "stop slideshow";
    $paramssld["light_box_fixed"] = "true";
    $paramssld["light_box_top"] = "false";
    $paramssld["light_box_bottom"] = "false";
    $paramssld["light_box_left"] = "false";
    $paramssld["light_box_right"] = "false";
    $paramssld["light_box_reposition"] = "false";
    $paramssld["light_box_retinaimage"] = "true";
    $paramssld["light_box_retinaurl"] = "false";
    $paramssld["light_box_retinasuffix"] = "@2x.$1";
    $paramssld["light_box_returnfocus"] = "true";
    $paramssld["light_box_trapfocus"] = "true";
    $paramssld["light_box_fastiframe"] = "true";
    $paramssld["light_box_preloading"] = "true";
    $paramssld["slider_title_position"] = "5";
    $paramssld["light_box_style"] = "1";
    $paramssld["light_box_size_fix"] = "false";
    $paramssld["ht_view0_show_sorting"] = "on";
    $paramssld["ht_view0_sortbutton_font_size"] = "14";
    $paramssld["ht_view0_sortbutton_font_color"] = "555555";
    $paramssld["ht_view0_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view0_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view0_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view0_sortbutton_border_radius"] = "0";
    $paramssld["ht_view0_sortbutton_border_padding"] = "3";
    $paramssld["ht_view0_sorting_float"] = "top";
    $paramssld["ht_view0_show_filtering"] = "on";
    $paramssld["ht_view0_filterbutton_font_size"] = "14";
    $paramssld["ht_view0_filterbutton_font_color"] = "555555";
    $paramssld["ht_view0_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view0_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view0_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view0_filterbutton_border_radius"] = "0";
    $paramssld["ht_view0_filterbutton_border_padding"] = "3";
    $paramssld["ht_view0_filtering_float"] = "left";
    $paramssld["ht_view1_show_sorting"] = "on";
    $paramssld["ht_view1_sortbutton_font_size"] = "14";
    $paramssld["ht_view1_sortbutton_font_color"] = "555555";
    $paramssld["ht_view1_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view1_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view1_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view1_sortbutton_border_radius"] = "0";
    $paramssld["ht_view1_sortbutton_border_padding"] = "3";
    $paramssld["ht_view1_sorting_float"] = "top";
    $paramssld["ht_view1_show_filtering"] = "on";
    $paramssld["ht_view1_filterbutton_font_size"] = "14";
    $paramssld["ht_view1_filterbutton_font_color"] = "555555";
    $paramssld["ht_view1_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view1_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view1_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view1_filterbutton_border_radius"] = "0";
    $paramssld["ht_view1_filterbutton_border_padding"] = "3";
    $paramssld["ht_view1_filtering_float"] = "left";
    $paramssld["ht_view2_show_sorting"] = "on";
    $paramssld["ht_view2_sortbutton_font_size"] = "14";
    $paramssld["ht_view2_sortbutton_font_color"] = "555555";
    $paramssld["ht_view2_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view2_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view2_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view2_sortbutton_border_radius"] = "0";
    $paramssld["ht_view2_sortbutton_border_padding"] = "3";
    $paramssld["ht_view2_sorting_float"] = "top";
    $paramssld["ht_view2_show_filtering"] = "on";
    $paramssld["ht_view2_filterbutton_font_size"] = "14";
    $paramssld["ht_view2_filterbutton_font_color"] = "555555";
    $paramssld["ht_view2_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view2_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view2_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view2_filterbutton_border_radius"] = "0";
    $paramssld["ht_view2_filterbutton_border_padding"] = "3";
    $paramssld["ht_view2_filtering_float"] = "left";
    $paramssld["ht_view3_show_sorting"] = "on";
    $paramssld["ht_view3_sortbutton_font_size"] = "14";
    $paramssld["ht_view3_sortbutton_font_color"] = "555555";
    $paramssld["ht_view3_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view3_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view3_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view3_sortbutton_border_radius"] = "0";
    $paramssld["ht_view3_sortbutton_border_padding"] = "3";
    $paramssld["ht_view3_sorting_float"] = "top";
    $paramssld["ht_view3_show_filtering"] = "on";
    $paramssld["ht_view3_filterbutton_font_size"] = "14";
    $paramssld["ht_view3_filterbutton_font_color"] = "555555";
    $paramssld["ht_view3_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view3_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view3_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view3_filterbutton_border_radius"] = "0";
    $paramssld["ht_view3_filterbutton_border_padding"] = "3";
    $paramssld["ht_view3_filtering_float"] = "left";
    $paramssld["ht_view4_show_sorting"] = "on";
    $paramssld["ht_view4_sortbutton_font_size"] = "14";
    $paramssld["ht_view4_sortbutton_font_color"] = "555555";
    $paramssld["ht_view4_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view4_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view4_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view4_sortbutton_border_radius"] = "0";
    $paramssld["ht_view4_sortbutton_border_padding"] = "3";
    $paramssld["ht_view4_sorting_float"] = "top";
    $paramssld["ht_view4_show_filtering"] = "on";
    $paramssld["ht_view4_filterbutton_font_size"] = "14";
    $paramssld["ht_view4_filterbutton_font_color"] = "555555";
    $paramssld["ht_view4_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view4_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view4_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view4_filterbutton_border_radius"] = "0";
    $paramssld["ht_view4_filterbutton_border_padding"] = "3";
    $paramssld["ht_view4_filtering_float"] = "left";
    $paramssld["ht_view6_show_sorting"] = "on";
    $paramssld["ht_view6_sortbutton_font_size"] = "14";
    $paramssld["ht_view6_sortbutton_font_color"] = "555555";
    $paramssld["ht_view6_sortbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view6_sortbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view6_sortbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view6_sortbutton_border_radius"] = "0";
    $paramssld["ht_view6_sortbutton_border_padding"] = "3";
    $paramssld["ht_view6_sorting_float"] = "top";
    $paramssld["ht_view6_show_filtering"] = "on";
    $paramssld["ht_view6_filterbutton_font_size"] = "14";
    $paramssld["ht_view6_filterbutton_font_color"] = "555555";
    $paramssld["ht_view6_filterbutton_background_color"] = "F7F7F7";
    $paramssld["ht_view6_filterbutton_hover_font_color"] = "ffffff";
    $paramssld["ht_view6_filterbutton_hover_background_color"] = "FF3845";
    $paramssld["ht_view6_filterbutton_border_radius"] = "0";
    $paramssld["ht_view6_filterbutton_border_padding"] = "3";
    $paramssld["ht_view6_filtering_float"] = "left";
    $paramssld["ht_view0_sorting_name_by_default"] = "Default";
    $paramssld["ht_view0_sorting_name_by_id"] = "Date";
    $paramssld["ht_view0_sorting_name_by_name"] = "Title";
    $paramssld["ht_view0_sorting_name_by_random"] = "Random";
    $paramssld["ht_view0_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view0_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view1_sorting_name_by_default"] = "Default";
    $paramssld["ht_view1_sorting_name_by_id"] = "Date";
    $paramssld["ht_view1_sorting_name_by_name"] = "Title";
    $paramssld["ht_view1_sorting_name_by_random"] = "Random";
    $paramssld["ht_view1_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view1_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view2_popup_full_width"] = "on";
    $paramssld["ht_view2_sorting_name_by_default"] = "Default";
    $paramssld["ht_view2_sorting_name_by_id"] = "Date";
    $paramssld["ht_view2_sorting_name_by_name"] = "Title";
    $paramssld["ht_view2_sorting_name_by_random"] = "Random";
    $paramssld["ht_view2_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view2_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view3_sorting_name_by_default"] = "Default";
    $paramssld["ht_view3_sorting_name_by_id"] = "Date";
    $paramssld["ht_view3_sorting_name_by_name"] = "Title";
    $paramssld["ht_view3_sorting_name_by_random"] = "Random";
    $paramssld["ht_view3_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view3_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view4_sorting_name_by_default"] = "Default";
    $paramssld["ht_view4_sorting_name_by_id"] = "Date";
    $paramssld["ht_view4_sorting_name_by_name"] = "Title";
    $paramssld["ht_view4_sorting_name_by_random"] = "Random";
    $paramssld["ht_view4_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view4_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view5_sorting_name_by_default"] = "Default";
    $paramssld["ht_view5_sorting_name_by_id"] = "Date";
    $paramssld["ht_view5_sorting_name_by_name"] = "Title";
    $paramssld["ht_view5_sorting_name_by_random"] = "Random";
    $paramssld["ht_view5_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view5_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view6_sorting_name_by_default"] = "Default";
    $paramssld["ht_view6_sorting_name_by_id"] = "Date";
    $paramssld["ht_view6_sorting_name_by_name"] = "Title";
    $paramssld["ht_view6_sorting_name_by_random"] = "Random";
    $paramssld["ht_view6_sorting_name_by_asc"] = "Ascending";
    $paramssld["ht_view6_sorting_name_by_desc"] = "Descending";
    $paramssld["ht_view0_cat_all"] = "All";
    $paramssld["ht_view1_cat_all"] = "All";
    $paramssld["ht_view2_cat_all"] = "All";
    $paramssld["ht_view3_cat_all"] = "All";
    $paramssld["ht_view4_cat_all"] = "All";
    $paramssld["ht_view6_cat_all"] = "All";

    return $paramssld;
}

function portfolio_gallery_get_view_slag_by_id($id)
{
    global $wpdb;
    $query = $wpdb->prepare("SELECT portfolio_list_effects_s from " . $wpdb->prefix . "huge_itportfolio_portfolios WHERE id=%d", $id);
    $view = $wpdb->get_var($query);
    switch ($view) {
        case 0:
            $slug = 'toggle-up-down';
            break;
        case 1:
            $slug = 'full-height';
            break;
        case 2:
            $slug = 'content-popup';
            break;
        case 3:
            $slug = 'full-width';
            break;
        case 4:
            $slug = 'faq';
            break;
        case 5:
            $slug = 'content-slider';
            break;
        case 6:
            $slug = 'lightbox-gallery';
            break;
    }
    return $slug;
}

/**
 * Get attachment ID by image src
 *
 * @param $image_url
 * @return mixed
 */
function portfolio_gallery_get_image_id($image_url)
{
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $wpdb->prefix . "posts WHERE guid='%s';", $image_url));
    return $attachment[0];
}

/**
 * Get image url by image src, width, height
 *
 * @param $image_src
 * @param $image_width
 * @param $image_height
 * @param bool $is_attachment
 * @return false|string
 */
function get_image_by_sizes_and_src( $image_src, $image_sizes, $is_thumbnail )
{
    $is_attachment = portfolio_gallery_get_image_id( $image_src );
    
    if ( is_string($image_sizes) ){
        $image_sizes =  $image_sizes;
        $img_width = intval( $image_sizes );
    }
    if ( is_object($image_sizes) ) {
        // Closures are currently implemented as objects
        $image_sizes = array( $image_sizes, '' );
    } else {
        $image_sizes = (array) $image_sizes;
    }
    if (!$is_attachment) {
        $image_url = $image_src;
    } else {
        $attachment_id = portfolio_gallery_get_image_id($image_src);
        $natural_img_width = explode( ',', wp_get_attachment_image_sizes( $attachment_id, 'full' ) );
        $natural_img_width = $natural_img_width[1];
        $natural_img_width = str_replace( ' ', '', $natural_img_width);
        $natural_img_width = intval( str_replace( 'px', '', $natural_img_width ) );
        if( $img_width <= 150 && !$is_thumbnail )
            $image_url = wp_get_attachment_image_url($attachment_id, 'medium');
        elseif( $img_width >= $natural_img_width )
            $image_url = wp_get_attachment_image_url($attachment_id, 'full');
        else 
            $image_url = wp_get_attachment_image_url($attachment_id, $image_sizes);
    }
    return $image_url;
}
