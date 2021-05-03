<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 ">
                <div class="card">
                    <div class="card-header">Add a new animal for Adoption</div>
                    <!-- display the errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    <!-- display the success status -->
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br />
                    @endif
                    <!-- define the form -->
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ url('animals') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-8">
                                <label>Animal Name</label>
                                <input type="text" name="name" placeholder="Animal Name" />
                            </div>
                            <div class="col-md-8">
                                <label>Available</label>
                                <select name="available">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label>Animal Type</label>
                                <select name="animal_type">
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
                                <input type="text" name="species" placeholder="Species" />
                            </div>

                            <div class="col-md-8">
                                <label>Description</label>
                                <input type="text" name="description" placeholder="Describe your pet" />
                            </div>
                            <div class="col-md-8">
                                <label>date_of_birth</label>
                                <input type="date" name="date_of_birth" placeholder="Date of birth" />
                            </div>

                            <div class="col-md-8">
                                <label>Image</label>
                                <input type="file" name="image" placeholder="Image file" />
                            </div>

                            <div class="col-md-8">
                                <label>Image 2</label>
                                <input type="file" name="image2" placeholder="Image file" />
                            </div>

                            <div class="col-md-8">
                                <label>Image 3</label>
                                <input type="file" name="image3" placeholder="Image file" />
                            </div>

                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" />
                                <input type="reset" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
