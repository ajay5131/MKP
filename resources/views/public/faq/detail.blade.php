@extends('public.layouts.layout')

@section('content')

    <section class="testimonials-section">
        <div class="container">

            <div class="panel-group" id="accordion">
                @foreach ($detail as $key => $value)
                    
                    <div class="faq-panel panel-default">
                        <div class="panel-heading">
                            <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" class="panel-title expand">
                                <a href="javascript:void(0);"><?php echo $value->question ?></a>
                            </h4>
                        </div>
                        <div id="collapse{{$key}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php echo $value->answer ?>
                            </div>
                        </div>
                    </div>

                @endforeach
                
            </div>
        </div>

    </section>

@endsection
