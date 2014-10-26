<?php
/**
 * The control class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

/**
 * The base class of control.
 *
 * @package framework
 */
class control
{
    /**
     * The global $app object.
     * 
     * @var object
     * @access protected
     */
    protected $app;

    /**
     * The global $config object.
     * 
     * @var object
     * @access protected
     */
    protected $config;

    /**
     * The global $lang object.
     * 
     * @var object
     * @access protected
     */
    protected $lang;

    /**
     * The global $dbh object, the database connection handler.
     * 
     * @var object
     * @access protected
     */
    protected $dbh;

    /**
     * The $dao object, used to access or update database.
     * 
     * @var object
     * @access protected
     */
    public $dao;

    /**
     * The $post object, used to access the $_POST var.
     * 
     * @var ojbect
     * @access public
     */
    public $post;

    /**
     * The $get object, used to access the $_GET var.
     * 
     * @var ojbect
     * @access public
     */
    public $get;

    /**
     * The $session object, used to access the $_SESSION var.
     * 
     * @var ojbect
     * @access public
     */
    public $session;

    /**
     * The $server object, used to access the $_SERVER var.
     * 
     * @var ojbect
     * @access public
     */
    public $server;

    /**
     * The $cookie object, used to access the $_COOKIE var.
     * 
     * @var ojbect
     * @access public
     */
    public $cookie;

    /**
     * The $global object, used to access the $_GLOBAL var.
     * 
     * @var ojbect
     * @access public
     */
    public $global;

    /**
     * The name of current module.
     * 
     * @var string
     * @access protected
     */
    protected $moduleName;

    /**
     * The vars assigned to the view page.
     * 
     * @var object
     * @access public
     */
    public $view; 

    /**
     * The type of the view, such html, json.
     * 
     * @var string
     * @access private
     */
    private $viewType;

    /**
     * The content to display.
     * 
     * @var string
     * @access private
     */
    private $output;

    /**
     * The construct function.
     *
     * 1. global the global vars, refer them by the class member such as $this->app.
     * 2. set the pathes of current module, and load it's mode class.
     * 3. auto assign the $lang and $config to the view.
     * 
     * @access public
     * @return void
     */
    public function __construct($moduleName = '', $methodName = '')
    {
        /* Global the globals, and refer them to the class member. */
        global $app, $config, $lang, $dbh, $common;
        $this->app        = $app;
        $this->config     = $config;
        $this->lang       = $lang;
        $this->dbh        = $dbh;
        $this->viewType   = $this->app->getViewType();

        $this->setModuleName($moduleName);
        $this->setMethodName($methodName);
        $this->setTplRoot();

        /* Load the model file auto. */
        $this->loadModel();

        /* Assign them to the view. */
        $this->view          = new stdclass();
        $this->view->app     = $app;
        $this->view->lang    = $lang;
        $this->view->config  = $config;
        $this->view->common  = $common;
        $this->view->session = $app->session;
        if(RUN_MODE == 'front') $this->view->layouts = $this->loadModel('block')->getPageBlocks($this->moduleName, $this->methodName);

        $this->setSuperVars();
    }

    //-------------------- Model related methods --------------------//

    /* Set the module name. 
     * 
     * @param   string  $moduleName     The module name, if empty, get it from $app.
     * @access  private
     * @return  void
     */
    private function setModuleName($moduleName = '')
    {
        $this->moduleName = $moduleName ? strtolower($moduleName) : $this->app->getModuleName();
    }

    /* Set the method name. 
     * 
     * @param   string  $methodName    The method name, if empty, get it from $app.
     * @access  private
     * @return  void
     */
    private function setMethodName($methodName = '')
    {
        $this->methodName = $methodName ? strtolower($methodName) : $this->app->getMethodName();
    }

    /**
     * Set TPL_ROOT used in template files.
     * 
     * @access public
     * @return void
     */
    public function setTplRoot()
    {
        if(!defined('TPL_ROOT')) define('TPL_ROOT', $this->app->getTplRoot() . $this->config->template->name . DS . 'view' . DS);
    }

