@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @requestdetails
                @slot('data', $request)
                @endrequestdetails

                <form action="{{ route('approvals.update', $request->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" hidden id="approved_notes" name="approved_notes">
                    <input type="text" hidden id="rejected_notes" name="rejected_notes">

                    <div class="row pt-4">
                        <div class="col d-flex justify-content-end">
                            <button {{ $disableBtns }} type="submit" class="btn btn-outline-primary ml-2" name="action"
                                id="approve_btn" value="approved">Approve</button>
                            <button {{ $disableBtns }} type="submit" class="btn btn-outline-danger ml-2" name="action"
                                id="reject_btn" value="rejected">Reject</button>
                        </div>
                    </div>
                </form>
            </div> <!-- END: card-body -->
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/approvals.js') }}"></script>
<script src="{{ asset('js/approvalnotes.js') }}"></script>
@endsection