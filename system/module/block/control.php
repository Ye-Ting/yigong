<?php
/**
 * The control file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class block extends control
{
    /**
     * Browse blocks admin.
     * 
     * @param  string    $template 
     * @param  int       $recTotal 
     * @param  int       $recPerPage 
     * @param  int       $pageID 
     * @access public
     * @return void
     */
    public function admin($template = '', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        if(!$template) $template = $this->config->template->name;

        $this->block->loadTemplateLang($template);

        $this->session->set('blockList', $this->app->getURI());
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $this->view->currentTemplate = $template;
        $this->view->templates       = $this->loadModel('ui')->getTemplates();
        $this->view->blocks          = $this->block->getList($template, $pager);
        $this->view->title           = $this->lang->block->common;
        $this->view->pager           = $pager;
        $this->display();
    }

    /**
     * Pages admin list.
     * 
     * @param  string    $template 
     * @access public
     * @return void
     */
    public function pages($template = '')
    {
        if(!$template) $template = $this->config->template->name;

        $this->block->loadTemplateLang($template);

        $this->view->currentTemplate = $template;
        $this->view->templates       = $this->loadModel('ui')->getTemplates();
        $this->display();       
    }

    /**
     * Create a block.
     * 
     * @param  string $template
     * @param  string $type    html|php
     * @access public
     * @return void
     */
    public function create( $template = '', $type = 'html')
    {
        if(!$template) $template = $this->config->template->name;

        $this->block->loadTemplateLang($template);

        if($_POST)
        {
            $this->block->create($template);
            if(!dao::isError()) $this->send(array('result' => 'success', 'locate' => $this->inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        if($type == 'phpcode')
        {
            $return = $this->block->canCreatePHP();
            if($return['result'] == 'fail') $this->view->okFile = $return['okFile'];
            $this->view->canCreatePHP = $return['result'] == 'success' ? true : false;
        }

        $this->view->type     = $type;
        $this->view->template = $template;
        $this->display();
    }

    /**
     * Edit a block.
     * 
     * @param string   $template
     * @param int      $blockID 
     * @param string   $type 
     * @access public
     * @return void
     */
    public function edit($template = 'default', $blockID, $type = '')
    {
        if(!$template) $template = $this->config->template->name;

        $this->block->loadTemplateLang($template);

        if(!$blockID) $this->locate($this->inlink('admin'));

        if($_POST)
        {
            $this->block->update($template);
            if(!dao::isError()) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        if($type == 'phpcode')
        {
            $return = $this->block->canCreatePHP();
            if($return['result'] == 'fail') $this->view->okFile = $return['okFile'];
            $this->view->canCreatePHP = $return['result'] == 'success' ? true : false;
        }

        $this->view->template = $template;
        $this->view->block    = $this->block->getByID($blockID);
        $this->view->type     = $this->get->type ? $this->get->type : $this->view->block->type;
        $this->display();
    }

    /**
     * Set the layouts of one region.
     * 
     * @param string   $page 
     * @param string   $region 
     * @param string   $template 
     * @access public
     * @return void
     */
    public function setRegion($page, $region, $template)
    {
        if(!$template) $template = $this->config->template->name;

        $this->block->loadTemplateLang($template);

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $result = $this->block->setRegion($page, $region, $template);

            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('pages', "templat={$template}")));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $blocks = $this->block->getRegionBlocks($page, $region, $template);
        if(empty($blocks)) $blocks = array(new stdclass());

        $this->view->title        = "<i class='icon-cog'></i> " . $this->lang->block->setPage . ' - '. $this->lang->block->{$template}->pages[$page] . ' - ' . $this->lang->block->$template->regions->{$page}[$region];
        $this->view->modalWidth   = 900;
        $this->view->page         = $page;
        $this->view->region       = $region;
        $this->view->blocks       = $blocks;
        $this->view->blockOptions = $this->block->getPairs($template);
        $this->view->template     = $template;

        $this->display();
    }

    /**
     * Delete a block from page region.
     * 
     * @param string $blockID 
     * @param string $confirm 
     * @access public
     * @return void
     */
    public function delete($blockID)
    {
        $result = $this->block->delete($blockID);

        if($result)  $this->send(array('result' => 'success'));
        if(!$result) $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Show block form.
     * 
     * @param  string  $type 
     * @param  int     $id 
     * @access public
     * @return void
     */
    public function blockForm($type, $id = 0)
    {
        if($id > 0) $this->view->block = $this->block->getByID($id); 

        $this->view->type = $type;
        $this->display();
    }
}
