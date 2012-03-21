
	<div class="clearfix">

		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset>
			
				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
				
				<?php if(isset($calendar)): ?>
				<input type="hidden" name="event_calendar_id" id="event_calendar_id" value="<?php echo $calendar->id(); ?>">
				<?php endif; ?>
				
				<?php echo Modules::run('image/resource/hook', 'event', isset($event) ? $event->id() : null); ?>
				
				<div class="row required<?php $this->form_validation->earmark('event_name'); ?>">
					<label for="event_name">Name</label>
					<span><input type="text" name="event_name" id="event_name" value="<?php echo $this->form_validation->value('event_name', isset($event) ? $event->name() : ''); ?>" /></span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('news_date_published'); ?>">
					
					<label for="event_date">Date</label>
					<span>
						<input type="text" class="date-picker" name="event_date" id="event_date" value="<?php echo $this->form_validation->value('event_date', isset($event) ? $event->date('Y-m-d') : date('Y-m-d')); ?>">
						<a href="#" class="icon icon-calendar date-picker-icon" title="Select Date" style="display: inline-block;">Select Date</a>
					</span>
				</div>
				
				<div class="row required ck-default<?php $this->form_validation->earmark('event_description'); ?> ck-close-toolbar">
					<label for="event_description">Description</label>
					<textarea name="event_description" id="event_description" rows="4" cols="20"><?php echo $this->form_validation->value('event_description', isset($event) ? $event->description() : ''); ?></textarea>
				</div>
			
				<div class="row button-row">
					<input type="submit" value="Save" />
				</div>
			
			</fieldset>

		</form>

	</div>
