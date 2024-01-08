<div class="form-row" id="{{ $divId }}" hidden>
    <div class="col-6 form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary dropdown-toggle subtype-action-btn" type="button"
                    data-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                </button>
                <div class="dropdown-menu subtype-action-select">
                    <a class="dropdown-item add-field">Add Field</a>
                    <a class="dropdown-item del-field">Delete Field</a>
                    <a class="dropdown-item del-subtype" hidden>Delete {{ $label }}</a>
                </div>
            </div>
            <select class="form-control custom-select subtype-select" name="{{ $selectArr }}">
                <option selected disabled>Select {{ $label }}</option>
                @foreach ($subtypes as $subtype)
                <option value="{{ $subtype->id }}" {{ old('account_type')==$subtype->id ?
                    'selected' : '' }}>
                    {{ $subtype->description }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-row" id="{{ $existingSubtypeId }}" hidden>
    @unless (count($existingSubtypeData) == 0)
    <div class="col-12 pt-2">
        <p>Existing {{ $label }}s</p>
    </div>
    @endunless
    @foreach ($existingSubtypeData as $value)
    <div class="col-6 form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <button data-toggle="button" aria-pressed="false"
                    class="btn btn-outline-danger existing-subtype-action-btn" type="button"><i
                        data-feather="minus-circle"></i></button>
            </div>
            <input readonly type="text" class="form-control existing-subtype-field" id="{{ $value->id }}"
                value="{{ $value->description }}">
        </div>
    </div>
    @endforeach
    <div class="col-6 form-group subtype-for-del"></div>
</div>