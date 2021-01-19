<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
    return;
}

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
        </div>  <!-- } .shop-content 끝 -->
	</div>      <!-- } #container 끝 -->
</div>
<!-- } 전체 콘텐츠 끝 -->

<!-- 하단 시작 { -->
<div id="ft">
    <div id="ft_wr">
        <div id="ft_company" class="ft_cnt">
        	<h2>고객센터</h2>
	        <p class="ft_info">
                <span class="customer"><?php echo $default['de_admin_company_tel']; ?></span><br>
                <span class="time">월~금: 09:00-18:00 (점심시간 12:00-13:00)<br />공휴일&주말: 1:1 채팅 상담만 가능</span>
			</p>
            <button class="kakao"><a href="#">카카오톡 상담</a></button>
	    </div>
     <div>
         <div class="sns"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></div>
    <span><b>회사명</b> <?php echo $default['de_admin_company_name']; ?></span> <br />
	            <span>주소 <?php echo $default['de_admin_company_addr']; ?></span> | <span>사업자 등록번호 <?php echo $default['de_admin_company_saupja_no']; ?></span> | 
	            <span>대표 <?php echo $default['de_admin_company_owner']; ?></span> | 
	            <span>팩스<?php echo $default['de_admin_company_fax']; ?></span><br>
	            <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
	            <span>통신판매업신고번호 <?php echo $default['de_admin_tongsin_no']; ?></span> | 
	            <span>개인정보 보호책임자 <?php echo $default['de_admin_info_name']; ?></span> | 
				<?php if ($default['de_admin_buga_no']) echo '<span>부가통신사업신고번호 '.$default['de_admin_buga_no'].'</span>'; ?>
        <p class="copy"> Copyright &copy; 뜨거운 청춘. All Rights Reserved.</p></div>
    </div>
</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<!-- } 하단 끝 -->

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
