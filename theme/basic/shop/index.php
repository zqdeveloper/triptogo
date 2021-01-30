<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH . '/index.php');
    return;
}

define("_INDEX_", TRUE);
include_once(G5_THEME_SHOP_PATH . '/shop.head.php');
?>

    <!--최신글-->
    <div class="latest_wr">
        <!--  사진 최신글2 { -->
        <?php
        $options = array();
        $options['masonry'] = 1;    // 메이슨리 모드(1:사용 0:사용하지않음)
        $options['more'] = 1; // 더보기 모드(1:사용 0:사용하지않음)
        $options['item'] = 5; // 가로수
        $options['thumb_w'] = 227; // 썸네일 이미지 가로크기
        $options['thumb_h'] = 100; // 썸네일 이미지 세로크기
        $options['gap'] = 16; // 좌우간격(px)
        $options['gapb'] = 0; // 상하간격(px)
        $options['line'] = 2; // 줄(기본 1) - 1줄 입력시 제목과 댓글만 1줄로 출력됩니다.
        $options['cate'] = 1; // 분류출력
        $options['center'] = 0; // 가운데(1:가운데,text-center 0:좌측)
        $options['bold'] = 1; // 볼드체(bold) - (1:볼드체 0:일반)
        $options['caption'] = 0;    // 캡션(0:캡젼없음, 1:캡션숨김, 2:일반캡션, 3:호버캡션)
        $options['date'] = 0;     // 날짜출력(1:출력 0:숨김)
        //展示文章
        // echo latest('theme/pic-card-news-more', 'review', 100, 20, 0, $options);
        $articles = latest('theme/pic-card-news-more', 'review', 100, 20, 0, $options);
        echo $articles;
        //상품이미지//商品展示
        $list = new item_list();
        $list->set_type('1', '2', '3', '4');
        $list->set_list_mod(4);
        $list->set_list_row(2);
        $list->set_img_size(500, 500);
        $list->set_list_skin(G5_SHOP_SKIN_PATH . '/list.10.skin.php');
        $list->set_view('it_img', true);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', false);
        $list->set_order_by('it_sum_qty DESC');
        echo $list->run();
        //$shop_good_items = $list->run();
       // var_dump($shop_good_items);
        ?>

        <!-- } 사진 최신글2 끝 -->
    </div>


    <!-- 메인이미지 시작 { -->
<? //php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
    <!-- } 메인이미지 끝 -->


<?php
include_once(G5_THEME_SHOP_PATH . '/shop.tail.php');
?>