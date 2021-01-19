<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

//새글 작성일때 기본좌표
if($write['wr_5'] == null){$write['wr_5'] =  37.566400714093284;}
if($write['wr_6'] == null){$write['wr_6'] = 126.9785391897507;}
?>

<section id="bo_w">
    <h2 class="sound_only"><?php echo $g5['title'] ?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) { 
        $option = '';
        if ($is_notice) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="notice" name="notice"  class="selec_chk" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice"><span></span>공지</label></li>';
        }
        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" class="selec_chk" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html"><span></span>html</label></li>';
            }
        }
        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="secret" name="secret"  class="selec_chk" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret"><span></span>비밀글</label></li>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }
        if ($is_mail) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="mail" name="mail"  class="selec_chk" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail"><span></span>답변메일받기</label></li>';
        }
    }
    echo $option_hidden;
    ?>
        

        
    <table class="w_tables" border="0" cellspacing="0" cellpadding="0">

        <?php if ($is_name) { ?>
        <tr>
            <td class="thead">작성자</td>
            <td>
                <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name2" required class="frm_input full_input w_inputs required" placeholder="작성자 성함" style="width:30%;">
            </td>
        </tr>
        <?php } ?>
        
        <?php if ($is_password) { ?>
        <tr>
            <td class="thead">비밀번호</td>
            <td>
                <input type="password" name="wr_password" id="wr_password2" <?php echo $password_required ?> class="frm_input full_input w_inputs <?php echo $password_required ?>" placeholder="비밀번호">
            </td>
        </tr>
        <?php } ?>
        <?php/* if ($is_email) { ?>
        <tr>
            <td class="thead">이메일</td>
            <td>
                <input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email2" class="frm_input half_input w_inputs email " placeholder="이메일">
            </td>
        </tr>
        <?php } */?>
        <?php if ($is_category) { ?>
        <tr>
            <td class="thead">구분</td>
            <td colspan="3">
                <div class="bo_w_select">
                    <label for="ca_name" class="sound_only">구분<strong>필수</strong></label>
                    <select name="ca_name" id="ca_name" required>
                        <option value="">구분선택</option>
                        <?php echo $category_option ?>
                    </select>
                </div>
            </td>
        </tr>  
        <?php } ?>
        <tr>
            <td class="thead">업체명</td>
            <td>
                <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input w_inputs required"  placeholder="업체명" style="width:60%;">
            </td>
        </tr>
        <tr>
            <td class="thead">대표전화</td>
            <td>
                <input type="tel" name="wr_2" value="<?php echo $write['wr_2'] ?>" id="wr_2" class="frm_input full_input w_inputs"  placeholder="대표전화" style="width:40%;">
            </td>
        </tr>
        <tr>
            <td class="thead">주소</td>
            <td>
                <input type="text" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3" class="frm_input full_input w_inputs required"  placeholder="주소검색" style="width:70%;" required readonly>
                <a href="javascript:void(0);" class="ser_bbt" id="ser_bbt"><i class="fa fa-search" aria-hidden="true"></i></a>
                <div style="width:50%; margin-top:5px;">
                <input type="text" name="wr_4" value="<?php echo $write['wr_4'] ?>" id="wr_4" class="frm_input full_input w_inputs"  placeholder="나머지주소">
                </div>
            </td>
        </tr>
        <tr>
            <td class="thead">마커선택</td>
            <td>
                <div class="mkup">
                    <style>
                        .mkup {padding-top: 0px; text-align: left;}
                        .mkup ul {display: inline-block; width: 40px; text-align: center; margin-top: 10px}
                    </style>
                    <ul>
                        <label for="wr_1_1"><img src="<?php echo $board_skin_url ?>/img/markerStar1.png"></label><br>
                        <input type="radio" name="wr_1" id="wr_1_1" value="markerStar1"<?php echo ($write['wr_1'] == "markerStar1") ? " checked" : "";?>>
                    </ul>
                    <ul>
                        <label for="wr_1_2"><img src="<?php echo $board_skin_url ?>/img/markerStar2.png"></label><br>
                        <input type="radio" name="wr_1" id="wr_1_2" value="markerStar2"<?php echo ($write['wr_1'] == "markerStar2") ? " checked" : "";?>>
                    </ul>
                    <ul>
                        <label for="wr_1_3"><img src="<?php echo $board_skin_url ?>/img/markerStar3.png"></label><br>
                        <input type="radio" name="wr_1" id="wr_1_3" value="markerStar3"<?php echo ($write['wr_1'] == "markerStar3") ? " checked" : "";?>>
                    </ul>
                    <ul>
                        <label for="wr_1_4"><img src="<?php echo $board_skin_url ?>/img/markerStar4.png"></label><br>
                        <input type="radio" name="wr_1" id="wr_1_4" value="markerStar4"<?php echo ($write['wr_1'] == "markerStar4") ? " checked" : "";?>>
                    </ul>
                    <ul>
                        <label for="wr_1_5"><img src="<?php echo $board_skin_url ?>/img/markerStar5.png"></label><br>
                        <input type="radio" name="wr_1" id="wr_1_5" value="markerStar5"<?php echo ($write['wr_1'] == "markerStar5") ? " checked" : "";?>>
                    </ul>
                </div>
            </td>
        </tr>
        
        <!-- API { -->
        <tr>
            <td colspan="2" class="cont_td">
                
                <div style="background-color:#f9f9f9; width:100%; margin-top:5px; height:200px; border-radius:4px;" id="map"></div>
                <div>
                    <input type="text" name="wr_5" value="<?php echo $write['wr_5']; ?>" id="wr_5" class="frm_input winp" readonly>
                    <input type="text" name="wr_6" value="<?php echo $write['wr_6']; ?>" id="wr_6" class="frm_input winp" readonly>
				</div>
                
                <div id="clickLatlng"></div>
                <!--
				<script type="text/javascript" src="https://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
				-->
				<script type="text/javascript" src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                
                <!-- {
                kakao Api / JavaScript 키 필요 
                //dapi.kakao.com/v2/maps/sdk.js?appkey=발급받은키값&libraries=services
                -->
                <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $board['bo_1'] ?>&libraries=services"></script>
                <!-- } -->
                
                <script>
                var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
                    mapOption = {
                        center: new daum.maps.LatLng(<?php echo $write['wr_5']?>, <?php echo $write['wr_6']?>), // 지도의 중심좌표
                        level: 3 // 지도의 확대 레벨
                    };

                // 지도를 생성
                var map = new daum.maps.Map(mapContainer, mapOption);

                // 주소-좌표 변환 객체 생성
                var geocoder = new daum.maps.services.Geocoder();

                // 마커
                var marker = new daum.maps.Marker({
                    map: map,
                    // 지도 중심좌표에 마커를 생성
                    position: map.getCenter()
                });

				

                // 주소검색 API (주소 > 좌표변환처리)
                $(function() {
                    $("#wr_3").on("click", function() {
                        new daum.Postcode({
                            oncomplete: function(data) {
                                //console.log(data);
                                $("#wr_3").val(data.address);
                                //$("#road").val(data.roadAddress);
                                //$("#sido").val(data.sido);
                                //$("#gugun").val(data.sigungu);
                                //$("#dong").val(data.bname);

                                geocoder.addressSearch(data.address, function(results, status) {
                                    // 정상적으로 검색이 완료됐으면
                                    if (status === daum.maps.services.Status.OK) {

                                        //첫번째 결과의 값을 활용
                                        var result = results[0];

                                        // 해당 주소에 대한 좌표를 받아서
                                        var coords = new daum.maps.LatLng(result.y, result.x);

                                        // 지도를 보여준다.
                                        map.relayout();

                                        // 지도 중심을 변경한다.
                                        map.setCenter(coords);

                                        // 좌표값을 넣어준다.
                                        document.getElementById('wr_5').value = coords.getLat();
                                        document.getElementById('wr_6').value = coords.getLng();

                                        // 마커를 결과값으로 받은 위치로 옮긴다.
                                        marker.setPosition(coords);
                                    }
                                });

                            }
                        }).open();
                    });
                    
                    $("#ser_bbt").on("click", function() {
                        new daum.Postcode({
                            oncomplete: function(data) {
                                //console.log(data);
                                $("#wr_3").val(data.address);
                                //$("#road").val(data.roadAddress);
                                //$("#sido").val(data.sido);
                                //$("#gugun").val(data.sigungu);
                                //$("#dong").val(data.bname);

                                geocoder.addressSearch(data.address, function(results, status) {
                                    // 정상적으로 검색이 완료됐으면
                                    if (status === daum.maps.services.Status.OK) {

                                        //첫번째 결과의 값을 활용
                                        var result = results[0];

                                        // 해당 주소에 대한 좌표를 받아서
                                        var coords = new daum.maps.LatLng(result.y, result.x);

                                        // 지도를 보여준다.
                                        map.relayout();

                                        // 지도 중심을 변경한다.
                                        map.setCenter(coords);

                                        // 좌표값을 넣어준다.
                                        document.getElementById('wr_5').value = coords.getLat();
                                        document.getElementById('wr_6').value = coords.getLng();

                                        // 마커를 결과값으로 받은 위치로 옮긴다.
                                        marker.setPosition(coords);
                                    }
                                });

                            }
                        }).open();
                    });
                });
					
				//마커를 기준으로 가운데 정렬이 될 수 있도록 추가
				var markerPosition = marker.getPosition(); 
				map.relayout();
				map.setCenter(markerPosition);

				//브라우저가 리사이즈될때 지도 리로드
				$(window).on('resize', function () {
					var markerPosition = marker.getPosition(); 
					map.relayout();
					map.setCenter(markerPosition)
				});

                </script>
                
            </td>
        </tr>
        <!-- } API -->
        
        
        <tr>
            <td colspan="2" class="cont_td">
                <?php if ($option) { ?>
                <div class="write_div opt_div">
                    <span class="sound_only">옵션</span>
                    <ul class="bo_v_option">
                    <?php echo $option ?>
                    </ul>
                </div>
                <?php } ?>
                
                <div style="height:10px">　</div>
                
                <div class="write_div">
                    <label for="wr_content" class="sound_only">내용<strong>필수</strong></label>
                    <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
                        <?php if($write_min || $write_max) { ?>
                        <!-- 최소/최대 글자 수 사용 시 -->
                        <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                        <?php } ?>
                        <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                        <?php if($write_min || $write_max) { ?>
                        <!-- 최소/최대 글자 수 사용 시 -->
                        <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                        <?php } ?>
                    </div>

                </div>
            
            </td>
        </tr>
    </table>




	
    
        



    

    <?//php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
        <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) {

    if ($i==1) $link_msg = "관련 여행상품 링크 1";

?>
    <div class="bo_w_link write_div">
        <label for="wr_link<?php echo $i ?>"><i class="fa fa-link" aria-hidden="true"></i><span class="sound_only"> 링크  #<?php echo $link_msg ?></span></label>
        <input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){ echo $write['wr_link'.$i]; } ?>" id="wr_link<?php echo $i ?>" class="frm_input full_input w_inputs" size="50">
    </div>
    <?php } ?>
        
 

    <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
    <div class="bo_w_flie write_div">
        <div class="file_wr write_div">
            <label for="bf_file_<?php echo $i+1 ?>" class="lb_icon"><i class="fa fa-folder-open" aria-hidden="true"></i><span class="sound_only"> 파일 #<?php echo $i+1 ?></span></label>
            <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file w_inputs">
        </div>
        <?php if ($is_file_content) { ?>
        <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input w_inputs" size="50" placeholder="파일 설명을 입력해주세요.">
        <?php } ?>

        <?php if($w == 'u' && $file[$i]['file']) { ?>
        <span class="file_del">
            <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
        </span>
        <?php } ?>
        
    </div>
    <?php } ?>


    <?php if ($is_use_captcha) { //자동등록방지  ?>
    <div class="write_div">
        <?php echo $captcha_html ?>
    </div>
    <?php } ?>

    <div class="btn_confirm write_div">
        <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn_cancel btn">취소</a>
        <button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn">작성완료</button>
    </div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->