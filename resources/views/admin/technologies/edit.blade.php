@extends('layouts.app')

@section('page-title', 'Modifica Tecnologia')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Modifica Tecnologia: {{ $technology->name }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert—danger mb—4 bg-white">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.technologies.update', ['technology' => $technology->id]) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input technology="text" class="form-control" id="name" name="name" required minlength="3" maxlength="128" value="{{ old('name', $technology->name) }}" placeholder="Inserisci il nome della tecnologia....">
                        </div>

                        <div class="text-center">
                            <button technology="submit" class="btn btn-warning w-75 text-center">
                                Aggiorna
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection