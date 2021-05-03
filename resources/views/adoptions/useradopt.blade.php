@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">My Adoption</center></div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Pet ID</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th colspan="3"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($adoptions as $adoption)
                                    @if ($adoption['user_id'] == Auth::id())

                                    <tr>
                                        <td>{{ $adoption['user_id'] }}</td>
                                        <td>{{ $adoption['petid'] }}</td>
                                        <td>{{ $adoption['status'] }}</td>
                                        <td><img style="width:70px%; height:70px" src="{{ asset('storage/images/' . App\Models\Animal::select('image')->where('id', $adoption['petid'])->get()->first()['image'] ) }}" alt=""></td>


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
