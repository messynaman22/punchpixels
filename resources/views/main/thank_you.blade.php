@extends('mainContent')

@section('content')
    <div style="text-align: center">
        <p>
            Thanks for your registration
        </p>
        <p>payment status :{{$result['payment_status']}}</p>
    </div>
@endsection
@section('footer')
    {{--<script type="text/javascript">signup.step = 1;</script>--}}

@endsection

