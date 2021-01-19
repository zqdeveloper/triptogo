<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!$board['bo_use_tag']) return;
?>

<!-- 태그 -->
        <tr>
            <th scope="row"><label for="wr_tags_input">태그/TAG</label></th>
            <td>
				<input type="text" name="tags" id="wr_tags_input" class="frm_input" size="50"value="<?php echo $write['tags']?>">
				<p style="margin:5px 0 0 0;">입력 예) 컴프,애드센스,애드포스트</p>
			</td>
		</tr>
<!-- //태그 -->
