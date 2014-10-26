<?php
/**
 * The smarty parser class file.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     framework
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class smartyParser
{
    /**
     * The control object passed by the control.class.php.
     * 
     * @var object   
     * @access public
     */
    public $control;

    /**
     * Construct function load smarty lib and init smarty configures.
     * 
     * @param  object    $control 
     * @access public
     * @return void
     */
    public function __construct($control)
    {
        global $app, $config;
        $this->control = $control;

        /* Load smarty class and create smarty object. */
        $app->loadClass('smarty', true);
        $this->smarty = new smartyBC();

        /* Use system config->debug as smarty->debug. */
        $this->smarty->debugging = $config->debug;

        /* Set smarty values of TemplateDir, CompilerDir, cachDir and ConfigDir. */ 
        $this->smarty->setTemplateDir(TPL_ROOT . 'view' . DS);
        $this->smarty->setCompileDir($app->getTmpRoot() . 'smarty' . DS .'compile' . DS);
        $this->smarty->setCacheDir($app->getTmpRoot() . 'smarty' . DS . 'cache' . DS);
        $this->smarty->setConfigDir(TPL_ROOT . 'config' . DS);
    }

    /**
     * Parse template.
     *
     * @param string $moduleName    module name
     * @param string $methodName    method name
     * @access private
     * @return string
     */
    public function parse($moduleName, $methodName)
    {
        /* Register app, config, lang objects. */
        global $app, $config, $lang;
        $this->smarty->register_object('control', $this->control);
        $this->smarty->register_object('app', $app);
        $this->smarty->register_object('lang', $lang);
        $this->smarty->register_object('config', $config);

        /* Get view files from control. */
        $viewFile = $this->control->setViewFile($moduleName, $methodName);
        echo $viewFile;
        if(is_array($viewFile)) extract($viewFile);

        /* Assign hook files. */        
        if(!isset($hookFiles)) $hookFiles = array();
        $this->smarty->assign('hookFiles', $hookFiles);

        /* Assign view variables. */
        foreach($this->control->view as $item => $value) $this->smarty->assign($item, $value);
        
        /* Render the template and return it. */
        $output = $this->smarty->fetch($viewFile);
        echo $output;
        return $output;
    }
}
