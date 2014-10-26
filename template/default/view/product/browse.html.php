<?php
/**
 * The browse view file of product of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php 
include TPL_ROOT . 'common/header.html.php';
$path = isset($category->pathNames) ? array_keys($category->pathNames) : array(0);
js::set('path', $path);
js::set('categoryID', $category->id);

include TPL_ROOT . 'common/treeview.html.php';
?>
<?php echo $common->printPositionBar($category, isset($product) ? $product : '');?>
<div class='row'>
  <div class='col-md-9 col-main'>
    <div class='list list-condensed'>
      <header><h2><i class='icon-th'></i> <?php echo $category->name;?></h2></header>
      <section class='cards cards-products cards-borderless'>
        <?php foreach($products as $product):?>
        <div class='col-sm-4 col-xs-6'>
          <div class='card'>
            <?php 
            if(empty($product->image)) 
            {
                echo html::a(inlink('view', "id=$product->id", "category={$category->alias}&name=$product->alias"), '<div class="media-placeholder" data-id="' . $product->id . '">' . $product->name . '</div>', "class='media-wrapper'");
            }
            else
            {
                $title = $product->image->primary->title ? $product->image->primary->title : $product->name;
                echo html::a(inlink('view', "id=$product->id", "category={$category->alias}&name=$product->alias"), html::image($product->image->primary->middleURL, "title='{$title}' alt='{$product->name}'"), "class='media-wrapper'");
            }
            ?>
            <div class='card-info'><span class="label label-success label-badge" title='<?php echo $lang->product->views;?>'><?php echo $product->views;?></span></div>
            <div class='card-heading'>
              <?php echo html::a(inlink('view', "id={$product->id}", "category={$category->alias}&name=$product->alias"), '<strong>' . $product->name . '</strong>');?>
              <span class='card-content text-latin'>
              <?php
              if($product->promotion != 0)
              {
                  echo "<strong class='text-muted'>"  .'</strong>';
                  echo "<strong class='text-danger'>" . $this->config->product->currency . $product->promotion . '</strong>&nbsp;&nbsp;';
              }
              else
              {
                  if($product->price != 0)
                  {
                      echo "<strong class='text-danger'>" . $this->config->product->currency . $product->price . '</strong>&nbsp;&nbsp;';
                  }
              }
              ?>
              </span>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </section>
      <footer class='clearfix'>
        <?php $pager->show('right', 'short');?>
      </footer>
    </div>
  </div>
  <div class='col-md-3 col-side'>
    <side class='page-side'><?php $this->block->printRegion($layouts, 'product_browse', 'side');?></side>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
