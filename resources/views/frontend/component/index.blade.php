@extends('frontend.layouts.app')

@section('title', __('Component'))

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col">
                <h3 class="d-flex align-self-end">Browse Components by Category</h3>
            </div>
            <div class="col-sm-2 text-right">
                <a class="btn btn-primary" href="{{ route('frontend.component.index.all') }}">View All </a>
            </div>
        </div>

        <div class="row justify-content-center pt-3">
            <div class="container">
                <div class="row equal">
                    @foreach ($componentType as $type)
                        @if ($type->parent()->count() == 0)
                            <div class="col-6 col-sm-3 col-md-2 p-1 d-flex">
                                <div class="text-center card">
                                    <a class="text-decoration-none"
                                        href="{{ route('frontend.component.category', $type) }}">
                                        <img class="img-fluid p-2 mx-auto" src="{{ $type->thumbURL() }}"
                                            alt="{{ $type->title }}" />
                                        <div class="p-1">
                                            {{ $type->title }} <br>({{ $type->inventoryCode() }})
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @if ($type->children()->count() == 0)
                                <!-- have children -->
                                @foreach ($type->children() as $child)
                                @endforeach
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            {{--  --}}

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3>Browse Components by Category</h3>

                    <div class="container">
                        <ul>
                            @foreach ($componentType as $type)
                                @if ($type->parent() == null)
                                    <li>
                                        <a href="{{ route('frontend.component.category', $type) }}">{{ $type->title }}</a>
                                        @if ($type->children() != null)
                                            <ul>
                                                @foreach ($type->children() as $child)
                                                    <li>
                                                        <a
                                                            href="{{ route('frontend.component.category', $child) }}">{{ $child->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
