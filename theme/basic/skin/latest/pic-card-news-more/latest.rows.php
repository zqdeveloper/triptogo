<?php
if (!defined('_GNUBOARD_')) {
	include_once('../../../common.php');

	$options = unserialize(base64_decode($tmp_options));

	// 모드
	$is_masonry = (isset($options['masonry']) && $options['masonry']) ? true : false;

	$options['thumb_w'] = (isset($options['thumb_w']) && $options['thumb_w'] > 0) ? $options['thumb_w'] : 400;
	if($is_masonry) {
		$options['thumb_h'] = (isset($options['thumb_h']) && $options['thumb_h'] > 0) ? $options['thumb_h'] : 0;
	} else {
		$options['thumb_h'] = (isset($options['thumb_h']) && $options['thumb_h'] > 0) ? $options['thumb_h'] : 300;
	}

	$options['line'] = (isset($options['line']) && $options['line'] >= 0) ? $options['line'] : 1;
	$options['line_height'] = 20 * $options['line'];

	// 캡션
	$caption = (isset($options['caption']) && $options['caption']) ? $options['caption'] : '';
	$is_caption = ($caption == "1") ? false : true;


	$list = array();
	$sql = " select * from {$g5['board_table']} where bo_table = '{$bo_table}' ";
	$board = sql_fetch($sql);
	$bo_subject = get_text($board['bo_subject']);

	$tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
	$start_rows = ($page - 1) * $rows;
	$sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num limit {$start_rows}, {$rows} ";
	$result = sql_query($sql);
	for ($i=0; $row = sql_fetch_array($result); $i++) {
        try {
			unset($row['wr_password']);     //패스워드 저장 안함( 아예 삭제 )
        } catch (Exception $e) {
        }
        $row['wr_email'] = '';              //이메일 저장 안함
        if (strstr($row['wr_option'], 'secret')){           // 비밀글일 경우 내용, 링크, 파일 저장 안함
			$row['wr_content'] = $row['wr_link1'] = $row['wr_link2'] = '';
			$row['file'] = array('count'=>0);
        }
        $list[$i] = get_list($row, $board, $latest_skin_url, $subject_len);
	}

}

// 날짜
$is_date = (isset($options['date']) && $options['date']) ? true : false;

// 분류
$is_cate = (isset($wset['cate']) && $wset['cate']) ? true : false;

// 글내용
$is_cont = ($options['line'] > 1) ? true : false;
$is_details = ($is_cont) ? '' : ' no-margin';

// 스타일
$is_center = (isset($options['center']) && $options['center']) ? ' text-center' : '';
$is_bold = (isset($options['bold']) && $options['bold']) ? true : false;

// 메이슨리 클래스
$img_wrap = ($is_masonry && !$options['thumb_h']) ? 'post-img' : 'img-wrap';

for ($i=0; $i<count($list); $i++) {

	$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $options['thumb_w'], $options['thumb_h'], false, true);

	if($thumb['src']) {
		$img = $thumb['src'];
	} else {
		$img = G5_IMG_URL.'/no_img.png';
	}
	$img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'">';

	//아이콘 체크
	//$wr_icon = '';
	//$is_lock = false;
	//if ($list[$i]['icon_secret'] || $list[$i]['wr_lock']) {
		//$is_lock = true;
		//$wr_icon = '<span class="rank-icon bg-orange">Lock</span>';
	//} else if($list[$i]['icon_new']) {
		//$wr_icon = '<span class="rank-icon bg-green">New</span>';
	//} else if($list[$i]['icon_hot']) {
		//$wr_icon = '<span class="rank-icon bg-blue">Hot</span>';
	//}

	//볼드체
	if($is_bold) {
		$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
	}

?>
<div class="post-row">
	<div class="post-list post-col">
		<div class="w-box">
			<div class="post-image">
				<a href="<?php echo $list[$i]['href'];?>">
					<div class="<?php echo $img_wrap;?>">
						<div class="img-item">
							<?php echo $img_content; ?>
							<?php if($is_caption && $caption) { ?>
							<div class="in-subject ellipsis trans-bg-black">
								<?php if($is_date || $list[$i]['wr_comment']) { ?>
								<span class="pull-right">
									<?php if ($list[$i]['wr_comment']) { ?>
									<span class="count red">+<?php echo $list[$i]['wr_comment']; ?></span>
									<?php } ?>
									<?php if ($is_date) { ?>
									&nbsp;<?php echo $list[$i]['datetime2']; ?>
									<?php } ?>
								</span>
								<?php } ?>
								<?php echo $list[$i]['subject'];?>
							</div>
							<?php } ?>
						</div>
					</div>
				</a>
			</div>
			<?php if($is_caption && !$caption) { // 캡션이 아닐 때 ?>
			<?php if($options['line_height']) { ?>
				<div class="post-content<?php echo $is_center;?>">
					<div class="post-subject">
						<a href="<?php echo $list[$i]['href'];?>">
							<?php echo $wr_icon;?>
							<?php echo $list[$i]['subject'];?>
							<?php if($is_cont) { ?>
								<div class="post-text">
									<?php echo conv_subject(strip_tags($list[$i]['content']), 100, '…');?>
								</div>
							<?php } ?>
						</a>
					</div>
					<div class="post-text post-ko txt-short ellipsis<?php echo $is_center;?><?php echo $is_details;?>">
                       <?php echo get_member_profile_img($list[$i]['mb_id']); ?> <?php echo $list[$i]['name'];?>
						<?php if($is_cate && $list[$i]['ca_name']) { ?>
							<span class="post-sp">|</span>
							<?php echo $list[$i]['ca_name'];?>
						<?php } ?>
						<?php if($is_date) { ?>
							<span class="post-sp">|</span>
							<span class="txt-normal">
								<?php echo $list[$i]['datetime2']; ?>
							</span>
						<?php } ?>
                        <!--추천출력-->
<span class="count red"> <i class="fa fa-heart-o" aria-hidden="true"></i> <?php echo $list[$i]['wr_good'] ?></span>
			
					</div>
				</div>
			<?php } else { ?>
				<div class="post-content">
					<a href="<?php echo $list[$i]['href'];?>" class="ellipsis">
						<?php if ($list[$i]['comment_cnt']) { ?>
							<span class="pull-right count red">+<?php echo $list[$i]['wr_comment']; ?></span>
						<?php } ?>
						<div class="title">
						<?php echo $wr_icon;?>
						<?php echo $list[$i]['subject'];?>
						</div>
					</a>
				</div>
			<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>