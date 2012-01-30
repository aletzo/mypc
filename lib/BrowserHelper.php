<?php
class BrowserHelper {
	
	private static $_instance = null;
	
    private $_browser = array(
		'browser'  => 'unknown',
		'version'  => 'unknown',
		'platform' => 'unknown',
		'agent'    => 'unknown'
	);
    
	private $_knownBrowsers = array(
		'chrome',
		'gecko',
		'firefox',
		'konqueror',
		'msie',
		'netscape',
		'opera',
		'safari',
		'webkit'
	);
    
	private $_knownPlatforms = array(
		'linux' => 'linux',
		'mac'   => 'macintosh|mac os x',
		'win'   => 'windows|win32'
	);
	
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
	public function __call($method, $arguments = array())
    {
        $method = strtolower($method);

        if ('get' == substr($method, 0, 3)) {
            $value = substr($method, 3, strlen($method));
            $method = 'get';
        } elseif ('isnot' == substr($method, 0, 5)) {
            $value = substr($method, 5, strlen($method));
            $method = 'isnot';
        } elseif ('is' == substr($method, 0, 2)) {
            $value = substr($method, 2, strlen($method));
            $method = 'is';
        }

		switch ($method) {
			case 'get':
		        if (isset($value)) {
		        	$this->_detect();
		        	if ('browser' == $value) {
		        		return $this->_browser;
		        	} elseif (isset($this->_browser[$value])) {
		        		return $this->_browser[$value];
		        	}
		        }
				break;
			case 'is':
		        if (isset($value)) {
		        	$this->_detect();

		        	if (in_array($value, $this->_knownBrowsers) && !isset($arguments[0])) {
						return $value == $this->_browser['browser'];
		        	}
		        	if (array_key_exists($value, $this->_knownPlatforms) && !isset($arguments[0])) {
						return $value == $this->_browser['platform'];
		        	}
					if (isset($this->_browser[$value])) {
                        $arg = substr($arguments[0], 1);
						switch (substr($arguments[0], 0, 1)) {
							case '>':
								return (int) $arg < (int) substr($this->_browser[$value], 0, 1);
								break;
							case '<':
								return (int) $arg > (int) substr($this->_browser[$value], 0, 1);
								break;
							default:
								return $arg == $this->_browser[$value];
								break;
						}
					} else {
						return false;
					}
		        }
				break;
			case 'isnot':
		        if (isset($value)) {
		        	$this->_detect();
		        	if (in_array($value, $this->_knownBrowsers) && !isset($arguments[0])) {
						return $value != $this->_browser['browser'];
		        	}
		        	if (array_key_exists($value, $this->_knownPlatforms) && !isset($arguments[0])) {
						return $value != $this->_browser['platform'];
		        	}
					if (isset($this->_browser[$value])) {
						switch (substr($arguments[0], 0, 1)) {
							case '>':
								return (int) strtolower($arguments[0]) > (int) substr($this->_browser[$value], 0, 1);
								break;
							case '<':
								return (int) strtolower($arguments[0]) < (int) substr($this->_browser[$value], 0, 1);
								break;
							default:
								return strtolower($arguments[0]) != $this->_browser[$value];
								break;
						}
					} else {
						return false;
					}
		        }
				break;
			default:
				break;
		}

		return false;
    }
	
	private function _detect()
	{
		$this->_browser['agent'] = strtolower($_SERVER['HTTP_USER_AGENT']);
		
		foreach ($this->_knownBrowsers as $value) {
			if (preg_match("#($value)[/ ]?([0-9.]*)#", $this->_browser['agent'], $match)) {
                $this->_browser['browser'] = $match[1];
                $this->_browser['version'] = $match[2];
            }
		}

		foreach ($this->_knownPlatforms as $key => $value) {
			if (preg_match("/$value/", $this->_browser['agent'])) {
	            $this->_browser['platform'] = $key;
			}
		}
				
		$this->_browser[$this->_browser['browser']] = $this->_browser['version'];
	}
}
