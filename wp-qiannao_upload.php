<?php
/*
Plugin Name: WP-qiannao_upload
Plugin URI: http://www.waisir.com
Description: 此插件用于WordPress后台发布文章页面，可直接上传文件到千脑网盘并返回外链地址.
Version: 1.1
Author: 歪SIR
Author URI: http://www.waisir.com
*/

function wp_qiannaoupload_init(){
	$qiannao_userid = get_option("wp_qiannao_userid");
    if($qiannao_userid == ""){
		update_option("wp_qiannao_userid","78009");
	}
	
	echo '<br/><div id="qiannao_upload_div" class="meta-box-sortables ui-sortable" style="position: relative;"><br/><div class="postbox">';
	echo '<div class="handlediv" title="Click to toggle"><br />';
	echo '</div>';
	echo '<h3 class="hndle"><span>千脑网盘插件</span></h3>';
	echo '<div class="inside">

<div class="inside">
</br>
   <iframe id="qn_upload" frameborder="0" width="90%" height="75" scrolling="auto" allowTransparency="true">
   </iframe>
  <script type="text/javascript">
      var qn_userid = "'. get_option("wp_qiannao_userid") .'";
      var editorname = "content";
      var qn_cssfile = "http://upload.qiannao.com/style/pwbbs.css";
      var qn_encoding= "utf-8";
   </script>
  <script language=JavaScript type="text/javascript" src="http://upload.qiannao.com/jslib/js/qn/Upload.js">
  </script>
</div>


	';
	
	echo '</div></div></div>';
	echo '<script>document.getElementById("postdivrich").appendChild(document.getElementById("qiannao_upload_div"));</script>';
        }
		
		

		
function wp_qiannaoupload_options(){
	$message='千脑用户上传ID更新成功';
	if($_POST['update_qiannao_option']){
		$wp_qiannao_user_saved = get_option("wp_qiannao_userid");
		$wp_qiannao_user = $_POST['wp_qiannao_user_option'];
		if ($wp_qiannao_user_saved != $wp_qiannao_user)
			if(!update_option("wp_qiannao_userid",$wp_qiannao_user)){
				$message='千脑用户上传ID更新失败';
			}else{
				$message='千脑用户上传ID更新成功';
			}
		echo '<div class="updated"><strong><p>'. $message . '</p></strong></div>';
	}

?>



<div class=wrap>
	<form method="post" action="">
		<h2>千脑分享网盘上传插件For WordPress </h2>
		<br>
		<fieldset name="wp_basic_options"  class="options">
		<table>
			<tr>
                <td valign="top" width ="270" align="left">输入千脑用户名:</td>
				<td><input type="text" width ="150px" name="wp_qiannao_user_option" value="<?php echo get_option("wp_qiannao_userid");  ?>" /></td>
                <td width ="250px" ><a style ="text-decoration: none;margin-left:15px" href ="http://www.qiannao.com/tomos/ui/register.htm" target ="_blank">注册千脑用户名</a></td>
			</tr>
           <tr>
                <td  colspan="3" valign="top"  align="center">&nbsp;</td>
		  </tr>
		</table>			
	  </fieldset>
		<p class="submit"><input type="submit" name="update_qiannao_option" value="更新设置 &raquo;" /></p>
  </form>
</div>



<?php
}


function wp_qiannao_upload_options_admin(){
	if (function_exists('add_options_page')) { 
		add_options_page('qiannao_upload', '千脑网盘插件', 3,  basename(__FILE__), 'wp_qiannaoupload_options');
	}
}

add_action('admin_menu', 'wp_qiannao_upload_options_admin');		
add_action('dbx_post_sidebar','wp_qiannaoupload_init');
?>
