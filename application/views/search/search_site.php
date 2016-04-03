
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dashboard</h1>


	<h2 class="sub-header">Resume</h2>
	<div class="row">
		<br>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Site Url</th>
					<th>Status</th>
					<th>Save</th>
					<th>Explore</th>
					<th>Ignore</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ( $scrap as $scraping ) { ?>
				<tr>
					<td><?php echo $scraping->href ?></td>
					<td></td>
					<td><a href="<?php echo base_url('sites/profile')?>"><button>Profile</button></a></td>
					<td></td>
				</tr>
				<?php }?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>

	</div>
</div>