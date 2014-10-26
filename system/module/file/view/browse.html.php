<?php include '../../common/view/header.modal.html.php';?>
<table class='table table-bordered'>
  <thead>
    <tr>
      <th class='text-center w-60px'><?php echo $lang->file->id;?></th>
      <th class='text-center'><?php echo $lang->file->common;?></th>
      <th class='text-center w-60px'><?php echo $lang->file->extension;?></th>
      <th class='text-center w-80px'><?php echo $lang->file->size;?></th>
      <th class='text-center w-100px'><?php echo $lang->file->addedBy;?></th>
      <th class='text-center w-160px'><?php echo $lang->file->addedDate;?></th>
      <th class='text-center w-150px'><?php echo $lang->actions;?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($files as $file):?>
    <tr class='text-center text-middle'>
      <td><?php echo $file->id;?></td>
      <td>
        <?php
        if($file->isImage)
        {
            echo html::a(inlink('download', "id=$file->id"), html::image($file->smallURL, "class='image-small' title='{$file->title}'"), "target='_blank'");
            if($file->primary == 1) echo '<small class="label label-success">'. $lang->file->primary .'</small>';
        }
        else
        {
            echo html::a(inlink('download', "id=$file->id"), "{$file->title}.{$file->extension}", "target='_blank'");
        }
        ?>
      </td>
      <td><?php echo $file->extension;?></td>
      <td><?php echo number_format($file->size / 1024 , 1) . 'K';?></td>
      <td><?php echo isset($users[$file->addedBy]) ? $users[$file->addedBy] : '';?></td>
      <td><?php echo $file->addedDate;?></td>
      <td class='text-center'>
      <?php
      echo html::a(inlink('edit',   "id=$file->id"), $lang->edit, "class='edit'");
      echo html::a(inlink('delete', "id=$file->id"), $lang->delete, "class='deleter'");
      if($file->isImage) echo html::a(inlink('setPrimary', "id=$file->id"), $lang->file->setPrimary, "class='option'");
      ?>
      </td>
    </tr>
    <?php endforeach;?>          
  </tbody>

</table>
<form id="fileForm" method='post' enctype='multipart/form-data' action='<?php echo inlink('upload', "objectType=$objectType&objectID=$objectID");?>'>
  <table class='table table-form'>
    <?php if($writeable):?>
    <tr>
      <td class='text-middle w-100px'><?php echo $lang->file->common . $lang->file->limit;?></td>
      <td><?php echo $this->fetch('file', 'buildForm');?></td>
    </tr>
    <tr><td colspan='2' class='text-center'><?php echo html::submitButton();?></td></tr>
    <?php else:?>
    <tr><td colspan='2'><h5 class='text-danger'><?php echo $lang->file->errorUnwritable;?></h5></td></tr>
    <?php endif;?>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
