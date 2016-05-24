<div>
	<h1 class="page-header">Menu</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table class="table table-striped table-bordered">
		<thead>
		
			
		<th>Title</th>
		<th>Alias</th>
		<th>Link</th>
		<th>Parent</th>
		<th>Navigation</th>
		<th>Target Window</th>
		<th>Image</th>
		<th>Access</th>
		<th>Meta title</th>
		<th>Meta Keyword</th>
		<th>Meta Description</th>
		
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
			<?php foreach($record as $field => $value) : ?>
				
				<?php if ($field != 'id') : ?>
					<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('menu_true') : lang('menu_false')) : $value; ?></td>
				<?php endif; ?>
				
			<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>