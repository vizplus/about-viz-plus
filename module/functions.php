<?php
function short_viz($str,$symbol=true){
	return number_format(floatval($str),2,'.','&nbsp;').($symbol?' viz':'');
}