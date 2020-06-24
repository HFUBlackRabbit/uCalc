@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="col-12">
                User: {{ $user['name'] }} (ID: {{ $user['id'] }})
            </h1>
            @forelse($questions as $question)
                <div class="col-6 p-1">
                    <div class="card">
                        <div class="card-header">
                            {{ $question['title'] }} ({{ $question['uuid'] }})
                        </div>
                        <div class="card-body">
                            <div>
                                <strong>created:</strong>
                                {{ $question['created_at'] }}
                            </div>
                            <div>
                                <strong>data:</strong>
                                <pre>
                                    @json($question['data'], JSON_PRETTY_PRINT)
                                </pre>
                            </div>
                            <div>
                                <strong>hash:</strong>
                                {{ $question['hash'] }}
                            </div>
                        <div>
                    </div>
                </div>

                <div class="card-header">
                    LABELS:
                </div>
                <div class="card-body">
                    @foreach($question['labels'] as $label)
                        <div>
                            <strong>uuid:</strong>
                            {{ $label['uuid'] }}
                        </div>
                        <div>
                            <strong>label:</strong>
                            {{ $label['label'] }}
                        </div>
                        <div>
                            <strong>position:</strong>
                            {{ $label['position'] }}
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
            @empty
                <div class="card">
                    <div class="card-body">
                        <h1>Empty :(</h1>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
