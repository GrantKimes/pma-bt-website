@extends('base')

@section('title', 'Order SV\'s')
@section('sv_order_tab', 'active')

@section('additional_includes')
  <!-- Datatables CSS -->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">-->
    
  <!-- Datatables JS -->
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
  <!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>-->


  <!-- My additional JS -->
  <script type="text/javascript" src="/js/sv.js"></script>
@endsection


@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class=" panel-title">Place an Order for Singing Valentines</h3>
        </div>
        <div class="panel-body">
          <p>We find the recipient during a class period and serenade them with a song, give them a rose and candy, and deliver any message you would like.</p> 
          <p>Each order costs $10, and can be paid with cash, Venmo (@JordanCraftPMA), or Paypal (SinfoniaBanking@gmail.com).</p> 
          <p>If you have any questions, you can send an email to <strong>SV@BetaTauPMA.org</strong>.</p>
        </div>
      </div>
    </div>


     

    
  </div>

{{-- {{ Form::open(array('url' => '/api/orders')) }} --}}
{{ Form::model($order, array('url' => array('/api/orders/{order}', $order->id))) }}
{{ Form::label('recipient_name', "Recipient's Name") }}
{{ Form::text('recipient_name')}}
{{ Form::close() }}


{{ $order }}

</div>

@endsection

