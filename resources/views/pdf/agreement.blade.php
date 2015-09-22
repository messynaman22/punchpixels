<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Agreement</title>
	{!! HTML::style("css/agreement.css") !!}
</head>
<body>
<div class="container ">

	@for ($i = 1; $i < 20; $i++)
		@if (isset($pdf_content['page_'.$i]))
            @if ($i>1)
			<div class="page-break"></div>
            @endif
			<div class="page page-height">
				<header>
                    <div>
                        <img class="logo m-l" src="{!! asset('images/logo.png') !!}" title="Credit1Solutions.com" alt="Credit1Solutions.com">
                    </div>
                    <div class="m-t">
                        <div class=" in" style="height:auto;width:630px">
                            <b>Customer Name / Serial No:</b> {!!  $step1_fname ." ".$step1_mname." ".$step1_lname !!} /  {!! $step1_serialno !!}
                        </div>
                        <div class="in"  style="height:auto;width:250px">
                            <b>Date / Time: </b> {!! $credit_report_date !!}
                        </div>
                    </div>
				</header>
				<section class="page" style="margin-top: -15px;">
					{!! $pdf_content['page_'.$i] !!}
				</section>
				<footer>
					<hr>
					<div>
						{!! $pdf_content['cancelation_policy'] !!}
					</div>
					<div class="text-center"><b>{!! $i !!}</b></div>
				</footer>
			</div>
		@endif
	@endfor

</div>
</body>
</html>