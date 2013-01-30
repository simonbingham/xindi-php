<?php
$userdata = $this->session->all_userdata();
if(array_key_exists('flash:old:type', $userdata) && array_key_exists('flash:old:text', $userdata))
{
	$message = array('type'=>$userdata['flash:old:type'], 'text'=>$userdata['flash:old:text']);
}

if(isset($message) && array_key_exists('type', $message) && array_key_exists('text', $message))
{
	echo '<p class="text-'.$message['type'].'">'.$message['text'].'</p>';
}
?>