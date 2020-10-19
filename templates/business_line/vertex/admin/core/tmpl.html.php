<script type="text/html" id="vertex-tool">
<!-- ko 'if': type == 'title' --><!-- ko 'if':icon --><div data-bind="css:css"><div data-bind="text:title,icon:icon"></div></div><!-- /ko --><!-- ko ifnot: icon --><div data-bind="text:title,css:css"></div><!-- /ko --><!-- /ko -->
<!-- ko 'if': type == 'tool' -->
<div data-bind="css:css,visible:visible">
	<!-- ko 'if': $data.callback -->
	<a href="javascript:void(0)" class="icon" data-bind="icon:icon,tooltip:title,attr:{title:title},visible:visible,click:callback,clickBubble:false"></a>
	<!-- /ko -->
	<!-- ko ifnot: $data.callback -->
	<!-- ko 'if': $data.widget -->
	<a href="javascript:void(0)" class="icon" data-bind="icon:icon,tooltip:title,attr:{title:title},visible:visible,click:openWidget"></a>
	<!-- /ko -->
	<!-- ko ifnot: $data.widget -->
	<a href="javascript:void(0)" class="icon" data-bind="icon:icon,tooltip:title,attr:{title:title},visible:visible"></a>
	<!-- /ko -->
	<!-- /ko -->
	<!-- ko 'if': $data.widget -->
	<!-- ko 'if': $data.widget.type == 'select' -->
	<input type="hidden" data-bind="select:$data.widget,attr:{name:$data.widget.name},value:$data.widget.value" />
	<div class="dropd" data-bind="css:{open:$data.widget.open,fr:$data.widget.fr}">
		<div class="va-select-drop" data-bind="css:{open:true},event:{mouseleave:$data.widget.hide}">
			<input type="text" class="vi" placeholder="Search..." data-bind="visible:$data.widget.showSearch,value:$data.widget.match,valueUpdate:'afterkeydown',event:{focus:$data.widget.focus,click:$data.widget.focus}" />
			<ul class="drop-menu" data-bind="foreach:$data.widget.optionsToShow">
				<li data-bind="css:{act:$parent.widget.isCurrent(value)}"><!-- ko 'if': $parent.widget.type == 'custom' --><input type="checkbox" /><!-- /ko --><a href="#" class="ns" data-bind="text:label,click:$parent.widget.select,clickBubble:false"></a></li>
			</ul>
		</div>
	</div>
	<!-- /ko -->
	<!-- ko 'if': $data.widget.type == 'color' -->
	<input data-bind="colorpicker:$data.widget,attr:{name:$data.widget.name}" style="display:none" class="vi" />
	<!-- /ko -->
	<!-- /ko -->
</div>
<!-- /ko -->
<!-- ko 'if': type == 'options' -->
<div data-bind="css:css,visible:visible">
	<!-- ko 'if': $data.callback -->
	<a href="javascript:void(0)" class="icon" data-bind="icon:icon,tooltip:title,attr:{title:title},click:callback,clickBubble:false"></a>
	<!-- /ko -->
	<!-- ko ifnot: $data.callback -->
	<!-- ko 'if': $data.widget -->
	<a href="javascript:void(0)" class="icon" data-bind="icon:icon,tooltip:title,attr:{title:title},click:openWidget"></a>
	<!-- /ko -->
	<!-- ko ifnot: $data.widget -->
	<a href="javascript:void(0)" class="icon" data-bind="icon:icon,tooltip:title,attr:{title:title}"></a>
	<!-- /ko -->
	<!-- /ko -->
	<!-- ko 'if': $data.widget -->
	<!-- ko 'if': $data.widget.type == 'select' -->
	<input type="hidden" data-bind="select:$data.widget,attr:{name:$data.widget.name},value:$data.widget.value" />
	<div class="dropd" data-bind="css:{open:$data.widget.open,fr:$data.widget.fr}">
		<div class="va-select-drop" data-bind="css:{open:true},event:{mouseleave:$data.widget.hide}">
			<input type="text" class="vi" placeholder="Search..." data-bind="visible:$data.widget.showSearch,value:$data.widget.match,valueUpdate:'afterkeydown',event:{focus:$data.widget.focus,click:$data.widget.focus}" />
			<ul class="drop-menu" data-bind="foreach:$data.widget.optionsToShow">
				<li data-bind="css:{act:$parent.widget.isCurrent(value)}"><!-- ko 'if': $parent.widget.type == 'custom' --><input type="checkbox" /><!-- /ko --><a href="#" class="ns" data-bind="text:label,click:$parent.widget.select,clickBubble:false"></a></li>
			</ul>
		</div>
	</div>
	<!-- /ko -->
	<!-- ko 'if': $data.widget.type == 'color' -->
	<input data-bind="colorpicker:$data.widget,attr:{name:$data.widget.name}" style="display:none" class="vi" />
	<!-- /ko -->
	<!-- /ko -->
