@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Display all animals</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date of Birth</th>
                                    <th>Animal Type</th>
                                    <th>Species</th>
                                    <th>Description</th>
                                    <th>Available</th>
                                    <th>Images</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($animals as $animal)
                                    <tr>
                                        <td>{{ $animal['name'] }}</td>
                                        <td>{{ $animal['date_of_birth'] }}</td>
                                        <td>{{ $animal['animal_type'] }}</td>
                                        <td>{{ $animal['species'] }}</td>
                                        <td>{{ $animal['description'] }}</td>
                                        <td>{{ $animal['available'] }}</td>
                                        <td><img style="width: 70px; height 70px"
                                                src="{{ asset('storage/images/' . $animal['image']) }}"></td>

                                        @if (Gate::denies('displayall') == false)
                                            <td><a href="{{ route('animals.show', ['animal' => $animal['id']]) }}"
                                                    class="btn btn-primary">Profile</a></td>
                                            <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}"
                                                    class="btn btn-warning">Edit</a></td>
                                            <td>

                                                <form
                                                    action="{{ action([App\Http\Controllers\AnimalController::class, 'destroy'], ['animal' => $animal['id']]) }}"
                                                    method="post">
                                                    @csrf


                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn btn-danger" type="submit"> Delete</button>

                                                </form>
                                            </td>

                                    @elseif (Gate::denies('displayall') == true)
                                    @if(App\Models\Adoption::select('status')->where('petid', $animal['id'])->exists())

                                    @if ((App\Models\Adoption::select('status')->where('petid', $animal['id'])->get()->first()['status'] == 'accepted'))



                                        @endif
                                    @else


                                                <td>

                                                    <form
                                                        action="{{ action([App\Http\Controllers\AdoptionController::class, 'store'], ['animal' => $animal['id']]) }}"
                                                        method="post">
                                                        @csrf
                                                        <a href="{{ route('animals.show', ['animal' => $animal['id']]) }}"
                                                        class="btn btn-link">Profile</a>

                                                        <input name="petid" type="hidden" value="{{ $animal['id'] }}">
                                                        <button class="btn btn-info" type="submit"> Adopt</button>

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

