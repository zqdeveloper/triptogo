<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

add_javascript('<script src="'.G5_JS_URL.'/owlcarousel/owl.carousel.min.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/owlcarousel/owl.carousel.css">', 0);
?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
	} ?>
    <div id="hd_wrapper">
        <div id="logo">
        	<a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
		
		<div class="hd_sch_wr">
	         <fieldset id="hd_sch">
	            <legend>쇼핑몰 전체검색</legend>
	            <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
	            <label for="sch_stx" class="sound_only">검색어 필수</label>
	                <div class="sch_ipt">
	            		<label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	            		<input type="text" name="q" class="sch_stx" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required placeholder="검색어를 입력해주세요">
	            		<button type="submit" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
	            	</div>
	            </form>
	        </fieldset>
	    
		</div>
        <!-- 쇼핑몰 배너 시작 { -->
        <?php // echo display_banner('왼쪽'); ?>
        <!-- } 쇼핑몰 배너 끝 -->
        
        <ul class="hd_login">        
            <?php if ($is_member) {  ?>
			<li class="shop_login">
				<?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?>	
			</li>
			<li class="shop_cart"><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span><span class="count"><?php echo get_boxcart_datas_count(); ?></span></a></li>
            <?php } else { ?>
            <li class="login"><a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $urlencode; ?>"><strong>로그인</strong></a></li>
             <li class="join"><a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $urlencode; ?>">회원가입</a></li>
            <?php }  ?>
        </ul>
    </div>

    <div id="hd_menu">
        <div class="s_menu">
    	<button type="button" id="menu_open"><i class="fa fa-bars" aria-hidden="true"></i> 전체 카테고리</button>
		<?php include_once(G5_THEME_SHOP_PATH.'/category.php'); // 분류 ?>
		<ul class="hd_menu">
            <li><a href="<?php echo shop_type_url(1); ?>">지역</a></li>
            <li><a href="<?php echo shop_type_url(2); ?>">관심</a></li>
            <li><a href="<?php echo shop_type_url(3); ?>">추천</a></li>
            <li><a href="<?php echo shop_type_url(4); ?>">지도</a></li>
            <li><a href="<?php echo shop_type_url(5); ?>">태그</a></li>
        </ul></div>
    </div> 
</div>
<!-- } 상단 끝 -->
        

<script>
jQuery(function ($){
	$(".btn_member_mn").on("click", function() {
        $(".member_mn").toggle();
        $(".btn_member_mn").toggleClass("btn_member_mn_on");
    });
    
    var active_class = "btn_sm_on",
        side_btn_el = "#quick .btn_sm",
        quick_container = ".qk_con";

    $(document).on("click", side_btn_el, function(e){
        e.preventDefault();

        var $this = $(this);
        
        if (!$this.hasClass(active_class)) {
            $(side_btn_el).removeClass(active_class);
            $this.addClass(active_class);
        }

        if( $this.hasClass("btn_sm_cl1") ){
            $(".side_mn_wr1").show();
        } else if( $this.hasClass("btn_sm_cl2") ){
            $(".side_mn_wr2").show();
        } else if( $this.hasClass("btn_sm_cl3") ){
            $(".side_mn_wr3").show();
        } else if( $this.hasClass("btn_sm_cl4") ){
            $(".side_mn_wr4").show();
        }
    }).on("click", ".con_close", function(e){
        $(quick_container).hide();
        $(side_btn_el).removeClass(active_class);
    });

    $(document).mouseup(function (e){
        var container = $(quick_container),
            mn_container = $(".shop_login");
        if( container.has(e.target).length === 0){
            container.hide();
            $(side_btn_el).removeClass(active_class);
        }
        if( mn_container.has(e.target).length === 0){
            $(".member_mn").hide();
            $(".btn_member_mn").removeClass("btn_member_mn_on");
        }
    });

    $("#top_btn").on("click", function() {
        $("html, body").animate({scrollTop:0}, '500');
        return false;
    });
});
</script>
<?php
    $wrapper_class = array();
    if( defined('G5_IS_COMMUNITY_PAGE') && G5_IS_COMMUNITY_PAGE ){
        $wrapper_class[] = 'is_community';
    }
?>
<!-- 전체 콘텐츠 시작 { -->
<div id="wrapper" class="<?php echo implode(' ', $wrapper_class); ?>">
    <!-- #container 시작 { -->
    <div id="container">

        <?php if(defined('_INDEX_')) { ?>

        <?php } // end if ?>
        <?php
            $content_class = array('shop-content');
            if( isset($it_id) && isset($it) && isset($it['it_id']) && $it_id === $it['it_id']){
                $content_class[] = 'is_item';
            }
            if( defined('IS_SHOP_SEARCH') && IS_SHOP_SEARCH ){
                $content_class[] = 'is_search';
            }
            if( defined('_INDEX_') && _INDEX_ ){
                $content_class[] = 'is_index';
            }
        ?>
        <!-- .shop-content 시작 { -->
        <div class="<?php echo implode(' ', $content_class); ?>">
            <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?>
   