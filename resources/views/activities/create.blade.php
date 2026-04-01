@extends('layouts.app')

@section('title', 'Create Activity')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Create New Activity</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="/activities" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Activity Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" placeholder="e.g., Daily SMS Count Comparison" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="5" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Provide detailed description of the activity" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/activities" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Activity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
