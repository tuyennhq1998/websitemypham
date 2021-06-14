@extends('layouts.app_master_user')
@section('css')
    <style>
		<?php $style = file_get_contents('css/user.min.css');echo $style;?>
        
        .css-tooltip:hover:after {
            content: attr(data-tooltip);
            position: absolute;
            z-index: 1;
            bottom: 100%;
            right: 0;
            width: 100%;
            background-color: rgba(251, 88, 88, 0.86);
            font-size: 11px;
            line-height: 1.6em;
            font-weight: 400;
            text-decoration: none;
            text-transform: none;
            text-align: center;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
@stop
@section('content')
    <section>
        <div class="title">Danh sách đơn hàng</div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col" style="text-align: center">Export</th>
                        <th scope="col" style="text-align: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td scope="row" style="text-align: center;position:relative;" data-tooltip='Click để xem chi tiết' class="css-tooltip" >
                            <a href="{{ route('get.user.order', $transaction->id) }}">DH{{ $transaction->id }}</a>
                        </td>
                        <td style="text-align: center">{{ $transaction->tst_name }}</td>
                        <td style="text-align: center">{{ number_format($transaction->tst_total_money,0,',','.') }} đ</td>
                        <td style="text-align: center">{{  $transaction->created_at }}</td>
                        <td style="text-align: center">
                            <span
                                class="label label-{{ $transaction->getStatus($transaction->tst_status)['class'] }}">
                                {{ $transaction->getStatus($transaction->tst_status)['name'] }}
                            </span>
                        </td>
                        <td style="text-align: center">
                            <a href="{{ route('ajax_get.user.invoice_transaction',$transaction->id) }}" target="_blank"
                               class="btn-xs label-success js-show-invoice_transaction" style="color: white"><i class="fa fa-save"></i> Export</a>
                        </td>
                        <td style="text-align: center">
                            @if (!in_array($transaction->tst_status , [-1,2,3]) )
                                <a href="{{ route('get.user.transaction.cancel',$transaction->id) }}" 
                                   class="btn-xs label-danger" style="color: white"><i class="fa fa-save"></i> Huỷ đơn</a>
                           @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="display: block;">
            {!! $transactions->appends($query ?? [])->links() !!}
        </div>
    </section>
@stop

@section('script')
    <div id="popup-transaction" class="modal text-center">
        <div class="header">Hoá đơn mua hang</div>
        <div class="content">

        </div>
        <div class="footer">
            <a href="#" rel="modal:close" class="btn btn-pink ">Đóng</a>
            <a href="" class="btn btn-purple js-export-pdf"> Export PDF</a>
        </div>
    </div>
@stop