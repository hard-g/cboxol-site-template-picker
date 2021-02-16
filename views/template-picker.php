<div class="panel panel-default panel-template-picker">
	<div class="panel-heading"><?php esc_html_e( 'Associated Site Template', 'cboxol-site-template-picker' ); ?></div>
	<div class="panel-body">
		<div class="site-template-categories">
			<label for="site-template-categories"><?php esc_html_e( 'Filter by Category:', 'cboxol-site-template-picker' ); ?></label>
			<select class="form-control" name="site-template-categories" id="site-template-categories">
				<option value="0"><?php esc_html_e( 'All Categories', 'cboxol-site-template-picker' ); ?></option>
				<?php foreach ( $categories as $category ) : ?>
					<option value="<?php echo esc_attr( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="site-template-picker">
			<p><?php esc_html_e( 'Loading Templates...', 'cboxol-site-template-picker' ); ?></p>
		</div>
	</div>
</div>
