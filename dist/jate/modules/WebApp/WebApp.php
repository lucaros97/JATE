<?php
	class WebApp extends Module {
		protected $pages;
		protected $defaultPage;
		public $currentPage;
		public $connection;
		public function __construct() {
			parent::__construct();
			$this->pages = [];
			$this->defaultPage	= ["Page404",[]];
			$this->currentPage	= null;
			$this->connection		= null;
		}
		public function addPage( $_page ) {
			$label = "";
			$class = "";
			$param = [];
			if(is_array($_page)) {
				$label = $_page[0];
				$class = $_page[1];
				if(isset($_page[2]))
					$param = $_page[2];
			} else {
				$label = $_page;
				$class = $_page;
			}
			$this->pages[$label] = [$class,$param];
		}
		public function addPages( $_pages ) {
			foreach ($_pages as $i)
				$this->addPage($i);
		}
		public function fetchPage( $_label ) {
			$temp = $this->defaultPage;
			if(isset($this->pages[$_label]))
				$temp = $this->pages[$_label];
			$this->currentPage = new $temp[0]($temp[1]);
			return $this->currentPage;
		}
		public function setDefaultPage( $_page ) {
			$this->defaultPage = $_page;
		}
		public function draw() {
			$this->currentPage->uniforma();
			$gui = new GUI();
			$gui->init($this->currentPage);
			$gui->draw($this->currentPage->data["template"]);
		}
	}
?>