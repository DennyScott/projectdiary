<div class="container">
	<div class="diary-content">

		<?php if(isset($_SESSION["user"])){ ?>
		<div class="row">
			<form method='post' action='<?php echo URL; ?>diary/addEntry'>
				<input type="hidden" name="storeID" id="storeID" value="<?php echo $project_id; ?>">	
				<div class="col-xs-offset-2 col-xs-8">
					<div class="addentry" id="addentry">
						<h3>Add Entry</h3>
					</div>
				</div>
			</form>
		</div>
		<?php } ?>

		<?php foreach ($entries as $entry) { ?>
			<hr>
			<div class="diary">
				<div class="row date">
					<h2 class="col-xs-12"> <?php echo $entry->name; ?></h2>
					<h3 class="col-xs-12"><small><?php echo $entry->updated; ?></small></h3>
				</div>
				<div class="row entry">
					<?php echo $entry->data; ?>
				</div>
			</div>
		<?php } ?>



	</div>
</div>