    /**
     * Load the model file of one module.
     * 
     * @param   string      $methodName    The method name, if empty, use current module's name.
     * @access  public
     * @return  object|bool If no model file, return false. Else return the model object.
     */
    public function loadModel($moduleName = '')
    {
        if(empty($moduleName)) $moduleName = $this->moduleName;
        $modelFile = helper::setModelFile($moduleName);

        /* If no model file, try load config. */
        if(!is_file($modelFile)  or !helper::import($modelFile)) 
        {
            $this->app->loadConfig($moduleName, false);
            $this->app->loadLang($moduleName);
            $this->dao = new dao();
            return false;
        }

        $modelClass = class_exists('ext' . $moduleName. 'model') ? 'ext' . $moduleName . 'model' : $moduleName . 'model';
        if(!class_exists($modelClass)) $this->app->triggerError(" The model $modelClass not found", __FILE__, __LINE__, $exit = true);

        $this->$moduleName = new $modelClass();
        $this->dao = $this->$moduleName->dao;
        return $this->$moduleName;
    }

    /**
     * Set the super vars.
     * 
     * @access protected
     * @return void
     */
    protected function setSuperVars()
    {
        $this->post    = $this->app->post;
        $this->get     = $this->app->get;
        $this->server  = $this->app->server;
        $this->session = $this->app->session;
        $this->cookie  = $this->app->cookie;
        $this->global  = $this->app->global;
    }

    //-------------------- View related methods --------------------//
   
    /**
     * Set the view file, thus can use fetch other module's page.
     * 
     * @param  string   $moduleName    module name
     * @param  string   $methodName    method name
     * @access private
     * @return string  the view file
     */
    public function setViewFile($moduleName, $methodName)
    {
        $moduleName = strtolower(trim($moduleName));
        $methodName = strtolower(trim($methodName));

        $modulePath = $this->app->getModulePath($moduleName);
        $viewExtPath = $this->app->getModuleExtPath($moduleName, 'view');

        if((RUN_MODE != 'front') or (strpos($modulePath, 'module' . DS . 'ext') !== false))
        {
            /* If not in front mode or is ext module, view file is in modeule path. */
            $mainViewFile = $modulePath . 'view' . DS . $methodName . '.' . $this->viewType . '.php';
        }
        else
        {
            /* If in front mode, view file is in www/template path. */
            $mainViewFile = TPL_ROOT . $moduleName . DS . "{$methodName}.{$this->viewType}.php";
        }

        /* Extension view file. */
        $commonExtViewFile = $viewExtPath['common'] . $methodName . ".{$this->viewType}.php";
        $siteExtViewFile   = $viewExtPath['site'] . $methodName . ".{$this->viewType}.php";
        $viewFile = file_exists($commonExtViewFile) ? $commonExtViewFile : $mainViewFile;
        $viewFile = file_exists($siteExtViewFile) ? $siteExtViewFile : $viewFile;
        if(!is_file($viewFile)) $this->app->triggerError("the view file $viewFile not found", __FILE__, __LINE__, $exit = true);

        /* Extension hook file. */
        $commonExtHookFiles = glob($viewExtPath['common'] . $methodName . "*.{$this->viewType}.hook.php");
        $siteExtHookFiles   = glob($viewExtPath['site'] . $methodName . "*.{$this->viewType}.hook.php");
        $extHookFiles       = array_merge((array) $commonExtHookFiles, (array) $siteExtHookFiles);
        if(!empty($extHookFiles)) return array('viewFile' => $viewFile, 'hookFiles' => $extHookFiles);

        return $viewFile;
    }

    /**
     * Get the extension file of an view.
     * 
     * @param  string $viewFile 
     * @access public
     * @return string|bool  If extension view file exists, return the path. Else return fasle.
     */
    public function getExtViewFile($viewFile)
    {
        $extPath     = dirname(realpath($viewFile)) . "/ext/_{$this->config->site->code}/";
        $extViewFile = $extPath . basename($viewFile);

        if(file_exists($extViewFile))
        {
            helper::cd($extPath);
            return $extViewFile;
        }

        $extPath = RUN_MODE == 'front' ? dirname(realpath($viewFile)) . '/ext/' : dirname(dirname(realpath($viewFile))) . '/ext/view/';
        $extViewFile = $extPath . basename($viewFile);

        if(file_exists($extViewFile))
        {
            helper::cd($extPath);
            return $extViewFile;
        }

        return false;
    }

