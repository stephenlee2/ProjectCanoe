<!DOCTYPE html>
<html>
 <head>
  <title>Canoe Form</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Investment Form</h3><br />
   <div class="form-group">
    <select name="clinet_id" id="client_id" class="form-control input-lg dynamic" data-dependent="fund_id">
     <option value="">Select Client</option>
     @foreach($client_list as $client)
     <option value="{{ $client->client_id}}">Client{{ $client->client_id }}</option>
     @endforeach
    </select>
   </div>
   <br />
   <div class="form-group">
    <select name="fund_id" id="fund_id" class="form-control input-lg dynamic" data-dependent="amount">
     <option value="">Select Fund</option>
    </select>
   </div>
   <br />
   <div class="form-group">
    <select name="amount" id="amount" class="form-control input-lg" data-dependent="investment_id">
     <option value="">Select Amount</option>
    </select>
    
   <br />
   <br />
  </div>

    {{ csrf_field() }}

        <script type="text/javascript">
        $(document).ready(function(){
            $("#msg").hide();
            $("#submit").click(function(){
                $("#msg").show();
                var investment_id=$('#investment_id').val();
                var date=$('#date').val();
                var Percentage=$('#Percentage').val();
                var token=$('#token').val();

                $.ajax({
                    type: "post",
                    data: "investment_id=" + investment_id + "&date=" + date + "&Percentage=" + Percentage + "&_token=" + token,
                    data:{investment_id:investment_id, date:date, Percentage:Percentage, token:token},
                    url: "<?php echo url('/canoeform/submit') ?>",
                    success:function(){
                    $("#msg").html("cashflow has been inserted.");
                    $("#msg").fadeOut(2000);
                    }
                })
            })
        })
             
        </script>


    <h3 align="center">Insert Cash Flow</h3><br />
    <p id="msg" class="alert alert-success">
    <div class="form-group">
        <h3>Selected Investment ---<span id="insertHere"></span></h3><br>
        <input type="hidden" value="{{csrf_token()}}" id="token"/>
        <input class="form-control" type="text" name="investment_id" id="investment_id" value="">
        New Amount: <input class="form-control" type="text" name="amountshow" id="amountshow" value=""><br>
        Date: <input class="form-control" type="text" name="date" id="date" value=""><br>
        Percentage: <input class="form-control" type="text" name="Percentage" value="" id="Percentage"><br>
        <input class="btn btn-promary" type="submit" value="Submit" id="submit">
    </div>


    </div>

 </body>
</html>

    <script type="text/javascript">
    // Show seleted investment data
    //when last dropdown is selected
    $('#amount').change(function(){
    $value1=$('#client_id').val();
    $value2=$('#fund_id').val();
    $value3=$('#amount').val();
    var el = document.getElementById('insertHere');
    el.innerHTML = 'Client:' + $value1 + 'Fund:' + $value2 + 'Amount:' + $value3;
    document.getElementById("amountshow").value = $value3;
    })

    //Calculate Amount$ when percentage value is input
    $('#Percentage').on('keyup',function(){
    $pvalue=$(this).val();
    $value3=$('#amount').val();
    $newamount=$value3*(1+$pvalue);
    document.getElementById("amountshow").value = $newamount;
    })
    </script>


<script>
$(document).ready(function(){

 $('.dynamic').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('canoeform.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

 //get investment_id
  $('#amount').change(function(){
  if($('#amount').val() != '')
  {
    var clientid=$('#client_id').val();
    var fundid=$('#fund_id').val();
    var amount=$('#amount').val();
   $.ajax({
    url:"{{ route('canoeform.fetch2') }}",
    method:"POST",
    data:{clientid:clientid, fundid:fundid, amount:amount},
    success:function(result)
    {
     //investment_id -> into hidden input box
     document.getElementById("investment_id").value = result;
    }
   })
  }
 });


//reset
 $('#client_id').change(function(){
  $('#fund_id').val('');
  $('#amount').val('');
 });

 $('#client_id').change(function(){
  $('#amount').val('');
 });
 

});

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>