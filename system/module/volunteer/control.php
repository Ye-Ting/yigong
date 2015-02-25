<?php
/**
 * The control file of article module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class volunteer extends control
{
    /** 
     * The index page, locate to the first category or home page if no category.
     * 
     * @access public
     * @return void
     */
    public function index()
    {   
        $volunteer = $this->volunteer->getByID(1);
        $this->send($volunteer);
    }   

    public function create()
    {
        $this->lang->volunteer->menu = $this->lang->activity->menu;
        // $this->lang->menuGroups->activity = $type;

        if($_POST)
        {
            $res = $this->volunteer->create();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'data'=> $res, 'locate'=>inlink('admin')));
        } 

        $this->view->title           = $this->lang->volunteer->create;
        // $this->view->currentCategory = $categoryID;
        // $this->view->categories      = $this->loadModel('tree')->getOptionMenu($type, 0, $removeRoot = true);
        // $this->view->type            = $type;

        $this->display();
    }

    public function search($keyword, $type="all")
    {

        // $volunteer = $this->volunteer->getByID(1);
        // $this->send($volunteer);
        // 搜索
        if ($type == "all") {
            // 1.根据义工号模糊查询
            $volunteers = $this->volunteer->queryByVolunteerNo($keyword);
            // 2.根据身份证号模糊查询
            
            // 3.根据姓名模糊查询
        }
        // $this->send(1);
        if ($volunteers) {
            $this->send($volunteers);
        }else{
            $this->send(array());
        }
    }

    /**
     * Browse volunteer in admin.
     * 
     * @param string $type        the volunteer type
     * @param int    $categoryID  the category id
     * @param int    $recTotal 
     * @param int    $recPerPage 
     * @param int    $pageID 
     * @access public
     * @return void
     */
    public function admin($orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {   
        $this->lang->volunteer->menu = $this->lang->activity->menu;
        // $this->lang->menuGroups->volunteer = $type;

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $volunteers = $this->volunteer->getList($orderBy, $pager);

        $this->view->title      = $this->lang->volunteer->admin;
        $this->view->type       = $type;
        $this->view->categoryID = $categoryID;
        $this->view->volunteers  = $volunteers;
        $this->view->pager      = $pager;
        $this->view->orderBy    = $orderBy;

        $this->display();
    }   


    /**
     * Delete an volunteer.
     * 
     * @param  int      $volunteerID 
     * @access public
     * @return void
     */
    public function delete($volunteerID)
    {
        if($this->volunteer->delete($volunteerID)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Edit an volunteer.
     * 
     * @param  int    $volunteerID 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function edit($volunteerID)
    {
        $this->lang->volunteer->menu = $this->lang->activity->menu;
        // $this->lang->menuGroups->volunteer = $type;

        $volunteer  = $this->volunteer->getByID($volunteerID);
        // $categories = $this->loadModel('tree')->getOptionMenu($type, 0, $removeRoot = true);
        // if(empty($categories) && $type != 'page')
        // {
            // die(js::alert($this->lang->tree->noCategories) . js::locate($this->createLink('tree', 'browse', "type=$type")));
        // }

        if($_POST)
        {
            $this->volunteer->update($volunteerID, $type);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
        }


        $this->view->title     = $this->lang->volunteer->edit;
        $this->view->volunteer = $volunteer;
        $this->display();
    }

}
