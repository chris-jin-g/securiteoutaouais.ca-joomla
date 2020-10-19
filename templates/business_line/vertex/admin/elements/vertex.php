<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
define("V4A",true);
define("VDBG",false);
jimport('joomla.form.form');
jimport('joomla.html.html');
jimport('joomla.form.formfield'); //import the necessary class definition for formfield
function jform_inst($arr = array()) {
  static $temp_arr = array();
  if(!$arr)
    return null;
  $temp_arr[$arr[0]] = JForm::getInstance($arr[0],$arr[1],array(),true,$arr[0]);
  return $temp_arr[$arr[0]];
}
function s5docleanUp() {
  // Remove old files
  $s5_remove_dir_name = dirname(__file__);
  $s5_remove_dir_name = str_replace("vertex/admin/elements","",$s5_remove_dir_name);
  if(file_exists($s5_remove_dir_name."css/s5_info_slide.css")) {
    $fileArray = array(
      $s5_remove_dir_name."css/s5_info_slide.css",
      $s5_remove_dir_name."css/s5_fullpage.css",
      $s5_remove_dir_name."css/s5_responsive_bars.css",
      $s5_remove_dir_name."css/s5_responsive_hide_classes.css",
      $s5_remove_dir_name."css/s5_vertex_addons.php",
      $s5_remove_dir_name."js/jquery.fullPage.js",
      $s5_remove_dir_name."js/jquery.slimscroll.min.js",
      $s5_remove_dir_name."js/lazy_load.js",
      $s5_remove_dir_name."js/s5_columns_equalizer.js",
      $s5_remove_dir_name."js/s5_flex_menu.js",
      $s5_remove_dir_name."js/s5_font_adjuster.js",
      $s5_remove_dir_name."js/s5_info_slide.js",
      $s5_remove_dir_name."js/s5_responsive_ie.js",
      $s5_remove_dir_name."js/s5_responsive_mobile_bar.js",
      $s5_remove_dir_name."js/s5_vertex_addons.php",
      $s5_remove_dir_name."js/scrollReveal.min.js",
      $s5_remove_dir_name."js/tooltips.js",
      );
    foreach($fileArray as $value) {
      if(file_exists($value)) {
        unlink($value);
      }
    }
  }
}

function msfix($name, $data) {
  $result = preg_match("#\"(s5_responsive_tablet_hide)\"\:(\"[^\"]+)#", $data, $match);
  if($result && isset($match[1]) && isset($match[2])) {
    $l = explode(",", trim($match[2], '"'));
    $data = str_replace('"'.trim($match[2], '"').'"', json_encode($l), $data);
  }
  return $data;
}

$vjson_data = null;
function runCron($file) {
  global $vjson_data;
  $jsonData = array();
  $check = '';
  $cronned = 0;
  $dir = dirname(dirname(dirname(dirname(__file__)))).DIRECTORY_SEPARATOR;
  if(file_exists($file)) {
    $check = file_get_contents($file);
    $check = str_replace("xml_","",$check);
    $check = msfix("s5_responsive_tablet_hide", $check);
    $check = msfix("s5_responsive_mobile_hide", $check);
  $check = msfix("s5_hide_component_items", $check);
    $file_data = json_decode($check,true);
    if(isset($file_data["vertexFramework"]))
      $vjson_data = $file_data["vertexFramework"];
    else
      $vjson_data = $file_data;
    
    $db = JFactory::getDBO();
    $query = "SELECT * FROM #__template_styles;";
    $db->setQuery($query);
    $result = $db->loadAssocList();
    $cb = count($vjson_data);
    foreach($result as $key => $data) {
      if(isset($data['title']) && isset($vjson_data[$data['title']])) {
        $jsonData[$data['title']] = $vjson_data[$data['title']];
      }
      /*foreach($result as $k => $style) {
        if(isset($style['title'])) {
          
        } else {
          $cronned++;
        }
      }*/
    }
    $cronned = $cb - count($jsonData);
    file_put_contents($dir."vertex.json",json_encode(array("vertexFramework" => $jsonData)),LOCK_EX);
    $vjson_data = $jsonData;
  }
  $msg = array('cron' => false);
  if($cronned) {
    $msg['cron'] = $cronned . ' items have been cleaned up';
  }
  s5docleanUp();
  return $msg;
}

