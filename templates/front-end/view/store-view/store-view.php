<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if(isset($_GET['single_prod_id'])){
    $id = $_GET['single_prod_id'];
  global $wpdb;
    $query = $wpdb->prepare("SELECT `name`,`description` FROM " . $wpdb->prefix . "huge_itportfolio_images where `id`=%d", $id);
    $result = $wpdb->get_results($query);
   foreach ($result as $key=>$value)
    {
        $name=$value->name;
        $description= $value->description;
    }
    $query = $wpdb->prepare("SELECT `image_url` FROM " . $wpdb->prefix . "huge_itportfolio_images where `id`=%d", $id);
    $imgurlArray=$wpdb->get_var($query);
    $imgurl = explode( ";", $imgurlArray);
    $imgCount= count($imgurl);

?>
    <div id="huge_it_product_<?php  echo esc_attr($id);?>"  class=" huge_it_product view-store ">
        <div id="huge_it_main-product">
            <div class="huge_it_container-title">

                    <?php echo $name; ?>

            </div>

        <div class="huge_it_container-imagery">
            <div class="huge_it_thumbnail-wrapper">
                <div class="huge_it_thumbnail-prev-button ">
        <span class="huge_it_icon-arrow_up">


        </span>
                </div>
                <div class=" huge_it_thumbnail-carousel">
                    <ul class="huge_it_thumbnails">
                        <?php
                        foreach ($imgurl as $key => $value) {
                            if ($key === count($imgurl)-1)  continue;

                           ?>

                            <li class="huge_it_thumbnail" style="display: block">
                                <a class="not_open p_responsive_lightbox" href="<?php echo esc_attr($value); ?>" >
                                    <img class="huge_it_thumbnail-image" src=" <?php echo esc_attr($value); ?>"/>
                                </a>
                            </li>


                          <?php
                                 }?>
                    </ul>
                </div>
                <div class="huge_it_thumbnail-next-button">
        <span class="huge_it_icon-arrow_down">

        </span>
                </div>

            </div>
            <div class="huge_it_main-carousel-wrapper">
                <div class="huge_it_main-image-carousel " id="main-image-carousel">
                    <a class="p_responsive_lightbox" href="<?php echo esc_attr($imgurl[0]); ?> "><img class="huge_it_product-image first-image" src="<?php echo esc_attr($imgurl[0]); ?> "/></a>
                </div>
            </div>
        </div>
        <div class="huge_it_container-details">
            <div class="huge_it_product-details">
                <?php echo $description; ?>

            </div>
            <div class="huge_it_share-buttons">

            </div>
        </div>

        </div>
    </div>


    <?php
} else {

    ?>

<section id="huge_it_portfolio_content_<?php echo esc_attr($portfolioID); ?>"
         class=" portfolio-gallery-content <?php if ( $portfolioShowSorting == 'on' ) {
             echo 'sortingActive ';
         }
         if ( $portfolioShowFiltering == 'on' ) {
             echo 'filteringActive';
         } ?>"
         data-portfolio-id="<?php echo esc_attr($portfolioID); ?>">
    <div id="huge-it-container-loading-overlay_<?php echo esc_attr($portfolioID); ?>"></div>
    <?php if ( ( $sortingFloatLgal == 'left' && $filteringFloatLgal == 'left' ) || ( $sortingFloatLgal == 'right' && $filteringFloatLgal == 'right' ) ) { ?>
    <div id="huge_it_portfolio_options_and_filters_<?php echo esc_attr($portfolioID); ?>">
        <?php } ?>
        <?php if ( $portfolioShowSorting == "on" ) { ?>
            <div id="huge_it_portfolio_options_<?php echo esc_attr($portfolioID); ?>"
                 data-sorting-position="<?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_float"]); ?>">
                <ul id="sort-by" class="option-set clearfix" data-option-key="sortBy">
                    <?php if ( $portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_default"] != '' ): ?>
                        <li><a href="#sortBy=original-order" data-option-value="original-order" class="selected"
                               data><?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_default"]); ?></a></li>
                    <?php endif; ?>
                    <?php if ( $portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_id"] != '' ): ?>
                        <li><a href="#sortBy=id"
                               data-option-value="id"><?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_id"]); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ( $portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_name"] != '' ): ?>
                        <li><a href="#sortBy=symbol"
                               data-option-value="symbol"><?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_name"]); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ( $portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_random"] != '' ): ?>
                        <li id="shuffle"><a
                                    href='#shuffle'><?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_random"]); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul id="port-sort-direction" class="option-set clearfix" data-option-key="sortAscending">
                    <?php if ( $portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_asc"] != '' ): ?>
                        <li><a href="#sortAscending=true" data-option-value="true"
                               class="selected"><?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_asc"]); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ( $portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_desc"] != '' ): ?>
                        <li><a href="#sortAscending=false"
                               data-option-value="false"><?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_name_by_desc"]); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php }
        if ( $portfolioShowFiltering == "on" ) { ?>
            <div id="huge_it_portfolio_filters_<?php echo esc_attr($portfolioID); ?>"
                 data-filtering-position="<?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_filtering_float"]); ?>">
                <ul>
                    <li rel="*"><a><?php echo esc_attr($portfolio_gallery_get_options["portfolio_gallery_ht_view8_cat_all"]); ?></a></li>
                    <?php
                    $portfolioCats = explode( ",", $portfolioCats );
                    foreach ( $portfolioCats as $portfolioCatsValue ) {
                        if ( ! empty( $portfolioCatsValue ) ) {
                            ?>
                            <li rel=".<?php echo str_replace( " ", "_", $portfolioCatsValue ); ?>">
                                <a><?php echo str_replace( "_", " ", $portfolioCatsValue ); ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>
        <?php if ( ( $sortingFloatLgal == 'left' && $filteringFloatLgal == 'left' ) || ( $sortingFloatLgal == 'right' && $filteringFloatLgal == 'right' ) ) { ?>
    </div>
<?php } ?>
    <div id="huge_it_portfolio_container_<?php echo esc_attr($portfolioID); ?>"
         class="huge_it_portfolio_container super-list variable-sizes clearfix view-<?php echo esc_attr($view_slug); ?>  "
         data-show-loading="<?php echo esc_attr($portfolioShowLoading); ?>"
         data-show-center="<?php echo esc_attr($portfolioposition); ?>" <?php if ( $portfolio_gallery_get_options["portfolio_gallery_ht_view8_sorting_float"] == "top" && $portfolio_gallery_get_options["portfolio_gallery_ht_view8_filtering_float"] == "top" ) {
        echo "style='clear: both;'";
    } ?>>

        <?php
        foreach ( $images as $key => $row ) {
            $link         = $row->sl_url;
            $descnohtml   = strip_tags( $row->description );
            $result       = substr( $descnohtml, 0, 50 );
            $catForFilter = explode( ",", $row->category );
            ?>
            <div
                    class="portelement portelement_<?php echo esc_attr($portfolioID); ?> portfolio-lightbox <?php foreach ( $catForFilter as $catForFilterValue ) {
                        echo str_replace( " ", "_", $catForFilterValue ) . " ";
                    } ?> " tabindex="0" data-symbol="<?php echo $row->name; ?>" data-category="alkaline-earth">
                <p style="display: none;" class="id"><?php echo esc_attr($row->id); ?></p>
                <div class="image-block_<?php echo esc_attr($portfolioID); ?>">
                    <?php //echo $row->id;
                    ?>
                    <?php $imgurl = explode( ";", $row->image_url ); ?>
                    <?php
                    if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$row->id"; }
                    else  if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$row->id"; }
                    else { $product_page_link = get_permalink()."/?single_prod_id=$row->id"; }
                    ?>
                    <?php
                    if ( $row->image_url != ';' ) {
                        switch ( portfolio_gallery_youtube_or_vimeo_portfolio( $imgurl[0] ) ) {
                            case 'image': ?>
                                <a href="<?php echo  $product_page_link; ?>"  <?php if ( $row->link_target == "on" ) { echo 'target="_blank"'; } ?>
                                   class=" portfolio-lightbox-group<?php echo esc_attr($portfolioID); ?>"
                                   data-description="<?php echo esc_attr( $row->description ); ?>"
                                   title="<?php echo esc_attr( $row->name ); ?>">
                                    <img alt="<?php echo esc_attr( $row->name ); ?>"
                                         id="wd-cl-img<?php echo esc_attr($key); ?>"
                                         data-title=" <?php echo portfolio_gallery_get_image_title($imgurl[0]); ?>"
                                         src="<?php echo esc_url( portfolio_gallery_get_image_by_sizes_and_src( $imgurl[0], array(
                                             $portfolio_gallery_get_options['portfolio_gallery_ht_view8_width'],
                                             ''
                                         ), false ) ); ?>"/>
                                </a>
                                <?php
                                break;
                            case 'youtube':

                                $videourl = portfolio_gallery_get_video_id_from_url( $imgurl[0] ); ?>
                                <a href="https://www.youtube.com/embed/<?php echo esc_attr($videourl[0]); ?>"
                                   data-description=" <?php echo esc_attr( $row->description ); ?>"
                                   class="huge_it_portfolio_item pyoutube  portfolio-lightbox-group<?php echo esc_attr($portfolioID); ?>"
                                   title="<?php echo esc_attr( $row->name ); ?>">
                                    <img alt="<?php echo esc_attr( $row->name ); ?>"
                                         id="wd-cl-img<?php echo esc_attr($key); ?>"
                                         src="//img.youtube.com/vi/<?php echo esc_attr($videourl[0]); ?>/mqdefault.jpg"/>
                                    <div class="play-icon <?php echo esc_attr($videourl[1]); ?>-icon"></div>
                                </a>
                                <?php
                                break;
                            case 'vimeo':
                                $videourl = portfolio_gallery_get_video_id_from_url( $imgurl[0] );
                                $hash = unserialize( wp_remote_fopen( "http://vimeo.com/api/v2/video/" . $videourl[0] . ".php" ) );
                                $imgsrc = $hash[0]['thumbnail_large']; ?>
                                <a class="huge_it_portfolio_item pvimeo  portfolio-lightbox-group<?php echo esc_attr($portfolioID); ?>"
                                   href="http://player.vimeo.com/video/<?php echo esc_attr($videourl[0]); ?>"
                                   data-description=" <?php echo esc_attr( $row->description ); ?>"
                                   title="<?php echo esc_attr($row->name); ?>">
                                    <img src="<?php echo esc_attr( $imgsrc ); ?>"
                                         alt="<?php echo esc_attr( $row->name ); ?>"/>
                                    <div class="play-icon vimeo-icon"></div>
                                </a>
                                <?php
                                break;
                        }
                    } else { ?>
                        <img alt="<?php echo esc_attr( $row->name ); ?>" id="wd-cl-img<?php echo esc_attr($key); ?>"
                             src="images/noimage.jpg"/>
                        <?php
                    } ?>
                </div>

                <?php if ( $row->name != "" ) { ?>
                    <div class="title-block_<?php echo esc_attr($portfolioID); ?>">
                        <a href="<?php echo  esc_attr($link); ?>" target="_blank"
                        title="<?php echo esc_attr( $row->name ); ?>">
                            <?php echo  $row->name; ?>
                            <?php if ( $link != '' ): ?>
                        </a>
                    <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        } ?>

        <div style="clear:both;"></div>
    </div>


</section>
<?php }