@extends('layout.master')

@push('plugin-styles')
  <!-- Plugin css import here -->
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Tables</a></li>
    <li class="breadcrumb-item active" aria-current="page">Basic Tables</li>
  </ol>
</nav>
@php 
  $modalExcel = "uploadExcel"; 
  $modalMessage = "messageCreate"; 
@endphp
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="card-title">Bordered table</h6>
          <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $modalExcel }}">
              Distribution
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $modalMessage }}">
              Message
            </button>
          </div>
        </div>
        <p class="text-muted mb-3">Add class <code>.table-bordered</code></p>
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                  Phone
                </th>
                <th>
                  Text
                </th>
                <th>
                  Messenger name
                </th>
                <th>
                  Status
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($messages as $message)
              <tr>
                <td>
                  #{{ $message->id }}
                </td>
                <td>
                  {{ $message->phone }}
                </td>
                <td>
                  {{ $message->text }}
                </td>
                <td>
                  {{ $message->messenger->name }}
                </td>
                <td>
                  {{ $message->status }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        {{ $messages->links('vendor.pagination.bootstrap-5') }}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="{{ $modalExcel }}" tabindex="-1" aria-labelledby="{{ $modalExcel }}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $modalExcel }}Title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <form action="{{ route('distribution.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Licenses:</label>
            <select class="form-select mb-3" name="license_id">
              @foreach($licenses as $license)
                <option value="{{ $license->id }}">{{ $license->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Messenger:</label>
            <select class="form-select mb-3" name="messenger_id">
              @foreach($messengers as $messenger)
                <option value="{{ $messenger->id }}">{{ $messenger->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">EXCEL file (.xlsx):</label>
            <input type="file" class="form-control" name="excel">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        <div class="modal-footer">
          <a href="/sample.xlsx" class="btn btn-primary">download sample excel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="{{ $modalMessage }}" tabindex="-1" aria-labelledby="{{ $modalMessage }}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $modalMessage }}Title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <form action="{{ route('message.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Licenses:</label>
            <select class="form-select mb-3" name="license_id">
              @foreach($licenses as $license)
                <option value="{{ $license->id }}">{{ $license->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Messenger:</label>
            <select class="form-select mb-3" name="messenger_id">
              @foreach($messengers as $messenger)
                <option value="{{ $messenger->id }}">{{ $messenger->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Phone:</label>
            <input type="text" class="form-control" name="phone">
          </div>
          <div class="mb-3">
            <label class="form-label">Text:</label>
            <input type="text" class="form-control" name="text">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection


@push('plugin-scripts')
  <!-- Plugin js import here -->
@endpush

@push('custom-scripts')
  <!-- Custom js here -->
@endpush