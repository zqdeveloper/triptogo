<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<h2 class="sound_only">최신글</h2>

<div class="latest_wr">
    
    <!--  사진 최신글2 { -->
    <?php
    $options = array();
    $options['masonry'] = 1;    // 메이슨리 모드(1:사용 0:사용하지않음)
    $options['more'] = 1; // 더보기 모드(1:사용 0:사용하지않음)
    $options['item'] = 5; // 가로수
    $options['thumb_w'] = 180; // 썸네일 이미지 가로크기
    $options['thumb_h'] = 100; // 썸네일 이미지 세로크기
    $options['gap'] = 10; // 좌우간격(px)
    $options['gapb'] = 10; // 상하간격(px)
    $options['line'] = 3; // 줄(기본 1) - 1줄 입력시 제목과 댓글만 1줄로 출력됩니다.
    $options['cate'] = 1; // 분류출력
    $options['center'] = 0; // 가운데(1:가운데,text-center 0:좌측)
    $options['bold'] = 1; // 볼드체(bold) - (1:볼드체 0:일반)
    $options['caption'] = 0;    // 캡션(0:캡젼없음, 1:캡션숨김, 2:일반캡션, 3:호버캡션)
    $options['date'] = 1;     // 날짜출력(1:출력 0:숨김)
    echo latest('pic-card-news-more', 'free', 10, 20, 0, $options);
    ?>
    <!-- } 사진 최신글2 끝 -->
</div>

<div class="latest_wr">
<!-- 최신글 시작 { -->
    <?php
    //  최신글
    $sql = " select bo_table
                from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
                where a.bo_device <> 'mobile' ";
    if(!$is_admin)
	$sql .= " and a.bo_use_cert = '' ";
    $sql .= " and a.bo_table not in ('notice', 'gallery') ";     //공지사항과 갤러리 게시판은 제외
    $sql .= " order by b.gr_order, a.bo_order ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$lt_style = '';
    	if ($i%3 !== 0 ) $lt_style = "margin-left:2%";
    ?>
    <div style="float:left;<?php echo $lt_style ?>" class="lt_wr">
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/basic', $row['bo_table'], 6, 24);
        ?>
    </div>
    <?php
    }
    ?>
    <!-- } 최신글 끝 -->
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>