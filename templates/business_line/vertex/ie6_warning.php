<?php if(preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT'])) { ?>	
<style>
#s5_iepopouter {
filter: alpha(opacity = 80);
}
</style>		
<script>
 var my_div = null;
 var newDiv = null;
 function s5_addIE6close() {document.getElementById("s5_iepopouter").style.display = 'none';document.getElementById("s5_iepopinner").style.display = 'none';}
</script>		
<div id="s5_ie_pop">
	<div id="s5_iepopouter"></div>			
		<div id="s5_iepopinner">		
		<div id="s5_iepopwrap" onclick="s5_addIE6close();"></div><div style='clear:both;height:0px;'>		
		<div id="s5_iepopwrap2"></div><div id="s5_iepop_bigtitle">You are using Internet Explorer 8.0 or older to view the web.</div>			
		<div style='clear:both;'></div><div id="s5_iepop_maintext">Due to security risks and a lack of support for web standards this website does not support your version of IE. Please upgrade to a newer browser to fully enjoy this site and the rest of the web. <br/><br/>After you update, please come back and you will be able to view our site.</div>			
		<a href='http://www.microsoft.com/windows/internet-explorer/' target='_blank'><center><div  id="s5_iepop_upgrade"><span style='font-size:18px;color:#2f82ff;'>Upgrade</span></div></center></a>
	</div>	
</div>		
<?php } ?>			
