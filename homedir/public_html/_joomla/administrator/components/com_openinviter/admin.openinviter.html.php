<?php
$file1 = JPATH_SITE."/components/com_openinviter/OpenInviter/config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$config = array();
	$config['username'] = $_POST['username'];
	$config['private_key'] = $_POST['private_key'];
	$config['transport'] = $_POST['transport'];
	$config['local_debug'] = ($_POST['local_debug'] == 'TRUE' ? TRUE:FALSE);
	$config['remote_debug'] = ($_POST['remote_debug']== 'TRUE' ? TRUE:FALSE);
	$config['message_subject'] = $_POST['mail_subject'];
	$config['message_body'] = $_POST['mail_body'];
	$config['cookie_path'] = $_POST['cookie_path'];
	$file_contents="<?php \n";
	$file_contents.="\$openinviter_settings=array(\n".row2text($config)."\n);\n";
	$file_contents.="?>";
	file_put_contents($file1,$file_contents);
}
$contents = "";
$contents.= "<div><h2>OpenInviter Component Settings</h2>";
require ($file1);
$mail_subject = $openinviter_settings['message_subject'];
$mail_body = $openinviter_settings['message_body'];
$filter_false = '';
$filter_true = '';
$transport_curl = '';
$transport_wget = '';
$local_debug_true = '';
$local_debug_false = '';
$remote_debug_true = '';
$remote_debug_false = '';
if ($openinviter_settings['transport'] == 'curl') $transport_curl = ' selected ';
else $transport_wget = ' selected ';
if ($openinviter_settings['local_debug']) $local_debug_true = ' selected ';
else $local_debug_false = ' selected ';
if ($openinviter_settings['remote_debug']) $remote_debug_true = ' selected ';
else $remote_debug_false = ' selected ';
$contents.="<form method='POST'><table border='0'><tr><td align='right'>OI Username</td><td><input type='text' name='username' value='{$openinviter_settings['username']}'></td></tr>
									<tr><td align='right'>OI Private Key</td><td><input type='text' name='private_key' value='{$openinviter_settings['private_key']}'></td></tr>
									<tr><td align='right'>Cookie Path</td><td><input type='text' name='cookie_path' value='{$openinviter_settings['cookie_path']}'></td></tr>
									<tr><td align='right'>Filter emails</td><td><select name='filter_emails'>
									<option{$filter_true}>TRUE</option>
									<option{$filter_false}>FALSE</option>
									</select></td></tr>
									<tr><td align='right'>Transport method</td><td><select name='transport'>
									<option{$transport_curl}>curl</option>
									<option{$transport_wget}>wget</option>
									</select></td></tr>
									<tr><td align='right'>Local Debug</td><td><select name='local_debug'>
									<option{$local_debug_true}>TRUE</option>
									<option{$local_debug_false}>FALSE</option>
									</select></td></tr>
									<tr><td align='right'>Remote Debug</td><td><select name='remote_debug'>
									<option{$remote_debug_true}>TRUE</option>
									<option{$remote_debug_false}>FALSE</option>
									</select></td></tr>
									<tr><td align='right'>Email Subject</td><td><input type='text' name='mail_subject' value='{$mail_subject}'></td></tr>
									<tr><td align='right'>Email Body</td><td><textarea name='mail_body' cols='40' rows='15'>{$mail_body}</textarea></td></tr>
									<tr><td colspan='2' align='center'><input type='submit' value='Save'></td></tr>
									</table></form>
</div>";
echo $contents;
?>