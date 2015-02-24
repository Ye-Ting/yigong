<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<?php include '../../common/view/chosen.html.php';?>

<div class="panel panel-default activity">
	<div class="panel-heading">江市义务工作者联合会义工服务记录</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-4">
				<div class="form-group">
				  <label class="col-sm-3 text-center">义工号</label>
				  <div class="col-sm-9">
				    <input id="volunteer_keword" type="text" class="form-control"  placeholder="义工编号">
				  </div>
				</div>
			</div>
			<!-- <div class="col-xs-3">
				姓名:
				<input type="text"></div>
			<div class="col-xs-3">
				组别:
				<input type="text"></div> -->
			<div class="col-xs-3">
				<button class="search_volunteer btn btn-info">查询</button>
			</div>
		</div>
		<hr>
		<div  class="row" id="volunteer_select" style="display: none;">
			<div class="col-xs-12" id="volunteer_result">
				<table class="table" >
					<tr>
						<th class="text-center">义工号</th>
						<th class="text-center">身份证号</th>
						<th class="text-center">姓名</th>
						<th class="text-center">联系方式</th>
						<th class="text-center">选择</th>
					</tr>
					<tbody id="volunteer_result_table">
						
					</tbody>
				</table>
			</div>
			<div class="col-xs-12">

			<a data-toggle="collapse" data-target="#create_volunteer" class="text-info">没有找到? 那就创建一个</a>
			
			<form id="create_volunteer" class="collapse" action="<?php echo $this->createLink('volunteer','create');?>" method="post" >
				<table  class="table " >
					<tr>
						<th class="text-center">义工号</th>
						<th class="text-center">身份证号</th>
						<th class="text-center">姓名</th>
						<th class="text-center">联系方式</th>
						<th class="text-center">操作</th>
					</tr>
					<tr>
						<td>
							<div class='required required-wrapper'></div>
							<?php echo html::input('volunteer_no', '', "class='form-control' placeholder='义工号'");?>
							<!-- <input type="text" class="form-control"  placeholder="义工号"> -->
						</td>
						<td>
							<div class='required required-wrapper'></div>
							<?php echo html::input('id_card', '', "class='form-control' placeholder='身份证号'");?>
							<!-- <input type="text" class="form-control" placeholder="身份证号"> -->
						</td>
						<td>
							<div class='required required-wrapper'></div>
							<?php echo html::input('name', '', "class='form-control' placeholder='姓名'");?>
							<!-- <input type="text" class="form-control"  placeholder="姓名"> -->
						</td>
						<td>
							<div class='required required-wrapper'></div>
							<?php echo html::input('phone', '', "class='form-control' placeholder='联系方式'");?>
							<!-- <input type="text" class="form-control" placeholder="联系方式"> -->
						</td>
						<td class="text-center"> <button class="btn btn-success">创建</button> </td>
					</tr>
				</table>
			</form>
				
				
			</div>
		</div>
		
		<div id="volunteer_info">
			
		</div>
	</div>
	<form method='post' role='form' id='ajaxForm'>
		<hr>
		<div>
			<?php echo html::hidden("volunteer_id") ?>
			
		</div>
		<table class="table ">
			<thead>
				<tr>
					<th class="col-xs-2 text-center">活动名称</th>
					<!-- <th class="col-xs-2 text-center">活动时间</th> -->
					<!-- <th class="col-xs-2 text-center">活动地点</th> -->
					<th class="col-xs-2 text-center">参加义工服务主要内容</th>
					<th class="col-xs-2 text-center">服务小时数</th>
					<th class="col-xs-2 text-center">备注</th>
				</tr>
			</thead>
			<tbody>

				<?php for ($i=0; $i < 8; $i++) { ?>
				<tr>
					<td >
						<div class='required required-wrapper'></div>
						<?php echo html::select("activities[]", $activities, "", " class='form-control chosen' data-placeholder='选择活动...'");?></td>
					<!-- <td class="text-center">
						<input type="text" class="form-info"></td> -->
					<!-- <td class="text-center">
						<input type="text" class="form-info"></td> -->
					<td class="text-center">
						<div class='required required-wrapper'></div>
						<input type="text" name="content[]" class="form-control"></td>
					<td class="text-center">
						<div class='required required-wrapper'></div>
						<input type="number" name="hour[]" class="form-control"></td>
					<td class="text-center">
						<input type="text" name="mark[]" class="form-control"></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div>
			<label id="people"></label>
			<label id="activities"></label>
			<label id="content"></label>
			<label id="hour"></label>
			<label id="mark"></label>
		</div>
		<div class="panel-body text-right">
			<!-- <input id="people" type="hidden"  value=""> -->
		
			<!-- <button class="btn btn-success btn-lg">提交</button> -->
			<?php echo html::submitButton('提交');?>
		</div>
	</form>
</div> 
<b>备注：</b>
<p>申请加入义工义务工作服务满20小时，发予《义工服务工作证》；义务服务满100小时发予电子版《义工服务工作卡》。</p>
<p>义务工作服务时间将会计入“爱心储蓄银行”系统，可作为本人之所需义务服务回报。</p>
<p>
	对于长期从事义工，积极热情投身义工服务者，将有机会参加《年度优秀义工》评选，《内江十佳义工》评选，《优秀市长奖义工》评选，给于奖励和提升。
</p>

<?php include '../../common/view/footer.admin.html.php';?>