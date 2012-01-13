<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2>Pages</h2>

		<table>
			<colgroup>
				<col />
				<col />
				<col />
				<col />
				<col />
				<col />
				<col />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th>ID</th>
					<th>&mdash;</th>
					<th>Name</th>
					<th>Permalink</th>
					<th>Preview</th>
					<th>Status</th>
					<th>Last Updated</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php echo Modules::run('page/admin/retrieve', 'table-row'); ?>
			</tbody>	
		</table>
		
		<div class="pagination" style="margin-top: 15px;">
			<ul>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
			</ul>
		</div>
		
		<ul class="admin-options">
			<li><?php echo anchor('admin/page/create', 'New Page', array('class' => 'button')); ?></li>
		</ul>

<?php $this->load->view('admin/common/footer.include.php'); ?>