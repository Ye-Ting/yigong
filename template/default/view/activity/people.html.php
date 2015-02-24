<?php
js::set('objectType', $objectType);
js::set('objectID',   $objectID);
if(isset($pageCSS)) css::internal($pageCSS);
?>
<?php if(isset($peoples) and $peoples):?>
<div class='panel'>
  <div class='panel-heading'>
    <div class='panel-actions'><a href='#peopleForm' class='btn btn-primary'><i class='icon-people-alt'></i> <?php echo $lang->message->post; ?></a></div>
    <strong><i class='icon-peoples'></i> <?php echo $lang->message->list;?></strong>
  </div>
  <div class='panel-body'>
    <div class='peoples-list'>
      <?php foreach($peoples as $number => $people):?>
      <div class='people' id="people<?php echo $people->id?>">
        <div class='content clearfix'>
          <div class='text'>
            <span class='author'>
              <strong><i class='icon-user text-muted'></i> <?php echo $people->from;?></strong>
            </span> 
            <small>(<?php echo formatTime($people->date, 'Y-m-d H:i');?>)<?php echo $lang->colon;?></small>&nbsp;
            <p>
              <?php echo nl2br($people->content);?>
              <span class='pull-right'><?php echo html::a($this->createLink('message', 'reply', "messageID=$people->id"), $lang->message->reply, "id='reply' data-type='iframe'");?></span>
            </p>
          </div>
        </div>
        <?php //$this->message->getFrontReplies($people);?>
      </div>
      <?php endforeach; ?>
    </div>
    <div class='pager clearfix' id='pager'><?php $pager->show('right', 'shortest');?></div>
  </div>
</div>
<?php endif;?>

<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-people-alt'></i> <?php echo $lang->message->post;?></strong></div>
  <div class='panel-body'>
    <form method='post' class='form-horizontal' id='peopleForm' action="<?php echo $this->createLink('message', 'post', 'type=people');?>">
      <?php if($this->session->user->account == 'guest'): ?>
      <div class='form-group'>
        <label for='from' class='col-sm-1 control-label'><?php echo $lang->message->from; ?></label>
        <div class='col-sm-5 required'>
          <?php echo html::input('from', '', "class='form-control'"); ?>
        </div>
      </div>
      <div class='form-group'>
        <label for='email' class='col-sm-1 control-label'><?php echo $lang->message->email; ?></label>
        <div class='col-sm-5'>
          <?php echo html::input('email', '', "class='form-control'"); ?>
        </div>
        <div class='col-sm-5'>
          <label class='checkbox'><input type='checkbox' name='receiveEmail' value='1' checked /> <?php echo $lang->people->receiveEmail; ?></label>
        </div>
      </div>
      <?php else: ?>
      <div class='form-group'>
        <label for='from' class='col-sm-1 control-label'><?php echo $lang->message->from; ?></label>
        <div class='col-sm-11'>
          <div class='signed-user-info pull-left'>
            <i class='icon-user text-muted'></i> <strong><?php echo $this->session->user->realname ;?></strong>
            <?php echo html::hidden('from', $this->session->user->realname);?>
            <?php if($this->session->user->email != ''): ?>
            <span class='text-muted'>&nbsp;(<?php echo $this->session->user->email;?>)</span>
            <?php echo html::hidden('email', $this->session->user->email); ?>
            <?php endif; ?>
          </div>
          <label class='checkbox pull-left'><input type='checkbox' name='receiveEmail' value='1' checked /> <?php echo $lang->people->receiveEmail; ?></label>
        </div>
      </div>
      <?php endif; ?>
      <div class='form-group'>
        <label for='content' class='col-sm-1 control-label'><?php echo $lang->message->content; ?></label>
        <div class='col-sm-11 required'>
          <?php
          echo html::textarea('content', '', "class='form-control'");
          echo html::hidden('objectType', $objectType);
          echo html::hidden('objectID', $objectID);
          ?>
        </div>
      </div>
      <div class='form-group hiding' id='captchaBox'></div>
      <div class='form-group'>
        <div class='col-sm-11 col-sm-offset-1'>
          <span><?php echo html::submitButton();?></span>
          <span><small class="text-important"><?php echo $lang->people->needCheck;?></small></span>
        </div>
      </div>
    </form>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
