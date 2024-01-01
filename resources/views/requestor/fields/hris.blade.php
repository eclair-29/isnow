<div class="hrisfields" hidden>
	<div class="form-row">
		<!-- Supervisors dropdown field -->
		<div class="col-6 form-group">
			<label for="supervisor">Supervisor<span class="required">*</span></label>
			<select name="approver" id="approver" class="form-control">
				<option selected disabled>Select Supervisor</option>
				@foreach ($supervisors as $supervisor)
				<option value="{{ $supervisor->id }}" {{ old('supervisor')==$supervisor->id ?
					'selected' : '' }}>{{ $supervisor->user->name }}</option>
				@endforeach
			</select>
			@error('approver')
			<small class="form-text text-danger">{{ $message }}</small>
			@enderror
		</div>
	</div>
</div>