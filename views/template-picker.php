<div class="panel panel-default panel-template-picker">
	<div class="panel-heading"><?php esc_html_e( 'Associated Site Template' ); ?></div>
	<div class="panel-body">
		<div class="site-template-categories">
			<label for="site-template-categories">Filter by Category:</label>
			<select class="form-control" name="site-template-categories" id="site-template-categories">
				<option value="0">All Categories</option>
				<?php foreach ( $categories as $category ) : ?>
					<option value="<?php echo esc_attr( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="site-template-picker">
			<p>Loading Templates...</p>
		</div>
	</div>
</div>