</div>
<!-- /ko -->
<!-- ko 'if': type == 'text' -->
<div class="widget" data-bind="css:css,visible:visible,attr:attrs,style:style,tooltip:help">
	<!-- ko 'if': title --><label data-bind="text:title"></label><!-- /ko -->
  <input type="text" class="vi vinput" data-bind="css:css,textInput:value,attr:{name:name},event:{change:callback}" />
</div>
<!-- /ko -->
<!-- ko 'if': type == 'radio' -->
<!-- ko foreach: options --><input type="radio" class="vh" data-bind="value:value,attr:{name:$parent.name,checked:$parent.checked()==value}" /><!-- /ko -->
<label class="cb" data-bind="radio:$data,css:css,click:toggle.bind($element),callback2:$data">
	<div class="vertex_yesno_cir"></div>
	<div class="vertex_yesno_wrap">
		<div class="vertex_yesno_wrapinner">
			<div class="vertex_yesno_left"></div>
			<div class="vertex_yesno_right"></div>
		</div>
	</div>
	<div class="vertex_yesno_sval" data-bind="text:checkedValue"></div>
</label>
<!-- /ko -->
<!-- ko 'if': type == 'checkbox' -->
<label class="cb" data-bind="css:css">
	<input type="checkbox" data-bind="value:value,attr:{name:name},checked:checked,callback2:$data" />
	<div class="vertex_yesno_cir"></div>
	<div class="vertex_yesno_wrap">
		<div class="vertex_yesno_wrapinner">
			<div class="vertex_yesno_left"></div>
			<div class="vertex_yesno_right"></div>
		</div>
	</div>
</label>
<!-- /ko -->
<!-- ko 'if': type == 'color' -->
<div class="widget" data-bind="css:css,visible:visible,attr:attrs,style:style,tooltip:help">
	<a class="vag-cb"></a><input type="text" class="vi tinput" data-bind="css:css,value:value,colorpicker:$data,attr:{name:name}" />
</div>
<!-- /ko -->
<!-- ko 'if': type == 'select' -->
<div class="widget" data-bind="css:css,visible:visible,attr:attrs,style:style,tooltip:help">
	<!-- ko 'if': title --><label data-bind="text:title"></label><!-- /ko -->
	<div class="reltive left">
	<input type="hidden" data-bind="select:$data,attr:{name:name},value:value" />
	<a class="vag-sa" data-bind="click:focus"></a><input type="text" class="vi vinput cinput" data-bind="value:$data.label,click:focus" />
	<div class="va-select-drop" data-bind="css:{open:$data.open},event:{mouseleave:$data.hide}">
		<input type="text" class="vi" placeholder="Search..." data-bind="visible:$data.showSearch,value:$data.match,valueUpdate:'afterkeydown',event:{focus:$data.focus,click:$data.focus}" />
		<ul class="drop-menu" data-bind="foreach:$data.optionsToShow,event:{mouseleave:$data.ml}">
			<li data-bind="css:{act:$parent.isCurrent(value)},event:{mouseenter:$parent.me}"><!-- ko 'if': $parent.type == 'custom' --><input type="checkbox" /><!-- /ko --><a href="#" class="ns" data-bind="html:label,css:{bold:(value=='vg')},click:$parent.select,clickBubble:false"></a></li>
		</ul>
	</div>
	</div>
</div>
<!-- /ko -->
<!-- ko 'if': type == 'multiple' -->
<div class="widget" data-bind="css:css,visible:visible,attr:attrs,style:style,tooltip:help">
	<!-- ko 'if': title --><label data-bind="text:title"></label><!-- /ko -->
	<div class="reltive left">
    <select class="vi" multiple="multiple" data-bind="attr:{name:name},options:$data.options,selectedOptions:$data.selected,optionsText:function(item){return item.label},optionsValue:function(item){return item.value}"></select>
	</div>
