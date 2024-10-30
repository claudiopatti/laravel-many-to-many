@extends('layouts.app')

@section('page-title', $project->name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $project->name }}
                    </h1>
                    <h6 class="text-center">
                        Pubblicato il: {{ $project->created_at }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col text-end">
            <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning">
                Modifica
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $project->id }}
                        </li>
                        <li>
                            Slug: {{ $project->slug }}
                        </li>
                        <li>
                            Tempo di consegna: {{ $project->delivery_time }}
                        </li>
                        <li>
                            Prezzo: {{ $project->price }}
                        </li>
                        <li>
                            Completato: {{ $project->complete ? 'Si' : 'No' }}
                        </li>
                        <li>
                            Tipo collegato:

                            @if (isset($project->type))
                                <a href="{{ route('admin.types.show', ['type' => $project->type_id]) }}">
                                    {{ $project->type->name }}
                                </a>
                            @else
                                -
                            @endif
                        </li>
                    </ul>


                    <p>
                        {!! nl2br($project->description) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection