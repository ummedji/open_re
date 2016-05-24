<div>
	<h1 class="page-header">Social Media</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) :
 
    ?>
	
		
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;
                               //var_dump($record);
                        $imagePath=FCPATH."assets/uploads/socialmedia/".$record['image'];
                        if(file_exists($imagePath))
                        {
                            $socialImage=base_url()."assets/uploads/socialmedia/".$record['image'];
                        }else{
                             $socialImage=base_url()."assets/images/no_image.jpg";
                        }
                        ?>
                    
                <img src="<?php echo $socialImage;?>">
                <a href="<?php echo $record['link'];?>" target="_blank"><?php echo $record['label'];?></a><br/>

		<?php endforeach; ?>

<?php endif; ?>