<div class="accountfields" hidden>
	<!-- Account type dropdown field -->
	<div class="form-row">
		<div class="col-6 form-group">
			<label for="account_type">Account Types<span class="required">*</span></label>
			<select name="account_type" id="account_type" class="form-control">
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

	<!-- Sap role fields -->
	<div class="form-row" id="sap_role_field_base" hidden>
		<div class="col-6 form-group">
			<div class="input-group">
				<!-- Add field row button -->
				<div class="input-group-prepend add-field">
					<label class="input-group-text">
						<!-- <i data-feather="plus" class="field-row-add-icon"></i> -->
						+
					</label>
				</div>
				<select name="sap_role[]" class="form-control custom-select">
					<option selected disabled>Select SAP Role</option>
					@foreach ($sapRoles as $sapRole)
					<option value="{{ $sapRole->id }}" {{ old('account_type')==$sapRole->id ?
						'selected' : '' }}>
						{{ $sapRole->description }}
					</option>
					@endforeach
				</select>
				<div class="input-group-append delete-field">
					<label class="input-group-text">
						<!-- <i data-feather="minus" class="field-row-delete-icon"></i> -->
						-
					</label>
				</div>
			</div>
		</div>
		<div class="col-6"></div>
	</div>
	<div class="form-row" id="sap_role_fields" hidden></div>

	<!-- Salesforce role fields -->
	<div class="form-row" id="salesforce_profile_field_base" hidden>
		<div class="col-6 form-group">
			<div class="input-group">
				<!-- Add field row button -->
				<div class="input-group-prepend add-field">
					<label class="input-group-text">
						<!-- <i data-feather="plus" class="field-row-add-icon"></i> -->
						+
					</label>
				</div>
				<select name="salesforce_profile[]" class="form-control custom-select">
					<option selected disabled>Select Salesforce Profile</option>
					@foreach ($salesforceProfiles as $salesforceProfile)
					<option value="{{ $salesforceProfile->id }}" {{ old('account_type')==$salesforceProfile->id ?
						'selected' : '' }}>
						{{ $salesforceProfile->description }}
					</option>
					@endforeach
				</select>
				<div class="input-group-append delete-field">
					<label class="input-group-text">
						<!-- <i data-feather="minus" class="field-row-delete-icon"></i> -->
						-
					</label>
				</div>
			</div>
		</div>
		<div class="col-6"></div>
	</div>
	<div class="form-row" id="salesforce_profile_fields" hidden></div>

	<!-- Approvers sequence -->
	@include('reusables.approvers')
</div>