    /**
     * Get css code for a method. 
     * 
     * @param  string    $moduleName 
     * @param  string    $methodName 
     * @access private
     * @return string
     */
    private function getCSS($moduleName, $methodName)
    {
        $moduleName = strtolower(trim($moduleName));
        $methodName = strtolower(trim($methodName));

        $modulePath = $this->app->getModulePath($moduleName);

        $cssExtPath = $this->app->getModuleExtPath($moduleName, 'css') ;

        $css = '';
        if((RUN_MODE != 'front') or (strpos($modulePath, 'module' . DS . 'ext') !== false))
        {
            $mainCssFile   = $modulePath . 'css' . DS . 'common.css';
            $methodCssFile = $modulePath . 'css' . DS . $methodName . '.css';

            if(file_exists($mainCssFile))   $css .= file_get_contents($mainCssFile);
            if(file_exists($methodCssFile)) $css .= file_get_contents($methodCssFile);
        }
        else
        {
            $defaultMainCssFile   = TPL_ROOT . $moduleName . DS . 'css' . DS . "common.css";
            $defaultMethodCssFile = TPL_ROOT . $moduleName . DS . 'css' . DS . "{$methodName}.css";
            $themeMainCssFile     = TPL_ROOT . $moduleName . DS . 'css' . DS . "common.{$this->config->site->theme}.css";
            $themeMethodCssFile   = TPL_ROOT . $moduleName . DS . 'css' . DS . "{$methodName}.{$this->config->site->theme}.css";

            if(file_exists($defaultMainCssFile))   $css .= file_get_contents($defaultMainCssFile);
            if(file_exists($defaultMethodCssFile)) $css .= file_get_contents($defaultMethodCssFile);
            if(file_exists($themeMainCssFile))     $css .= file_get_contents($themeMainCssFile);
            if(file_exists($themeMethodCssFile))   $css .= file_get_contents($themeMethodCssFile);
        }

        $commonExtCssFiles = glob($cssExtPath['common'] . $methodName . DS . '*.css');
        foreach($commonExtCssFiles as $cssFile) $css .= file_get_contents($cssFile);

        $methodExtCssFiles = glob($cssExtPath['site'] . $methodName . DS . '*.css');
        foreach($methodExtCssFiles as $cssFile) $css .= file_get_contents($cssFile);

        return $css;
    }

    /**
     * Get js code for a method. 
     * 
     * @param  string    $moduleName 
     * @param  string    $methodName 
     * @access private
     * @return string
     */
    private function getJS($moduleName, $methodName)
    {
        $moduleName = strtolower(trim($moduleName));
        $methodName = strtolower(trim($methodName));
        
        $modulePath = $this->app->getModulePath($moduleName);
        $jsExtPath  = $this->app->getModuleExtPath($moduleName, 'js');

        $js = '';
        if((RUN_MODE !== 'front') or (strpos($modulePath, 'module' . DS . 'ext') !== false))
        {
            $mainJsFile   = $modulePath . 'js' . DS . 'common.js';
            $methodJsFile = $modulePath . 'js' . DS . $methodName . '.js';

            if(file_exists($mainJsFile))   $js .= file_get_contents($mainJsFile);
            if(file_exists($methodJsFile)) $js .= file_get_contents($methodJsFile);
        }
        else
        {
            $defaultMainJsFile   = TPL_ROOT . $moduleName . DS . 'js' . DS . "common.js";
            $defaultMethodJsFile = TPL_ROOT . $moduleName . DS . 'js' . DS . "{$methodName}.js";
            $themeMainJsFile     = TPL_ROOT . $moduleName . DS . 'js' . DS . "common.{$this->config->site->theme}.js";
            $themeMethodJsFile   = TPL_ROOT . $moduleName . DS . 'js' . DS . "{$methodName}.{$this->config->site->theme}.js";

            if(file_exists($defaultMainJsFile))   $js .= file_get_contents($defaultMainJsFile);
            if(file_exists($defaultMethodJsFile)) $js .= file_get_contents($defaultMethodJsFile);
            if(file_exists($themeMainJsFile))     $js .= file_get_contents($themeMainJsFile);
            if(file_exists($themeMethodJsFile))   $js .= file_get_contents($themeMethodJsFile);
        }

        $commonExtJsFiles = glob($jsExtPath['common'] . $methodName . DS . '*.js');
        foreach($commonExtJsFiles as $jsFile) $js .= file_get_contents($jsFile);

        $methodExtJsFiles = glob($jsExtPath['site'] . $methodName . DS  . '*.js');
        foreach($methodExtJsFiles as $jsFile) $js .= file_get_contents($jsFile);

        return $js;
    }

