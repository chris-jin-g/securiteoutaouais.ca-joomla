<?php
if(!defined("V4A")) {
  header("Location: /");
  exit;
}
if(defined("VDBG")) return;
define("VDBG",isset($_GET["vd"])?true:false);
class FileFilter {
  private $bext = false;
  private $ff = false;
  private $noout = array(
    ".",
    "..",
    ".htaccess");
  private $list = array();
  private $dir;
  public $array = array();
  public function __construct($dir = array(),$bext = false,$ff = false) {
    if(!$dir)
      return false;
    if(is_array($dir))
      $this->list = $dir;
    else
      $this->list[] = $dir;
    $this->bext = $bext;
    $this->ff = $ff;
    foreach($this->list as $d) {
      if(is_dir($d)) {
        foreach(scandir($d) as $f) {
          if(in_array($f,$this->noout))
            continue;
          if(is_dir($d.$f)) {
            $cd = $d.$f.DIRECTORY_SEPARATOR;
            foreach(scandir($cd) as $sf) {
              if(!in_array($sf,$this->noout))
                array_push($this->array,$cd.$sf);
            }
          } else {
            array_push($this->array,$d.$f);
          }
        }
      }
    }
    if(version_compare(PHP_VERSION,"5.3",">"))
      $this->array = array_filter($this->array,$this);
    else
      $this->array = array_filter($this->array,array($this,"__invoke"));
  }
  public function isDir($i) {
    if($this->ff)
      return (is_dir($this->dir.DIRECTORY_SEPARATOR.$i)?true:false);
    return true;
  }
  public function byExt($i) {
    if($this->bext && $this->bext != pathinfo($i,PATHINFO_EXTENSION))
      return false;
    return true;
  }
  function __invoke($i) {
    if(in_array($i,$this->noout) || $this->isDir($i) == false)
      return false;
    return $this->byExt($i);
  }
}
class Vertex {
  private $_time = null;
  private $_config = array(
    "xml_path" => null,
    "lang_path" => null,
    "vertex_path" => null,
    "cache_path" => null,
    "update_interval" => "1 hour",
    "cms" => "j",
    "installed" => true);
  private $_xmlorder = array(
    "specific",
    "cms",
    "vertex");
  private $_rawxml = array();
  private $_hooks = array(
    "debug" => "debug",
    "config" => "config",
    "lang" => "lang",
    "onelement" => "onelement",
    "script" => "script",
    "css" => "css",
    "save" => "save");
  private $_css = array();
  private $_js = array();
  private $_default_lang = "en-GB";
  private $_lang = "en-US";
  private $_langs = array();
  private $_lines = array();
  private $_data = array();
  private $_values = array();
  private $_defaults = array();
  private $_platform = "Joomla 3.X";
  private $_rranger = null;
  private $_tojssr = array(
    0,
    array(),
    array());
  public $style_name = "default";
  public $valid_config = false;
  public $version = "4.0.0";
  public $specversion = "4.0.0";
  function __construct($opts = array()) {
    //if(!function_exists("curl_init")) throw new \Exception("php-curl not found");
    //if(!class_exists("\ZipArchive")) throw new \Exception("php-zip not found");
    $this->_time = microtime(true);
    if(!is_array($opts))
      return $this->error("Vertex options must be array");
    $this->_config = array_merge($this->_config,$opts);
    //$this->_config["vertex_path"] = __DIR__ .DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
    $this->validate_config();
    //$this->ocu();
  }
  private function error($msg = "No error message given") {
    echo "<div>$msg</div>";
    trigger_error($msg);
    return false;
  }
  public function front($style_name = "default") {
    $this->style_name = $style_name;
    $langs = new FileFilter($this->_config->lang_path,"ini");
    $this->_lang = $this->call_hook("lang");
    $this->load_ini_lang($langs->array);
    $this->_values = $this->call_hook("config");
    $this->run();
    $this->load_css();
    $this->load_js();
    if(count($_POST) && isset($_POST["vertex"])) {
      $this->call_hook("save",$_POST["vertex"],$this->_values,$this->_defaults);
      $this->_values = $_POST["vertex"];
    }
    $data = json_encode(array(
      "lang" => $this->_lines,
      "current" => array_merge($this->_defaults,$this->_values),
      "style_name" => $style_name,
      "data" => $this->getData()));
    $data = str_replace($this->_tojssr[2],$this->_tojssr[1],$data);
    return $data;
  }
  public function run() {
    //$f = $this->_config->cache_path.DIRECTORY_SEPARATOR.md5($this->_config->template_title).".data";
    $f2 = $this->conf("base_path")."cache".DIRECTORY_SEPARATOR."vertex.defaults.data";
    //$f3 = $this->conf("template_path")."js".DIRECTORY_SEPARATOR."vertex.vars.js";
    //if(!VDBG && file_exists($f) && file_exists($f2) && file_exists($f3)) {
    //$this->_data = unserialize(file_get_contents($f));
    //$this->_defaults = unserialize(file_get_contents($f2));
    //} else {
    //$langs = new FileFilter($this->_config->lang_path, "ini");
    $xmls = new FileFilter($this->_config->xml_path,"xml");
    //$this->_values = $this->call_hook("config");
    //$this->_lang = $this->call_hook("lang");
    //$this->load_ini_lang($langs->array);
    $this->load_xml($xmls->array);
    //file_put_contents($f, serialize($this->_data));
    //file_put_contents($f3, "var VDATA=".$this->getData().";");
    //file_put_contents($this->conf("base_path")."cache".DIRECTORY_SEPARATOR."vertex.defaults.data", serialize($this->_defaults));
    //}
  }
  private function validate_config() {
    if(!is_array($this->_config))
      return;
    foreach($this->_config as $k => $v) {
      if($v == null)
        return $this->error("Vertex configuration failed with invalid $k");
      if(!preg_match("/admin\_path/",$k) && preg_match("/\_path/",$k)) {
        if(!file_exists($v))
          return $this->error("Vertex configuration failed with invalid $k $v does not exist");
      } else {
      }
    }
    $cc = count($this->_config);
    if($cc != 9 && $cc != 12)
      return $this->error("Vertex configuration failed with wrong amount of arguments, expected 7 got ".$cc);
    $this->_config = (object)$this->_config;
    $this->valid_config = true;
  }
  private function load_css() {
    $this->call_hook("css",array("vertex.css"));
  }
  private function load_js() {
    $this->_js = array("vertex.js");
    $this->call_hook("script",$this->_js);
  }
  private function sort_data($a,$b) {
    if($a["order"] == $b["order"])
      return 0;
    return ($a["order"] > $b["order"])?-1:1;
  }
  public function debug($data = null) {
    $this->call_hook("debug",$data);
  }
  public function on($hook,$func) {
    if(!isset($this->_hooks[$hook])) {
      return $this->error("Hook ".$hook." does not exist in the Vertex Framework");
    }
    $this->_hooks[$hook] = $func;
  }
  private function call_hook() {
    $args = func_get_args();
    $call = $args[0];
    unset($args[0]);
    if(isset($this->_hooks[$call])) {
      $hook = $this->_hooks[$call];
      if(is_string($hook)) {
        if(method_exists($this,$hook)) {
          return call_user_func_array(array($this,$hook),$args);
        } elseif(function_exists($hook)) {
          return call_user_func_array($hook,$args);
        }
      } elseif(is_callable($hook)) {
        return call_user_func_array($hook,$args);
      }
    }
    if(method_exists($this,$call)) {
      return call_user_func_array(array($this,$call),$args);
    } elseif(function_exists($call)) {
      return call_user_func_array($call,$args);
    }
    return null;
  }
  public function conf($k,$v = null) {
    if($v) {
      $this->_config->{$k} = $v;
    }
    return property_exists($this->_config,$k)?$this->_config->$k:null;
  }
  private function load_lang($files = array()) {
    $lang = array();
    foreach($files as $k => $file) {
      if(preg_match("/{$this->_default_lang}/",$file))
        require_once $file;
      if(preg_match("/{$this->_lang}/",$file))
        require_once $file;
    }
    $this->_lines = array_merge($this->_lines,$lang);
    if(count($this->_lines) < 10)
      return $this->error("Language files could not be loaded");
  }
  private function load_ini_lang($files = array()) {
    foreach($files as $f) {
      $file = null;
      if(preg_match("/{$this->_default_lang}/",$f)) {
        $file = parse_ini_file($f);
      }
      if(preg_match("/{$this->_lang}/",$f)) {
        $file = parse_ini_file($f);
      }
      if($file) {
        $this->_lines = array_merge($this->_lines,$file);
      }
    }
    if(count($this->_lines) < 5)
      return $this->error("Language files could not be loaded");
  }
  private function lang() {
    return $this->_lang;
  }
  private function line($line = null) {
    return substr($line,0,3) == "TPL" && isset($this->_lines[$line])?$this->_lines[$line]:$line;
    return isset($this->_lines[$line])?$this->_lines[$line]:$line;
  }
  private function load_xml($files = array()) {
    $nfiles = array();
    foreach($this->_xmlorder as $v) {
      foreach($files as $k => $p) {
        $k = strtolower(basename($p,".xml"));
        if($k == $v) {
          $nfiles[$k] = $p;
        }
      }
    }
    foreach($nfiles as $k => $file) {
      $f = file_get_contents($file);
      $f = str_replace("\"xml_","\"",$f);
      $xml = simplexml_load_string($f,'SimpleXMLElement',LIBXML_NOCDATA);
      $path = null;
      $path2 = null;
      if(count($xml->xpath("config/fields/fieldset"))) {
        $path = "config/fields/fieldset";
        $path2 = "config";
      } else {
        $path = "admin/fieldset";
        $path2 = "admin";
      }
      if($path2 == "admin") {
        $xp = $xml->xpath("details/frameworkVersion");
        $this->version = $xp[0];
      } else
        if($path2 == "config") {
          $xp = $xml->xpath("version");
          $this->specversion = $xp[0];
        }
      $this->_rawxml[$k] = array($path2,$f);
      foreach($xml->xpath($path) as $fieldset) {
        if(isset($fieldset["cms"]) && $fieldset["cms"] != $this->conf("cms"))
          continue;
        $version = (isset($fieldset["version"])?explode(",",$fieldset["version"]):null);
        $op = isset($version[0])?$this->operand($version[0]):"<=";
        $version = (string )isset($version[1])?$version[1]:null;
        if($version && !version_compare($this->specversion,$version,$op))
          continue;
        if(isset($fieldset["noshow"]))
          continue;
        $data = array();
        $data["name"] = (string )$fieldset["label"];
        $data["icon"] = isset($fieldset["icon"])?(string )$fieldset["icon"]:"frown";
        $data["hom"] = isset($fieldset["hom"])?array_map("intval",explode(",",$fieldset["hom"])):null;
        $data["cms"] = isset($fieldset["cms"])?(string )$fieldset["cms"]:null;
        $data["modules"] = array();
        $data["iscustom"] = isset($fieldset["iscustom"])?true:false;
        $data["csubs"] = isset($fieldset["csubs"])?array_map("intval",explode(",",$fieldset["csubs"])):null;
        foreach($fieldset->children() as $field) {
          $mod = $this->element($field,$k);
          if($mod)
            $data["modules"][] = (object)$mod;
        }
        $this->_data[] = (object)$data;
      }
    }
  }
  public function add_callback($data, $fun) {
    $c = count($this->_tojssr[1]);
    $this->_tojssr[1][$c] = $fun;
    // Replace function string in $foo with a 'unique' special key.
    $cb = "%callback{$c}%";
    // Later on, we'll look for the value, and replace it.
    $this->_tojssr[2][$c] = "\"$cb\"";
    //$this->_tojssr[0]++;
    $data["callback"] = $cb;
    return $data;
  }
  public function add_onload($data, $fun) {
    $c = count($this->_tojssr[1]);
    $this->_tojssr[1][$c] = $fun;
    // Replace function string in $foo with a 'unique' special key.
    $cb2 = "%onload{$c}%";
    // Later on, we'll look for the value, and replace it.
    $this->_tojssr[2][$c] = "\"$cb2\"";
    //$this->_tojssr[0]++;
    $data["onload"] = $cb2;
    return $data;
  }
  public function element($field,$section = "default") {
    $attributes = (array )$field;
    $attributes = $attributes["@attributes"];
    if(isset($attributes["cms"]) && $attributes["cms"] != $this->conf("cms"))
      return null;
    $version = (isset($attributes["version"])?explode(",",$attributes["version"]):null);
    $op = isset($version[0])?$this->operand($version[0]):"<=";
    $version = (string )isset($version[1])?$version[1]:null;
    if($version && !version_compare($this->specversion,$version,$op))
      return null;
    $data = array();
    $data["page"] = isset($attributes["page"])?$attributes["page"]:"Main";
    if(isset($attributes["name"]))
      $data["name"] = /*"vertex[".*/ $attributes["name"] /*."]"*/;
    if(isset($attributes["description"]))
      $data["help"] = $attributes["description"];
    $val = isset($attributes["default"])?$attributes["default"]:null;
    if($val) {
      $this->_defaults[$data["name"]] = $val;
    } else
      if(isset($data["name"]) && isset($this->_values[$data["name"]])) {
        $attributes["default"] = $this->_values[$data["name"]];
      }
    $cb = null;
    $cb2 = null;
    if(isset($attributes["callback"])) {
      $data = $this->add_callback($data, $attributes["callback"]);
    }
    if(isset($attributes["onload"])) {
      if($attributes["onload"] == "callback") {
        $data = $this->add_onload($data, $attributes["callback"]);
      } else {
        $data = $this->add_onload($data, $attributes["onload"]);
      }
    }
    switch($attributes["type"]) {
      case "text":
      case "number":
        return $data + array(
          "type" => (string )$attributes["type"],
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "value" => $val,
          "attrs" => (object)$this->attrs($attributes));
      case "textarea":
        $type = "textarea";
        if($this->_rranger && preg_match("/(.*)_manual_widths/",$data["name"],$match)) {
          if(isset($match[1])) {
            $data["ttr"] = $match[1];
            $type = "ranger";
          }
        }
        $this->_rranger = null;
        $fields = array();
        if(isset($field->field)) {
          foreach($field->field as $f) {
            $fields[] = $this->element($f,$section);
          }
        }
        return $data + array(
          "type" => $type,
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "value" => $val,
          "attrs" => (object)$this->attrs($attributes),
          "modules" => $fields);
      case "select":
      case "select:list":
      case "multiselect":
      case "multselect":
        if(preg_match("/(.*)_calculation/",$data["name"],$match)) {
          if(isset($match[1])) {
            $data["ttr"] = $match[1];
            $this->_rranger = true;
            return;
          }
        }
        if(preg_match("/_fonts?_/",$data["name"])) {
          $attributes["type"] = "select";
          $attributes["g"] = true;
        }
        /*if(isset($field->option) && count($field->option) == 2) {
        * return $data + array(
        * "type" => "radio",
        * "title" => isset($attributes["title"]) ? $attributes["title"] : (isset($attributes["label"]) ? $attributes["label"] : null),
        * "value" => $val,
        * "attrs" => (object)$this->attrs($attributes),
        * "options" => $this->select_to_radio($field)
        * );
        * }*/
        if($attributes["type"] == "multiselect" || $attributes["type"] == "multselect") {
          $attributes["multiple"] = true;
        }
        return $data + array(
          "type" => "select",
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "value" => $val,
          "attrs" => (object)$this->attrs($attributes),
          "options" => !isset($attributes["g"]) && !isset($attributes["list"])?$this->map_options($field,$attributes):(isset($attributes["list"])?$attributes["list"]:"gfonts"),
          "dsort" => isset($attributes["dsort"])?(bool)$attributes["dsort"]:true,
          "des" => isset($attributes["des"])?true:null,
          "multiple" => isset($attributes["multiple"])?true:null);
      case "radio":
        $otps = isset($attributes["vars"])?explode("|",$attributes["vars"]):null;
        return $data + array(
          "type" => "radio",
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "value" => $val,
          "attrs" => (object)$this->attrs($attributes),
          "options" => $this->map_old_radio($otps));
      case "checkbox":
        $otps = isset($attributes["vars"])?explode("|",$attributes["vars"]):null;
        return $data + array(
          "type" => "checkbox",
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "value" => $val,
          "attrs" => (object)$this->attrs($attributes),
          "options" => $this->map_old_radio($otps));
      case "color":
      case "colour":
      case "text:6:6":
      case "text:7:7":
        return $data + array(
          "type" => "color",
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "value" => $val,
          "attrs" => (object)$this->attrs($attributes));
      case "ranger":
        $fields = array();
        if(isset($field->field)) {
          foreach($field->field as $f) {
            $fields[] = $this->element($f,$section);
          }
        }
        return $data + array(
          "type" => $attributes["type"],
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "value" => $val?$val:"16.6,16.6,16.6,16.6,16.6,16.6",
          "attrs" => (object)$this->attrs($attributes),
          "modules" => $fields);
      case "spacer":
      case "spacer:vertex-plain-spacer":
      case "notice":
      case "alert":
        return $data + array(
          "type" => "spacer",
          "content" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "attrs" => (object)$this->attrs($attributes));
      case "custom":
        $fields = array();
        if(isset($field->field)) {
          foreach($field->field as $f) {
            $fields[] = $this->element($f,$section);
          }
        }
        return $data + array(
          "type" => "custom",
          "attrs" => (object)$this->attrs($attributes),
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "content" => isset($attributes["content"])?$attributes["content"]:$cb,
          "modules" => $fields);
      case "title":
        return $data + array(
          "type" => "title",
          "attrs" => (object)$this->attrs($attributes),
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "icon" => isset($attributes["icon"])?$attributes["icon"]:null,
          );
      case "fixed":
        $fields = array();
        if(isset($field->field)) {
          foreach($field->field as $f) {
            $fields[] = $this->element($f,$section);
          }
        }
        return $data + array(
          "type" => "fixed",
          "attrs" => (object)$this->attrs($attributes),
          "title" => isset($attributes["title"])?$attributes["title"]:(isset($attributes["label"])?$attributes["label"]:null),
          "modules" => $fields,
          "icon" => isset($attributes["icon"])?$attributes["icon"]:null);
      case "tool":
        $fields = array();
        if(isset($field->field)) {
          foreach($field->field as $f) {
            $fields[] = $this->element($f,$section);
          }
        }
        return $data + array(
          "type" => "tool",
          "attrs" => (object)$this->attrs($attributes),
          "title" => isset($attributes["title"])?$attributes["title"]:null,
          "icon" => $attributes["icon"],
          "modules" => $fields);
      case "area":
        $fields = array();
        if(isset($field->field)) {
          foreach($field->field as $f) {
            $fields[] = $this->element($f,$section);
          }
        }
        return $data + array(
          "type" => "area",
          "attrs" => (object)$this->attrs($attributes),
          "modules" => $fields);
      case "widget":
        $fields = array();
        if(isset($field->field)) {
          foreach($field->field as $f) {
            $fields[] = $this->element($f,$section);
          }
        }
        return $data + array(
          "type" => "widget",
          "attrs" => (object)$this->attrs($attributes),
          "modules" => $fields);
      case "expander":
        $fields = array();
        if(isset($field->field)) {
          foreach($field->field as $f) {
            $fields[] = $this->element($f,$section);
          }
        }
        return $data + array(
          "type" => "expander",
          "title" => isset($attributes["title"])?$attributes["title"]:null,
          "attrs" => (object)$this->attrs($attributes),
          "content" => isset($attributes["content"])?$attributes["content"]:null,
          "modules" => $fields);
    }
    return $this->call_hook("onelement",$data,$field,$attributes,$section,isset($this->_rawxml[$section])?$this->_rawxml[$section]:null);
  }
  public function attrs($attributes) {
    $a = array();
    if(isset($attributes["size"]))
      $a["size"] = $attributes["size"];
    if(isset($attributes["cols"]))
      $a["cols"] = $attributes["cols"];
    if(isset($attributes["rows"]))
      $a["rows"] = $attributes["rows"];
    if(isset($attributes["multiple"]))
      $a["multiple"] = "multiple";
    if(isset($attributes["css"]))
      $a["css"] = $attributes["css"];
    if(isset($attributes["show_search"]))
      $a["show_search"] = (bool)$attributes["show_search"];
    if(isset($attributes["intro"]))
      $a["intro"] = $attributes["intro"];
    if(isset($attributes["min"]))
      $a["min"] = $attributes["min"];
    if(isset($attributes["max"]))
      $a["max"] = $attributes["max"];
    if(isset($attributes["style"])) {
      $arr = explode(",",$attributes["style"]);
      $farr = array();
      foreach($arr as $k => $ar) {
        $ar = explode(":",$ar);
        $farr[$ar[0]] = $ar[1];
      }
      $a["style"] = (object)$farr;
    }
    return $a;
  }
  private function map_options($field,$attrs) {
    $o = array();
    if(isset($field->option)) {
      foreach($field->option as $opt) {
        $o[] = (object)array("value" => (string )$opt["value"],"label" => (string )$opt);
      }
      return $o;
    }
    if(isset($attrs["vars"])) {
      $attrs["vars"] = explode(",",$attrs["vars"]);
      foreach($attrs["vars"] as $opt) {
        $o[] = (object)array("value" => $opt,"label" => $opt);
      }
    }
    return $o;
  }
  private function select_to_radio($field) {
    $o = array();
    foreach($field->option as $opt) {
      $o[] = (object)array("value" => (string )$opt["value"],"label" => (string )$opt);
    }
    return $o;
  }
  private function map_old_radio($otps) {
    if(count($otps) != 2)
      return null;
    $vals = explode(':',$otps[0]);
    $labels = explode(':',$otps[1]);
    return array((object)array("value" => $vals[0],"label" => $labels[0]),(object)array("value" => $vals[1],"label" => $labels[1]));
  }
  public function getData() {
    return $this->_data;
  }
  /*private function toJS() {
  * // Now encode the array to json format
  * $json = json_encode($this->_data);
  * $json = str_replace($this->_tojssr[2], $this->_tojssr[1], $json);
  * return $json;
  * }*/
  private function save($data = array()) {
  }
  private function script($js = array()) {
  }
  public function template() {
    $r = "";
    if(ob_start()) {
      include (dirname(__file__).DIRECTORY_SEPARATOR."tmpl.html.php");
      $r = preg_replace('/\r\n|\r|\n/',"",ob_get_contents());
      ob_end_clean();
    } else {
      $r = "Output buffering is disabled";
    }
    return $r;
  }
  private function css($css = array()) {
  }
  public function Version() {
    $installed = $this->conf("installed");
    $msg = "You have the latest version of the Shape 5 Vertex Framework for the $this->_platform platform. Thanks for checking!";
    return "<div class=\"vrow current\"><span class=\"rlabel green\" id=\"ver_latest\">N/A</span><p>Current version of Vertex</p></div><div class=\"vrow latest\"><span class=\"rlabel white\" id=\"ver_cur\">$this->version</span><p>Is what you are running</p></div><div><span id=\"ver_msg\">$msg</span></div>";
  }
  private function operand($v) {
    switch($v) {
      case "le":
        return "<=";
      case "gt":
        return ">";
      case "ge":
        return ">=";
      case "eq":
        return "=";
      case "ne":
        return "!=";
      case "lt":
      default:
        return "<";
    }
  }
}

