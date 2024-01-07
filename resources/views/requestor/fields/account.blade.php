<div class="accountfields" hidden>
	<!-- Account type dropdown field -->
	<div class="form-row" hidden id="account_types">
		<div class="col-6 form-group">
			<label for="account_type">Account Types<span class="required">*</span></label>
			<select name="account_type" id="account_type" class="form-control custom-select">
				<option selected disabled>Select Account Types</option>
				@foreach ($accountTypes as $accountType)
				<option value="{{ $accountType->id }}" {{ old('account_type')==$accountType->id ?
					'selected' : '' }}>
					{{ $accountType->description }} - ¥{{ $accountType->current_charge }}
				</option>
				@endforeach
			</select>
			@error('account_type')
			<small class="form-text text-danger">{{ $message }}</small>
			@enderror
		</div>
		<div class="col-6 form-group">
			<label for="charges">Charges</label>
			<input readonly class="form-control-plaintext" type="text" name="charges" id="charges" value="¥0">
		</div>
		<div class="col form-group" hidden>
			<input hidden name="approver" id="approver" class="form-control" value="{{ $deptHead->id ?? '' }}" />
		</div>
	</div>

	<!-- Account: SAP subtypes dropdown -->
	@subtypeselect
	@slot('selectArr', 'sap_role[]')
	@slot('existingArr', 'existing_sap_role[]')
	@slot('existingSubtypeId', 'existing_sap_roles')
	@slot('existingSubtypeData', $existingSapRoles)
	@slot('divId', 'sap_roles')
	@slot('label', 'SAP Role')
	@slot('subtypes', $sapRoles)
	@endsubtypeselect

	@subtypeselect
	@slot('selectArr', 'salesforce_subtype[]')
	@slot('existingArr', 'existing_salesforce_subtype[]')
	@slot('existingSubtypeId', 'existing_salesforce_subtypes')
	@slot('existingSubtypeData', $existingSalesforceProfiles)
	@slot('divId', 'salesforce_subtypes')
	@slot('label', 'Salesforce Profile')
	@slot('subtypes', $salesforceProfiles)
	@endsubtypeselect

	<!-- Approvers sequence -->
	@include('reusables.approvers')
</div>