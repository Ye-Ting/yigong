<?php
/**
 * The model file of activity module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     activity
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class activityModel extends model
{
    /** 
     * Get an activity by id.
     * 
     * @param  int      $activityID 
     * @param  bool     $replaceTag 
     * @access public
     * @return bool|object
     */
    public function getByID($activityID, $replaceTag = true)
    {   
        /* Get activity self. */
        $activity = $this->dao->select('*')->from(TABLE_ACTIVITY)->where('id')->eq($activityID)->fetch();
        if(!$activity) $activity = $this->dao->select('*')->from(TABLE_ACTIVITY)->where('id')->eq($activityID)->fetch();

        if(!$activity) return false;
        
        /* Add link to content if necessary. */
        if($replaceTag) $activity->content = $this->loadModel('tag')->addLink($activity->content);

        /* Get it's categories. */
        $activity->categories = $this->dao->select('t2.*')
            ->from(TABLE_RELATION)->alias('t1')
            ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
            ->where('t1.type')->eq($activity->type)
            ->andWhere('t1.id')->eq($activityID)
            ->fetchAll('id');

        /* Get activity path to highlight main nav. */
        $path = '';
        foreach($activity->categories as $category) $path .= $category->path;
        $activity->path = explode(',', trim($path, ','));

        /* Get it's files. */
        $activity->files = $this->loadModel('file')->getByObject($activity->type, $activityID);

        return $activity;
    }   

    /**
     * Get page by ID.
     * 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function getPageByID($pageID)
    {
        /* Get activity self. */
        $page = $this->dao->select('*')->from(TABLE_ACTIVITY)->where('alias')->eq($pageID)->andWhere('type')->eq('page')->fetch();
        if(!$page) $page = $this->dao->select('*')->from(TABLE_ACTIVITY)->where('id')->eq($pageID)->fetch();

        if(!$page) return false;
        
        /* Add link to content if necessary. */
        $page->content = $this->loadModel('tag')->addLink($page->content);
        
        /* Get it's files. */
        $page->files = $this->loadModel('file')->getByObject('page', $page->id);

        return $page;
    }

    /** 
     * Get activity list.
     * 
     * @param  string  $type 
     * @param  array   $categories 
     * @param  string  $orderBy 
     * @param  object  $pager 
     * @access public
     * @return array
     */
    public function getList($type, $categories, $orderBy, $pager = null)
    {
        if($type == 'page')
        {
            $activitys = $this->dao->select('*')->from(TABLE_ACTIVITY)
                ->where('type')->eq('page')
                ->orderBy('id_desc')
                ->page($pager)
                ->fetchAll('id');
        }
        else
        {
            /* Get activitys(use groupBy to distinct activitys).  */
            $activitys = $this->dao->select('*')->from(TABLE_ACTIVITY)
                ->beginIf(defined('RUN_MODE') and RUN_MODE == 'front')
                ->where('addedDate')->le(helper::now())
                ->andWhere('status')->eq('normal')
                ->fi()
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll('id');
        }
        if(!$activitys) return array();

        /* Get categories for these activitys. */
        $categories = $this->dao->select('t2.id, t2.name, t2.alias, t1.id AS activity')
            ->from(TABLE_RELATION)->alias('t1')
            ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
            ->where('t2.type')->eq($type)
            ->beginIf($categories)->andWhere('t1.category')->in($categories)->fi()
            ->fetchGroup('activity', 'id');

        /* Assign categories to it's activity. */
        foreach($activitys as $activity) $activity->categories = isset($categories[$activity->id]) ? $categories[$activity->id] : array();

        /* Get images for these activitys. */
        $images = $this->loadModel('file')->getByObject($type, array_keys($activitys), $isImage = true);

        /* Assign images to it's activity. */
        foreach($activitys as $activity)
        {
            if(empty($images[$activity->id])) continue;

            $activity->image = new stdclass();
            $activity->image->list    = $images[$activity->id];
            $activity->image->primary = $activity->image->list[0];
        }

        /* Assign summary to it's activity. */
        foreach($activitys as $activity) $activity->summary = empty($activity->summary) ? helper::substr(strip_tags($activity->content), 200, '...') : $activity->summary;

        /* Assign comments to it's activity. */
        $activityIdList = array_keys($activitys);
        $comments = $this->dao->select("objectID, count(*) as count")->from(TABLE_MESSAGE)
            ->where('type')->eq('comment')
            ->andWhere('objectType')->eq('activity')
            ->andWhere('objectID')->in($activityIdList)
            ->andWhere('status')->eq(1)
            ->groupBy('objectID')
            ->fetchPairs('objectID', 'count');
        foreach($activitys as $activity) $activity->comments = isset($comments[$activity->id]) ? $comments[$activity->id] : 0;
 
        return $activitys;
    }


    public function getAll()
    {
        $activitys = $this->dao->select('*')->from(TABLE_ACTIVITY)
            ->orderBy('id_desc')
            ->fetchAll('id');

        if(!$activitys) return array();
        return $activitys;
    }

    
    /**
     * Get page pairs.
     * 
     * @param string $pager 
     * @access public
     * @return array
     */
    public function getPagePairs($pager = null)
    {
        return $this->dao->select('id, title')->from(TABLE_ACTIVITY)
            ->where('type')->eq('page')
            ->andWhere('addedDate')->le(helper::now())
            ->andWhere('status')->eq('normal')
            ->orderBy('id_desc')
            ->page($pager, false)
            ->fetchPairs();
    }

    /**
     * Get activity pairs.
     * 
     * @param string $modules 
     * @param string $orderBy 
     * @param string $pager 
     * @access public
     * @return array
     */
    public function getPairs($categories, $orderBy, $pager = null)
    {
        return $this->dao->select('t1.id, t1.title, t1.alias')->from(TABLE_ACTIVITY)->alias('t1')
            ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
            ->where('1=1')
            ->beginIf(defined('RUN_MODE') and RUN_MODE == 'front')
            ->andWhere('t1.addedDate')->le(helper::now())
            ->andWhere('t1.status')->eq('normal')
            ->fi()
            ->beginIF($categories)->andWhere('t2.category')->in($categories)->fi()
            ->orderBy($orderBy)
            ->page($pager, false)
            ->fetchAll('id');
    }

    /**
     * get hot activitys. 
     *
     * @param string|array    $categories
     * @param int             $count
     * @param string          $type
     * @access public
     * @return array
     */
    public function getHot($categories, $count, $type = 'activity')
    {
        $family = array();
        $this->loadModel('tree');

        if(!is_array($categories)) $categories = explode(',', $categories);
        foreach($categories as $category) $family = array_merge($family, $this->tree->getFamily($category));

        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $count, 1);
        return $this->getList($type, $family, 'views_desc', $pager);
    }

    /**
     * get latest activitys. 
     *
     * @param string|array     $categories
     * @param int              $count
     * @param string           $type
     * @access public
     * @return array
     */
    public function getLatest($categories, $count, $type = 'activity')
    {
        $family = array();
        $this->loadModel('tree');

        if(!is_array($categories)) $categories = explode(',', $categories);
        foreach($categories as $category) $family = array_merge($family, $this->tree->getFamily($category));

        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $count, 1);
        return $this->getList($type, $family, 'addedDate_desc', $pager);
    }

    /**
     * Get the prev and next ariticle.
     * 
     * @param  int    $current  the current activity id.
     * @param  int    $category the category id.
     * @access public
     * @return array
     */
    public function getPrevAndNext($current, $category)
    {
        $current = $this->getByID($current);
        $prev = $this->dao->select('t1.id, title')->from(TABLE_ACTIVITY)->alias('t1')
           ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
           ->where('t2.category')->eq($category)
           ->andWhere('t1.status')->eq('normal')
           ->andWhere('t1.addedDate')->lt($current->addedDate)
           ->orderBy('t1.addedDate_desc')
           ->limit(1)
           ->fetch();

       $next = $this->dao->select('t1.id, title')->from(TABLE_ACTIVITY)->alias('t1')
           ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
           ->where('t2.category')->eq($category)
           ->andWhere('t1.addedDate')->le(helper::now())
           ->andWhere('t1.status')->eq('normal')
           ->andWhere('t1.addedDate')->gt($current->addedDate)
           ->orderBy('t1.addedDate')
           ->limit(1)
           ->fetch();

        return array('prev' => $prev, 'next' => $next);
    }

    /**
     * 添加活动信息 
     * 需要添加的信息 编号 姓名 联系方式 身份证号 组别
     * Create an activity.
     * 
     * @param  string $type 
     * @access public
     * @return int|bool
     */
    public function create($type)
    {
        $now = helper::now();
        $activity = fixer::input('post')
            ->stripTags('content', $this->config->allowedTags->admin)
            ->setDefault('addedDate', $now)
            ->add('editedDate', $now)
            ->get();
        $this->dao->insert(TABLE_ACTIVITY)
            ->data($activity, $skip = 'uid,isLink')
            ->autoCheck()
            ->exec();

        $activityID = $this->dao->lastInsertID();

        // // $this->loadModel('file')->updateObjectID($this->post->uid, $activityID, $type);
        // // $this->file->copyFromContent($this->post->content, $activityID, $type);

        if(dao::isError()) return false;

        // /* Save activity keywords. */
        // // $this->loadModel('tag')->save($activity->keywords);

        // // if($type != 'page') $this->processCategories($activityID, $type, $this->post->categories);
        return $activityID;
    }

    // 义工信息查询
    // 需要根据义工注册编号 身份证号 查询




    /**
     * Update an activity.
     * 
     * @param string   $activityID 
     * @access public
     * @return void
     */
    public function update($activityID, $type = 'activity')
    {
        $activity  = $this->getByID($activityID);
        // $category = array_keys($activity->categories);

        $activity = fixer::input('post')
            ->stripTags('content', $this->config->allowedTags->admin)
            ->add('editedDate', helper::now())
            ->get();

        // $activity->keywords = seo::unify($activity->keywords, ',');

        $this->dao->update(TABLE_ACTIVITY)
            ->data($activity,$skip = 'uid,isLink')
            ->autoCheck()
            ->where('id')->eq($activityID)
            ->exec();

        $this->loadModel('file')->updateObjectID($this->post->uid, $activityID, $type);
        $this->file->copyFromContent($this->post->content, $activityID, $type);

        if(dao::isError()) return false;

        // $this->loadModel('tag')->save($activity->keywords);
        // if($type != 'page') $this->processCategories($activityID, $type, $this->post->categories);

        return !dao::isError();
    }
        
    /**
     * Delete an activity.
     * 
     * @param  int      $activityID 
     * @access public
     * @return void
     */
    public function delete($activityID, $null = null)
    {
        $activity = $this->getByID($activityID);
        if(!$activity) return false;

        $this->dao->delete()->from(TABLE_RELATION)->where('id')->eq($activityID)->andWhere('type')->eq($activity->type)->exec();
        $this->dao->delete()->from(TABLE_ACTIVITY)->where('id')->eq($activityID)->exec();

        return !dao::isError();
    }

    /**
     * Process categories for an activity.
     * 
     * @param  int    $activityID 
     * @param  string $tree
     * @param  array  $categories 
     * @access public
     * @return void
     */
    public function processCategories($activityID, $type = 'activity', $categories = array())
    {
       if(!$activityID) return false;

       /* First delete all the records of current activity from the releation table.  */
       $this->dao->delete()->from(TABLE_RELATION)
           ->where('type')->eq($type)
           ->andWhere('id')->eq($activityID)
           ->autoCheck()
           ->exec();

       /* Then insert the new data. */
       foreach($categories as $category)
       {
           if(!$category) continue;

           $data = new stdclass();
           $data->type     = $type; 
           $data->id       = $activityID;
           $data->category = $category;
           $this->dao->insert(TABLE_RELATION)->data($data)->exec();
       }
    }

    /**
     * Create preview link. 
     * 
     * @param  int    $activityID 
     * @access public
     * @return string
     */
    public function createPreviewLink($activityID)
    {
        // $activity = $this->getByID($activityID);
        // if(empty($activity)) return null;
        // $module  = $activity->type;
        // $param   = "activityID=$activityID";
        // if($activity->type != 'page')
        // {
        //     $categories    = $activity->categories;
        //     $categoryAlias = current($categories)->alias;
        //     $alias         = "category=$categoryAlias&name=$activity->alias";
        // }
        // else
        // {
        //     $alias = "name=$activity->alias";
        // }

        // $link = commonModel::createFrontLink($module, 'view', $param, $alias);
        // if($activity->link) $link = $activity->link;

        return $link;
    }

    /**
     * Delete '<p><br /></p>' if it at string's last. 
     * 
     * @param  string    $content 
     * @access public
     * @return string
     */
    public function rtrimContent($content)
    {
        /* Delete empty line such as '<p><br /></p>' if activity content has it at last */
        $res   = '';
        $match = '/(\s+?<p><br \/>\s+?<\/p>)+$/';
        preg_match($match, $content, $res);
        if(isset($res[0]))
        {
            $content = substr($content, 0, strlen($content) - strlen($res[0]));
        }
        return $content;
    }

    /**
     * Set css.
     * 
     * @param  int      $activityID 
     * @access public
     * @return int
     */
    public function setCss($activityID)
    {
        $data = fixer::input('post')
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->get();

        $this->dao->update(TABLE_ACTIVITY)->data($data, $skip = 'uid')->autoCheck()->where('id')->eq($activityID)->exec();
        
        return !dao::isError();
    }

    /**
     * Set js.
     * 
     * @param  int      $activityID 
     * @access public
     * @return int
     */
    public function setJs($activityID)
    {
        $data = fixer::input('post')
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->get();

        $this->dao->update(TABLE_ACTIVITY)->data($data, $skip = 'uid')->autoCheck()->where('id')->eq($activityID)->exec();
        
        return !dao::isError();
    }


    public function join($activityID,$people)
    {
        $now = helper::now();

        $people['addedDate'] = $now;
        $people['editedDate'] = $now;


        $this->dao->insert(TABLE_ACTIVITY_PEOPLE)
            ->data($people)
            ->autoCheck()
            ->exec();
        // $this->getByID($activityID)
    }

    /**
     * Get peoples of one object.
     * 
     * @param  int    $objectID      the object id
     * @access public
     * @return array
     */
    public function getByObject($objectID, $pager = null)
    {
        // $userMessages = $this->cookie->cmts;
        // $userMessages = trim($userMessages, ',');
        // if(empty($userMessages)) $userMessages = '0';
        return  $this->dao->select('*')->from(TABLE_ACTIVITY_PEOPLE)
            ->where('activity_id')->eq($objectID)
            ->beginIf(RUN_MODE == 'front')->andWhere('status')->eq('normal')->fi()
            ->orderBy('id_desc')
            ->page($pager)
            ->fetchAll();
    }


    public function createRecords()
    {
        $now = helper::now();
        $records = fixer::input('post')
            ->setDefault('addedDate', $now)
            ->add('editedDate', $now)
            ->add('status', 'normal')
            ->get();

        // var_dump($records);

        for ($i=0; $i < 8 ; $i++) { 
            $record = array();
            $record['addedDate'] = $records->addedDate;
            $record['editedDate'] = $records->editedDate;
            $record['status'] = $records->status;
            $record['people'] = $records->volunteer_id;
            // var_dump($records->activities);
            // echo $records->activities[i];
            // var_dump(i);
            
            if ($records->activities[$i]) {
                $record['activity_id'] = $records->activities[$i];
                $record['content'] = $records->content[$i];
                $record['hour'] = $records->hour[$i];
                $record['mark'] = $records->mark[$i];

                // var_dump($record);

                $this->dao->insert(TABLE_ACTIVITY_PEOPLE)
                    ->data($record)
                    ->autoCheck()
                    ->batchCheck('people, activity_id, content, hour', 'notempty')
                    ->exec();

                if(dao::isError()) return false;

            }else{
                continue ;
            }
            
        }

        return true;

        // $this->dao->insert(TABLE_ARTICLE)
        //     ->data($article, $skip = 'categories,uid,isLink')
        //     ->autoCheck()
        //     ->batchCheckIF($type != 'page' and !$this->post->isLink, $this->config->article->require->edit, 'notempty')
        //     ->batchCheckIF($type == 'page' and !$this->post->isLink, $this->config->article->require->page, 'notempty')
        //     ->batchCheckIF($type != 'page' and $this->post->isLink, $this->config->article->require->link, 'notempty')
        //     ->batchCheckIF($type == 'page' and $this->post->isLink, $this->config->article->require->pageLink, 'notempty')
        //     ->checkIF(($type == 'page') and $this->post->alias, 'alias', 'unique', "type='page'")
        //     ->exec();
        // $articleID = $this->dao->lastInsertID();

        // $this->loadModel('file')->updateObjectID($this->post->uid, $articleID, $type);
        // $this->file->copyFromContent($this->post->content, $articleID, $type);

        // if(dao::isError()) return false;
    }
}
