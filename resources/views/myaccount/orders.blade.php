<!-- Author: Sergio Córdoba -->
@extends('layouts.app') 
@section('title', trans('app.titles.order'))  
@section('content') 
@forelse ($viewData["orders"] as $order) 
<div class="card mb-4"> 
    <div class="card-header"> 
        <strong>Order #{{ $order->getId() }}</strong> 
    </div> 
    <div class="card-body"> 
        <b>Date:</b> {{ $order->getCreatedAt() }}<br/> 
        <b>Total:</b> ${{ $order->getTotal() }}<br/>
        <table class="table table-bordered table-striped text-center mt-3"> 
            <thead> 
                <tr> 
                    <th scope="col">Item ID</th> 
                    <th scope="col">Travel Title</th> 
                    <th scope="col">Price</th> 
                    <th scope="col">Quantity</th> 
                </tr> 
            </thead> 
            <tbody> 
                @foreach ($order->getItems() as $item) 
                    <tr> 
                    <td>{{ $item->getId() }}</td> 
                    <td> 
                        <a class="link-success" href="{{ route('travel.show', ['id'=> $item->getTravel()->getId()]) }}"> 
                        {{ $item->getTravel()->getTitle() }} 
                        </a> 
                    </td> 
                    <td>${{ $item->getPrice() }}</td> 
                    <td>{{ $item->getQuantity() }}</td>
                    </tr> 
                @endforeach
                <br> 
                <form action="{{ route('order.download', ['id' => $order->id]) }}" method="GET">
                @csrf
                    <button class="btn bg-primary text-white" type="submit">@lang('app.order.download_order')</button>
                </form>
            </tbody> 
        </table> 
    </div> 
</div> 
@empty 
    <div class="alert alert-danger" role="alert"> 
        Seems to be that you have not purchased anything in our store =(. 
    </div> 
@endforelse 
@endsection
