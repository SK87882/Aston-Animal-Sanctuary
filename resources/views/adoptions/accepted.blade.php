@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Accepted Adoptions</center></div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Pet ID</th>
                                    <th>Status</th>
                                    <th colspan="3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adoptions as $adoption)
                                    @if ($adoption['status'] == 'accepted')
                                    <tr>
                                        <td>{{ $adoption['user_id'] }}</td>
                                        <td>{{  (App\Models\User::select('name')->where('id', $adoption['user_id'])->get()->first()['name'])}}
                                        <td>{{ $adoption['petid'] }}</td>
                                        <td>{{ $adoption['status'] }}</td>
                                    </tr>


                                    @endif
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
