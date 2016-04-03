
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dashboard</h1>


	<h2 class="sub-header">Resume</h2>
	<div class="row">
		<br>
		
		<?php echo form_open('Search/search_site_url','class="form-inline"')?>
			<div class="form-group">
				<label for="exampleInputName2">Web Url Link Search</label>
				<div class="input-group">
					<div class="input-group-addon">http://</div>
					<input type="text" class="form-control" id="exampleInputName2"
						placeholder="www.siteweb.com" name="url" required>
				</div>
			</div>

			<button type="submit" class="btn btn-default">Scrap</button>
		<?php echo form_close();?>
	</div>
	<div class="row">
		<br>
		
		<?php echo form_open('Search/search_site','class="form-inline"')?>
			<div class="form-group">
				<label for="exampleInputName2">Web Url IMG Search</label>
				<div class="input-group">
					<div class="input-group-addon">http://</div>
					<input type="text" class="form-control" id="exampleInputName2"
						placeholder="www.siteweb.com" name="url" required>
				</div>
			</div>

			<button type="submit" class="btn btn-default">Scrap</button>
		<?php echo form_close();?>
	</div>
	<div class="row">
		<br>
		
		<?php echo form_open('Search/search_site','class="form-inline"')?>
			<div class="form-group">
				<label for="exampleInputName2">Web TAG Search</label>
				<div class="input-group">
					<div class="input-group-addon">http://</div>
					<input type="text" class="form-control" id="exampleInputName2"
						placeholder="www.siteweb.com" name="url" required>
				</div>
			</div>

			<button type="submit" class="btn btn-default">Scrap</button>
		<?php echo form_close();?>
	</div>
</div>