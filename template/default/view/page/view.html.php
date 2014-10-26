<?php 
include TPL_ROOT . 'common/header.html.php'; 
include TPL_ROOT . 'common/treeview.html.php'; 
js::set('pageID', $page->id);
css::internal($page->css);
js::execute($page->js);
?>
<?php $common->printPositionBar($page);?>
<div class='row'>
  <?php if(!empty($layouts['page_view'])):?>
  <div class='col-md-9 col-main'>
  <?php else:?>
  <div class='col-md-12'>
  <?php endif;?>
    <div class='article'>
      <header>
        <h1><?php echo $page->title;?></h1>
      </header>
      <section class='article-content'>
        <?php echo $page->content;?>
      </section>
      <section>
        <?php $this->loadModel('file')->printFiles($page->files);?>
      </section>
      <footer>
        <?php if($page->keywords):?>
        <p class='small'><strong class="text-muted"><?php echo $lang->article->keywords;?></strong><span class="article-keywords"><?php echo $lang->colon . $page->keywords;?></span></p>
        <?php endif; ?>
      </footer>
    </div>
  </div>
  <?php if(!empty($layouts['page_view'])):?>
  <div class='col-md-3 col-side'><?php $this->block->printRegion($layouts, 'page_view', 'side');?></div>
  <?php endif;?>
</div>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
