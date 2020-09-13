@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('partials.messages')
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        @foreach ($text as $t)
                        {{ $t }}
                        @endforeach
                        {{-- <input id="text" type="text" class="form-control" name="text" value="{{ old('text') ?? $text ?? null }}" required autocomplete="off"> --}}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <div class="btn-group">
                            <h2 class="m-0 text-dark">Dashboard</h2>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="btn-group">
                            <a class="btn bg-primary font-weight-bold mr-1 mb-1" href="{{ url('employee/add') }}">
                                <i class="fas fa-plus mr-2"></i>
                                @lang(__(' Add Data'))
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive" id="users-table-wrapper">
                        <table class="table table-striped table-borderless fixed" id="datatable">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Employee Number</th>
                                    <th style="text-align:center">Last Name</th>
                                    <th style="text-align:center">First Name</th>
                                    <th style="text-align:center;min-width:50px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data))
                                    @foreach ($data as $d)
                                    <tr>
                                        <td style="text-align:center">{{ $d->employeeNumber }}</td>
                                        <td style="text-align:center">{{ $d->lastName }}</td>
                                        <td style="text-align:center">{{ $d->firstName }}</td>
                                        <td style="text-align:center">
                                            <a class="btn-sm bg-primary font-weight-bold mr-1 mb-1" href="{{ url('employee/'.$d->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn-sm bg-danger font-weight-bold ml-1 mb-1" href="{{ url('employee/'.$d->id.'/destroy') }}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6"><em>@lang('No records found.')</em></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
