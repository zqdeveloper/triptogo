<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once($latest_skin_path.'/latest.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

// 모드
$is_masonry = (isset($options['masonry']) && $options['masonry']) ? true : false;
$is_more = (isset($options['more']) && $options['more']) ? true : false;

if($is_masonry || $is_more) {
 	add_javascript('<script src="'.$latest_skin_url.'/js/imagesloaded.pkgd.min.js"></script>', 0);
}

$options['thumb_w'] = (isset($options['thumb_w']) && $options['thumb_w'] > 0) ? $options['thumb_w'] : 400;
if($is_masonry) {
	$options['thumb_h'] = 0;
	add_javascript('<script src="'.$latest_skin_url.'/js/masonry.pkgd.min.js"></script>', 0);
} else {
	$options['thumb_h'] = (isset($options['thumb_h']) && $options['thumb_h'] > 0) ? $options['thumb_h'] : 300;
}

if($is_more) {
	add_javascript('<script src="'.$latest_skin_url.'/js/jquery.infinitescroll.min.js"></script>', 0);

	$tmp_options = base64_encode(serialize($options));

	// 더보기 링크
	$more_href = $latest_skin_url.'/latest.rows.php?bo_table='.urlencode($bo_table).'&amp;rows='.urlencode($rows).'&amp;subject_len='.urlencode($subject_len);
	$more_href .= '&amp;latest_skin_url='.urlencode($latest_skin_url);
	$more_href .= '&amp;tmp_options='.$tmp_options;
	$more_href .= '&amp;page=2';
}


// 이미지 높이
$img_h = latest_img_height($options['thumb_w'], $options['thumb_h'], '75');

$options['line'] = (isset($options['line']) && $options['line'] >= 0) ? $options['line'] : 1;
$options['line_height'] = 20 * $options['line'];
if($options['line_height']) $options['line_height'] = $options['line_height'] + 2;

// 간격
$gap = (isset($options['gap']) && ($options['gap'] > 0 || $options['gap'] == "0")) ? $options['gap'] : 15;
$gapb = (isset($options['gapb']) && ($options['gapb'] > 0 || $options['gapb'] == "0")) ? $options['gapb'] : 15;

// 캡션
$caption = (isset($options['caption']) && $options['caption']) ? $options['caption'] : '';
$is_caption = ($caption == "1") ? false : true;

// 가로수
$item = (isset($options['item']) && $options['item'] > 0) ? $options['item'] : 4;

?>
<style>
#latest_card_news .post-wrap { margin-right:<?php echo $gap * (-1);?>px; margin-bottom:<?php echo $gapb * (-1);?>px;margin-top:32px;  }
#latest_card_news .post-row { width:<?php echo latest_img_width($item);?>%; }
#latest_card_news .post-list { margin-right:<?php echo $gap;?>px; margin-bottom:<?php echo $gapb;?>px; }
<?php if($options['line_height']) { ?>
#latest_card_news .post-subject { height:<?php echo $options['line_height'];?>px; }
<?php } ?>
#latest_card_news .img-wrap { padding-bottom:<?php echo $img_h;?>%; }
</style>
<div id="latest_card_news" class="card_news">

	<div class="post-wrap<?php echo ($caption == "3") ? ' is-hover' : ''; // 호버캡션 ?>">
		<?php include($latest_skin_path.'/latest.rows.php'); ?>
	</div>
	<div class="clearfix"></div>
	<?php if($is_more) { ?>
		<div id="latest_card_news-nav" class="post-nav">
			<a href="<?php echo $more_href;?>"></a>
		</div>
		<div id="latest_card_news-more" class="post-more">
			<a href="#" title="더보기">
				<span class="lightgray">
					<i class="fa fa-plus-circle fa-4x"></i><span class="sound_only">더보기</span>
				</span>
			</a>
		</div>
	<?php } ?>
</div>

<?php if($is_more || $is_masonry) { ?>
<script>
	$(function(){
		var $latest_card_news = $('#latest_card_news .post-wrap');
		<?php if($is_masonry) { ?>
		$latest_card_news.imagesLoaded(function(){
			$latest_card_news.masonry({
				columnWidth : '.post-row',
				itemSelector : '.post-row',
				isAnimated: true
			});
		});
		<?php } ?>
		<?php if($is_more) { ?>
		$latest_card_news.infinitescroll({
			navSelector  : '#latest_card_news-nav',
			nextSelector : '#latest_card_news-nav a',
			itemSelector : '.post-row',
			loading: {
				msgText: '로딩 중...',
				finishedMsg: '더이상 게시물이 없습니다.',
				img: '<?php echo $latest_skin_url;?>/img/loader.gif',
			}
		}, function( newElements ) {
			var $newElems = $( newElements ).css({ opacity: 0 });
			$newElems.imagesLoaded(function(){
				$newElems.animate({ opacity: 1 });
				<?php if($is_masonry) { ?>
				$latest_card_news.masonry('appended', $newElems, true);
				<?php } else { ?>
				$latest_card_news.append($newElems);
				<?php } ?>
			});
		});
		$(window).unbind('#latest_card_news .infscr');
		$('#latest_card_news-more a').click(function(){
		   $latest_card_news.infinitescroll('retrieve');
		   $('#latest_card_news-nav').show();
			return false;
		});
		$(document).ajaxError(function(e,xhr,opt){
			if(xhr.status==404) $('#latest_card_news-nav').remove();
		});
		<?php } ?>
	});
</script>
<?php } ?>