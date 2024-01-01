<div class="accountfields" hidden>
	<div class="form-row">
		<!-- Account type dropdown field -->
		<div class="col-6 form-group">
			<label for="account_type">Account Types<span class="required">*</span></label>
			<select name="account_type" id="account_type" class="form-control">
				<option selected disabled>Select Account Types</option>
				@foreach ($accountTypes as $accountType)
				<option value="{{ $accountType->id }}" {{ old('account_type')==$accountType->id ?
					'selected' : '' }}>
					{{ $accountType->description }} - ¥ {{ $accountType->current_charge }}
				</option>
				@endforeach
			</select>
			@error('account_type')
			<small class="form-text text-danger">{{ $message }}</small>
			@enderror
		</div>
		<div class="col form-group" hidden>
			<input hidden name="approver" id="approver" class="form-control" value="{{ $deptHead->id ?? '' }}" />
		</div>
	</div>
	<!-- Approvers sequence -->
	@include('reusables.approvers')
</div>