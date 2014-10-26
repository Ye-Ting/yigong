<?php
/**
 * The control file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class ui extends control
{
    /**
     * Set template.
     *
     * @param  string   $template 
     * @param  string   $theme 
     * @param  bool     $custom 
     * @access public
     * @return void
     */
    public function setTemplate($template = '', $theme = '', $custom = false)
    {
        $templates = $this->ui->getTemplates();
        if($template and isset($templates[$template]))
        {  
            $settings = array();
            $setting['name']   = $template;
            $setting['theme']  = $theme;
            $setting['parser'] = isset($templates[$template]['parser']) ? $templates[$template]['parser'] : 'default';
            $setting['customTheme'] =  $custom ? $theme : '';

            $result = $this->loadModel('setting')->setItems('system.common.template', $setting);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title     = $this->lang->ui->setTemplate;
        $this->view->templates = $templates;
        $this->display();
    }

    /**
     * install template 
     * 
     * @access public
     * @return void
     */
    public function installTemplate($package = '', $overridePackage = 'no', $install = 'no')
    {
        $this->view->installed = false;
        list($this->view->authorities, $this->view->commands) = $this->ui->checkAuthorities();
        if(!empty($this->view->authorities)) exit($this->display());
        
        if($_FILES)
        {
            $tmpName  = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];

            $package = basename($fileName, '.zip');
            move_uploaded_file($tmpName, $this->app->getDataRoot() . "template/$fileName");
        }

        if($package == '') die($this->display());
        $this->view->package = $package;

        $installedTemplates = $this->ui->getTemplateOptions();
        if(($overridePackage == 'no') and isset($installedTemplates[$package]))
        {
            $this->view->conflicts = true;
            $this->view->fileName  = $fileName;
            die($this->display());
        }

        $this->ui->extractPackage($package);

        if($install == 'no')
        {
            $this->view->template = (object)$this->ui->getInfoFromPackage($package);
            die($this->display());
        }

        if($install == 'no') $copyResult = $this->ui->copyTemplateFiles($package);

        $this->view->installed = true;
        $this->view->title = $this->lang->ui->installTemplate;
        $this->display();
    }

    /**
     * Custom theme.
     * 
     * @param  string $theme 
     * @param  string $template 
     * @access public
     * @return void
     */
    public function customTheme($theme = '', $template = '')
    {
        if(empty($template)) $template = $this->config->template->name;
        $templates = $this->ui->getTemplates();

        if($_POST)
        {
            if(isset($templates[$template]) && isset($templates[$template]['themes'][$theme]))
            {
                $cssFile  = sprintf($this->config->site->ui->customCssFile, $template, $theme);
                $savePath = dirname($cssFile);
                if(!is_dir($savePath)) mkdir($savePath, 0777, true);
                file_put_contents($cssFile, $this->post->css);

                $setting       = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true): array();
                $postedSetting = fixer::input('post')->remove('template,theme,css')->get();

                $setting[$template][$theme] = $postedSetting;

                $result  = $this->loadModel('setting')->setItems('system.common.template', array('custom' => helper::jsonEncode($setting)) );
                $this->loadModel('setting')->setItems('system.common.template', array('customVersion' => time()));
                $this->send(array('result' => 'success', 'message' => $this->lang->ui->themeSaved));
            }
        }

        $setting = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true) : array();

        $this->view->setting = !empty($setting[$template][$theme]) ? $setting[$template][$theme] : array();

        $this->view->title      = "<i class='icon-cog'></i> " . $this->lang->ui->customtheme;
        $this->view->modalWidth = 1000;
        $this->view->theme      = $theme;
        $this->view->template   = $template;
        $this->display();
     }

    /**
     * set logo.
     * 
     * @access public
     * @return void
     */
    public function setLogo()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $return = $this->ui->setOptionWithFile($section = 'logo', $htmlTagName = 'logo');
            
            if($return['result']) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setLogo')));
            if(!$return['result']) $this->send(array('result' => 'fail', 'message' => $return['message']));
        }

        $this->view->title = $this->lang->ui->setLogo;
        $this->view->logo  = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : false;

        $this->display();
    }

    /**
     * Set base style.
     * 
     * @access public
     * @return void
     */
    public function setBaseStyle()
    {
        if($_POST)
        {
            $style  = fixer::input('post')->stripTags('content', $this->config->allowedTags->admin, false)->get();
            $return = $this->loadModel('setting')->setItems('system.common.site', array('basestyle' => $style->content));

            if($return) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setBaseStyle')));
            if(!$return) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title   = $this->lang->ui->setBaseStyle;
        $this->view->content = isset($this->config->site->basestyle) ? $this->config->site->basestyle : '';

        $this->display();
    }

    /**
     * Upload favicon.
     * 
     * @access public
     * @return void
     */
    public function setFavicon()
    {   
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {   
            $return = $this->ui->setOptionWithFile($section = 'favicon', $htmlTagName = 'favicon', $allowedFileType = 'ico');
            
            if($return['result']) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setFavicon')));
            if(!$return['result']) $this->send(array('result' => 'fail', 'message' => $return['message']));
         }

        $this->view->title   = $this->lang->ui->setFavicon;
        $this->view->favicon = isset($this->config->site->favicon) ? json_decode($this->config->site->favicon) : false;

        $this->display();
    }

    /**
     * Delete favicon 
     * 
     * @access public          
     * @return void            
     */ 
    public function deleteFavicon() 
    {
        $favicon = isset($this->config->site->favicon) ? json_decode($this->config->site->favicon) : false;

        $this->loadModel('setting')->deleteItems("owner=system&module=common&section=site&key=favicon");
        if($favicon) $this->loadModel('file')->delete($favicon->fileID);

        $this->locate(inlink('setFavicon'));
    }

    /**
     * Delete logo. 
     * 
     * @access public          
     * @return void            
     */ 
    public function deleteLogo() 
    {
        $logo = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : false;

        $this->loadModel('setting')->deleteItems("owner=system&module=common&section=site&key=logo");
        if($logo) $this->loadModel('file')->delete($logo->fileID);

        $this->locate(inlink('setLogo'));
    }
}
