{{-- resources/views/medications/create.blade.php --}}
@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1>
                <i class="fa fa-plus-circle"></i>
                {{ __('إضافة دواء جديد') }}
            </h1>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <form action="{{ route('medications.store') }}" method="POST">
                        @csrf

                        @include('medications._form', [ 'medication' => null ])

                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fa fa-save"></i>
                            {{ __('حفظ') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