    /**
     * Assign one var to the view vars.
     * 
     * @param   string  $name       the name.
     * @param   mixed   $value      the value.
     * @access  public
     * @return  void
     */
    public function assign($name, $value)
    {
        $this->view->$name = $value;
    }

    /**
     * Clear the output.
     * 
     * @access public
     * @return void
     */
    public function clear()
    {
        $this->output = '';
    }

    /**
     * Parse view file. 
     *
     * @param  string $moduleName    module name, if empty, use current module.
     * @param  string $methodName    method name, if empty, use current method.
     * @access public
     * @return string the parsed result.
     */
    public function parse($moduleName = '', $methodName = '')
    {
        if(empty($moduleName)) $moduleName = $this->moduleName;
        if(empty($methodName)) $methodName = $this->methodName;

        /* If the parser is default or run mode is admin, install, upgrade, call default parser.  */
        if(RUN_MODE != 'front' or $this->config->template->parser == 'default')
        {
            $this->parseDefault($moduleName, $methodName);
            return $this->output;
        }

        /* Call the extened parser. */
        $parserClassName = $this->config->template->parser . 'Parser';
        $parserClassFile = 'parser.' . $this->config->template->parser . '.class.php';
        $parserClassFile = dirname(__FILE__) . DS . $parserClassFile;
        if(!is_file($parserClassFile)) $this->app->triggerError(" The parser file  $parserClassFile not found", __FILE__, __LINE__, $exit = true);

        helper::import($parserClassFile);
        if(!class_exists($parserClassName)) $this->app->triggerError(" Can not find class : $parserClassName not found in $parserClassFile <br/>", __FILE__, __LINE__, $exit = true);

        $parser = new $parserClassName($this);
        return $parser->parse($moduleName, $methodName);
    }

    /**
     * Parse json format.
     *
     * @param string $moduleName    module name
     * @param string $methodName    method name
     * @access private
     * @return void
     */
    private function parseJSON($moduleName, $methodName)
    {
        return false;
        unset($this->view->app);
        unset($this->view->config);
        unset($this->view->lang);
        unset($this->view->pager);
        unset($this->view->header);
        unset($this->view->position);
        unset($this->view->moduleTree);
        unset($this->view->common);

        $output['status'] = is_object($this->view) ? 'success' : 'fail';
        $output['data']   = json_encode($this->view);
        $output['md5']    = md5(json_encode($this->view));
        $this->output     = json_encode($output);
    }

    /**
     * Parse default html format.
     *
     * @param string $moduleName    module name
     * @param string $methodName    method name
     * @access private
     * @return void
     */
    private function parseDefault($moduleName, $methodName)
    {
        /* Set the view file. */
        $viewFile = $this->setViewFile($moduleName, $methodName);
        if(is_array($viewFile)) extract($viewFile);

        /* Get css and js. */
        $css = $this->getCSS($moduleName, $methodName);
        $js  = $this->getJS($moduleName, $methodName);
        if($css) $this->view->pageCSS = $css;
        if($js)  $this->view->pageJS  = $js;

        /* Change the dir to the view file to keep the relative pathes work. */
        $currentPWD = getcwd();
        chdir(dirname($viewFile));

        extract((array)$this->view);
        ob_start();
        include $viewFile;
        if(isset($hookFiles)) foreach($hookFiles as $hookFile) include $hookFile;
        $this->output .= ob_get_contents();
        ob_end_clean();

        /* At the end, chang the dir to the previous. */
        chdir($currentPWD);
    }