class JFormFieldVertex extends JFormField {
  protected $type = 'Vertex'; //the form field type
  protected function getInput() {
    if (JFactory::getApplication()->isSite()) {
      echo '<b style="color:red; font-style: italic;">Vertex does not support config at frontend</b>';
      return;
    }
    if(!defined('VERTEX_LOADED')) {
      JHtml::_('behavior.modal');
      global $vjson_data;
      //$document = JFactory::getDocument();
      $data = null;
      foreach((array )$this->form as $key => $val) {
        if($val instanceof JRegistry || $val instanceof Joomla\Registry\Registry) {
          $data = &$val;
          break;
        }
      }
      $title = $data->toArray();
      $title = $title['title'];
      $dir = dirname(dirname(dirname(dirname(__file__)))).DIRECTORY_SEPARATOR;
      $vertex = $template_path = $template_name = $vertex_admin_path = null;
      $vpath = $dir."vertex/admin/core/vertex.php";
      var_dump(runCron($dir."vertex.json"));
      if(!file_exists($vpath)) {
        trigger_error("Vertex not installed");
        echo "<div style=\"color:red\">Vertex not installed</div>";
        return "";
      } else {
        include_once ($vpath);
        $conf = array(
          "base_path" => $dir,
          "xml_path" => $dir."xml/",
          "lang_path" => $dir."xml/language/",
          "vertex_path" => $dir."vertex/admin/",
          "update_interval" => "1 hour",
          "template_title" => $title,
          "cache_path" => JPATH_CACHE,
          "cms" => "j",
          "installed" => true
        );
        $vertex = load_vertex("joomla",$conf);
        if(!$vertex) {
          trigger_error("Vertex create failed");
          echo "<div style=\"color:red\">Vertex create failed</div>";
          return;
        }
        //$db = JFactory::getDbo();
        $vertex->on("config",function () use ($title,$dir,$vjson_data) {
          /*$db->setQuery("CREATE TABLE IF NOT EXISTS `#__vertex` (
          * `id` INT(10) NOT NULL AUTO_INCREMENT,
          * `style` VARCHAR(128) NOT NULL,
          * `config` MEDIUMTEXT NULL,
          * PRIMARY KEY (`id`),
          * UNIQUE INDEX `style_key` (`style`)
          * ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;")->execute();
          * $title = $db->escape($title);
          * $res = $db->setQuery("SELECT `config` FROM `#__vertex` WHERE `style` = '$title'")->execute();
          * $res = $db->loadAssoc();
          * if($res && is_array($res) && isset($res["config"])) {
          * $res = unserialize($res["config"]);
          * }
          */
          $res = null;
          if(!$vjson_data && file_exists($dir."vertex.json")) {
            $res = file_get_contents($dir."vertex.json");
            if($res) {
              $res = json_decode($res,true);
              if(isset($res["vertexFramework"])) $res = $res["vertexFramework"];
              if(isset($res[$title])) return (array)$res[$title];
              else if(count($res)) {
                return (array)end($res);
              } else return array();
            } else return array();
          } else if(count($vjson_data)) {
            //var_dump($title, array_keys($vjson_data));
            if(isset($vjson_data[$title])) return (array)$vjson_data[$title];
            else if(count($vjson_data)) return (array)end($vjson_data);
          }
          return (array)array();
        });
        $vertex->on("lang",function () {
          return JFactory::getDocument()->getLanguage();
        });
        $vertex->on("css",function ($csss = array())use ($vertex) {
          foreach($csss as $css) JFactory::getDocument()->addStyleSheet($vertex->conf("admin_path")."css/".$css);
        });
        $vertex->on("script",function ($jss = array())use ($vertex) {
          foreach($jss as $js)JFactory::getDocument()->addScript($vertex->conf("admin_path")."js/".$js);
        });
        $vertex->on("save",function ($data = array(),$current = array(),$default = array())use ($title,$dir,$vjson_data) {
          /*$db->setQuery("CREATE TABLE IF NOT EXISTS `#__vertex` (
          * `id` INT(10) NOT NULL AUTO_INCREMENT,
          * `style` VARCHAR(128) NOT NULL,
          * `config` MEDIUMTEXT NULL,
          * PRIMARY KEY (`id`),
          * UNIQUE INDEX `style_key` (`style`)
          * ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;")->execute();*/
          //$title = $db->escape($title);
          $conf = array_merge($current,$data);
          $res = array();
          if(!$vjson_data && file_exists($dir."vertex.json")) {
            $f = file_get_contents($dir."vertex.json");
            if($f) {
              $res = json_decode($f,true);
              if(isset($res["vertexFramework"])) $res = $res["vertexFramework"];
            }
          } else {
            $res = $vjson_data;
          }
          if(isset($_POST["title"])) {
            $title = $_POST["title"];
            unset($conf["title"], $_POST["title"]);
          }
          $res[$title] = $conf;
          $res = file_put_contents($dir."vertex.json",json_encode(array("vertexFramework" => $res)),LOCK_EX);
          //$res = $db->setQuery("REPLACE INTO `#__vertex` SET `style` = '$title', `config` = '$conf';")->execute();
          if($res) echo "MSG:DONE";
          else echo "MSG:ERROR";
          //var_dump($_POST, $data, $current, $conf);
          JFactory::getApplication()->close();
        });
        $vertex->on("onelement",function ($data,$field,$attrs,$section,$xml)use ($vertex) {
          switch($attrs["type"]) {
            case "fluidwidth":$fields = array(); if(isset($field->field)) {
              foreach($field->field as $f) {
                $fields[] = $vertex->element($f,$section); }
              }
              return $data + array(
                "type" => "custom",
                "attrs" => (object)$vertex->attrs($attrs),
                "modules" => $fields
              );
            case "menujs":
              $jform = jform_inst($xml);
              if(!$jform)break;
              $f = $jform->getInput($data["name"],null,isset($attrs["default"])?$attrs["default"]:null);
              return $data + array(
                "type" => "select",
                "title" => isset($attrs["title"])?$attrs["title"]:(isset($attrs["label"])?$attrs["label"]:null),
                "attrs" => (object)$vertex->attrs($attrs),
                "options" => $f,
                "dsort" => true
              );
            case "menu"://just for backwards compat
              $jform = jform_inst($xml);
              if(!$jform)break;
              $f = $jform->getInput($data["name"],null,isset($attrs["default"])?$attrs["default"]:null);
              return $data + array(
                "type" => "custom",
                "title" => isset($attrs["title"])?$attrs["title"]:(isset($attrs["label"])?$attrs["label"]:null),
                "attrs" => (object)$vertex->attrs($attrs),
                "content" => $f
              );
            case "menuitemsjs":
              $jform = jform_inst($xml);
              if(!$jform)break;
              $f = $jform->getInput($data["name"],null,isset($attrs["default"])?$attrs["default"]:null);
              return $data + array(
                "type" => "select",
                "title" => isset($attrs["title"])?$attrs["title"]:(isset($attrs["label"])?$attrs["label"]:null),
                //"attrs" => (object)array("multiple" => "multiple"),
                "attrs" => (object)$vertex->attrs($attrs + array("multiple" => "multiple")),
                "options" => $f,
                "dsort" => true
              );
            case "menuitems"://just for backwards compat
              $jform = jform_inst($xml);
              if(!$jform)break;
              $f = $jform->getInput($data["name"],null,isset($attrs["default"])?$attrs["default"]:null);
              return $data + array(
                "type" => "custom",
                "title" => isset($attrs["title"])?$attrs["title"]:(isset($attrs["label"])?$attrs["label"]:null),
                "attrs" => (object)$vertex->attrs($attrs),
                "content" => $f
              );
            default:
              $jform = jform_inst($xml);
              if(!$jform)break; //if($data["hidden"]) break;
              $f = $jform->getInput($data["name"],null,isset($attrs["default"])?$attrs["default"]:null);
              return $data + array(
                "type" => "custom",
                "title" => isset($attrs["title"])?$attrs["title"]:(isset($attrs["label"])?$attrs["label"]:null),
                "attrs" => (object)$vertex->attrs($attrs),
                "content" => $f
              );
          }
          return null;
        });
      }
      $front = $vertex->front($title);
      $ipath = $vertex->conf("admin_path");
      $ver = $vertex->version;
      $js = "VG.img_path=\"{$ipath}img\";
      function setMultiple(a,b){if(!b)return;for(var i=0;i<a.options.length;i++){if(b.indexOf(a.options[i].value)>-1){a.options[i].selected=true;a.options[i].setAttribute('selected','selected')}}}
      function parseElement(a,b){
        var c=va.ko.dataFor(this);
        if(a.nodeName=='SELECT'){
          var d=[],e;
          for(var i=0;i<a.options.length;i++){
            d.push({label:a.options[i].innerHTML,value:a.options[i].value});
          }
          e=new va.Module({'page':c.page,'name':a.name,'type':'select','value':b,'options':d},c.tabid);
          c.modules.push(e);
          a.parentNode.removeChild(a);
        }
      }
      Gator(window).on(\"load\", function(){
        var a=document.getElementById(\"style-form\"),b=document.getElementById(\"jform_home\"),ofd=[],sn;
        function putBack(){
          for(var i=0;i<ofd.length;i++){
            ofd[i].style.display='none';
            a.appendChild(ofd[i]);
          }
        }
        if(b){
          b=b.parentNode.parentNode;
          b.pb = 'jform[home]';
          document.getElementById(\"voverview\").appendChild(b);
          //ofd.push({match:encodeURIComponent(\"jform[home]\"),el:b});
          ofd.push(b);
        }
        var stype;
        function urlencode(str) {
          return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
        }
        function pre(m) {
          if(m=='style.save2copy'){
            var tn = ''+document.getElementById('jform_title').value;
            var re = /([0-9]+)/gi; 
            var mat = tn.match(re);
            if(mat&&mat[0]) {
              var nn = parseInt(mat[0]);
              if(nn) nn++;
              tn = tn.replace(mat[0], nn);
            } else {
              tn = tn + ' (1)';
            }
            stype=m;
            VERTEX.save('&action='+m+'&title='+urlencode(tn));
          } else {
            var tn = ''+document.getElementById('jform_title').value;
            stype=m;
            VERTEX.save('&title='+urlencode(tn));
          }
        }
        function setcb(m,n){
          m.removeAttribute(\"onclick\");
          m.onclick = function(){pre(n)};
        }
        VERTEX.preSave=putBack;
        VERTEX.beforeSave=function(fd){
          return fd;
        };
        var lw=[0,0],lh={px:500,'%':40};
        VERTEX.customUpdate=function(t,o){
          if(o=='s5_body_width') {
            lw[0]=VG.current.s5_body_width;
            t.subscribe(function(n) {
              var v1=VG.getValueFor('vertex[s5_fixed_fluid]');
              n=parseInt(n);
              var x = lh[v1];
              if(n>=x){
                lw[0]=n;
              }
              VERTEX.onPage(null,lw,v1);
            });
          }
          if(o=='s5_max_body_width') {
            lw[1]=VG.current.s5_max_body_width;
            t.subscribe(function(n) {
              var v1=VG.getValueFor('vertex[s5_fixed_fluid]');
              n=parseInt(n);
              var x = lh[v1];
              if(n>=x){
                lw[1]=n;
              }
              VERTEX.onPage(null,lw,v1);
            });
          }
        };
        var rt=0, rti;
        function crti() {
          clearInterval(rti);
          rt=0;
          rti=null;
        }
    VERTEX.onPage=function(a,b,c){
      jQuery('#s5_favicon,#s5_logo_image_file').removeAttr('readonly');
      if(jQuery.fn.fieldMedia){
        jQuery('#s5_favicon,#s5_logo_image_file').parents('.field-media-wrapper').fieldMedia();
      } else if (SqueezeBox){
        $$('a.modal').removeEvents('click');
        SqueezeBox.assign($$('a.modal'),{parse:'rel'});
        SqueezeBox.options=null;
      }
          var v1=c?c:VG.getValueFor('vertex[s5_fixed_fluid]');
          var v2=b&&b[0]?b[0]:VG.getValueFor('vertex[s5_body_width]');
          var v3=b&&b[1]?b[1]:VG.getValueFor('vertex[s5_max_body_width]');
          if(v1&&v2&&!v3){
            document.getElementById('maxw').innerHTML='#vfw .maxw{min-width:500px;width:'+v2+v1+'}';
          } else if(v1&&v2&&v3) {
            document.getElementById('maxw').innerHTML='#vfw .maxw{min-width:500px;max-width:'+v3+'px;width:'+v2+v1+'}';
          } else {
            document.getElementById('maxw').innerHTML='';
          }
          crti();
          rti = setInterval(function(){rt++;va.ev.send('ranger_update',[]);if(rt>5)crti()},150);
        };
        var apply = document.getElementById(\"toolbar-apply\"), save = document.getElementById(\"toolbar-save\"), copy = document.getElementById(\"toolbar-save-copy\");
        setcb(apply.children[0],'style.apply');
        setcb(save.children[0],'style.save');
        setcb(copy.children[0],'style.save2copy');
        var VDATA=$front;
        VERTEX.load(VDATA,a,function(){
          if(stype){
            if(!VERTEX.debug) Joomla.submitbutton(stype);
          }
        },'$ver');
        sn=document.getElementById(\"jform_title\");
        if(sn){
          sn=sn.parentNode.parentNode.parentNode;
          a.insertBefore(sn, a.children[0]);
        }
        if(a.children[a.children.length-1]){
          a.children[a.children.length-1].style.display=\"none\";
        }
        //a.style.display=\"none\";
        var sd='<style type=\"text/css\" id=\"maxw\"></style>';
        document.head.innerHTML+=sd;
        setTimeout(function(){
          var assignments = {name:\"Assignments\",icon:\"dot-circled\",type:\"custom\",modules:[
            {type:\"custom\",title:null,css:\"well\",content:function(){
              var a=document.getElementById(\"assignment\");
              this.appendChild(a);
              ofd.push(a);
              a.style.display=\"block\";
            }}
          ],csublen:jQuery(a).find(\"input[type=checkbox]\").length};
          VDATA.data.push(assignments);
          VDATA.data[0].icon=\"coverflow\";
          VERTEX.inject(VDATA.data);
        }, 500);
      });";
   JFactory::getDocument()->addScriptDeclaration($js);
   /**
    * Disable jQuery chosen
    * http://harvesthq.github.io/chosen/
    */
   if(isset(JFactory::getDocument()->_scripts[JURI::root(true).'/media/jui/js/chosen.jquery.min.js'])) {
    unset(JFactory::getDocument()->_scripts[JURI::root(true).'/media/jui/js/chosen.jquery.min.js']);
    JFactory::getDocument()->addScriptDeclaration("jQuery.fn.extend({chosen:function(){}});");
   }
   define('VERTEX_LOADED',true);
   return $vertex->template();
  }
}
}
