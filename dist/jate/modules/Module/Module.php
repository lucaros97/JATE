<?php
  jRequire("../Query/Query.php");
  jRequire("../File/File.php");
  class Module {
    use Query, File;
    public $name;
    public $modules;
    public function __construct() {
      $this->name    = get_class($this);
      $this->modules = [];
    }
    public function addModules( $_modules ) {
      if(!is_array($_modules))
        throw new InvalidArgumentException("Parameter must be an array.");
      foreach ($_modules as $value)
        $this->addModule($value);
    }
    public function addModule( $_module ) {
      if(!is_object($_module))
        throw new InvalidArgumentException("Parameter must be a object.");
      if(! is_subclass_of ($_module, "Module"))
        throw new InvalidArgumentException("Parameter must be a object inherited from Module object.");
      $this->modules[$_module->name] = $_module;
    }
  }
?>
