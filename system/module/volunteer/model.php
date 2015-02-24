<?php
class volunteerModel extends model
{
    // 义工信息添加
    /**
     * Create an volunteer.
     * 
     * @param  string $type 
     * @access public
     * @return int|bool
     */
    public function create()
    {
        // 需要添加的信息 编号 姓名 联系方式 身份证号 组别
        
        $now = helper::now();
        $volunteer = fixer::input('post')
            ->setDefault('addedDate', $now)
            ->add('editedDate', $now)
            ->get();
        $this->dao->insert(TABLE_VOLUNTEER)
            ->data($volunteer)
            ->autoCheck()
            ->batchCheck('id_card,volunteer_no', 'unique')
            ->exec();
        // $volunteer = fixer::input('post')
        //     ->stripTags('content', $this->config->allowedTags->admin)
        //     ->setDefault('addedDate', $now)
        //     ->add('editedDate', $now)
        //     ->get();
        // $this->dao->insert(TABLE_volunteer)
        //     ->data($volunteer, $skip = 'uid,isLink')
        //     ->autoCheck()
        //     ->exec();

        $volunteerID = $this->dao->lastInsertID();

        if(dao::isError()) return false;

        $volunteer->id = $volunteerID;
        return $volunteer;
        // return $volunteerID;
    }

    /**
     * 义工信息查询
     *
     * Get an article by id.
     * 
     * @access public
     * @return bool|object
     */
    public function getByID($volunteerID)
    {   
        // /* Get article self. */
        // $article = $this->dao->select('*')->from(TABLE_ARTICLE)->where('alias')->eq($articleID)->fetch();
        // if(!$article) 
        $volunteer = $this->dao->select('*')
            ->from(TABLE_VOLUNTEER)
            ->where('id')->eq($volunteerID)
            ->fetch();

        if(!$volunteer) return false;
        
        // /* Add link to content if necessary. */
        // if($replaceTag) $article->content = $this->loadModel('tag')->addLink($article->content);

        // /* Get it's categories. */
        // $article->categories = $this->dao->select('t2.*')
        //     ->from(TABLE_RELATION)->alias('t1')
        //     ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
        //     ->where('t1.type')->eq($article->type)
        //     ->andWhere('t1.id')->eq($articleID)
        //     ->fetchAll('id');

        // /* Get article path to highlight main nav. */
        // $path = '';
        // foreach($article->categories as $category) $path .= $category->path;
        // $article->path = explode(',', trim($path, ','));

        // /* Get it's files. */
        // $article->files = $this->loadModel('file')->getByObject($article->type, $articleID);

        return $volunteer;
    }   
    /**
     * 义工信息义工注册编号查询
     *
     * Get an article by id.
     * 
     * @access public
     * @return bool|object
     */
    public function getByVolunteerNo($volunteerNo){   
        
        $volunteer = $this->dao->select('*')
            ->from(TABLE_VOLUNTEER)
            ->where('volunteer_no')->eq($volunteerNo)
            ->fetch();

        if(!$volunteer) return false;

        return $volunteer;
    } 
    public function getByIDcard($IDcard)
    {
        $volunteer = $this->dao->select('*')
            ->from(TABLE_VOLUNTEER)
            ->where('id_card')->eq($IDcard)
            ->fetch();

        if(!$volunteer) return false;

        return $volunteer;
    }

    /**
     * 义工信息义工注册编号查询
     *
     * Get an article by id.
     * 
     * @access public
     * @return bool|object
     */
    public function queryByVolunteerNo($volunteerNo){   
        
        $volunteers = $this->dao->select('*')
            ->from(TABLE_VOLUNTEER)
            ->where('volunteer_no')->like("%$volunteerNo%")
            ->fetchAll();

        if(!$volunteers) return false;

        return $volunteers;
    } 
    public function queryByIDcard($IDcard){   
        
        $volunteers = $this->dao->select('*')
            ->from(TABLE_VOLUNTEER)
            ->where('id_card')->like("%$IDcard%")
            ->fetchAll();

        if(!$volunteers) return false;

        return $volunteers;
    } 


    /** 
     * Get volunteer list.
     * 
     * @param  string  $type 
     * @param  array   $categories 
     * @param  string  $orderBy 
     * @param  object  $pager 
     * @access public
     * @return array
     */
    public function getList($orderBy, $pager = null)
    {
        $volunteers = $this->dao->select('*')->from(TABLE_VOLUNTEER)
            ->beginIf(defined('RUN_MODE') and RUN_MODE == 'front')
            ->where('addedDate')->le(helper::now())
            ->andWhere('status')->eq('normal')
            ->fi()
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('id');
        if(!$volunteers) return array();

        return $volunteers;
    }


    /**
     * Delete an volunteer.
     * 
     * @param  int      $volunteerID 
     * @access public
     * @return void
     */
    public function delete($volunteerID, $null = null)
    {
        $volunteer = $this->getByID($volunteerID);
        if(!$volunteer) return false;

        // $this->dao->delete()->from(TABLE_RELATION)->where('id')->eq($volunteerID)->andWhere('type')->eq($volunteer->type)->exec();
        $this->dao->delete()->from(TABLE_VOLUNTEER)->where('id')->eq($volunteerID)->exec();

        return !dao::isError();
    }



    /**
     * Update an volunteer.
     * 
     * @param string   $volunteerID 
     * @access public
     * @return void
     */
    public function update($volunteerID)
    {
        $volunteer  = $this->getByID($volunteerID);

        $volunteer = fixer::input('post')
            ->add('editedDate', helper::now())
            ->get();

        $this->dao->update(TABLE_VOLUNTEER)
            ->data($volunteer)
            ->autoCheck()
            ->where('id')->eq($volunteerID)
            ->exec();

        if(dao::isError()) return false;

        return !dao::isError();
    }
}
