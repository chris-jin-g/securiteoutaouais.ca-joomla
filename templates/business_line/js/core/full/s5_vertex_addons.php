<script type = "text/javascript" > /*<![CDATA[*/ <?php if ($s5_login_url != "") { ?>
jQuery(document).ready(function() {
    function s5_login_url() {
        window.location = "<?php echo $s5_login_url; ?>";
    }
    if (document.getElementById("s5_login")) {
        document.getElementById("s5_login").className = "";
        document.getElementById("s5_login").onclick = s5_login_url;
        if (document.getElementById("s5_login").href) {
            document.getElementById("s5_login").href = "javascript:;";
        }
    }
});
<?php } ?>
<?php if ($s5_register_url != "") { ?>
jQuery(document).ready(function() {
    function s5_register_url() {
        window.location = "<?php echo $s5_register_url; ?>";
    }
    if (document.getElementById("s5_register")) {
        document.getElementById("s5_register").className = "";
        document.getElementById("s5_register").onclick = s5_register_url;
        if (document.getElementById("s5_register").href) {
            document.getElementById("s5_register").href = "javascript:;";
        }
    }
});
<?php } ?>
<?php if ($s5_menudetach  == "yes" && $s5_show_menu == "show") { ?>
<?php if ($browser == "ie9") { ?>
function s5_fm_load_check_scroll_height() {
    <?php } ?>
    <?php if ($browser != "ie9") { ?>
    jQuery(document).ready(function() {
            <?php } ?>
            if (window.addEventListener) {
                window.addEventListener('scroll', s5_fm_check_scroll_height, false);
                window.addEventListener('resize', s5_fm_check_scroll_height, false);
            } else if (window.attachEvent) {
                window.attachEvent('onscroll', s5_fm_check_scroll_height);
                window.attachEvent('onreisze', s5_fm_check_scroll_height);
            }
            window.setTimeout(s5_fm_check_scroll_height, 100);
        }
        <?php if ($browser != "ie9") { ?>);
    <?php } ?>
    var s5_menu_wrap_height = 0;
    var s5_menu_wrap_parent_height = 0;
    var s5_menu_wrap_parent_parent_height = 0;
    var s5_menu_wrap_run = "no";

    function s5_fm_check_scroll_height() {
        if (s5_menu_wrap_run == "no") {
            s5_menu_wrap_height = document.getElementById("s5_menu_wrap").offsetHeight;
            s5_menu_wrap_parent_height = document.getElementById("s5_menu_wrap").parentNode.offsetHeight;
            s5_menu_wrap_parent_parent_height = document.getElementById("s5_menu_wrap").parentNode.parentNode.offsetHeight;
            s5_menu_wrap_run = "yes";
        }
        <?php if ($s5_fmenuslidein == "yes") { ?>
	        <?php if ($s5_initialmenufloat == "") {
				$s5_initialmenufloat = 300;
			} ?>
			<?php if ($s5_fmenuheight == "") {
				$s5_fmenuheight = 999999;
			} ?>
	        var s5_fmenuheight_new = <?php echo $s5_fmenuheight; ?>;
	        <?php if ($s5_fmenuheight == 999999) { ?>
	        	s5_fmenuheight_new = document.getElementById("s5_menu_wrap").offsetHeight;
	        <?php } ?>

	        if (window.pageYOffset >= <?php echo $s5_initialmenufloat; ?> - s5_fmenuheight_new) {
	            document.getElementById("s5_menu_wrap").style.top = "0px";
	        } else {
	            document.getElementById("s5_menu_wrap").style.top = "-500px";
	        }
        <?php } ?>

        if (document.getElementById("s5_floating_menu_spacer") != null) {
    		if (window.pageYOffset >= <?php echo $s5_initialmenufloat; ?> && window.innerWidth > <?php echo $s5_responsive_mobile_bar_trigger; ?>) {
                document.getElementById("s5_floating_menu_spacer").style.height = s5_menu_wrap_height + "px";
                <?php if ($s5_fmenufullwidth  == "yes") { ?>
                document.getElementById("s5_menu_wrap").className = 's5_wrap_fmfullwidth';
                <?php } else {?>
                document.getElementById("s5_menu_wrap").className = 's5_wrap notfullwidth';
                <?php } ?>
                document.getElementById("subMenusContainer").className = 'subMenusContainer';
                if (s5_menu_wrap_parent_height >= s5_menu_wrap_height - 20 && s5_menu_wrap_parent_parent_height >= s5_menu_wrap_height - 20 && document.getElementById("s5_menu_wrap").parentNode.style.position != "absolute" && document.getElementById("s5_menu_wrap").parentNode.parentNode.style.position != "absolute") {
                    document.getElementById("s5_floating_menu_spacer").style.display = "block";
                }
            } else {
                document.getElementById("s5_menu_wrap").className = '';
                if (document.body.innerHTML.indexOf("s5_menu_overlay_subs") <= 0) {
                    document.getElementById("subMenusContainer").className = '';
                }
                document.getElementById("s5_floating_menu_spacer").style.display = "none";
            }
        }
    }

    <?php if ($browser == "ie9") { ?>
    	window.setTimeout(s5_fm_load_check_scroll_height, 1000);
    <?php } ?>
<?php } ?>
</script>