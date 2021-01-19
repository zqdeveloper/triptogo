<?php
if (!defined('_GNUBOARD_')) exit;

// Image Height
function latest_img_height($thumb_w, $thumb_h, $height='56.25') {

	$height = ($thumb_w > 0 && $thumb_h > 0) ? round(($thumb_h / $thumb_w) * 100, 2) : $height;

	return $height;
}

// Image Width
function latest_img_width($cols, $opt='') {

	if($cols > 0) {
		$width = (int)((100 / $cols) * 100);
		$width = $width / 100;
	} else {
		$width = ($opt) ? $opt : '33.3';
	}

	return $width;
}

// Date & Time
function latest_datetime($date, $type='m.d') {
	global $aslang;

	$diff = G5_SERVER_TIME - $date;

	$s = 60; //1분 = 60초
	$h = $s * 60; //1시간 = 60분
	$d = $h * 24; //1일 = 24시간
	$y = $d * 10; //1년 = 1일 * 10일

	if ($diff < $s) {
		$time = astxt($aslang['dt_sec'], array($diff)); //초전
	} else if ($h > $diff && $diff >= $s) {
		$time = astxt($aslang['dt_min'], array(round($diff/$s))); //분전
	} else if ($d > $diff && $diff >= $h) {
		$time = astxt($aslang['dt_hour'], array(round($diff/$h))); //시간전
	} else if ($y > $diff && $diff >= $d) {
		$time = astxt($aslang['dt_day'], array(round($diff/$d))); //일전
	} else {
		$time = date($type, $date);
	}

	return $time;
}
?>
