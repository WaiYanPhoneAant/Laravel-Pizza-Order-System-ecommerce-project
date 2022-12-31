@extends('user.layouts.master')

@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="col-md-8 m-auto">
        <a onclick="history.back()" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-3"></i>back</a>
    </div>
    <div class="row px-xl-5 mt-3">
        
        <div class=" col-lg-8 table-responsive mb-5 m-auto"  style="height: 400px;">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Order Id</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle " id="dataTable">
                   
                    @foreach ($orderData as $od)
                    <tr>
                       
                        <td class="align-middle  text-black">
                           {{$od->created_at}}
                        </td>
                        <td class="align-middle  text-black">
                            {{$od->order_code}}
                         </td>
                         <td class="align-middle  text-black">
                            {{$od->total_price}} $
                         </td>
                         <td class="align-middle  text-black">
                            @if ($od->status===0)
                                <div class="text-info">
                                    <i class="fa-solid fa-clock-rotate-left me-2"></i>pending
                                </div>
                            @elseif($od->status===1)
                            <div class="text-success">
                                <i class="fa-solid fa-check me-2"></i>Success
                            </div>
                            @elseif($od->status===2)
                            <div class="text-danger">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>Denine
                            </div>
                            @endif
                         </td>
                       
                    </tr>
                    @endforeach
                   
                </tbody>
                
            </table>
            {{$orderData->links()}}
            {{-- @if (count($cartList)==0)
                    <h5 class="text-black-50 text-center mt-5">
                        There is no cart here!
                    </h5>
            @endif --}}
        </div>
      
    </div>
</div>
<!-- Cart End -->

@endsection
@section('scriptSource')
<script>
    $(document).ready(function () {


    });
    
    
</script>
@endsection