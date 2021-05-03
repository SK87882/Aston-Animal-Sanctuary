@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Edit and update the animal</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br />
                    @endif
                    <div class="card-body">
                        <form class="form-horizontal" method="POST"
                            action="{{ route('animals.update', ['animal' => $animal['id']]) }}"
                            enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="col-md-8">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $animal->name }}" />
                            </div>

                            <div class="col-md-8">
                                <label>Available</label>
                                <select name="available" value="{{ $animal->available }}">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                            <label>Animal Type</label>
                                <select name="animal_type" value ="{{ $animal->animal_type}}">
                                    <option value="cat">Cat</option>
                                    <option value="dog">Dog</option>
                                    <option value="hamster">Hamster</option>
                                    <option value="snake">Snake</option>
                                    <option value="horse">Horse</option>
                                    <option value="fish">Fish</option>
                                    <option value="lizard">Lizard</option>
                                    <option value="bird">Bird</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label>Species</label>
                                <input type="text" name="species" value="{{ $animal->species }}" />
                            </div>

                            <div class="col-md-8">
                                <label>Description</label>
                                <input type="text" name="description" value="{{ $animal->description }}" />
                            </div>
                            <div class="col-md-8">
                                <label>date_of_birth</label>
                                <input type="date" name="date_of_birth" value="{{ $animal->date_of_birth }}" />
                            </div>

                            <div class="col-md-8">
                                <label>Image</label>
                                <input type="file" name="image" />
                            </div>

                            <div class="col-md-8">
                                <label>Image2</label>
                                <input type="file" name="image2" />
                            </div>

                            <div class="col-md-8">
                                <label>Image3</label>
                                <input type="file" name="image3" />
                            </div>


                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" />
                                <input type="reset" class="btn btn-danger" />
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