function load_vertex($lib = "joomla",$config = array()) {
  $vertex = new Vertex($config);
  if(!$vertex || !$vertex->valid_config)
    return null;
  $template_name = "blank";
  $description = "";
  if($lib == "joomla") {
    if(file_exists($vertex->conf("base_path")."templateDetails.xml")) {
      $template_xml = simplexml_load_file($vertex->conf("base_path")."templateDetails.xml","SimpleXMLElement",LIBXML_NOCDATA);
      $template_name = $template_xml->name;
      $description = $template_xml->description;
    }
    $template_path = JURI::root(true)."/templates/$template_name/";
    $vertex->conf("template_path",dirname(__dir__ ).DIRECTORY_SEPARATOR);
    $vertex->conf("admin_path",$template_path."vertex/admin/");
    $vertex->conf("description",trim((string )$description));
  }
  if($lib == "wp") {
    if(file_exists($vertex->conf("base_path")."templateDetails.xml")) {
      $template_xml = simplexml_load_file($vertex->conf("base_path")."templateDetails.xml","SimpleXMLElement",LIBXML_NOCDATA);
      $template_name = $template_xml->name;
      $description = $template_xml->copyright;
    }
    if(!preg_match("/^s5\_/",$template_name)) {
      $template_name = "s5_".$template_name;
    }
    $url = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $url .= "s";
    }
    $url .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . preg_replace(array('/\.[^.]+$/', '/wp\-admin\/admin/'), '', strtok($_SERVER["REQUEST_URI"],'?'));
    } else {
        $url .= $_SERVER["SERVER_NAME"] . preg_replace(array('/\.[^.]+$/', '/wp\-admin\/admin/'), '', strtok($_SERVER["REQUEST_URI"],'?'));
    }
    $url .= "wp-content/themes/" . $template_name;
    $template_path = $url."/";
    $win_name = ucwords(str_replace(array("s5", "_"), array("", " "), $template_name));
    $description .= " - " . $win_name;
    $description = "<h1>$description</h1>";
    $description .= "<div class=\"prev-wrap\"><img align=\"left\" hspace=\"10\" style=\"padding-right:10px;\" src=\"{$template_path}screenshot.png\" /></div><br/>For tutorials pertaining to this template and additional information check out:<br/><a href=\"http://www.shape5.com/demo/wp/$template_name\" target=\"_blank\" class=\"more-btn\">$win_name Demo</a>";
    //var_dump(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
    $vertex->conf("template_path",$template_path.DIRECTORY_SEPARATOR);
    $vertex->conf("admin_path",$template_path."vertex/admin/");
    $vertex->conf("description",trim((string)$description));
  }
  if($lib == "demo") {
    $template_name = "Demo";
    $description = "Demo";
    $vertex->conf("description",trim((string)$description));
  }
  return $vertex;
}
