<div class="form-group" hidden>
	<input hidden name="user_id" id="user_id" class="form-control" value="{{ $user->id }}" />
	<input hidden name="status_id" id="status_id" class="form-control" />
</div>
<div class="form-row">
	<div class="col-5 form-group">
		<label for="staff_id">Requestor ID</label>
		<input readonly name="staff_id" id="staff_id" class="form-control" value="{{ $user->staff_id }}" />
	</div>

	<div class="col-5 form-group">
		<label for="requestor">Requestor</label>
		<input readonly name="requestor" id="requestor" class="form-control" value="{{ $user->name }}" />
	</div>

	<div class="col-2 form-group">
		<label for="site_code">Site</label>
		<input readonly name="site_code" id="site_code" class="form-control" value="{{ $user->site->site_code }}" />
	</div>
</div>

<div class="form-row">
	<div class="col form-group">
		<label for="division">Division</label>
		<input readonly name="division" id="division" class="form-control" value="{{ $user->division->description }}" />
	</div>

	<div class="col form-group">
		<label for="dept">Dept.</label>
		<input readonly name="dept" id="dept" class="form-control" value="{{ $user->dept->description }}" />
	</div>

	<div class="col form-group">
		<label for="staff_status">Status</label>
		<input readonly name="staff_status" id="staff_status" class="form-control"
			value="{{ $user->status->description }}" />
	</div>
</div>