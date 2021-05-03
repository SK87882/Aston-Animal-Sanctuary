@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Adoptions</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>UserID</th>
                                    <th>PetID</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th colspan="5">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adoptions as $adoption)
                                    <tr>
                                        <td>{{ $adoption['user_id'] }}</td>
                                        <td>{{ $adoption['petid'] }}</td>
                                        <td>{{ $adoption['status'] }}</td>
                                        <td><img style="width:100px; height:100px" src="{{ asset('storage/images/' . App\Models\Animal::select('image2')->where('id', $adoption['petid'])->get()->first()['image2']) }}"
                                            alt=""></td>

                                     @if(App\Models\Adoption::select('status')->where('petid', $adoption['petid'])->where('user_id', $adoption['user_id'])->exists())

                                         @if ((App\Models\Adoption::select('status')->where('petid', $adoption['petid'])->where('user_id', $adoption['user_id'])->get()->first()['status'] == 'accepted'))
                                         <td></td>
                                         @elseif ((App\Models\Adoption::select('status')->where('petid', $adoption['petid'])->where('user_id', $adoption['user_id'])->get()->first()['status'] == 'rejected'))
                                         <td></td>

                                         @else

                                      <td>
                                            <form
                                                action="{{ action([App\Http\Controllers\AdoptionController::class, 'create'], ['adoption' => $adoption['status'], $adoption['id']]) }}"
                                                method="get">
                                                @csrf
                                                <input name="user_id" type="hidden" value="{{ $adoption['user_id'] }}">
                                                <input name="petid" type="hidden" value="{{ $adoption['petid'] }}">
                                                 <button class="btn btn-primary" type="submit"> Accept</button>
                                               </form>
                                        </td>

                                        <td>
                                            <form
                                                action="{{ action([App\Http\Controllers\AdoptionController::class, 'update'], ['adoption' => $adoption['status'], $adoption['id']]) }}"
                                                method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="PATCH">
                                                <input name="user_id" type="hidden" value="{{ $adoption['user_id'] }}">
                                                <input name="petid" type="hidden" value="{{ $adoption['petid'] }}">
                                                <button class="btn btn-warning" type="submit"> Reject</button>
                                            </form>
                                        </td>

                                        @endif
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