    /**
     * Get the output of one module's one method as a string, thus in one module's method, can fetch other module's content.
     * 
     * If the module name is empty, then use the current module and method. If set, use the user defined module and method.
     *
     * @param   string  $moduleName    module name.
     * @param   string  $methodName    method name.
     * @param   array   $params        params.
     * @access  public
     * @return  string  the parsed html.
     */
    public function fetch($moduleName = '', $methodName = '', $params = array())
    {
        if($moduleName == '') $moduleName = $this->moduleName;
        if($methodName == '') $methodName = $this->methodName;
        if($moduleName == $this->moduleName and $methodName == $this->methodName) 
        {
            $this->parse($moduleName, $methodName);
            return $this->output;
        }

        /* Set the pathes and files to included. */
        $modulePath        = $this->app->getModulePath($moduleName);
        $moduleControlFile = $modulePath . 'control.php';
        $actionExtPath     = $this->app->getModuleExtPath($moduleName, 'control');

        $commonActionExtFile = $actionExtPath['common'] . strtolower($methodName) . '.php';
        $siteActionExtFile   = $actionExtPath['site'] . strtolower($methodName) . '.php';
        $file2Included = file_exists($commonActionExtFile) ? $commonActionExtFile : $moduleControlFile;
        $file2Included = file_exists($siteActionExtFile) ? $siteActionExtFile : $file2Included;

        /* Load the control file. */
        if(!is_file($file2Included)) $this->app->triggerError("The control file $file2Included not found", __FILE__, __LINE__, $exit = true);
        $currentPWD = getcwd();
        chdir(dirname($file2Included));
        if($moduleName != $this->moduleName) helper::import($file2Included);
        
        /* Set the name of the class to be called. */
        $className = class_exists("my$moduleName") ? "my$moduleName" : $moduleName;
        if(!class_exists($className)) $this->app->triggerError(" The class $className not found", __FILE__, __LINE__, $exit = true);

        /* Parse the params, create the $module control object. */
        if(!is_array($params)) parse_str($params, $params);
        $module = new $className($moduleName, $methodName);

        /* Call the method and use ob function to get the output. */
        ob_start();
        call_user_func_array(array($module, $methodName), $params);
        $output = ob_get_contents();
        ob_end_clean();

        /* Return the content. */
        unset($module);
        chdir($currentPWD);
        return $output;
    }

    /**
     * Print the content of the view. 
     * 
     * @param   string  $moduleName    module name
     * @param   string  $methodName    method name
     * @access  public
     * @return  void
     */
    public function display($moduleName = '', $methodName = '')
    {
        if(empty($this->output)) $this->parse($moduleName, $methodName);
        echo $this->output;
    }

    /**
     * Send data directly, for ajax requests.
     * 
     * @param  misc    $data 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function send($data, $type = 'json')
    {
        if($type == 'json') echo json_encode($data);
        die(helper::removeUTF8Bom(ob_get_clean()));
    }

    /**
     * Create a link to one method of one module.
     * 
     * @param   string         $moduleName    module name
     * @param   string         $methodName    method name
     * @param   string|array   $vars          the params passed, can be array(key=>value) or key1=value1&key2=value2
     * @param   string         $viewType      the view type
     * @access  public
     * @return  string the link string.
     */
    public function createLink($moduleName, $methodName = 'index', $vars = array(), $alias = array(), $viewType = '')
    {
        if(empty($moduleName)) $moduleName = $this->moduleName;
        return helper::createLink($moduleName, $methodName, $vars, $alias, $viewType);
    }

    /**
     * Create a link to the inner method of current module.
     * 
     * @param   string         $methodName    method name
     * @param   string|array   $vars          the params passed, can be array(key=>value) or key1=value1&key2=value2
     * @param   string         $viewType      the view type
     * @access  public
     * @return  string  the link string.
     */
    public function inlink($methodName = 'index', $vars = array(), $alias = array(), $viewType = '')
    {
        return helper::createLink($this->moduleName, $methodName, $vars, $alias, $viewType);
    }

    /**
     * Location to another page.
     * 
     * @param   string   $url   the target url.
     * @access  public
     * @return  void
     */
    public function locate($url)
    {
        header("location: $url");
        exit;
    }
}
