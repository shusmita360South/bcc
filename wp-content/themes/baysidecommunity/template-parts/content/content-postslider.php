<?php
/**
 * Template part for displaying service
 *
 *
 * @package WordPress
 * @subpackage Comfort_Sleep
 * @since 1.0.0
 */


?>
<?php 
    $blogIds = get_field('blog_posts');
    $homePosts = get_homePosts($blogIds);
?>
<div class="block-7 section-padding-top-one-fourth">
    <div class="<?php echo $catSlug;?> banner-slider owl-carousel">
        <?php        
        if ($homePosts->have_posts()) :
            while ( $homePosts->have_posts() ) {
                $homePosts->the_post();
                set_query_var('catSlug', $catSlug);
                get_template_part( 'template-parts/post/post', 'slider' );
            }
            wp_reset_postdata(); 
        endif; 
        ?>
    </div>
    <?php if (count($blogIds) > 1) : ?>
        <div class="<?php echo $catSlug;?> progress-bar-outer">
            <div class="progress-bar">
                <div class="<?php echo $catSlug;?> progress-bar-inner"></div>
            </div>  
        </div>
    <?php endif; ?>
</div>



<script>
jQuery(document).ready(function($) {
	//=============homepage banner slider=========================================
    var $homebannerSlider = $(".block-7 .<?php echo $catSlug;?>.banner-slider");
    $homebannerSlider.on("initialized.owl.carousel", function (el) {
        
        var pageCount = el.item.count/el.page.size;
        pageCount = Math.ceil(pageCount);
        //console.log(pageCount);
        var barWidth = (1/pageCount)*100 + '%';

       
        if(el.item.count > el.page.size) {
            $('.block-7 .<?php echo $catSlug;?>.progress-bar-inner').css('width',barWidth);
        } 
        
    });
    var stagePadding = ($(window).width() - 1640)/2;
    $homebannerSlider.owlCarousel({
        items: 1,
        //autoplay: true,
        autoplayTimeout: 4000,
        mouseDrag: false,
        dots: true,
        loop: false,
        nav: true,
        navText: [
           "<span aria-label='Previous'><svg xmlns='http://www.w3.org/2000/svg' width='5.399' height='8.645' viewBox='0 0 5.399 8.645'><defs><style>.arrow{fill:#FFFFFF;stroke:#FFFFFF;}</style></defs><g transform='translate(32.926 19.081) rotate(-90)'><path class='arrow' d='M3.174,10.781l-.393.393L6.2,14.593l.2.188.2-.188,3.419-3.419-.393-.393L6.4,14Z' transform='translate(8.362 -43)'/></g></svg></span>",
           "<span aria-label='Next'><svg xmlns='http://www.w3.org/2000/svg' width='5.399' height='8.645' viewBox='0 0 5.399 8.645'><defs><style>.arrow{fill:#FFFFFF;stroke:#FFFFFF;}</style></defs><g transform='translate(32.926 19.081) rotate(-90)'><path class='arrow' d='M3.174,10.781l-.393.393L6.2,14.593l.2.188.2-.188,3.419-3.419-.393-.393L6.4,14Z' transform='translate(8.362 -43)'/></g></svg></span>"
        ],
        smartSpeed: 2000,
        autoplaySpeed: 2000,
        navSpeed: 2000,
        stagePadding: 400,
        margin: 30,
        onChanged: homeBannerSlideronChanged,
        responsive : {

            0 : {
                stagePadding: 40,
            },
            600 : {
                stagePadding: 100,
            },
            800 : {
                stagePadding: 200,
            },
            1200 : {
                stagePadding: 300,
            },
            1800 : {
                stagePadding: 400,
            },
            2420 : {
                stagePadding: stagePadding,
            }
        }
        
    });
    function homeBannerSlideronChanged(event) {
        //console.log(event);
        var element   = event.target;        
        var pages     = event.page.count;     // Number of pages
        var page      = event.page.index;     // Position of the current page
      
        // it loop is true then reset counter from 1
        if(page > pages) {
            page = page - pages;
        }
        //console.log('page:',page);
       
        var counterLineWidth = page/pages * 100;
        $('.block-7 .<?php echo $catSlug;?>.progress-bar-inner').css("left",counterLineWidth+"%");
    }
    $( ".block-7 .<?php echo $catSlug;?>.progress-bar-outer .progress-bar-inner" ).draggable({ 
        axis: "x",
        containment: ".progress-bar",
        start: function(event, ui) {
           start = ui.position.left;
        },
        stop: function(event, ui) {
           stop = ui.position.left;
           if(start < stop) {
                $homebannerSlider.trigger('next.owl.carousel');
           } else {
                $homebannerSlider.trigger('prev.owl.carousel'); 
           }
        }

    });
});
</script>