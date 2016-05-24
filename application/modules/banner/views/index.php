<div>
	<h1 class="page-header">Banner</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
<!--	<table class="table table-striped table-bordered">
		<thead>
		
			
		<th>Description</th>
		<th>Image</th>
		
		</thead>
		<tbody>-->
		
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;
                        $bannerimagePath=FCPATH."assets/uploads/banner/original/".$record['image'];
                        if(file_exists($bannerimagePath))
                        {
                            $bannerimage=  base_url()."assets/uploads/banner/".$record['image'];
                        }
                        else{
                            $bannerimage= base_url()."assets/images/no_image.jpg";
                        }
                        echo $record['description']."<br/>";
                        ?>
                       <img src="<?php echo $bannerimage;?>"><br/>


<!--			<tr>-->
			<?php /* foreach($record as $field => $value) : ?>
				
				<?php if ($field != 'id') : ?>
					<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('banner_true') : lang('banner_false')) : $value; ?></td>
				<?php endif; ?>
				
			<?php endforeach; */?>

<!--			</tr>-->
		<?php endforeach; ?>
<!--		</tbody>
	</table>-->
<?php endif; ?>