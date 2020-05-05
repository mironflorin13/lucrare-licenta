@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label for="location">Location</label>
                    <input  type="text" 
                            class="form-control @error('location') is-invalid @enderror"
                            id="location"
                            name="location"
                            value="{{old('title')??$user->dentist_profiles->location}}"
                            >
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address')??$user->dentist_profiles->address}}" >
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    
                    <label for="description">Description</label>
                    <textarea type="text"
                              class="form-control @error('description') is-invalid @enderror"
                              id="description"
                              rows="3"
                              name="description"
                              >{{$user->dentist_profiles->description}}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 
               
                <label for="imag">Profile Image</label>  
                <div class="custom-file">
                    
                    <label >Profile Picture</label>
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image" >Imagine</label>
                </div>
            
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>
@endsection