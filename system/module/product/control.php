<?php
/**
 * The control file of product module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class product extends control
{

    public function __construct()
    {
        parent::__construct();
        if(RUN_MODE == 'admin')
        {
            $this->view->treeModuleMenu = $this->loadModel('tree')->getTreeMenu('product', 0, array('treeModel', 'createAdminLink'));
            $this->view->treeManageLink = html::a(helper::createLink('tree', 'browse', "type=product"), $this->lang->tree->manage);
        }
    }

    /**
     * Index page of product module.
     * 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function index($pageID = 1)
    {
        /* Display browse page. */
        $this->locate($this->inlink('browse', "categoryID=0&pageID={$pageID}"));
    }

    /** 
     * Browse product in front.
     * 
     * @param int    $categoryID   the category id
     * @param int    $pageID       current page id
     * @access public
     * @return void
     */
    public function browse($categoryID = 0, $pageID = 1)
    {  
        $category = $this->loadModel('tree')->getByID($categoryID, 'product');

        if($category && $category->link) helper::header301($category->link);

        $this->app->loadClass('pager', $static = true);
        $pager = new pager(0, $this->config->product->recPerPage, $pageID);

        $categoryID = is_numeric($categoryID) ? $categoryID : $category->id;
        $products   = $this->product->getList($this->tree->getFamily($categoryID), '`order` desc', $pager);

        if(!$category and $categoryID != 0) die($this->fetch('error', 'index'));

        if($categoryID == 0)
        {
            $category = new stdclass();
            $category->id       = 0;
            $category->name     = $this->lang->product->home;
            $category->alias    = '';
            $category->keywords = '';
            $category->desc     = '';
        }

        $title    = $category->name;
        $keywords = trim($category->keywords . ' ' . $this->config->site->keywords);
        $desc     = strip_tags($category->desc) . ' ';
        $this->session->set('productCategory', $category->id);

        $this->view->title     = $title;
        $this->view->keywords  = $keywords;
        $this->view->desc      = $desc;
        $this->view->category  = $category;
        $this->view->products  = $products;
        $this->view->pager     = $pager;
        $this->view->contact   = $this->loadModel('company')->getContact();

        $this->display();
    }

    /**
     * Browse product in admin.
     * 
     * @param int    $categoryID  the category id
     * @param string $orderBy     the order by
     * @param int    $recTotal 
     * @param int    $recPerPage 
     * @param int    $pageID 
     * @access public
     * @return void
     */
    public function admin($categoryID = 0, $orderBy = '`order` desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {   
        /* Set the session. */
        $this->session->set('productList', $this->app->getURI(true));

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);
        
        $families = '';
        if($categoryID) $families = $this->loadModel('tree')->getFamily($categoryID, 'product');
        $products = $this->product->getList($families, $orderBy, $pager);

        $this->view->title          = $this->lang->product->admin;
        $this->view->products       = $products;
        $this->view->pager          = $pager;
        $this->view->categoryID     = $categoryID;
        $this->view->orderBy        = $orderBy;
        $this->display();
    }   

    /**
     * Create a product.
     * 
     * @param int    $categoryID  
     * @access public
     * @return void
     */
    public function create($categoryID = '')
    {
        $categories = $this->loadModel('tree')->getOptionMenu('product', 0, $removeRoot = true);
        if(empty($categories))
        {
            die(js::locate($this->createLink('tree', 'redirect', 'type=product')));
        }

        if($_POST)
        {
            $productID = $this->product->create();       
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('admin')));
        }

        $maxID = $this->dao->select('max(id) as maxID')->from(TABLE_PRODUCT)->fetch('maxID');

        $this->view->title           = $this->lang->product->create;
        $this->view->currentCategory = $categoryID;
        $this->view->categories      = $categories;
        $this->view->order           = $maxID + 1;
        $this->display();
    }

    /**
     * Edit a product.
     * 
     * @param  int $productID 
     * @access public
     * @return void
     */
    public function edit($productID)
    {
        $categories = $this->loadModel('tree')->getOptionMenu('product', 0, $removeRoot = true);
        if(empty($categories))
        {
            die(js::alert($this->lang->tree->noCategories) . js::locate($this->createLink('tree', 'browse', 'type=product')));
        }

        if($_POST)
        {
            $this->product->update($productID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
        }

        $product = $this->product->getByID($productID);

        if(empty($product->attributes))
        {
            $attribute = new stdclass();
            $attribute->order = 0;
            $attribute->label = '';
            $attribute->value = '';

            $product->attributes = array($attribute);
        }

        $this->view->title          = $this->lang->product->edit;
        $this->view->product        = $product;
        $this->view->categories     = $categories;

        $this->display();
    }

    /**
     * Change status 
     * 
     * @param  int    $productID 
     * @param  string $status 
     * @access public
     * @return void
     */
    public function changeStatus($productID, $status)
    {
        $this->dao->update(TABLE_PRODUCT)->set('status')->eq($status)->where('id')->eq($productID)->exec();

        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success', 'locate' => $this->server->http_referer));
    }

    /**
     * Set currency. 
     * 
     * @access public
     * @return void
     */
    public function currency()
    {
        if($_POST)
        {
            $this->product->currency();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
        }

        $this->view->title = "<i class='icon-cog'></i> " . $this->lang->product->currency;
        $this->display();
    }

    /**
     * View a product.
     * 
     * @param int $productID 
     * @access public
     * @return void
     */
    public function view($productID)
    {
        $product = $this->product->getByID($productID);
        if(!$product) die($this->fetch('error', 'index'));

        /* fetch first category for display. */
        $category = array_slice($product->categories, 0, 1);
        $category = $category[0]->id;

        $currentCategory = $this->session->productCategory;
        if($currentCategory > 0)
        {
            if(isset($product->categories[$currentCategory]))
            {
                $category = $currentCategory;  
            }
            else
            {
                foreach($product->categories as $productCategory)
                {
                    if(strpos($productCategory->path, $currentCategory)) $category = $productCategory->id;
                }
            }
        }
        $category = $this->loadModel('tree')->getByID($category);

        $title    = $product->name . ' - ' . $category->name;
        $keywords = $product->keywords . ' ' . $category->keywords . ' ' . $this->config->site->keywords;
        $desc     = strip_tags($product->desc);
        
        $this->view->title       = $title;
        $this->view->keywords    = $keywords;
        $this->view->desc        = $desc;
        $this->view->product     = $product;
        $this->view->prevAndNext = $this->product->getPrevAndNext($product->order, $category->id);
        $this->view->category    = $category;
        $this->view->contact     = $this->loadModel('company')->getContact();

        $this->dao->update(TABLE_PRODUCT)->set('views = views + 1')->where('id')->eq($productID)->exec(false);

        $this->display();
    }

    /**
     * Delete a product.
     * 
     * @param  int      $productID 
     * @access public
     * @return void
     */
    public function delete($productID)
    {
        if($this->product->delete($productID)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Set css.
     * 
     * @param  int      $productID 
     * @access public
     * @return void
     */
    public function setCss($productID)
    {
        if($_POST)
        {
            if($this->product->setCss($productID)) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title   = $this->lang->product->css;
        $this->view->product = $this->product->getByID($productID);
        $this->display();
    }


    /**
     * Set js.
     * 
     * @param  int      $productID 
     * @access public
     * @return void
     */
    public function setJs($productID)
    {
        if($_POST)
        {
            if($this->product->setJs($productID)) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title   = $this->lang->product->js;
        $this->view->product = $this->product->getByID($productID);
        $this->display();
    }
}