</div>
<!-- /ko -->
<!-- ko 'if': type == 'custom' -->
<div data-bind="css:css,style:style">
	<!-- ko ifnot: modules().length --><div class="inwid" data-bind="custom:$data,callback2:$data"></div><!-- /ko -->
	<!-- ko 'if': modules().length --><div class="clearfix inwid nopad"><div data-bind="html:title,custom:$data"></div><div data-bind="template:{name:'vertex-tool',foreach:modules}"></div></div><!-- /ko -->
</div>
<!-- /ko -->
<!-- ko 'if': type == 'expander' -->
<div data-bind="css:css,style:style">
	<!-- ko ifnot: modules().length --><div class="clearfix inwid"><div class="col_11_of_12 ta-left" data-bind="html:title"></div></div><!-- /ko -->
	<!-- ko 'if': modules().length --><div class="clearfix inwid">
	<div><div class="col_11_of_12 ta-left fix1" data-bind="html:title"></div>
	<a href="javascript:void(0)" class="icon exp-icon" data-bind="expander:$data,icon:icon,tooltip:'Click to expand',click:expand,clickBubble:false"></a>
	</div>
	<div data-bind="visible:ex,template:{name:'vertex-tool',foreach:modules}"></div>
	</div><!-- /ko -->
</div>
<!-- /ko -->
<!-- ko 'if':type == 'widget' --><div data-bind="css:oon($data.page,true),style:style,template:{name:'vertex-tool',foreach:modules}"></div><!-- /ko -->
<!-- ko 'if':type=='ranger' -->
<!-- ko 'if':modules().length --><div class="w100 wid-tools group active" data-bind="template:{name:'vertex-tool',foreach:modules}"></div><!-- /ko -->
<input type="text" data-bind="ranger:$data,attr:{name:name},value:value" style="display:none" />
<!-- /ko -->
<!-- ko 'if':type=='spacer' --><div class="vf-tip open reltive"><i class="vertex-icon-attention"></i><div class="fadet"><div data-bind="html:content"></div></div></div><!-- /ko -->
</script>
<style type="text/css">
pre{padding:5px}
.string{color:green}
.number{color:darkorange}
.boolean{color:blue}
.null{color:magenta}
.key{color:red}
</style>
<div id="vfo" style="display:none">
  <div class="eW">
    <div class="eH col_1 fir">
      <div class="ocol" id="voverview">
        <?php echo $this->conf("description"); ?>
      </div>
    </div>
    <div class="eH col_2">
      <div class="ocol">
        <h3>Built on the Vertex Framework</h3>
        <img src="<?php echo $this->conf("admin_path"); ?>/img/fwpic1.png" alt="" />
        <p>The S5 Vertex Framework is a set of functionality that creates the core logic and structure of a template. The purpose of the S5 Vertex framework is to unify the layouts, designs, and functions that Shape5 has built over the years to create one of the most flexible, robust and powerful template blue prints available</p>
        <a target="_blank" href="http://www.shape5.com/joomla/framework/vertex_framework.html" class="more-btn">Learn More About Vertex</a>
      </div>
    </div>
    <div class="eH col_3 las">
      <div class="ocol blue">
        <h3>Available Updates</h3>
        <?php echo $this->Version(); ?>
      </div>
      <div class="ocol red">
        <h3>Tutorials</h3>
        <ul>
          <li><a target="_blank" href="http://www.shape5.com/component/option,com_smf/Itemid,95/&Itemid=95">Get Product Support</a></li>
		  <li><a target="_blank" href="http://www.shape5.com/product_details/club_templates/">View Our Latest Templates</a></li>
		  <li><a target="_blank" href="http://demo.shape5.com">Product Demos</a></li>
		  <li><a target="_blank" href="http://www.shape5.com/custom_services.html">Hire A Professional</a></li>
		  <li><a target="_blank" href="http://www.shape5.com/promotions/member_bonuses/">Extra Member Bonuses</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div style="display:none">
	<div id="vfw">
		<ul class="vnav vrow mainm bottom fnts" data-bind="foreach:pages">
			<li data-bind="visible:mcount"><a href="#" data-bind="css:{act:$root.currentPage(name)},text:name,click:$root.loadPage,clickBubble:false,icon:icon"></a><!-- ko if: csublen > 0 --><span class="nsp bg-color2" data-bind="text:csublen"></span><!-- /ko --></li>
		</ul>
    <!-- ko if:$root.activePage -->
		<ul class="vnav vrow subm fnts">
			<!-- ko if:$root.activePage().subNav().length > 1 -->
			<!-- ko foreach:$root.activePage().subNav -->
			<li><a href="#" data-bind="css:{act:$root.currentVisible($data)},text:$data,click:$root.loadPanel,clickBubble:false"></a></li>
			<!-- /ko -->
			<!-- /ko -->
			<li class="walk-through" data-bind="visible:$root.tourCount"><a href="#" data-bind="click:function(){$root.tourStart()}">Walkthrough Tutorial<i class="vertex-icon-help-circled"></i></a></li>
		</ul>
    <!-- /ko -->
    <div class="clearfix" data-bind="css:{loaded:isLoaded,left:notPageCenter,maxw:!notPageCenter(),'layout-wrap':!notPageCenter()}">
			<!-- ko if:$root.activePage() -->
			<!-- ko if:$root.activePage().subNav().length>1 --><div class="vag-ptitle color10 hide"><span data-bind="text:$root.activePage().name"></span><span data-bind="text:' - '+currentPanel()"></span></div><!-- /ko -->
			<div class="mods w100">
					<!-- ko foreach:$root.modules -->
					<!-- ko 'if':$data -->
					<div class="mod" data-bind="css:oon($data.page),attr:{'data-intro':(attrs&&attrs.intro?attrs.intro:null)}">
						<!-- ko 'if':title -->
						<!-- ko ifnot:$root.equal(type,'fixed') -->
						<div class="w30 lab color11">
							<div class="lab-in">
								<!-- ko 'if':help -->
								<div class="vhi">
									<i class="vertex-icon-help-circled"></i>
									<div class="vf-tip dark hel"><div data-bind="lang:help"></div><div class="varrow bottom dark"></div></div>
								</div>
								<!-- /ko -->
								<div class="vtitle" data-bind="text:title"></div>
							</div>
						</div>
						<!-- /ko -->
						<!-- /ko -->
						<!-- ko 'if':type=='fixed' -->
						<div data-bind="style:style">
							<div data-bind="text:title,icon:icon,click:callback"><i class="vertex-icon-cog"></i></div>
						</div>
						<!-- /ko -->
						<!-- ko ifnot:type=='fixed' -->
						<div class="w70 wid color11" data-bind="css:{w100:!title}">
							<div class="mod-content wcenter w100" data-bind="css:{mdisabled:disabled}">
								<!-- ko 'if':type!='custom' --><!-- ko 'if':modules().length --><div class="w100 wid-tools group active" data-bind="template:{name:'vertex-tool',foreach:modules}"></div><!-- /ko --><!-- /ko -->
								<!-- ko 'if':type=='spacer' --><div class="vf-tip open"><i class="vertex-icon-attention"></i><div class="fadet"><div data-bind="html:content"></div></div></div><!-- /ko -->
								<!-- ko 'if':type=='text' --><div class="w50"><input type="text" class="vi vinput" data-bind="css:css,value:value,attr:{name:name}" /></div><!-- /ko -->
								<!-- ko 'if':type=='radio' -->
								<!-- ko foreach:options --><input type="radio" class="vh" data-bind="value:value,attr:{name:$parent.name,checked:$parent.checked()==value}" /><!-- /ko -->
								<label class="cb" data-bind="radio:$data,css:css,click:toggle.bind($element),callback2:$data">
									<div class="vertex_yesno_cir"></div>
									<div class="vertex_yesno_wrap">
										<div class="vertex_yesno_wrapinner">
											<div class="vertex_yesno_left"></div>
											<div class="vertex_yesno_right"></div>
										</div>
									</div>
									<div class="vertex_yesno_sval" data-bind="text:checkedValue"></div>
								</label>
								<!-- /ko -->
								<!-- ko 'if':type=='checkbox' -->
								<label class="cb" data-bind="css:css">
									<input type="checkbox" data-bind="value:value,attr:{name:name},checked:checked,callback2:$data" />
									<div class="vertex_yesno_cir"></div>
									<div class="vertex_yesno_wrap">
										<div class="vertex_yesno_wrapinner">
											<div class="vertex_yesno_left"></div>
											<div class="vertex_yesno_right"></div>
										</div>
									</div>
								</label>
								<!-- /ko -->
								<!-- ko 'if':type=='textarea' --><div class="w50"><textarea data-bind="css:css,value:value,attr:{name:name}"></textarea></div><!-- /ko -->
								<!-- ko 'if':type=='color' --><div class="w50 reltive"><a class="vag-cb"></a><input type="text" class="vi vinput cinput" data-bind="css:css,textInput:value,colorpicker:1,attr:{name:name}" /></div><!-- /ko -->
								<!-- ko 'if':type=='ranger' --><input type="text" data-bind="ranger:$data,attr:{name:name},value:$data.value" style="display:none" /><!-- /ko -->
								<!-- ko 'if':type=='select' -->
								<div class="w50 reltive">
									<input type="hidden" class="hid" data-bind="select:$data,attr:{name:name},value:value" />
									<a class="vag-sa" data-bind="click:focus"></a><input type="text" class="vi vinput cinput" data-bind="value:$data.label,click:focus" />
									<div class="va-select-drop" data-bind="css:{open:$data.open},event:{mouseleave:$data.hide}">
										<input type="text" class="vi" placeholder="Search..." data-bind="visible:$data.showSearch,value:$data.match,valueUpdate:'afterkeydown',event:{focus:$data.focus,click:$data.focus}" />
										<ul class="drop-menu" data-bind="foreach:$data.optionsToShow,event:{mouseleave:$data.ml}">
											<li data-bind="css:{act:$parent.isCurrent(value)},event:{mouseenter:$parent.me}"><!-- ko 'if':$parent.type=='custom' --><input type="checkbox" /><!-- /ko --><a href="#" class="ns" data-bind="html:label,css:{bold:(value=='vg')},click:$parent.select,clickBubble:false"></a></li>
										</ul>
									</div>
								</div>
								<!-- /ko -->
                <!-- ko 'if':type=='multiple' -->
								<div class="w50 reltive">
                  <select class="vi" multiple="multiple" data-bind="attr:{name:name},options:$data.options,selectedOptions:$data.selected,optionsText:function(item){return item.label},optionsValue:function(item){return item.value}"></select>
								</div>
								<!-- /ko -->
								<!-- ko 'if':type=='custom' -->
                <div data-bind="custom:$data,css:css,style:style,callback:callback"></div>
                <!-- ko 'if':modules().length --><div data-bind="template:{name:'vertex-tool',foreach:modules}"></div><!-- /ko -->
                <!-- /ko -->
								<!-- ko 'if':type=='widget' --><div data-bind="template:{name:'vertex-tool',foreach:modules},css:css,style:style"></div><!-- /ko -->
								<!-- ko 'if':type=='area' --><div class="clearfix" data-bind="template:{name:'vertex-tool',foreach:widgets},css:oon($data.page,true),style:style,callback:callback"></div><!-- /ko -->
							</div>
						</div>
						<!-- /ko -->
					</div>
					<!-- /ko -->
					<!-- /ko -->
			</div>
			<!-- /ko -->
		</div>
    <!-- ko foreach:$root.popups -->
		<div class="popups w100" data-bind="visible:isOpen">
      <div class="pchild">
      <a href="#" class="popup-close" data-bind="click:hide,clickBubble:false"><i class="vertex-icon-cancel"></i></a>
			<div class="popup-wrap">
				<div class="w100 popup">
						<!-- ko foreach:fields -->
						<div class="mod" data-bind="css:oon('all'),visible:visible" style="display:table">
							<!-- ko 'if':title -->
							<div class="w30 lab color11">
								<div class="lab-in">
									<!-- ko 'if':help -->
									<div class="vhi">
										<i class="vertex-icon-help-circled"></i>
										<div class="vf-tip dark hel"><div data-bind="lang:help"></div><div class="varrow bottom dark"></div></div>
									</div>
									<!-- /ko -->
									<div class="vtitle" data-bind="text:title"></div>
								</div>
							</div>
							<!-- /ko -->
							<div class="w70 wid" data-bind="css:{alt:!title,w100:!title},attr:{colspan:title?1:2}">
								<div class="mod-content w100 left color11" data-bind="css:{mdisabled:disabled}">
									<!-- ko 'if':type=='spacer' --><div class="vf-tip open"><i class="vertex-icon-attention"></i><div class="fadet"><div data-bind="html:content"></div></div></div><!-- /ko -->
									<!-- ko 'if':type=='text' --><div class="w50"><input type="text" class="vi vinput" data-bind="css:css,value:value,attr:{name:name}" /></div><!-- /ko -->
									<!-- ko 'if':type=='radio' -->
									<!-- ko foreach:options --><input type="radio" class="vh" data-bind="value:value,attr:{name:$parent.name,checked:$parent.checked()==value}" /><!-- /ko -->
									<label class="cb" data-bind="radio:$data,css:css,click:toggle.bind($element),callback2:$data">
										<div class="vertex_yesno_cir"></div>
										<div class="vertex_yesno_wrap">
											<div class="vertex_yesno_wrapinner">
												<div class="vertex_yesno_left"></div>
												<div class="vertex_yesno_right"></div>
											</div>
										</div>
										<div class="vertex_yesno_sval" data-bind="text:checkedValue"></div>
									</label>
									<!-- /ko -->
									<!-- ko 'if':type=='checkbox' -->
									<label class="cb" data-bind="css:css">
										<input type="checkbox" data-bind="value:value,attr:{name:name},checked:checked,callback2:$data" />
										<div class="vertex_yesno_cir"></div>
										<div class="vertex_yesno_wrap">
											<div class="vertex_yesno_wrapinner">
												<div class="vertex_yesno_left"></div>
												<div class="vertex_yesno_right"></div>
											</div>
										</div>
									</label>
									<!-- /ko -->
									<!-- ko 'if':type=='textarea' --><div class="w50"><textarea data-bind="css:css,value:value,attr:{name:name}"></textarea></div><!-- /ko -->
									<!-- ko 'if':type=='color' --><div class="w50 reltive"><a class="vag-cb"></a><input type="text" class="vi vinput cinput" data-bind="css:css,textInput:value,colorpicker:$data,attr:{name:name}" /></div><!-- /ko -->
									<!-- ko 'if':type=='ranger' --><input type="text" data-bind="ranger:$data,attr:{name:name},value:value" style="display:none" /><!-- /ko -->
									<!-- ko 'if':type=='select' -->
									<div class="w50 reltive">
										<input type="hidden" data-bind="select:$data,attr:{name:name},value:value" />
										<a class="vag-sa" data-bind="click:focus"></a><input type="text" class="vi vinput cinput" data-bind="value:$data.label,click:focus" />
										<div class="va-select-drop" data-bind="css:{open:$data.open},event:{mouseleave:$data.hide}">
											<input type="text" class="vi" placeholder="Search..." data-bind="visible:$data.showSearch,value:$data.match,valueUpdate:'afterkeydown',event:{focus:$data.focus,click:$data.focus}" />
											<ul class="drop-menu" data-bind="foreach:$data.optionsToShow,event:{mouseleave:$data.ml}">
												<li data-bind="css:{act:$parent.isCurrent(value)},event:{mouseenter:$parent.me}"><!-- ko 'if':$parent.type=='custom' --><input type="checkbox" /><!-- /ko --><a href="#" class="ns" data-bind="html:label,css:{bold:(value=='vg')},click:$parent.select,clickBubble:false"></a></li>
											</ul>
										</div>
									</div>
									<!-- /ko -->
                  <!-- ko 'if':type=='multiple' -->
									<div class="w50 reltive">
										<select class="vi" multiple="multiple" data-bind="attr:{name:name},foreach:$data.options,selectedOptions:$data.selected">
                      <option data-bind="html:label,css:{bold:(value=='vg')},attr:{value:value}"></option>
                    </select>
									</div>
									<!-- /ko -->
									<!-- ko 'if':type=='custom' --><div data-bind="custom:$data,css:css,style:style,callback:callback"></div><!-- /ko -->
									<!-- ko 'if':type=='widget' --><div data-bind="template:{name:'vertex-tool',foreach:modules},css:css,style:style"></div><!-- /ko -->
									<!-- ko 'if':type=='area' --><div class="clearfix fh" data-bind="template:{name:'vertex-tool',foreach:widgets},css:oon($data.page,true),style:style,callback:callback"></div><!-- /ko -->
								</div>
							</div>
						</div>
						<!-- /ko -->
				</div>
			</div>
      </div>
		</div>
    <!-- /ko -->
	</div>
</div>