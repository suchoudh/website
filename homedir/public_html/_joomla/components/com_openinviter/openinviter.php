<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
function row2text($row,$dvars=array())
	{
	reset($dvars);
	while(list($idx,$var)=each($dvars))
		unset($row[$var]);
	$text='';
	reset($row);
	$flag=0;
	$i=0;
	while(list($var,$val)=each($row))
		{
		if($flag==1)
			$text.=", ";
		elseif($flag==2)
			$text.=",\n";
		$flag=1;
		//Variable
		if(is_numeric($var))
			if($var{0}=='0')
				$text.="'$var'=>";
			else
				{
				if($var!==$i)
					$text.="$var=>";
				$i=$var;
				}
		else
			$text.="'$var'=>";
		$i++;
		//letter
		if(is_array($val))
			{
			$text.="array(".row2text($val,$dvars).")";
			$flag=2;
			}
		else
			$text.="'$val'";
		}
	return($text);
	}
include_once('OpenInviter/frontend.php');
echo $contents;
?>
