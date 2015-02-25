<?php
/**
 * The control file of activity module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     activity
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class activity extends control
{
    /** 
     * The index page, locate to the first category or home page if no category.
     * 
     * @access public
     * @return void
     */
    public function index()
    {   
        // $category = $this->loadModel('tree')->getFirst('activity');
        // if($category) $this->locate(inlink('browse', "category=$category->id"));
        $this->locate(inlink('browse'));
        // $this->locate($this->createLink('index'));
    }   

    /** 
     * Browse activity in front.
     * 
     * @param int    $categoryID   the category id
     * @param int    $pageID       current page id
     * @access public
     * @return void
     */
    public function browse($categoryID = 0, $pageID = 1)
    {   
        // $category = $this->loadModel('tree')->getByID($categoryID, 'activity');

        // if($category->link) helper::header301($category->link);

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal = 0, $this->config->activity->recPerPage, $pageID);

        $categoryID = is_numeric($categoryID) ? $categoryID : $category->id;
        // $activitys   = $this->activity->getList('activity', $this->tree->getFamily($categoryID, 'activity'), 'addedDate_desc', $pager);
        // $families = $categoryID ? $this->loadModel('tree')->getFamily($categoryID, $type) : '';
        $activitys = $this->activity->getList($type, ' ', 'id_desc', $pager);

        // var_dump($activitys);
        // if($category)
        // {
        //     $title    = $category->name;
        //     $keywords = trim($category->keywords . ' ' . $this->config->site->keywords);
        //     $desc     = strip_tags($category->desc);
        //     $this->session->set('activityCategory', $category->id);
        // }
        // else
        // {
        //     die($this->fetch('error', 'index'));
        // }

       $this->view->title      = $this->lang->activity->common;
       $this->view->categoryID = $categoryID;
       $this->view->activitys   = $activitys;
       $this->view->pager      = $pager;
       
       if($category)
       {
           if($category->link) helper::header301($category->link);

           $this->view->category = $category;
           $this->view->title    = $category->name;
           $this->view->keywords = trim($category->keywords . ' ' . $this->config->site->keywords);
           $this->view->desc     = strip_tags($category->desc);
           $this->session->set('articleCategory', $category->id);
       }

       $this->display();
    }
    
    /**
     * Browse activity in admin.
     * 
     * @param string $type        the activity type
     * @param int    $categoryID  the category id
     * @param int    $recTotal 
     * @param int    $recPerPage 
     * @param int    $pageID 
     * @access public
     * @return void
     */
    public function admin($type = 'activity', $categoryID = 0, $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {   
        $this->lang->activity->menu = $this->lang->$type->menu;
        $this->lang->menuGroups->activity = $type;

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $families = $categoryID ? $this->loadModel('tree')->getFamily($categoryID, $type) : '';
        $activitys = $this->activity->getList($type, $families, $orderBy, $pager);

        if($type != 'page') 
        {
            // $this->view->treeModuleMenu = $this->loadModel('tree')->getTreeMenu($type, 0, array('treeModel', 'createAdminLink'));
            $this->view->treeManageLink = html::a(helper::createLink('tree', 'browse', "type={$type}"), $this->lang->tree->manage);
        }

        $this->view->title      = $this->lang->$type->admin;
        $this->view->type       = $type;
        $this->view->categoryID = $categoryID;
        $this->view->activitys  = $activitys;
        $this->view->pager      = $pager;
        $this->view->orderBy    = $orderBy;

        $this->display();
    }   

    /**
     * Create an activity.
     * 
     * @param  string $type 
     * @param  int    $categoryID
     * @access public
     * @return void
     */
    public function create($type = 'activity', $categoryID = '')
    {
        $this->lang->activity->menu = $this->lang->{$type}->menu;
        $this->lang->menuGroups->activity = $type;

        // $categories = $this->loadModel('tree')->getOptionMenu($type, 0, $removeRoot = true);
        // if(empty($categories) && $type != 'page')
        // {
        //     die(js::locate($this->createLink('tree', 'redirect', "type=$type")));
        // }

        if($_POST)
        {
            $this->activity->create($type);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('admin', "type=$type")));
        }

        if($type != 'page') 
        {
            // $this->view->treeModuleMenu = $this->loadModel('tree')->getTreeMenu($type, 0, array('treeModel', 'createAdminLink'));
            $this->view->treeManageLink = html::a(helper::createLink('tree', 'browse', "type={$type}"), $this->lang->tree->manage);
        }

        $this->view->title           = $this->lang->{$type}->create;
        $this->view->currentCategory = $categoryID;
        $this->view->categories      = $this->loadModel('tree')->getOptionMenu($type, 0, $removeRoot = true);
        $this->view->type            = $type;

        $this->display();
    }

    /**
     * Edit an activity.
     * 
     * @param  int    $activityID 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function edit($activityID, $type)
    {
        // $this->lang->activity->menu = $this->lang->$type->menu;
        $this->lang->menuGroups->activity = $type;

        $activity    = $this->activity->getByID($activityID, $replaceTag = false);
        // $categories = $this->loadModel('tree')->getOptionMenu($type, 0, $removeRoot = true);
        // if(empty($categories) && $type != 'page')
        // {
            // die(js::alert($this->lang->tree->noCategories) . js::locate($this->createLink('tree', 'browse', "type=$type")));
        // }

        if($_POST)
        {
            $this->activity->update($activityID, $type);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
        }

        if($type != 'page') 
        {
            // $this->view->treeModuleMenu = $this->loadModel('tree')->getTreeMenu($type, 0, array('treeModel', 'createAdminLink'));
            $this->view->treeManageLink = html::a(helper::createLink('tree', 'browse', "type={$type}"), $this->lang->tree->manage);
        }

        $this->view->title      = $this->lang->activity->edit;
        $this->view->activity    = $activity;
        // $this->view->categories = $categories;
        $this->view->type       = $type;
        $this->display();
    }

    /**
     * View an activity.
     * 
     * @param int $activityID 
     * @access public
     * @return void
     */
    public function view($activityID)
    {
        $activity  = $this->activity->getByID($activityID);
        if(!$activity) die($this->fetch('error', 'index'));

        if($activity->link)
        {
            $this->dao->update(TABLE_ACTIVITY)->set('views = views + 1')->where('id')->eq($activityID)->exec();
            helper::header301($activity->link);
        }

        /* fetch category for display. */
        $category = array_slice($activity->categories, 0, 1);
        $category = $category[0]->id;

        $currentCategory = $this->session->activityCategory;
        if($currentCategory > 0)
        {
            if(isset($activity->categories[$currentCategory]))
            {
                $category = $currentCategory;  
            }
            else
            {
                foreach($activity->categories as $activityCategory)
                {
                    if(strpos($activityCategory->path, $currentCategory)) $category = $activityCategory->id;
                }
            }
        }

        $category = $this->loadModel('tree')->getByID($category);

        $title    = $activity->title . ' - ' . $category->name;
        $keywords = $activity->keywords . ' ' . $category->keywords . ' ' . $this->config->site->keywords;
        $desc     = strip_tags($activity->summary);
        
        $this->view->title       = $title;
        $this->view->keywords    = $keywords;
        $this->view->desc        = $desc;
        $this->view->activity     = $activity;
        $this->view->prevAndNext = $this->activity->getPrevAndNext($activity->id, $category->id);
        $this->view->category    = $category;
        $this->view->contact     = $this->loadModel('company')->getContact();

        $this->dao->update(TABLE_ACTIVITY)->set('views = views + 1')->where('id')->eq($activityID)->exec();

        $this->display();
    }

    /**
     * Delete an activity.
     * 
     * @param  int      $activityID 
     * @access public
     * @return void
     */
    public function delete($activityID)
    {
        if($this->activity->delete($activityID)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Set css.
     * 
     * @param  int      $activityID 
     * @access public
     * @return void
     */
    public function setCss($activityID)
    {
        $activity = $this->activity->getByID($activityID);
        if($_POST)
        {
            if($this->activity->setCss($activityID)) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "type={$activity->type}")));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title   = $this->lang->activity->css;
        $this->view->activity = $activity;
        $this->display();
    }


    /**
     * Set js.
     * 
     * @param  int      $activityID 
     * @access public
     * @return void
     */
    public function setJs($activityID)
    {
        $activity = $this->activity->getByID($activityID);
        if($_POST)
        {
            if($this->activity->setJs($activityID)) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "type={$activity->type}")));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title   = $this->lang->activity->js;
        $this->view->activity = $activity;
        $this->display();
    }

    public function join($activityID){

        $people['people'] = $this->app->user->account;
        $people['realName'] = $this->app->user->realname;
        $people['phone'] = $this->app->user->mobile;
        $people['activity_id'] = $activityID;
        $people['status'] = 'normal';
        // var_dump($this->app->user);
        $this->activity->join($activityID,$people);
        // if($category) $this->locate(inlink('browse', "category=$category->id"));
        // $this->locate(inlink('view', "id=$activityID"));
        $this->send(array('result' => 'success', 'message' => $lang->activity->EnrollSuccess, 'locate'=>inlink('view', "id=$activityID")));
    }

    /**
     * Show the people of one object, and print the people form.
     * 
     * @param string $objectType 
     * @param string $objectID 
     * @access public
     * @return void
     */
    public function people($activityID, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal = 0 , 10, $pageID);
        // $this->view->objectType  = $objectType;
        // $this->view->objectID    = $objectID;

        $this->view->peoples    = $this->activity->getByObject( $activityID, $pager);
        $this->view->pager       = $pager;
        $this->view->startNumber = ($pageID - 1) * 10;
        $this->lang->message     = $this->lang->people;
        $this->display();
    }


    public function record($value='')
    {

        if($_POST)
        {
            // if (condition) {
            //     # code...
            // }
            // $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->activity->createRecords();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            // $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
        }
        $activities_all = $this->activity->getAll();
        $activities = array(0 =>'');
        foreach ($activities_all as $key => $value) {
            // echo $key;
            // echo $value['title'];
            // var_dump($value);
            $activities[$key] =  date('Y-m-d',strtotime($value->date)) .' | '. $value->title ;
            // $activities = array_add($activities,$key,$value['title']);
        }
        $this->view->activities = $activities;
        // var_dump($this->view->activities);
        $this->display();
    }
}
